<?php

namespace App\Http\Controllers\Admin;

use App\Events\ConfirmedSale;
use App\Events\FormSubmitted;
use App\Events\PaymentRecieved;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\CustomPayment;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;


class PaymentController extends Controller
{
    protected $payment;

    public function __construct(PaymentService $payment)
    {
        $this->payment = $payment;
    }

    public function checkout(Request $request)
    {

        $validated = $request->validate([
            'method' => 'required|string|in:stripe,paypal',
        ]);
        $bookingId = session('booking_id');
        if (!$bookingId) {
            abort(404);
        }
        $booking = Booking::findOrFail($bookingId);

        $amount = $booking->total_price - ($booking->discount ?? 0);
        $validated['amount'] = $amount;
        $validated['booking_id'] = $bookingId;
        $response = $this->payment->pay($validated['method'], $validated);
        if (isset($response['url'])) {
            return redirect()->away($response['url']);
        }
        return back()->with('error', 'Payment could not be initiated.');
    }
    public function stripeWebhook(Request $request)
    {
        $endpointSecret = setting('webhook_secret');

        // Grab the EXACT raw body + signature
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        // 1) Verify signature
        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid Stripe payload', ['error' => $e->getMessage()]);
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid Stripe signature', ['error' => $e->getMessage()]);
            return response('Invalid signature', 400);
        }

        // 3) Handle only the event types you expect
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $type    = $session->metadata->payment_type ?? null;

            if ($type === 'booking_payment') {
                $booking = Booking::where('ss_id', $session->id)->first();
                if (!$booking) {
                    Log::warning('Booking not found for session', ['session_id' => $session->id]);
                } else {
                    $booking->status = 'Completed';
                    $booking->save();

                    Log::info('Booking marked Completed', ['booking_id' => $booking->id]);
                }
            } elseif ($type === 'custom_payment') {
                $payment = CustomPayment::where('ss_id', $session->id)->first();
                if (! $payment) {
                    Log::warning('CustomPayment not found for session', ['session_id' => $session->id]);
                } else {
                    $payment->status = 'Completed';
                    $payment->save();
                    Log::info('CustomPayment marked Completed', ['payment_id' => $payment->id]);
                }
            }
        }


        return response('Webhook received', 200);
    }
    public function webhook(Request $request)
    {
        $event = $request->all();
        Log::info('PayPal Webhook Received:', $event);
        if ($event['event_type'] === 'PAYMENT.CAPTURE.COMPLETED') {
            $resource = $event['resource'];
            $paypalOrderId = $resource['id'];
            $customId = $resource['custom_id'] ?? null;

            Booking::where('paypal_order_id', $paypalOrderId)
                ->update([
                    'status' => 'Completed'
                ]);

            Log::info("Payment {$paypalOrderId} marked as completed.");
        }

        return response()->json(['status' => 'Webhook received'], 200);
    }
}

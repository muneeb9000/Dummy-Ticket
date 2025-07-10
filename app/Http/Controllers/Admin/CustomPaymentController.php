<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomPaymentRequest;
use App\Models\CustomPayment;
use Stripe\Stripe;
use App\Events\CustomPaymentCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomPaymentController extends Controller
{
    public function index(Request $request)
    {
           if (!Auth::user()->can('custom-payment.view')) {
        abort(403, 'Unauthorized Access');
    }

        $customPayments = CustomPayment::all();
        return view('admin.pages.custom_payments.index', compact('customPayments'));
    }

    public function store(StoreCustomPaymentRequest $request)
    {
        // 1) get validated data
        $data = $request->validated();

        // 2) define same fixed‐price map you have in Alpine
        $fixedPrices = [
            'flight_correction'        => 15,
            'hotel_correction'         => 15,
            'flight_hotel_correction'  => 20,
            'urgent_8h'                => 15,
            'urgent_6h'                => 30,
        ];

        // 3) pick the amount: fixed if in map, otherwise custom_amount
        $serviceType = $data['service_type'];
        if (array_key_exists($serviceType, $fixedPrices)) {
            $amount = $fixedPrices[$serviceType];
        } else {
            // custom_amount was validated to be numeric ≥ 0.01
            $amount = $data['custom_amount'];
        }

        // 4) persist your CustomPayment (store the real amount paid)
        $customPayment = CustomPayment::create([
            'first_name'    => $data['first_name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'order_number'  => $data['order_number'],
            'service_type'  => $serviceType,
            // store the actual $amount, whether fixed or custom
            'custom_amount' => $amount,
            'status'        => 'Pending',
        ]);

        event(new CustomPaymentCreated($customPayment));
        // 5) create your Stripe Checkout Session using $amount
        Stripe::setApiKey(setting('stripe_key'));
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => ucwords(str_replace('_', ' ', $serviceType)),
                        ],
                        // Stripe wants cents!
                        'unit_amount'  => (int) round($amount * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode'           => 'payment',
                'success_url'    => route('website.custom.thankyou') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'     => route('website.custom-payment'),
                'metadata'       => [
                    "payment_type" => "custom_payment",
                    'payment_id' => $customPayment->id,
                ],
            ], [
                'idempotency_key' => 'custom_' . $customPayment->id . '_' . time()
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error('Stripe session creation failed', ['error' => $e->getMessage()]);
            throw new \Exception('Payment initialization failed. Please try again.');
        }
        // 6) save the session ID and redirect
        $customPayment->update(['ss_id' => $session->id]);

        return redirect($session->url);
    }
}

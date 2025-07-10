<?php

namespace App\Repositories\Payments;

use App\Contracts\PaymentGatewayInterface;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use Illuminate\Support\Str;
use Stripe\Exception\ApiErrorException;

class StripeGateway implements PaymentGatewayInterface
{
    public function charge(array $data)
    {

        Stripe::setApiKey(setting('stripe_key'));

        $booking = Booking::with([
            'flightReservations',
            'hotelBookings',
            'travelInsurances',
            'travelGuides',
            'travelers'
        ])->findOrFail($data['booking_id']);

        $lineItems = [];
        $discounts = [];

        // Flight & Hotel Combined
        if (
            $booking->type === 'FlightAndHotelBooking' &&
            $booking->flight_reservation && $booking->hotel_booking &&
            $booking->flightReservations && $booking->hotelBookings
        ) {
            $combinedPrice = $booking->flightReservations->price + $booking->hotelBookings->price;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => (int) round($combinedPrice * 100),
                    'product_data' => [
                        'name' => 'Flight & Hotel Booking x ' . $booking->no_of_travelers,
                    ],
                ],
                'quantity' => 1,
            ];
        } else {
            // Flight Reservation
            if ($booking->flight_reservation && $booking->flightReservations) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => (int) round($booking->flightReservations->price * 100),
                        'product_data' => [
                            'name' => 'Flight Reservation x ' . $booking->flightReservations->no_of_travelers,
                        ],
                    ],
                    'quantity' => 1,
                ];
            }

            // Hotel Booking
            if ($booking->hotel_booking && $booking->hotelBookings) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => (int) round($booking->hotelBookings->price * 100),
                        'product_data' => [
                            'name' => 'Hotel Booking x ' . $booking->hotelBookings->no_of_travelers,
                        ],
                    ],
                    'quantity' => 1,
                ];
            }
        }

        // Travel Insurance
        if ($booking->travel_insurance && $booking->travelInsurances) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => (int) round($booking->travelInsurances->price * 100),
                    'product_data' => [
                        'name' => 'Travel Insurance x ' . $booking->travelInsurances->no_of_travelers,
                    ],
                ],
                'quantity' => 1,
            ];
        }

        // Travel Guide
        if ($booking->travel_guide && $booking->travelGuides) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => (int) round($booking->travelGuides->price * 100),
                    'product_data' => [
                        'name' => 'Travel Guide x ' . $booking->travelGuides->no_of_cities,
                    ],
                ],
                'quantity' => 1,
            ];
        }

        // Urgent Reservation
        $urgentPrice = null;
        if ($booking->urgent_reservation == 1) {
            $urgentPrice = 30;
        } elseif ($booking->urgent_reservation == 2) {
            $urgentPrice = 15;
        }

        if (!is_null($urgentPrice)) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $urgentPrice * 100,
                    'product_data' => [
                        'name' => 'Urgent Reservation Fee',
                    ],
                ],
                'quantity' => 1,
            ];
        }

        // Handle discount using Stripe Coupons
        if ($booking->discount !== null && $booking->discount > 0) {
            try {
                // Create a one-time coupon for this specific discount
                $coupon = \Stripe\Coupon::create([
                    'amount_off' => (int) round($booking->discount * 100),
                    'currency' => 'usd',
                    'duration' => 'once',
                    'name' => 'Booking Discount',
                    'metadata' => [
                        'booking_id' => $booking->id,
                        'discount_amount' => $booking->discount,
                    ],
                ]);

                $discounts[] = [
                    'coupon' => $coupon->id,
                ];
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                \Log::error('Failed to create Stripe coupon: ' . $e->getMessage());
                // You might want to fall back to negative line item approach here
            }
        }

        // Calculate total for metadata
        $totalAmount = $booking->total_price;
        if ($booking->discount !== null) {
            $totalAmount -= $booking->discount;
        }

        $thankyou = '';
        switch ($booking->type) {
            case 'FlightReservation':
                $thankyou = route('website.flight.thankyou') . '?session_id={CHECKOUT_SESSION_ID}';
                break;

            case 'HotelBooking':
                $thankyou = route('website.hotel.thankyou') . '?session_id={CHECKOUT_SESSION_ID}';
                break;

            case 'FlightAndHotelBooking':
                $thankyou = route('website.hotel.flight.thankyou') . '?session_id={CHECKOUT_SESSION_ID}';
                break;

            case 'TravelInsurance':
                $thankyou = route('website.insurance.thankyou') . '?session_id={CHECKOUT_SESSION_ID}';
                break;

            case 'TravelGuides':
                $thankyou = route('website.visa.thankyou') . '?session_id={CHECKOUT_SESSION_ID}';
                break;

            default:
                abort(404);
                break;
        }

        $cancel = '';
        switch ($booking->type) {
            case 'FlightReservation':
                $cancel = '/get-flight-itinerary-for-visa';
                break;

            case 'HotelBooking':
                $cancel = '/get-hotel-booking-for-visa';
                break;

            case 'FlightAndHotelBooking':
                $cancel = '/get-flight-itinerary-and-hotel-bookings-for-visa';
                break;

            case 'TravelInsurance':
                $cancel = '/get-travel-insurance-for-visa';
                break;

            case 'TravelGuides':
                $cancel = '/get-travel-guides-for-visa';
                break;

            default:
                $cancel = '/cancel-payment';
                break;
        }

        // Prepare session data
        $sessionData = [
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url($thankyou),
            'cancel_url' => url($cancel),
            'metadata' => [
                "payment_type" => "booking_payment",
                'booking_id' => $booking->id,
                'original_total' => $booking->total_price,
                'discount_applied' => $booking->discount ?? 0,
                'final_total' => $totalAmount,
            ],
        ];
        $idempotencyKey = 'booking_'
            . $booking->id
            . '_'
            . time()
            . '_'
            . Str::random(8);
        // Add discounts if any
        if (!empty($discounts)) {
            $sessionData['discounts'] = $discounts;
        }

        try {
            $session = Session::create(
                $sessionData,
                ['idempotency_key' => $idempotencyKey]
            );
        } catch (ApiErrorException $e) {
            Log::error('Stripe session creation failed', [
                'error'            => $e->getMessage(),
                'booking_id'       => $booking->id,
                'idempotency_key'  => $idempotencyKey,
            ]);
            throw new \Exception('Payment session could not be created. Please try again.');
        }
        $booking->update(["ss_id" => $session->id]);
        return [
            'session_id' => $session->id,
            'url' => $session->url,
            'amount' => $totalAmount,
            'discount_applied' => $booking->discount ?? 0,
            'original_amount' => $booking->total_price,
        ];
    }
}

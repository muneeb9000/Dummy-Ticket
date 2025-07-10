<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlightAndHotelRequest;
use App\Http\Requests\FlightReservationRequest;
use App\Http\Requests\HotelBookingRequest;
use App\Http\Requests\TravelGuideRequest;
use App\Http\Requests\TravelInsuranceRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\BookingStorageService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\CalculationService;
use App\Events\FormSubmitted;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Events\ConfirmedSale;
use App\Events\PaymentRecieved;

class BookingController extends Controller
{
    protected BookingStorageService $bookingStorageService;

    public function __construct(BookingStorageService $bookingStorageService)
    {
        $this->bookingStorageService = $bookingStorageService;
    }

    public function index()
    {
          if (!Auth::user()->can('bookings.view')) {
                abort(403, 'Unauthorized Access');
            }
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.pages.bookings.index', compact('bookings'));
    }

   public function approve(Request $request)
    {
      
        if (!Auth::user()->can('bookings.approval')) {
            abort(403, 'Unauthorized Access');
        }
      
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'status' => 'required|string',
            'options' => 'nullable|array',
            'options.*' => 'string',
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->status = $request->status;
        $booking->save();

        $options = $request->options ?? [];

        if (in_array('formSubmissionNotification', $options)) {
            event(new FormSubmitted($booking));
        }
        if (in_array('receivedPaymentNow', $options)) {
            event(new PaymentRecieved($booking));
        }
        if (in_array('confirmedSales', $options)) {
            event(new ConfirmedSale($booking));
        }

        return redirect()->back()->with('success', 'Action performed successfully.');
    }

    public function store(FlightReservationRequest $request, CalculationService $calculator)
    {

        $allData = $request->all();
        $allData['form-type'] = 'FlightReservation';

        $this->validateCalculatedValues($allData, $calculator);

        try {
            session()->forget(['booking_id', 'coupon_amount', 'applied_coupon']);
            $booking = $this->bookingStorageService->store($allData);
            $orderNo = $booking->id . strtoupper(Str::random(17));
            $booking->order_no = $orderNo;
            $booking->save();
            session(['booking_id' => $booking->id]);


            return redirect()->route('website.payyourbill');
        } catch (\Exception $e) {
            Log::error('Booking creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(404);
        }
    }
    public function storeHotel(HotelBookingRequest $request, CalculationService $calculator)
    {
        $allData = $request->all();
        $allData['form-type'] = 'HotelBooking';

        $this->validateCalculatedValues($allData, $calculator);

        try {
            session()->forget(['booking_id', 'coupon_amount', 'applied_coupon']);
            $booking = $this->bookingStorageService->store($allData);
            $orderNo = $booking->id . strtoupper(Str::random(17));
            $booking->order_no = $orderNo;
            $booking->save();
            session(['booking_id' => $booking->id]);


            return redirect()->route('website.payyourbill');
        } catch (\Exception $e) {
            Log::error('Booking creation or payment failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            abort(404);
        }
    }
    public function storeFlightAndHotel(FlightAndHotelRequest $request, CalculationService $calculator)
    {
        $allData = $request->all();
        $allData['form-type'] = 'FlightAndHotelBooking';

        $allData['total_flight_reservation_travelers'] = $allData['total_flight_and_hotel_reservation_travellers'];
        $allData['total_hotel_booking_travelers'] = $allData['total_flight_and_hotel_reservation_travellers'];

        $this->validateCalculatedValues($allData, $calculator);

        try {
            session()->forget(['booking_id', 'coupon_amount', 'applied_coupon']);
            $booking = $this->bookingStorageService->store($allData);
            $orderNo = $booking->id . strtoupper(Str::random(17));
            $booking->order_no = $orderNo;
            $booking->save();
            session(['booking_id' => $booking->id]);



            return redirect()->route('website.payyourbill');
        } catch (\Exception $e) {
            Log::error('Booking creation or payment failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            abort(404);
        }
    }
    public function storeTravelInsurance(TravelInsuranceRequest $request, CalculationService $calculator)
    {
        $allData = $request->all();
        $allData['form-type'] = 'TravelInsurance';
        $allData['total_hotel_booking_travelers'] = $allData['total_flight_reservation_travelers'];

        $this->validateCalculatedValues($allData, $calculator);

        try {
            $booking = $this->bookingStorageService->store($allData);
            $orderNo = $booking->id . strtoupper(Str::random(17));
            $booking->order_no = $orderNo;
            $booking->save();
            session(['booking_id' => $booking->id]);


            return redirect()->route('website.payyourbill');
        } catch (\Exception $e) {
            Log::error('Booking creation or payment failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            abort(404);
        }
    }
    public function storeTravelGuide(TravelGuideRequest $request, CalculationService $calculator)
    {
        $allData = $request->all();
        $allData['form-type'] = 'TravelGuides';
        $allData['total_hotel_booking_travelers'] = $allData['total_flight_reservation_travelers'];

        $this->validateCalculatedValues($allData, $calculator);

        try {
            $booking = $this->bookingStorageService->store($allData);
            $orderNo = $booking->id . strtoupper(Str::random(17));
            $booking->order_no = $orderNo;
            $booking->save();
            session(['booking_id' => $booking->id]);



            return redirect()->route('website.payyourbill');
        } catch (\Exception $e) {
            Log::error('Booking creation or payment failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            abort(404);
        }
    }

    private function validateCalculatedValues(array $allData, CalculationService $calculator, array $options = [])
    {
        $formType = $allData['form-type'];

        if ($formType === 'FlightAndHotelBooking') {
            $flightAndHotel = $calculator->calculateFlightAndHotelBooking($allData);
            $submitted = (float) ($allData['total_flight_reservation_&_hotel_bookings_price'] ?? 0);
            if (round((float) $flightAndHotel, 2) !== round($submitted, 2)) {
                dd('Corrupt Value', $flightAndHotel, $submitted);
            }
        } else {
            $flightPrice = $calculator->calculateFlightReservation($allData);
            $submitted = (float) ($allData['total_flight_reservation_price'] ?? 0);
            if ($flightPrice && round((float) $flightPrice, 2) !== round($submitted, 2)) {
                dd('Corrupt Value', $flightPrice, $submitted);
            }

            $hotelPrice = $calculator->calculateHotelBooking($allData);
            $submitted = (float) ($allData['total_hotel_booking_price'] ?? 0);
            if ($hotelPrice && round((float) $hotelPrice, 2) !== round($submitted, 2)) {
                dd('Corrupt Value', $hotelPrice, $submitted);
            }
        }

        $insurancePrice = $calculator->calculateTravelInsurance($allData);
        $submitted = (float) ($allData['total_travel_insurance_price'] ?? 0);
        if ($insurancePrice && round((float) $insurancePrice, 2) !== round($submitted, 2)) {
            dd('Corrupt Value', $insurancePrice, $submitted);
        }

        $guidesPrice = $calculator->calculateTravelGuides($allData);
        $submitted = (float) ($allData['total_travel_guides_price'] ?? 0);
        if ($guidesPrice && round((float) $guidesPrice, 2) !== round($submitted, 2)) {
            dd('Corrupt Value', $guidesPrice, $submitted);
        }

        $urgentPrice = $calculator->calculateUrgentReservation($allData);
        $flag = $allData['urgent_reservation'] ?? 0;
        $submittedUrgentPrice = $flag == 1 ? 30 : ($flag == 2 ? 15 : 0);
        if ($urgentPrice && round((float) $urgentPrice, 2) !== round((float) $submittedUrgentPrice, 2)) {
            dd('Corrupt Value', $urgentPrice, $submittedUrgentPrice);
        }

        $totalOrder = $calculator->calculateTotalOrder($allData, $formType === 'FlightAndHotelBooking');
        $submitted = (float) ($allData['total_order'] ?? 0);
        if ($totalOrder && round((float) $totalOrder, 2) !== round($submitted, 2)) {
            dd('Corrupt Value', $totalOrder, $submitted);
        }
    }

    public function formDetail(Booking $booking)
    {
          if (!Auth::user()->can('bookings.view')) {
                abort(403, 'Unauthorized Access');
            }
        $view = match ($booking->type) {
            'FlightReservation' => 'admin.pages.bookings.flight-reservation',
            'HotelBooking'      => 'admin.pages.bookings.hotel-reservation',
            'TravelInsurance'   => 'admin.pages.bookings.travel-insurance',
            'TravelGuides'       => 'admin.pages.bookings.travel-guide',
            'FlightAndHotelBooking' => 'admin.pages.bookings.flight-plus-hotel',
        };
        return view($view, compact('booking'));
    }
}

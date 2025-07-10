<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

       public function index(Request $request)
    {
           if (!Auth::user()->can('coupons.view')) {
        abort(403, 'Unauthorized Access');
      }
        if ($request->ajax()) {
            $coupons = $this->service->all();
       
            return response()->json([
                'draw' => $request->input('draw', 1),
                'recordsTotal' => Coupon::count(),
                'recordsFiltered' => Coupon::count(),
                'data' => $coupons
            ]);
        }

        return view('admin.pages.coupons.index');
    }

    public function store(StoreCouponRequest $request)
    {

           if (!Auth::user()->can('coupons.create')) {
        abort(403, 'Unauthorized Access');
    }
        $coupon = $this->service->create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Coupon created successfully.',
            'data' => $coupon
        ]);
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        
           if (!Auth::user()->can('coupons.edit')) {
        abort(403, 'Unauthorized Access');
    }
      
        $updated = $this->service->update($coupon, $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Coupon updated successfully.',
            'data' => $updated
        ]);
    }

    public function destroy(Coupon $coupon)
    {
        
           if (!Auth::user()->can('coupons.delete')) {
        abort(403, 'Unauthorized Access');
    }
        $this->service->delete($coupon);
        
        return response()->json([
            'success' => true,
            'message' => 'Coupon deleted successfully.'
        ]);
    }

    public function applyCoupon(Request $request)
    {
     
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $bookingId = session('booking_id');

        if (!$bookingId) {
            return response()->json(['status' => 'error', 'message' => 'Booking not found.'], 404);
        }

        if (session('applied_coupon') === $request->coupon_code) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon has already been applied.',
            ], 409);
        }

        $booking = Booking::findOrFail($bookingId);
       
       
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return response()->json(['status' => 'error', 'message' => 'Invalid coupon code.'], 404);
        }

        if ($coupon->status !== 'active') {
         return response()->json(['status' => 'error', 'message' => 'Coupon status is not valid.'], 404);
        }
      
        if ($coupon->usage_limit > 0 && $coupon->coupon_usage >= $coupon->usage_limit) {
            return response()->json(['status' => 'error', 'message' => 'Coupon usage limit exceeded.'], 400);
        }


        if (now()->gt($coupon->expiry_date)) {
            return response()->json(['status' => 'error', 'message' => 'Coupon has expired.'], 400);
        }
    
        $bookingServices = [
            'flight'    => $booking->flight_reservation,
            'hotel'     => $booking->hotel_booking,
            'insurance' => $booking->travel_insurance,
            'guide'     => $booking->travel_guide,
        ];

        $couponServices = [
            'flight'    => $coupon->flight,
            'hotel'     => $coupon->hotel,
            'insurance' => $coupon->insurance,
            'guide'     => $coupon->guide,
        ];

       if ($bookingServices !== $couponServices) {
            return response()->json([
                'status' => 'error',
                'message' => 'This coupon is not valid for the selected services.',
            ], 400);
        }

        $discount = ($coupon->percentage / 100) * $booking->total_price;
        $booking->discount = $discount;
        $booking->save();

        $coupon->increment('coupon_usage');

        session([
            'total_price' => $booking->total_price - $discount,
            'coupon_amount' => $discount,
            'applied_coupon' => $request->coupon_code,
        ]);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Coupon applied successfully!',
            'discount_amount' => $discount,
            'new_total' => $booking->total_price - $discount,
        ]);
    }

}
<?php 

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    public function create(array $data): Coupon
    {
        $data['form'] = 'percentage'; 
        return Coupon::create($data);
    }

    public function update(Coupon $coupon, array $data): Coupon
    {
        $data['form'] = 'percentage'; 
        $coupon->update($data);
        return $coupon;
    }

    public function delete(Coupon $coupon): bool
    {
        return $coupon->delete();
    }

    public function all()
    {
        return Coupon::with('creator')
            ->latest()
            ->get()
            ->map(function ($coupon) {
                return [
                    'id' => $coupon->id,
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'percentage' => $coupon->percentage,
                    'status' => $coupon->status,
                    'usage_limit' => $coupon->usage_limit,
                    'expiry_date' => $coupon->expiry_date?->toDateString(),
                    'usages_count' => $coupon->coupon_usage,
                    'created_at' => $coupon->created_at->toDateString(),
                    'flight' => $coupon->flight,
                    'hotel' => $coupon->hotel,
                    'insurance' => $coupon->insurance,
                    'guide' => $coupon->guide,
                ];
            });
    }

}
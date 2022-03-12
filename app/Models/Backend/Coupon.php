<?php

namespace App\Models\Backend;

use App\Models\Frontend\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['code', 'start_time', 'end_time', 'limit', 'percent', 'min_price', 'status'];

    public function scopeCreateNewCoupon()
    {
        $start_time = Carbon::create(request()->start_time);

        $end_time = Carbon::create(request()->end_time);

        $start_time->toDateTimeString();

        $end_time->toDateTimeString();

        $coupon = $this->create([
            'code' => request()->code,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'limit' => request()->limit,
            'percent' => request()->percent,
            'min_price' => request()->min_price,
            'status' => request()->status,
        ]);

        return $coupon;
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFindByCode($query, $code)
    {
        if ($code) {
            $code = $this->where('code', $code)->first();

            if ($code) {
                return $code;
            }
        }

        return false;
    }

    public function scopeCheckExpirationDate($query)
    {
        $now = Carbon::now();

        $query->where('start_time', '<=', $now)->where('end_time', '>=', $now);

        return $query;
    }
}

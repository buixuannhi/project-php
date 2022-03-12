<?php

namespace App\Models\Frontend;

use App\Helper\CartHelper;
use App\Models\Backend\Coupon;
use App\Models\Backend\Payment;
use App\Models\Backend\Service;
use App\Models\User;
use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory, SoftDeletes, QueryFilter;

    protected $fillable = [
        'user_id',
        'payment_id',
        'coupon_id',
        'note',
        'arrive_date',
        'depart_date',
        'adult',
        'children',
        'status',
        'total_amount'
    ];

    protected $filterable = [
        'payment_id',
        'status',
        'total_amount'
    ];


    public function scopeAddOrder($query, $request)
    {
        $depart_date = Carbon::create($request->depart_date);

        $arrive_date = Carbon::create($request->arrive_date);

        $depart_date->toDateTimeString();

        $arrive_date->toDateTimeString();

        $status = $request->status ? $request->status : 0;

        $coupon_id = $request->coupon_id ? $request->coupon_id : null;

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'payment_id' => $request->payment_id,
            'arrive_date' => $arrive_date,
            'depart_date' => $depart_date,
            'adult' => $request->adult,
            'children' => $request->children,
            'coupon_id' => $coupon_id,
            'status' => $status,
            'note' => $request->note,
            'total_amount' => $request->total_amount,
        ]);

        return $order;
    }

    /**
     * Get all of the orderDetail for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function orderServices()
    {
        return $this->hasMany(OrderService::class);
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function scopeFilterByDate($query)
    {

        $depart_date = request()->depart_date;

        $arrive_date = request()->arrive_date;

        if ($depart_date && $arrive_date) {

            $depart_date = Carbon::create($depart_date);

            $arrive_date = Carbon::create($arrive_date);

            $depart_date->toDateTimeString();

            $arrive_date->toDateTimeString();

            // $query->whereBetween('reservation_from', [$from, $to])->get();

            $query->where('depart_date', '>=', $depart_date)->where('arrive_date', '<=', $arrive_date);
        }

        return $query;
    }
}

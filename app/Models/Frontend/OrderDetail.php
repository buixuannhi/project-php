<?php

namespace App\Models\Frontend;

use App\Helper\CartHelper;
use App\Models\Backend\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'room_id', 'quantity', 'price'];

    public function scopeAddOrderDetail($query, $order_id)
    {
        $cart = new CartHelper();

        foreach ($cart->content() as $item) {
            OrderDetail::create([
                'order_id' => $order_id,
                'room_id' => $item['room_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        $cart->destroy();
    }


    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

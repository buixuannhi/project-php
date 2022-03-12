<?php

namespace App\Models\Frontend;

use App\Models\Backend\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'service_id'];

    public function scopeAddOrderService($query, $services, $order_id)
    {
        foreach ($services as $service) {
            OrderService::create([
                'order_id' => $order_id,
                'service_id' => $service,
            ]);
        }
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

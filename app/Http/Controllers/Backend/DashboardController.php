<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Room;
use App\Models\Frontend\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::all()->count();
        $rooms = Room::all()->count();
        $unpaid = Order::where('status', 0)->count();
        $accounts = User::all()->count();

        return view('backend.dashboard', compact('orders', 'rooms', 'accounts', 'unpaid'));
    }

    public function events()
    {
        $events = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->select('users.name as title', 'orders.depart_date as start', 'orders.arrive_date as end')
            ->get();

        foreach ($events as $event) {
            $event->start = date("Y-m-d\TH:i:s", strtotime($event->start));
            $event->end = date("Y-m-d\TH:i:s", strtotime($event->end));
        }

        $events->toArray();

        return response()->json(['status' => 'success', 'events' => $events]);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Order;
use Illuminate\Http\Request;

class OrderBackendController extends Controller
{
    public function show(Request $request)
    {
        $page = 'List Orders';

        $params = $request->all();

        $orders = Order::latest()->filter($params)->filterByDate()->paginate(5);

        return view('backend.orders.index', compact('orders', 'page'));
    }

    public function detail($id)
    {
        $page = 'Order Detail';

        $order = Order::find($id);

        return view('backend.orders.detail', compact('order', 'page'));
    }

    public function update($id, Request $request)
    {

        $status = $request->status;

        $order_update = Order::find($id);

        if ($status < $order_update->status) {
            return response()->json(['message' => "Status is not valid!"]);
        } else if ($status == $order_update->status) {
            return;
        } else {
            $result = $order_update->update(['status' => $status]);
        }

        if ($result) {
            // Class status
            $class = statusClass($status);

            // Response data
            return response()->json(['order_id' => $id, 'message' => "Update status order number $id success !", 'class' => $class]);
        }
    }
}

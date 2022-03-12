<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\CartHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CheckoutRequest;
use App\Mail\OrderComplete;
use App\Models\Backend\Brand;
use App\Models\Backend\Coupon;
use App\Models\Backend\Information;
use App\Models\Backend\Payment;
use App\Models\Backend\Service;
use App\Models\Frontend\Order;
use App\Models\Frontend\OrderDetail;
use App\Models\Frontend\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{

    public function __construct()
    {
        View::composer('*', function ($view) {
            $brands = Brand::take(6)->orderBy('position', 'asc')->get();
            $info = Information::get()->first();

            $view->with([
                'brands' => $brands,
                'info' => $info
            ]);
        });
    }

    public function showCheckoutForm(CartHelper $cart)
    {
        $payments = Payment::all();

        $services = Service::all();

        $hours = 0;

        if (session('depart_date') && session('arrive_date')) {
            $depart_date = Carbon::create(session('depart_date')[0]);

            $arrive_date = Carbon::create(session('arrive_date')[0]);

            $depart_date->toDateTimeString();

            $arrive_date->toDateTimeString();

            $hours = $arrive_date->diffInHours($depart_date);
        }

        return view('frontend.pages.checkout', compact('payments', 'services', 'cart'))->with('hours', $hours);
    }

    public function changeDate(Request $request)
    {
        $depart_date = $request->depart_date;

        $arrive_date = $request->arrive_date;

        if ($arrive_date && $depart_date) {
            $depart_date = Carbon::create($depart_date);

            $arrive_date = Carbon::create($arrive_date);

            $depart_date->toDateTimeString();

            $arrive_date->toDateTimeString();

            $hours = $arrive_date->diffInHours($depart_date);

            return response()->json(['hours' => $hours]);
        }
    }

    public function checkout(CheckoutRequest $request)
    {
        $order = Order::addOrder($request);

        if ($order) {

            // Reduce the number of quantity coupon
            if ($request->coupon_id) {
                $coupon_id = $request->coupon_id;

                $check_coupon_exits = Coupon::find($coupon_id);

                if ($check_coupon_exits) {

                    $check_coupon_exits->limit = $check_coupon_exits->limit - 1;

                    $check_coupon_exits->save();
                }
            }

            // Insert order detail
            OrderDetail::addOrderDetail($order->id);

            // Insert Order service
            if ($request->services) {
                $services = $request->services;

                OrderService::addOrderService($services, $order->id);
            }

            // new Order
            $new_order = Order::findOrFail($order->id);

            // Remove old session
            $request->session()->forget(['depart_date', 'arrive_date', 'children', 'adult', 'coupon']);

            // Send mail success.
            Mail::to($request->email)->send(new OrderComplete($new_order));

            // Checkout with paypal
            if ($request->ajax()) {
                $route_redirect = route('checkout.complete');

                return response()->json(['success' => $route_redirect]);
            }

            // Payment without paypal
            return redirect()->route('checkout.complete');
        } else {
            return redirect()->back()->with('error', 'Checkout failed !');
        }
    }

    public function complete()
    {
        $user_id = Auth::user()->id;

        $order = Order::where('user_id', $user_id)->latest()->first();

        $depart_date = $order->depart_date;

        $arrive_date = $order->arrive_date;

        $hours = countHours($depart_date, $arrive_date);

        return view('frontend.pages.order-complete', compact('order', 'hours'));
    }

    public function orderHistory()
    {
        $user_id = Auth::user()->id;

        $orders = Order::where('user_id', $user_id)->latest()->get();

        return view('frontend.pages.order-history', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::find($id);

        return view('frontend.pages.order-details', compact('order'));
    }
}

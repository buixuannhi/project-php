<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\CartHelper;
use App\Models\Backend\Brand;
use App\Models\Backend\Information;
use App\Models\Backend\Room;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\View;

class CartController extends Controller
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

    public function show(CartHelper $cart)
    {
        return view('frontend.pages.cart', compact('cart'));
    }

    public function add(Request $request, CartHelper $cart)
    {
        $room = Room::find($request->room_id);

        $quantity = $request->quantity ? $request->quantity : 1;

        $cart->add($room, $quantity);

        if ($request->home) {

            // Remove old session
            $request->session()->forget(['depart_date', 'arrive_date', 'children', 'adult']);

            // Put new session
            $request->session()->push('depart_date', $request->depart_date);
            $request->session()->push('arrive_date', $request->arrive_date);
            $request->session()->push('children', $request->children);
            $request->session()->push('adult', $request->adult);

            return redirect()->route('checkout.show');
        }


        return response()->json(['success' => true]);
    }

    public function update($rowId, Request $request, CartHelper $cart)
    {

        $quantity = $request->quantity;

        // Call method update
        $cart->update($rowId, $quantity);

        return redirect()->back()->with('success', 'The room has been updated !');
    }


    public function remove($rowId, CartHelper $cart)
    {
        $cart->remove($rowId);

        return redirect()->back()->with('success', 'Remove cart item successfully !');
    }

    public function destroy(CartHelper $cart)
    {
        $cart->destroy();

        return redirect()->back()->with('success', 'Remove all item successfully !');
    }
}

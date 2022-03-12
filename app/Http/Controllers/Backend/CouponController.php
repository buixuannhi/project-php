<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreCouponRequest;
use App\Http\Requests\Backend\UpdateCouponRequest;
use App\Mail\SendNewCoupon;
use App\Models\Backend\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List Coupons';

        $coupons = Coupon::latest()->paginate(3);

        return view('backend.coupons.index', compact('coupons', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Add New Coupon';

        $random_coupon = Str::random(10);
        $random_coupon = Str::upper($random_coupon);

        return view('backend.coupons.add', compact('page', 'random_coupon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCouponRequest $request, Coupon $coupon)
    {
        $code = $request->code;

        if ($request->send_to_user) {
            // Send mail new coupon.
            $users = User::all();

            foreach ($users as $user) {
                Mail::to($user->email)->send(new SendNewCoupon($code));
            }
        }


        $new_coupon = $coupon->createNewCoupon();

        // Check Result
        return alertInsert($new_coupon, 'coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Update Coupon';

        $coupon_edit = Coupon::find($id);

        $start_time = Carbon::create($coupon_edit->start_time);

        $end_time = Carbon::create($coupon_edit->end_time);

        $start_time = $start_time->format('d/m/Y H:i A');

        $end_time = $end_time->format('d/m/Y H:i A');

        return view('backend.coupons.edit', compact('page', 'coupon_edit', 'start_time', 'end_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, $id,)
    {
        $coupon_update = Coupon::find($id);

        // Convert date form input
        $start_time = Carbon::create($request->start_time);

        $end_time = Carbon::create($request->end_time);

        $start_time->toDateTimeString();

        $end_time->toDateTimeString();

        // Merge in to request
        $request->merge(['start_time' => $start_time]);

        $request->merge(['end_time' => $end_time]);

        $coupon_update->update($request->all());

        // Check Result
        return alertUpdate($coupon_update, 'coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $coupon_delete = Coupon::find($id);

        // Check Relationship
        if (count($coupon_delete->orders) > 0) {
            $message = 'Can\'t move record to trash! Because it belongs to a certain order !';
            return redirect()->back()->with('error', $message);
        } else {
            $coupon_delete->delete();

            return alertTrash($coupon_delete, 'coupons.index');
        }
    }

    public function trash()
    {
        $page = 'Coupons Trash';

        $coupons_trash = Coupon::onlyTrashed()->get();

        return view('backend.coupons.trash', compact('page', 'coupons_trash'));
    }

    public function trashAction(Request $request)
    {
        // Action
        $action = $request->action;

        // Get id from request
        $action_id = $request->all();

        // Slice Token and Action
        $action_id = array_slice($action_id, 1, -1);

        // *** Action Restore *** \\
        if ($action === 'restore') {
            if ($action_id) {
                Coupon::withTrashed()->whereIn('id', $action_id)->restore();

                return redirect()->back()->with('success', 'Record recovery successful!');
            } else {
                return redirect()->back()->with('error', 'There aren\'t any records of successful restores!');
            };
            // Success
        } else {
            // *** Action Delete *** \\
            Coupon::withTrashed()->whereIn('id', $action_id)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}

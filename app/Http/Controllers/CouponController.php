<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CouponController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }

    public function status($id,$status)
    {
        if ($status == 1) {
            Coupon::where('id',$id)->update([
                'status' => 0 
            ]);
            return redirect()->route('coupons')->withStatus(__('Coupon successfully deactivated.'));
        } else {
            Coupon::where('id',$id)->update([
                'status' => 1 
            ]);
            return redirect()->route('coupons')->withStatus(__('Coupon successfully activated.')); 
        }
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Coupon::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'discount_price' => $request->discount_price,
            'active_from' => $request->active_from,
            'active_to' => $request->active_to,
            'limit_to_num_uses' => $request->limit_uses,
            'status' => 1,
        ]);
        return redirect()->route('coupons')->withStatus(__('coupon successfully created.'));
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
        $coupon = Coupon::find($id);
        $active_from_f = Carbon::parse($coupon->active_from);
        $coupon->active_from_f = str_replace('U','',$active_from_f->format('Y-m-dTH:i'));
        $coupon->active_from_f = str_replace('C','',$coupon->active_from_f);

        $active_to_f = Carbon::parse($coupon->active_to);
        $coupon->active_to_f = str_replace('U','',$active_to_f->format('Y-m-dTH:i'));
        $coupon->active_to_f = str_replace('C','',$coupon->active_to_f);

        return view('coupons.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Coupon::find($request->id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'discount_price' => $request->discount_price,
            'active_from' => $request->active_from,
            'active_to' => $request->active_to,
            'limit_to_num_uses' => $request->limit_uses,
            // 'used_count' => $request->used_count,
        ]);
        return redirect()->route('coupons')->withStatus(__('coupon successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}

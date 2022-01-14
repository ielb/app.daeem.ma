<?php

namespace App\Http\Controllers;

use App\Models\DeliverySetting;
use Illuminate\Http\Request;

class DeliverySettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverySetting = DeliverySetting::latest()->get();
        return view('pricing_plans.index',compact('deliverySetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pricing_plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DeliverySetting::create([
            'price_from' => $request->price_form,
            'price_to' => $request->price_to,
            'delivery_price' => $request->delivery_price,
        ]);
        return redirect()->route('settings.delivery')->withStatus(__('successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliverySetting  $deliverySetting
     * @return \Illuminate\Http\Response
     */
    public function show(DeliverySetting $deliverySetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliverySetting  $deliverySetting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $delivery_settings = DeliverySetting::find($id);
       return view('pricing_plans.edit',compact('delivery_settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliverySetting  $deliverySetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DeliverySetting::find($request->id)->update([
            'price_from' => $request->price_from,
            'price_to' => $request->price_to,
            'delivery_price' => $request->delivery_price
        ]);
        return redirect()->route('settings.delivery')->withStatus(__('successfully updeted.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliverySetting  $deliverySetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliverySetting = DeliverySetting::find($id);
        $deliverySetting -> delete();
        return redirect()->route('settings.delivery')->withStatus(__('successfully Delete.'));
    }
}

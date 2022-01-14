<?php

namespace App\Http\Controllers;

use App\Models\Supermarket;
use App\Models\City;
use App\Models\Hour;
use App\Models\Rating;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class SupermarketController extends Controller
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

        $supermarkets = Supermarket::latest()->get();

        return view('supermarkets.index',['supermarkets' => $supermarkets]);
    }

    public function supermarkets_select2(Request $request)
    {
        $supermarkets = [];
//        if($request->has('q')){
//            $search = $request->q;
//            $supermarkets =Supermarket::select("id", "name")
//                ->where('name', 'LIKE', "%$search%")
//                ->where('status' ,'=', 1)
//                ->latest()
//                ->get();
//        }
//        else {
            $supermarkets =Supermarket::select("id", "name")->where('status' ,'=', 1)->latest()
                ->get();
//        }
        return response()->json($supermarkets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cities = City::all();
        return view('supermarkets.create',['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'supermarket_name' => ['required', 'string', 'max:255'],
            'supermarket_address' => ['required', 'string', 'max:255'],
            'supermarket_phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
        ]);


        $use_fake_rating = $request->supermarket_logo;

        if(isset($request->supermarket_logo)){
            $supermarket_logo_name = rand().'_'.time().'.'.$request->supermarket_logo->extension();
        }else{
            $supermarket_logo_name = "market_avatar.jpeg";
        }
        if(isset($request->supermarket_cover)){
            $supermarket_cover_name = rand().'_'.time().'.'.$request->supermarket_cover->extension();
        }else{
            $supermarket_cover_name = "cover_avatar.jpeg";
        }

        $supermarket_name = $request->supermarket_name;
        $supermarket_phone = $request->supermarket_phone;
        $supermarket_address = $request->supermarket_address;
        $supermarket_city = $request->supermarket_city;
        $supermarket_lat = $request->supermarket_lat;
        $supermarket_lng = $request->supermarket_lng;
        $supermarket_description = $request->supermarket_description;

        $result = Supermarket::create([
            'name' => trim($supermarket_name),
            'logo' => trim($supermarket_logo_name),
            'cover' => trim($supermarket_cover_name),
            'phone' => trim($supermarket_phone),
            'address' => trim($supermarket_address),
            'lat' => trim($supermarket_lat),
            'lng' => trim($supermarket_lng),
            'use_fake_rating' =>  $use_fake_rating == null ? 0 : 1,
            'city_id' => $supermarket_city,
            'description' => $supermarket_description,
            'status' => 1
        ]);

        if($result){
            if(isset($request->supermarket_logo)){
                $request->supermarket_logo->move(public_path('images/supermarkets/logos'),$supermarket_logo_name);
            }
            if(isset($request->supermarket_cover)){
                $request->supermarket_cover->move(public_path('images/supermarkets/covers'),$supermarket_cover_name);
            }
        }


        return redirect()->route('supermarkets')->withStatus(__('Supermarket successfully created.'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supermarket  $supermarket
     * @return \Illuminate\Http\Response
     */

    public function supermarketslocations()
    {
        //TODO - Method for admin onlt
        if (! auth()->user()->role == "admin") {
            abort(403);
        }

        $toRespond = [
            'supermarkets'=> Supermarket::where('status', 1)->get(),
        ];

        return response()->json($toRespond);
    }

    public function show(Supermarket $supermarket)
    {

       $total_orders =  $supermarket->orders()->count();
       $finished_orders =  $supermarket->orders()->where('status_id' ,'=', 5)->count();
       $processed_orders =  $supermarket->orders()->whereIn('status_id',[2,3,4,8])->count();


       $orders = Order::where('supermarket_id',$supermarket->id)->get();


        $days = array();
        $hours = array();
        if($supermarket->hours()->count()){

            $hours = $supermarket->hours;
        }


        //Days of the week
        $timestamp = strtotime('next Monday');
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        //Generate days columns
        $hoursRange = ['id'];
        for ($i = 0; $i < 7; $i++) {
            $from = $i.'_from';
            $to = $i.'_to';

            array_push($hoursRange, $from);
            array_push($hoursRange, $to);
        }

        $cities = City::all();
        return view('supermarkets.show',
            [
                'cities' => $cities ,
                'supermarket' => $supermarket ,
                'orders' => $orders ,
                'days'=> $days ,
                'hours' => $hours,
                'total_orders' => $total_orders,
                'finished_orders' => $finished_orders,
                'processed_orders' => $processed_orders
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supermarket  $supermarket
     * @return \Illuminate\Http\Response
     */
    public function edit(Supermarket $supermarket)
    {
        $cities = City::all();
        return view('supermarkets.edit',['cities' => $cities , 'supermarket' => $supermarket]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supermarket  $supermarket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supermarket $supermarket)
    {

        $request->validate([
            'supermarket_name' => ['required', 'string', 'max:255'],
            'supermarket_address' => ['required', 'string', 'max:255'],
            'supermarket_phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
        ]);

        if(isset($request->supermarket_logo)){
            $supermarket_logo_name = rand().'_'.time().'.'.$request->supermarket_logo->extension();
        }else{
            $supermarket_logo_name = $supermarket->logo;
        }
        if(isset($request->supermarket_cover)){
            $supermarket_cover_name = rand().'_'.time().'.'.$request->supermarket_cover->extension();
        }else{
            $supermarket_cover_name = $supermarket->cover;
        }

        $supermarket_name = $request->supermarket_name;
        $supermarket_phone = $request->supermarket_phone;
        $supermarket_address = $request->supermarket_address;
        $supermarket_lat= $request->supermarket_lat;
        $supermarket_lng = $request->supermarket_lng;
        $supermarket_city = $request->supermarket_city;
        $supermarket_description = $request->supermarket_description;

        $result = $supermarket->update([
            'name' => trim($supermarket_name),
            'logo' => trim($supermarket_logo_name),
            'cover' => trim($supermarket_cover_name),
            'phone' => trim($supermarket_phone),
            'address' => trim($supermarket_address),
            'lat' => trim($supermarket_lat),
            'lng' => trim($supermarket_lng),
            'city_id' => $supermarket_city,
            'description' => $supermarket_description
        ]);

        if($result){
            if(isset($request->supermarket_logo)){
                $request->supermarket_logo->move(public_path('images/supermarkets/logos'),$supermarket_logo_name);
            }
            if(isset($request->supermarket_cover)){
                $request->supermarket_cover->move(public_path('images/supermarkets/covers'),$supermarket_cover_name);
            }
        }

        return redirect()->route('supermarkets')->withStatus(__('Supermarket successfully updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supermarket  $supermarket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supermarket $supermarket)
    {
        //
    }

    /**
     * change status
     *
     * @param  \App\Models\Supermarket  $supermarket
     * @return \Illuminate\Http\Response
     */
    public function activate(Supermarket $supermarket)
    {
        $supermarket->status = 1;

        $supermarket->update();

        return redirect()->route('supermarkets')->withStatus(__('Supermarket successfully activated.'));

    }

    /**
     * change status
     *
     * @param  \App\Models\Supermarket  $supermarket
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Supermarket $supermarket)
    {
        $supermarket->status = 0;

        $supermarket->update();

        return redirect()->route('supermarkets')->withStatus(__('Supermarket successfully deactivated.'));

    }

    public function workingHours(Supermarket $supermarket, Request $request)
    {


        $hours = Hour::where(['supermarket_id' => $supermarket->id ])->first();
        $from_0 = $request->from_0 != null ? $request->from_0 : '00:00' ;
        $to_0   = $request->to_0 != null ? $request->to_0 : '00:00' ;
        $from_1 = $request->from_1 != null ? $request->from_1 : '00:00' ;
        $to_1   = $request->to_1 != null ? $request->to_1 : '00:00' ;
        $from_2 = $request->from_2 != null ? $request->from_2 : '00:00' ;
        $to_2   = $request->to_2 != null ? $request->to_2 : '00:00' ;
        $from_3 = $request->from_3 != null ? $request->from_3 : '00:00' ;
        $to_3   = $request->to_3 != null ? $request->to_3 : '00:00' ;
        $from_4 = $request->from_4 != null ? $request->from_4 : '00:00' ;
        $to_4   = $request->to_4 != null ? $request->to_4 : '' ;
        $from_5 = $request->from_5 != null ? $request->from_5 : '00:00' ;
        $to_5   = $request->to_5 != null ? $request->to_5 : '00:00' ;
        $from_6 = $request->from_6 != null ? $request->from_6 : '00:00' ;
        $to_6   = $request->to_6 != null ? $request->to_6 : '00:00' ;
        $days_off = array();
        for($i=0;$i<7;$i++){

            if(!in_array($i,$request->days)){
                $days_off[] = $i ;
            }

        }

        $days_off_str = implode(',',$days_off);

        if(!$hours){

            Hour::create([

                '0_from' => $from_0,
                '0_to' =>$to_0,
                '1_from' =>$from_1,
                '1_to' =>$to_1,
                '2_from' =>$from_2,
                '2_to' =>$to_2,
                '3_from' =>$from_3,
                '3_to' =>$to_3,
                '4_from' =>$from_4,
                '4_to' =>$to_4,
                '5_from' =>$from_5,
                '5_to' =>$to_5,
                '6_from' =>$from_6,
                '6_to' =>$to_6,
                'day_off' =>$days_off_str,
                'supermarket_id' =>$supermarket->id,
                ]);


        }else{

            $hours->update([

                '0_from' => $from_0,
                '0_to' =>$to_0,
                '1_from' =>$from_1,
                '1_to' =>$to_1,
                '2_from' =>$from_2,
                '2_to' =>$to_2,
                '3_from' =>$from_3,
                '3_to' =>$to_3,
                '4_from' =>$from_4,
                '4_to' =>$to_4,
                '5_from' =>$from_5,
                '5_to' =>$to_5,
                '6_from' =>$from_6,
                '6_to' =>$to_6,
                'day_off' =>$days_off_str,
            ]);
        }

        return redirect()->back()->withStatus(__('Working hours successfully updated!'));

    }

  


}

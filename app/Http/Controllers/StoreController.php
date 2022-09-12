<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\City;
use App\Models\Hour;
use App\Models\Rating;
use App\Models\Client;
use App\Models\User;
use App\Models\Order;
use App\Models\StoreType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
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

        $stores = Store::latest()->get();

        return view('stores.index', ['stores' => $stores]);
    }

    public function stores_select2(Request $request)
    {
        $stores = [];
        //        if($request->has('q')){
        //            $search = $request->q;
        //            $Stores =Store::select("id", "name")
        //                ->where('name', 'LIKE', "%$search%")
        //                ->where('status' ,'=', 1)
        //                ->latest()
        //                ->get();
        //        }
        //        else {
        $stores = Store::select("id", "name")->where('status', '=', 1)->latest()
            ->get();
        //        }
        return response()->json($stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cities = City::all();
        $store_types = StoreType::all();
        return view('stores.create', ['cities' => $cities, 'store_types' => $store_types]);
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
            'store_name' => ['required', 'string', 'max:255'],
            'store_commission' => ['required'],
            'store_address' => ['required', 'string', 'max:255'],
            'store_phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
        ]);


        $use_fake_rating = $request->is_faked_rating == null ? 0 : 1;


        if (isset($request->store_logo)) {
            $store_logo_name = rand() . '_' . time() . '.' . $request->store_logo->extension();
        } else {
            $store_logo_name = "market_avatar.jpeg";
        }
        if (isset($request->store_cover)) {
            $store_cover_name = rand() . '_' . time() . '.' . $request->store_cover->extension();
        } else {
            $store_cover_name = "cover_avatar.jpeg";
        }

        $store_type = $request->store_type;
        $store_commission = $request->store_commission;
        $store_name = $request->store_name;
        $store_phone = $request->store_phone;
        $store_phone_two = $request->store_phone_two;
        $store_address = $request->store_address;
        $store_city = $request->store_city;
        $store_lat = $request->store_lat;
        $store_lng = $request->store_lng;
        $store_description = $request->store_description;
        $store_email = $request->store_email;
        $store_password = $request->store_password;


        $result = Store::create([
            'name' => trim($store_name),
            'logo' => trim($store_logo_name),
            'cover' => trim($store_cover_name),
            'email' => trim($store_email),
            'password' => md5(trim($store_password)),
            'phone' => trim($store_phone),
            'phone_two' => trim($store_phone_two),
            'address' => trim($store_address),
            'lat' => trim($store_lat),
            'lng' => trim($store_lng),
            'use_fake_rating' =>  $use_fake_rating,
            'city_id' => $store_city,
            'user_id' => auth()->user()->id,
            'description' => $store_description,
            'commission' => $store_commission,
            'store_type_id' => $store_type,
            'recovery_token' => Str::random(60),
            'status' => 1
        ]);
        if ($result) {

            if (isset($request->store_logo)) {
                $request->store_logo->move(public_path('images/stores/logos'), $store_logo_name);
            }
            if (isset($request->store_cover)) {
                $request->store_cover->move(public_path('images/stores/covers'), $store_cover_name);
            }
        }



        return redirect()->route('stores')->withStatus(__('Store successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */

    public function storeslocations()
    {
        //TODO - Method for admin onlt
        if (!auth()->user()->role == "admin") {
            abort(403);
        }

        $toRespond = [
            'stores' => Store::where('status', 1)->get(),
        ];

        return response()->json($toRespond);
    }

    public function show(Store $store)
    {

        $total_orders =  $store->orders()->count();
        $finished_orders =  $store->orders()->where('status_id', '=', 5)->count();
        $processed_orders =  $store->orders()->whereIn('status_id', [2, 3, 4, 8])->count();


        $orders = Order::where('store_id', $store->id)->get();


        $days = array();
        $hours = array();
        if ($store->hours()->count()) {

            $hours = $store->hours;
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
            $from = $i . '_from';
            $to = $i . '_to';

            array_push($hoursRange, $from);
            array_push($hoursRange, $to);
        }

        $cities = City::all();
        $store_types = StoreType::all();
        return view(
            'stores.show',
            [
                'cities' => $cities,
                'store_types' => $store_types,
                'store' => $store,
                'orders' => $orders,
                'days' => $days,
                'hours' => $hours,
                'total_orders' => $total_orders,
                'finished_orders' => $finished_orders,
                'processed_orders' => $processed_orders
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $cities = City::all();
        return view('stores.edit', ['cities' => $cities, 'store' => $store]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {

        $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'store_commission' => ['required'],
            'store_address' => ['required', 'string', 'max:255'],
            'store_phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
        ]);

        $use_fake_rating = $request->is_faked_rating == null ? 0 : 1;

        if (isset($request->store_logo)) {
            $store_logo_name = rand() . '_' . time() . '.' . $request->store_logo->extension();
        } else {
            $store_logo_name = $store->logo;
        }
        if (isset($request->store_cover)) {
            $store_cover_name = rand() . '_' . time() . '.' . $request->store_cover->extension();
        } else {
            $store_cover_name = $store->cover;
        }

        $store_type = $request->store_type;
        $store_commission = $request->store_commission;
        $store_name = $request->store_name;
        $store_phone = $request->store_phone;
        $store_phone_two = $request->store_phone_two;
        $store_address = $request->store_address;
        $store_city = $request->store_city;
        $store_lat = $request->store_lat;
        $store_lng = $request->store_lng;
        $store_description = $request->store_description;
        $store_email = $request->store_email;
        $store_password = $request->store_password;
        if ($store_password == '') {
            $store_password = md5(trim($request->store_password));
        } else {
            $store_password = $store->password;
        }

        $result = $store->update([
            'name' => trim($store_name),
            'logo' => trim($store_logo_name),
            'cover' => trim($store_cover_name),
            'email' => trim($store_email),
            'password' => trim(md5($store_password)),
            'phone' => trim($store_phone),
            'phone_two' => trim($store_phone_two),
            'address' => trim($store_address),
            'lat' => trim($store_lat),
            'lng' => trim($store_lng),
            'use_fake_rating' => $use_fake_rating,
            'city_id' => $store_city,
            'description' => $store_description,
            'commission' => $store_commission,
            'store_type_id' => $store_type,
            'recovery_token' => Str::random(60),
            'status' => 1
        ]);

        if ($result) {
            if (isset($request->store_logo)) {
                $request->store_logo->move(public_path('images/stores/logos'), $store_logo_name);
            }
            if (isset($request->store_cover)) {
                $request->store_cover->move(public_path('images/stores/covers'), $store_cover_name);
            }
        }

        return redirect()->route('stores')->withStatus(__('Store successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }

    /**
     * change status
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function activate(Store $store)
    {
        $store->status = 1;

        $store->update();

        return redirect()->route('stores')->withStatus(__('Store successfully activated.'));
    }

    /**
     * change status
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Store $store)
    {
        $store->status = 0;

        $store->update();

        return redirect()->route('stores')->withStatus(__('Store successfully deactivated.'));
    }

    public function workingHours(Store $store, Request $request)
    {


        $hours = Hour::where(['store_id' => $store->id])->first();
        $from_0 = $request->from_0 != null ? $request->from_0 : '00:00';
        $to_0   = $request->to_0 != null ? $request->to_0 : '00:00';
        $from_1 = $request->from_1 != null ? $request->from_1 : '00:00';
        $to_1   = $request->to_1 != null ? $request->to_1 : '00:00';
        $from_2 = $request->from_2 != null ? $request->from_2 : '00:00';
        $to_2   = $request->to_2 != null ? $request->to_2 : '00:00';
        $from_3 = $request->from_3 != null ? $request->from_3 : '00:00';
        $to_3   = $request->to_3 != null ? $request->to_3 : '00:00';
        $from_4 = $request->from_4 != null ? $request->from_4 : '00:00';
        $to_4   = $request->to_4 != null ? $request->to_4 : '';
        $from_5 = $request->from_5 != null ? $request->from_5 : '00:00';
        $to_5   = $request->to_5 != null ? $request->to_5 : '00:00';
        $from_6 = $request->from_6 != null ? $request->from_6 : '00:00';
        $to_6   = $request->to_6 != null ? $request->to_6 : '00:00';
        $days_off = array();
        for ($i = 0; $i < 7; $i++) {

            if (!in_array($i, $request->days)) {
                $days_off[] = $i;
            }
        }

        $days_off_str = implode(',', $days_off);

        if (!$hours) {

            Hour::create([

                '0_from' => $from_0,
                '0_to' => $to_0,
                '1_from' => $from_1,
                '1_to' => $to_1,
                '2_from' => $from_2,
                '2_to' => $to_2,
                '3_from' => $from_3,
                '3_to' => $to_3,
                '4_from' => $from_4,
                '4_to' => $to_4,
                '5_from' => $from_5,
                '5_to' => $to_5,
                '6_from' => $from_6,
                '6_to' => $to_6,
                'day_off' => $days_off_str,
                'store_id' => $store->id,
            ]);
        } else {

            $hours->update([

                '0_from' => $from_0,
                '0_to' => $to_0,
                '1_from' => $from_1,
                '1_to' => $to_1,
                '2_from' => $from_2,
                '2_to' => $to_2,
                '3_from' => $from_3,
                '3_to' => $to_3,
                '4_from' => $from_4,
                '4_to' => $to_4,
                '5_from' => $from_5,
                '5_to' => $to_5,
                '6_from' => $from_6,
                '6_to' => $to_6,
                'day_off' => $days_off_str,
            ]);
        }

        return redirect()->back()->withStatus(__('Working hours successfully updated!'));
    }

    //get location
    public function getLocation(Store $store)
    {
        return response()->json([
            'data' => [
                'lat' => $store->lat,
                'lng' => $store->lng,
                'area' => $store->radius,
                'id' => $store->id,
            ],
            'status' => true,
            'errMsg' => '',
        ]);
    }

    public function updateDeliveryArea(Store $store, Request $request)
    {

        $store->radius = json_decode($request->path);
        $store->update();

        return response()->json([
            'status' => true,
            'msg' => '',
        ]);
    }
}
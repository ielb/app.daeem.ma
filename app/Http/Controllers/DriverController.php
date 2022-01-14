<?php

namespace App\Http\Controllers;

use \Datetime;
use \DateTimeZone;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Shift;
use App\Models\ShiftOption;
use App\Models\DriverShift;
use App\Models\Day;
use App\Models\Zone;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class DriverController extends Controller
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
        $drivers  =   User::where('role', 'driver')->orWhere('role', 'collector')->latest()->get();
        return view('drivers.index', ['drivers' =>  $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $request->validate([
            'code' => ['required', 'string', 'max:10'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
            'worker_role' => ['required'],
            'password' => ['required', 'string', 'min:8','confirmed'],
        ]);


        if (isset($request->driver_image) ) {
            $driver_image = rand().'_'.date('YmdHis').'.'.$request->driver_image->extension();
        }
        else
        {
            $driver_image = 'driver-avatar.png';
        }




        //Create the driver
        $user = User::create([
            'code' => strip_tags($request->code),
            'cash' => strip_tags($request->cash),
            'gender' => strip_tags($request->gender),
            'name' => strip_tags($request->name),
            'email' => strip_tags($request->email),
            'phone' => strip_tags($request->phone),
            'vehicle' => strip_tags($request->vehicle_type),
            'password' => Hash::make($request->password),
            'role' => strip_tags($request->worker_role),
            'image' => $driver_image,
            'remember_token' =>  Str::random(60) ,
            'working' => 0,
            'status' => 1,
        ]);
        if($user){
            if(isset($request->driver_image)){
                $request->driver_image->move(public_path('images/drivers/'),$driver_image);
            }
        }
        return redirect()->route('drivers.index')->withStatus(__('Driver successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $driver)
    {
        if(auth()->user()->role == 'driver' && $driver->id != auth()->user()->id){
            abort(404);
        }

        if ($driver->role == 'driver')
        {
            //Today paid orders
            $today = Order::where(['user_id' => $driver->id])->where('status_id', '5')->where('created_at', '>=', Carbon::today());
            //Week paid orders
            $week = Order::where(['user_id' => $driver->id])->where('status_id', '5')->where('created_at', '>=', Carbon::now()->startOfWeek());
            //This month paid orders
            $month = Order::where(['user_id' => $driver->id])->where('status_id', '5')->where('created_at', '>=', Carbon::now()->startOfMonth());
            //Previous month paid orders
            $previousmonth = Order::where(['user_id' => $driver->id])->where('status_id', '5')->where('created_at', '>=',  Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<',  Carbon::now()->subMonth(1)->endOfMonth());
        }
        elseif ($driver->role == 'collector')
        {
            //Today paid orders
            $today = Order::where(['collector_id' => $driver->id])->where('status_id', '9')->where('created_at', '>=', Carbon::today());
            //Week paid orders
            $week = Order::where(['collector_id' => $driver->id])->where('status_id', '9')->where('created_at', '>=', Carbon::now()->startOfWeek());
            //This month paid orders
            $month = Order::where(['collector_id' => $driver->id])->where('status_id', '9')->where('created_at', '>=', Carbon::now()->startOfMonth());
            //Previous month paid orders
            $previousmonth = Order::where(['collector_id' => $driver->id])->where('status_id', '9')->where('created_at', '>=',  Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<',  Carbon::now()->subMonth(1)->endOfMonth());
        }

        
        $earnings = [
            'today' => [
                'orders' => $today->count(),
                'icon' => 'bg-gradient-red'
            ],
            'week' => [
                'orders' => $week->count(),
                'icon' => 'bg-gradient-orange'
            ],
            'month' => [
                'orders' => $month->count(),
                'icon' => 'bg-gradient-green'
            ],
            'previous month' => [
                'orders' => $previousmonth->count(),
                'icon' => 'bg-gradient-info'
            ]
        ];

        return view('drivers.edit',  ['driver' => $driver, 'earnings' => $earnings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deactivate(User $driver)
    {
        $driver->status = 0;
        $driver->save();

        return redirect()->route('drivers.index')->withStatus(__('Driver successfully deactivated.'));
    }

    public function activate(User $driver)
    {
        $driver->status = 1;
        $driver->update();

        return redirect()->route('drivers.index')->withStatus(__('Driver successfully activated.'));
    }

    public function update(Request $request, User $driver)
    {
        $request->validate([
            'name_driver' => ['required', 'string', 'max:255'],
            'phone_driver' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
        ]);


        if($request->driver_image  == null ){
            $driver_image = $driver->image;
        }else{
            $driver_image = rand().'_'.date('YmdHis').'.'.$request->driver_image->extension();
            $request->driver_image->move(public_path('images/drivers/'),$driver_image);
        }


        $driver->update([
            'name' => strip_tags($request->name_driver),
            'cash' => strip_tags($request->cash_driver),
            'gender' => strip_tags($request->gender_driver),
            'vehicle' => strip_tags($request->vehicle_type),
            'phone' => strip_tags($request->phone_driver),
            'image' => strip_tags($driver_image),
        ]);

        return redirect()->route('drivers.edit', ['driver' => $driver,])->withStatus(__('Driver successfully updated.'));
    }

    public function updatePassword(Request $request, User $driver)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','string', 'min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);


        $driver->update([
            'password'=> Hash::make($request->new_password)
        ]);

        return redirect()->route('drivers.edit', ['driver' => $driver,])->withStatus(__('Driver successfully updated.'));
    }

    public function workingStatus(Request $request, $id)
    {
//       return response()->json($request->data);
        $driver = User::find($id);
        if($request->data == 0)
        {
            $driver->update([
                'working' => 1
            ]);
        }
        else
        {
            $driver->update([
                'working' => 0
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Working status has been changed',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getValidDate($dateRequest){

        $today = Date('Y-m-d');
        $date = ["start" => $today,"end" => $today];

        if ($dateRequest != null){

            $dateArray = explode(' - ',$dateRequest);
            $start = Carbon::parse($dateArray[0]);

            $end = Carbon::parse($dateArray[1]);

            $date = ["start" => $start,"end" => $end];
        }

        return $date;

    }

    public function reports_index()
    {
        $driver_car = env('DRIVER_CAR_PRICE');
        $driver_motorcycle = env('DRIVER_MOTORCYCLE_PRICE');
        if(!isset($_GET['reports_date'])) {
            $orders = Order::with('products')->where('user_id', '=', auth()->user()->id)->where('status_id', '=', '5')->where('created_at', Carbon::today())->get();
        }
        if(isset($_GET['reports_date']))
        {
            $date = $this->getValidDate($_GET['reports_date']);
            if($date['start'] == $date['end'])
            {
                $orders = Order::whereDate('created_at', $date['start'])->where('user_id',auth()->user()->id)->where('status_id','5')->with('products')->get();
            }
            else
            {
                $orders = Order::with('products')->whereBetween('created_at', [$date['start'],$date['end']])->where('user_id','=',auth()->user()->id)->where('status_id','=','5')->get();
            }
        }

        if(auth()->user()->vehicle == "Car"){
            $profitDelivery = $driver_car;
        }elseif(auth()->user()->vehicle == "Motorcycle"){
            $profitDelivery = $driver_motorcycle;
        }

        $sumProfitDelivery = $profitDelivery * count($orders);

        $all_collectables = 0;
        $all_collection_profit = 0;
        if(count($orders))
        {
            foreach($orders as $order)
            {
                $count_of_collectables = 0;
                $collection_profit = 0;
                foreach($order->products as $product_for_collect)
                {
                    if($product_for_collect->price > env('COLLECTION_PRODUCT_PRICE'))
                    {
                        $count_of_collectables += 1 ;
                        $all_collectables += 1 ;
                        $collection_profit += env('COLLECTION_PRICE');
                        $all_collection_profit += env('COLLECTION_PRICE');
                    }
                }
                $order->collection_profit = $collection_profit;
            }
        }
        else
        {
            $collection_profit = 0;
        }


        $orderPrice = $orders->where('status_id','=','5')->where('user_id','=',auth()->user()->id)->sum('order_price');
        $deliveryPrice = $orders->where('status_id','=','5')->where('user_id','=',auth()->user()->id)->sum('delivery_price');
        $salesOrderDriver = ($orderPrice + $deliveryPrice);



        ///////////////////////////////////////////////////////

        if(isset($_GET['reports_week'])){
            $get = explode('-',$_GET['reports_week'])[1];
            $week = str_replace('W','',$get);
        }else{
            $date = new DateTime(Date('Y-m-d'));
            $week = $date->format("W");
        }

//        $shifts = DriverShift::with('shift','day','shift_option')->where('week',$week)->where('user_id',auth()->user()->id)->get();
        $days = Day::orderBy('id', 'ASC')->get();


//        $start = $date->startOfWeek()->toDateString();
//        $end = $date->endOfWeek()->toDateString();

        foreach ($days as $day)
        {
            $day->shifts = DriverShift::with('shift','day','shift_option')->where('week',$week)->where('day_id',$day->id)->where('user_id',auth()->user()->id)->get();
        }

        $shift_orders = Order::with('products')->where('user_id', '=', auth()->user()->id)->where('status_id', '=', '5')->get();
        foreach ($shift_orders as $shift_order)
        {
            $order_date = Carbon::parse($shift_order->created_at);
            $d = Carbon::parse($order_date)->format('l');
            $shift_order->weekNumber = $order_date->weekOfYear;
            $shift_order->dayName = $d;
            foreach ($shift_order->products as $shift_product)
            {
                if($shift_product->price > env('COLLECTION_PRODUCT_PRICE'))
                {
                    $shift_order->collection_profit += env('COLLECTION_PRICE');
                }
            }
        }
        $week_orders = $shift_orders->where('weekNumber', $week);

        $all_shift_collectables = 0;

        foreach ($week_orders as $week_order)
        {
            $all_shift_collectables += $week_order->collection_profit;
        }


        return view('reports.index',
            [
                'orders' => $orders ,
                'profitDelivery' => $profitDelivery ,
                'collection_profit' => $collection_profit,
                'salesOrderDriver' => $salesOrderDriver ,
                'sumProfitDelivery' => $sumProfitDelivery ,
                'all_collectables' => $all_collectables ,
                'all_collection_profit' => $all_collection_profit ,
                'week' => Date('Y').'-W'.$week ,
                'days' => $days ,
                'week_orders' => $week_orders ,
                'all_shift_collectables' => $all_shift_collectables ,
            ]);
    }
}

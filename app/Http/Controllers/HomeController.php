<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\User;
use App\Models\Supermarket;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::all();
        //BY DATE FROM
        if (isset($_GET['fromDate']) && strlen($_GET['fromDate']) > 3) {
            $start = Carbon::parse($_GET['fromDate']);
            $orders = $orders->where('created_at', '>=', $start);
        }

        //BY DATE TO
        if (isset($_GET['toDate']) && strlen($_GET['toDate']) > 3) {
            $end = Carbon::parse($_GET['toDate']);
            $orders = $orders->where('created_at', '<=', $end);
        }
        //get all sore
        $store = Store::all();
        //filter state by date//
        $order_price = $orders->where('status_id','=','5')->sum('order_price');
        $delivery_price = $orders->where('status_id','=','5')->sum('delivery_price');


        //get order by type count
       
       $just_created_order = $orders->where('status_id','=',1)->count();
       $accept_driver_order = $orders->where('status_id','=',8)->count();
       $prepared_order = $orders->where('status_id','=',8)->count();
       $refunded_order = $orders->where('status_id','=',10)->count();
       $delivred_order = $orders->where('status_id','=',5)->count();


         //BY DATE FROM
         if (isset($_GET['fromDate']) && strlen($_GET['fromDate']) > 3) {
            $start = Carbon::parse($_GET['fromDate']);
            $order_price = $orders->where('status_id','=','5')->where('created_at', '>=', $start)->sum('order_price');
            $delivery_price = $orders->where('status_id','=','5')->where('created_at', '>=', $start)->sum('delivery_price');
            $just_created_order = $orders->where('status_id','=',1)->where('created_at', '>=', $start)->count();
            $accept_driver_order = $orders->where('status_id','=',8)->where('created_at', '>=', $start)->count();
            $prepared_order = $orders->where('status_id','=',8)->where('created_at', '>=', $start)->count();
            $refunded_order = $orders->where('status_id','=',10)->where('created_at', '>=', $start)->count();
            $delivred_order = $orders->where('status_id','=',5)->where('created_at', '>=', $start)->count();
        
        }

        //BY DATE TO
        if (isset($_GET['toDate']) && strlen($_GET['toDate']) > 3) {
            $end = Carbon::parse($_GET['toDate']);
            $order_price = $orders->where('status_id','=','5')->where('created_at', '<=', $end)->sum('order_price');
            $delivery_price = $orders->where('status_id','=','5')->where('created_at', '<=', $end)->sum('delivery_price');
            $just_created_order = $orders->where('status_id','=',1)->where('created_at', '<=', $end)->count();
            $accept_driver_order = $orders->where('status_id','=',8)->where('created_at', '<=', $end)->count();
            $prepared_order = $orders->where('status_id','=',8)->where('created_at', '<=', $end)->count();
            $refunded_order = $orders->where('status_id','=',10)->where('created_at', '<=', $end)->count();
            $delivred_order = $orders->where('status_id','=',5)->where('created_at', '<=', $end)->count();
        }
        //get orders delivered by car
        $car = $orders->where('user.vehicle','=','Car')->where('status_id','=','5')->sum('delivery_price');
        //get orders delivered by motorcycle
        $motorcycle = $orders->where('user.vehicle','=','Motorcycle')->where('status_id','=','5')->sum('delivery_price');
        //get count order delivered by car
        $count_car = $orders->where('user.vehicle','=','Car')->where('status_id','=','5');
        //get count order delivered by motorcycle
        $count_motorcycle = $orders->where('user.vehicle','=','Motorcycle')->where('status_id','=','5');
        //sales
        $salesOrder = ($order_price + $delivery_price);
        //driver cost
        $driver_motorcycle = env('DRIVER_MOTORCYCLE_PRICE');
        $driver_car = env('DRIVER_CAR_PRICE');
        //profit from car delivery
        $delivery_car = $car - ($driver_car  * count($count_car) );
        //profit from motorcycle delivery
        $delivery_motorcycle = $motorcycle - ($driver_motorcycle * count($count_motorcycle));
        //delivery profit from orders
        $deliveryProfit = $delivery_car + $delivery_motorcycle;
     
    


        //get order by month
        $months = [0 => __('Jan'),1 => __('Feb'),2 => __('Mar'),3 => __('Apr'),4 => __('May'),5 => __('Jun'),6 => __('Jul'),7 => __('Aug'),8 => __('Sep'),9 => __('Oct'),10 => __('Nov'),11 => __('Dec'),];
        $sevenMonthsDate = Carbon::now()->subMonths(6)->startOfMonth();

        $salesValue = DB::table('orders')
        ->select(DB::raw('SUM(order_price + delivery_price) AS sumValue'))
        ->where('created_at', '>', $sevenMonthsDate)
        ->where('status_id','5')
        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'), 'asc')
        ->pluck('sumValue');

        $monthLabels = DB::table('orders')
        ->select(DB::raw('MONTH(created_at) as month'))
        ->where('created_at', '>', $sevenMonthsDate)
        ->where('status_id','5')
        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'), 'asc')
        ->pluck('month');

        $totalOrders = DB::table('orders')->select(DB::raw('count(id) as totalPerMonth'))->where('created_at', '>', $sevenMonthsDate)->where('status_id','5')->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'), 'asc')->pluck('totalPerMonth');

        //get driver stats//
        $driver_order = $orders->where('user_id','=',auth()->user()->id);
        $collector_order = $orders->where('collector_id','=',auth()->user()->id);
        $orderDelivred = $orders->where('user_id','=',auth()->user()->id)->where('status_id','=','5');
        $collectorOrderDelivred = $orders->where('collector_id','=',auth()->user()->id)->where('status_id','=','5');
        $orderPrice = $orders->where('status_id','=','5')->where('user_id','=',auth()->user()->id)->sum('order_price');
        $collectorOrderPrice = $orders->where('status_id','=','5')->where('collector_id','=',auth()->user()->id)->sum('order_price');
        $deliveryPrice = $orders->where('status_id','=','5')->where('user_id','=',auth()->user()->id)->sum('delivery_price');
        $collectorDeliveryPrice = $orders->where('status_id','=','5')->where('collector_id','=',auth()->user()->id)->sum('delivery_price');
        $salesOrderDriver = ($orderPrice + $deliveryPrice);
        $salesOrderCollector = ($collectorOrderPrice + $collectorDeliveryPrice);
        //get order deliverd by driver car or morocycle
        $driverOrder = $orders->where('status_id','=','5')->where('user_id','=',auth()->user()->id)->where('user.vehicle','=',auth()->user()->vehicle)->sum('delivery_price');
       if(auth()->user()->role == "driver"){
        if(auth()->user()->vehicle == "Car"){
            $profitDelivery = ($driver_car * count($orderDelivred));
        }elseif(auth()->user()->vehicle == "Motorcycle"){
            $profitDelivery = ($driver_motorcycle * count($orderDelivred));
        }
       }else{
        $profitDelivery = "0";
       }


        $order_for_collectables=[];
       //get driver collectables
        if(auth()->user()->role == "driver")
        {
            $order_for_collectables = Order::with('products')->where('user_id','=',auth()->user()->id)->where('status_id','=','5')->get();
        }
        elseif (auth()->user()->role == "collector")
        {
            $order_for_collectables = Order::with('products')->where('collector_id','=',auth()->user()->id)->where('status_id','=','5')->get();
        }
       $collection_profit = 0;
       $count_of_collectables = 0;
       if(count($order_for_collectables)>0){
           foreach($order_for_collectables as $order_for_collectable)
           {
            foreach($order_for_collectable->products as $product_for_collect)
            {
                if($product_for_collect->price > env('COLLECTION_PRODUCT_PRICE'))
                {
                    $count_of_collectables += 1 ;
                    $collection_profit += env('COLLECTION_PRICE');
                }
            }
           }
       }
       
       //get order by date
          //Today orders
          $today = Order::whereDate('created_at', '=', Carbon::today());
         
          //Yester day
          $Yesterday = Order::whereDate('created_at', Carbon::yesterday());
          
          //Week orders
          $week = Order::whereDate('created_at', '>=', Carbon::now()->startOfWeek());
          //This month orders
          $month = Order::whereDate('created_at', '>=', Carbon::now()->startOfMonth());

          $earnings = [
            'Today' => [
                'orders' => $today->count(),
            ],
            'Yesterday' => [
                'orders' => $Yesterday->count(),
            ],
            'Week' => [
                'orders' => $week->count(),
            ],
            'Month' => [
                'orders' => $month->count(),
            ]
        ];

        return view('home.index',['orders'=>$orders,'salesOrder'=>$salesOrder,'deliveryProfit'=>$deliveryProfit,'store'=>$store,'months' => $months,'salesValue' => $salesValue,'monthLabels' => $monthLabels,'totalOrders' => $totalOrders,'delivery_price'=> $delivery_price,'driver_order'=>$driver_order,'collector_order'=>$collector_order,'collectorOrderDelivred'=>$collectorOrderDelivred,'salesOrderCollector'=>$salesOrderCollector,'salesOrderDriver'=>$salesOrderDriver,'deliveryPrice'=>$deliveryPrice,'profitDelivery'=>$profitDelivery,'parameters'=>count($_GET) != 0,'just_created_order'=>$just_created_order,'accept_driver_order'=>$accept_driver_order,'prepared_order'=>$prepared_order,'refunded_order'=>$refunded_order,'delivred_order'=>$delivred_order,'count_of_collectables'=>$count_of_collectables,'collection_profit'=>$collection_profit,'earnings'=>$earnings,]);
    }

    public function orderNotification()
    {
        $view = $_GET['view'];

        if(auth()->user()->role == 'admin')
        {
            if($view != '')
            {
                Order::where('seen', '=', 0)->update(array('seen' => 1));
            }

            $orders         =   Order::with('client')->where('status_id', 1)->orderBy('id', 'desc')->get();
            $unseenOrders   =   Order::where([
                ['status_id', '=', 1],
                ['seen', '=', 0],
            ])->get();

            foreach ($orders as $key => $order) {
                $order['notify_order_date'] = $order['created_at']->diffForHumans();
            }
        }
        elseif (auth()->user()->role == 'driver')
        {
            if($view != '')
            {
                Order::where('seen_by_driver', '=', 0)->update(array('seen_by_driver' => 1));
            }

            $orders         =   Order::with('client')->where('status_id', 3)->where('user_id',auth()->user()->id)->orderBy('id', 'desc')->get();
            $unseenOrders   =   Order::where([
                ['status_id', '=', 3],
                ['seen_by_driver', '=', 0],
            ])->get();

            foreach ($orders as $key => $order) {
                $order['notify_order_date'] = $order['created_at']->diffForHumans();
            }
        }
        elseif (auth()->user()->role == 'collector')
        {
            if($view != '')
            {
                Order::where('seen_by_collector', '=', 0)->update(array('seen_by_collector' => 1));
            }

            $orders         =   Order::with('client')->where('status_id', 9)->where('user_id',auth()->user()->id)->orderBy('id', 'desc')->get();
            $unseenOrders   =   Order::where([
                ['status_id', '=', 9],
                ['seen_by_collector', '=', 0],
            ])->get();

            foreach ($orders as $key => $order) {
                $order['notify_order_date'] = $order['created_at']->diffForHumans();
            }
        }


        $json               =   array();

        $json['notifyOrders']   =   $orders;
        $json['orderCount']      =   $orders->count();
        $json['unseenOrders']     =   $unseenOrders->count();


        echo json_encode($json);

    }
}

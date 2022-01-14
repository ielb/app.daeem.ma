<?php

namespace App\Http\Controllers;
use \Datetime;
use \DateTimeZone;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use App\Models\OrderHasProduct;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
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

    public function getValidDate($dateRequest){

        $today = Date('Y-m-d');
        $date = ["start" => $today,"end" => $today];

        if ($dateRequest != null){

            $dateArray = explode(' - ',$dateRequest);
            $start = \DateTime::createFromFormat('d/m/Y', $dateArray[0], new \DateTimeZone('UTC'))
                ->format('Y-m-d');
            $start2 = \DateTime::createFromFormat('d/m/Y', $dateArray[0], new \DateTimeZone('UTC'))
                ->format('d-m-Y');

            $end = \DateTime::createFromFormat('d/m/Y', $dateArray[1], new \DateTimeZone('UTC'))
                ->format('Y-m-d');
            $end2 = \DateTime::createFromFormat('d/m/Y', $dateArray[1], new \DateTimeZone('UTC'))
                ->format('d-m-Y');

            $date = ["start" => $start,"end" => $end , 'start2' => $start2 , 'end2' => $end2];

        }

        return $date;

    }

    public function cal_percentage($this_month, $last_month): float
    {
        $tmp = $this_month * 100;
        if ($last_month == 0) {
            return floatval($tmp - 100);
        }
        return floatval($tmp / $last_month) - 100;

    }
    public function filter_percent($value)
    {

        if (intval($value) < 0) {
            return  0;
        }else if(intval($value) > 100){
            return  100;
        }
        return $value;
    }

    public function index(Request $request)
    {

        $use_date = false;
        if(isset($request->date_range)){
            $use_date = true;
            $date = $this->getValidDate($request->date_range);
        }


        $start_of_month = Carbon::now()->startOfMonth();

        // Orders
        if($use_date){
            if($date['start'] === $date['end']){
                $total_orders = Order::whereDate('created_at', $date['start'])->count();
            }else{
                $total_orders = Order::whereBetween('created_at', [$date['start'],$date['end']])->count();
            }

        }else{
            $total_orders = Order::all()->count();
        }

        $total_orders_this_month = Order::where('created_at', '>=', $start_of_month)->count();
        $total_orders_last_month = Order::where('created_at', '>=', Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<', Carbon::now()->subMonth(1)->endOfMonth())->count();
        $total_orders_percent = $this->cal_percentage($total_orders_this_month, $total_orders_last_month);

        // delivered
        if($use_date){
            if($date['start'] === $date['end']){
                $total_orders_delivered = Order::whereDate('created_at', $date['start'])->where('status_id', 5)->count();
            }else{
                $total_orders_delivered = Order::whereBetween('created_at', [$date['start'],$date['end']])->where('status_id', 5)->count();
            }
        }else{
            $total_orders_delivered = Order::where('status_id', 5)->count();
        }
        $total_orders_delivered_this_month = Order::where('status_id', 5)->where('created_at', '>=', $start_of_month)->count();
        $total_orders_delivered_last_month = Order::where('status_id', 5)->where('created_at', '>=', Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<', Carbon::now()->subMonth(1)->endOfMonth())->count();
        $total_orders_delivered_percent = $this->cal_percentage($total_orders_delivered_this_month, $total_orders_delivered_last_month);
      //  dd($total_orders_delivered_percent);

        // pending
        if($use_date){
            if($date['start'] === $date['end']){
                $total_orders_pending = Order::whereDate('created_at', $date['start'])->whereIn('status_id', [2, 3, 4, 8])->count();
            }else{
                $total_orders_pending = Order::whereBetween('created_at', [$date['start'],$date['end']])->whereIn('status_id', [2, 3, 4, 8])->count();
            }
        }else{
            $total_orders_pending = Order::whereIn('status_id', [2, 3, 4, 8])->count();
        }

        $total_orders_pending_this_month = Order::whereIn('status_id', [2, 3, 4, 8])->where('created_at', '>=', $start_of_month)->count();
        $total_orders_pending_last_month = Order::whereIn('status_id', [2, 3, 4, 8])->where('created_at', '>=', Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<', Carbon::now()->subMonth(1)->endOfMonth())->count();
        $total_orders_pending_percent = $this->cal_percentage($total_orders_pending_this_month, $total_orders_pending_last_month);

        // rejected
        // pending
        if($use_date){
            if($date['start'] === $date['end']){
                $total_orders_refunded = Order::whereDate('created_at', $date['start'])->whereIn('status_id', [10])->count();
            }else{
                $total_orders_refunded = Order::whereBetween('created_at', [$date['start'],$date['end']])->whereIn('status_id', [10])->count();
            }
        }else{
            $total_orders_refunded = Order::whereIn('status_id', [10])->count();
        }

        $total_orders_refunded_this_month = Order::whereIn('status_id', [10])->where('created_at', '>=', $start_of_month)->count();
        $total_orders_refunded_last_month = Order::whereIn('status_id', [10])->where('created_at', '>=', Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<', Carbon::now()->subMonth(1)->endOfMonth())->count();
        $total_orders_refunded_percent = $this->cal_percentage($total_orders_refunded_this_month, $total_orders_refunded_last_month);

        // total orders revenue
        if($use_date){
            if($date['start'] === $date['end']){
                $total_orders_revenue = Order::whereDate('created_at', $date['start'])->where('status_id', 5)->sum('order_price');
            }else{
                $total_orders_revenue = Order::whereBetween('created_at', [$date['start'],$date['end']])->where('status_id', 5)->sum('order_price');
            }
        }else{
            $total_orders_revenue = Order::where('status_id', 5)->sum('order_price');
        }

        $total_orders_revenue_this_month = Order::where('status_id', 5)->where('created_at', '>=', $start_of_month)->sum('order_price');
        $total_orders_revenue_last_month = Order::where('status_id', 5)->where('created_at', '>=', Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<', Carbon::now()->subMonth(1)->endOfMonth())->sum('order_price');
        $total_orders_revenue_percent = $this->cal_percentage($total_orders_revenue_this_month, $total_orders_revenue_last_month);

        // total delivery revenue
        if($use_date){
            if($date['start'] === $date['end']){
                $delivery_orders_revenue = Order::whereDate('created_at', $date['start'])->where('status_id', 5)->sum('delivery_price');
            }else{
                $delivery_orders_revenue = Order::whereBetween('created_at', [$date['start'],$date['end']])->where('status_id', 5)->sum('delivery_price');
            }
        }else{
            $delivery_orders_revenue = Order::where('status_id', 5)->sum('delivery_price');
        }

        $delivery_orders_revenue_this_month = Order::where('status_id', 5)->where('created_at', '>=', $start_of_month)->sum('delivery_price');
        $delivery_orders_revenue_last_month = Order::where('status_id', 5)->where('created_at', '>=', Carbon::now()->subMonth(1)->startOfMonth())->where('created_at', '<', Carbon::now()->subMonth(1)->endOfMonth())->sum('delivery_price');
        $delivery_orders_revenue_percent = $this->cal_percentage($delivery_orders_revenue_this_month, $delivery_orders_revenue_last_month);

        // total products revenue
        if($use_date){
            if($date['start'] === $date['end']){
                $results = DB::select(DB::raw("SELECT SUM(p.price * ohp.qty) as total FROM products p , order_has_products ohp , orders o where p.id = ohp.product_id and o.id = ohp.order_id and o.status_id = 5 and Date(o.created_at) = '".$date['start']."' "))[0];
            }else{
                $results = DB::select(DB::raw("SELECT SUM(p.price * ohp.qty) as total FROM products p , order_has_products ohp , orders o where p.id = ohp.product_id and o.id = ohp.order_id and o.status_id = 5 and o.created_at between '".$date['start']."' and '".$date['end']."'"))[0];
            }

        }else{
            $results = DB::select(DB::raw("SELECT SUM(p.price * ohp.qty) as total FROM products p , order_has_products ohp , orders o where p.id = ohp.product_id and o.id = ohp.order_id and o.status_id = 5"))[0];
        }

        $products_orders_revenue = $results->total == null ? 0 : $results->total  ;
        $results = DB::select(DB::raw("SELECT SUM(p.price * ohp.qty) as total FROM products p , order_has_products ohp , orders o where p.id = ohp.product_id and o.id = ohp.order_id and o.status_id = 5 and o.created_at >= '" . $start_of_month . "'"))[0];
        $products_orders_revenue_this_month = $results->total == null ? 0 : $results->total  ;
        $results = DB::select(DB::raw("SELECT SUM(p.price * ohp.qty) as total FROM products p , order_has_products ohp , orders o where p.id = ohp.product_id and o.id = ohp.order_id and o.status_id = 5 and o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "'"))[0];
        $products_orders_revenue_last_month = $results->total == null ? 0 : $results->total  ;
        $products_orders_revenue_percent = $this->cal_percentage($products_orders_revenue_this_month, $products_orders_revenue_last_month);


        // net delivery
        $moto_drivers_price = intval(env('DRIVER_MOTORCYCLE_PRICE'));
        $car_drivers_price = intval(env('DRIVER_CAR_PRICE'));
        if($use_date){
            if($date['start'] === $date['end']){
                $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Car' and o.status_id = 5 and Date(o.created_at) = '".$date['start']."' "))[0];
            }else{
                $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Car' and o.status_id = 5 and o.created_at between '".$date['start']."' and '".$date['end']."'"))[0];
            }


        }else{
            $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Car' and o.status_id = 5"))[0];
        }
        $count_car_drivers = $results->cnt;
        $total_delivery_car_drivers = $results->total;
        $net_delivery_car_drivers = $total_delivery_car_drivers - ($count_car_drivers * $car_drivers_price);
        if($use_date){
            if($date['start'] === $date['end']){
                $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Motorcycle' and o.status_id = 5 and Date(o.created_at) = '".$date['start']."'"))[0];
            }else{
                $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Motorcycle' and o.status_id = 5 and o.created_at between '".$date['start']."' and '".$date['end']."'"))[0];
            }
        }else{
            $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Motorcycle' and o.status_id = 5"))[0];
        }
        $count_moto_drivers = $results->cnt;
        $total_delivery_moto_drivers = $results->total;
        $net_delivery_moto_drivers = $total_delivery_moto_drivers - ($count_moto_drivers * $moto_drivers_price);

        $net_delivery_total = $net_delivery_car_drivers + $net_delivery_moto_drivers;


        $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Car' and o.status_id = 5 and o.created_at >= '" . Carbon::now()->startOfMonth() . "'"))[0];
        $count_car_drivers_this_month = $results->cnt;
        $total_delivery_car_drivers_this_month = $results->total;
        $net_delivery_car_drivers_this_month = $total_delivery_car_drivers_this_month - ($count_car_drivers_this_month * $car_drivers_price);


        $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Motorcycle' and o.status_id = 5 and o.created_at >= '" . Carbon::now()->startOfMonth() . "'"))[0];
        $count_moto_drivers_this_month = $results->cnt;
        $total_delivery_moto_drivers_this_month = $results->total;
        $net_delivery_moto_drivers_this_month = $total_delivery_moto_drivers_this_month - ($count_moto_drivers_this_month * $moto_drivers_price);

        $net_delivery_drivers_this_month = $net_delivery_car_drivers_this_month + $net_delivery_moto_drivers_this_month;


        $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Car' and o.status_id = 5 and  o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "'"))[0];
        $count_car_drivers_last_month = $results->cnt;
        $total_delivery_car_drivers_last_month = $results->total;
        $net_delivery_car_drivers_last_month = $total_delivery_car_drivers_last_month - ($count_car_drivers_last_month * $car_drivers_price);

        $results = DB::select(DB::raw("SELECT count(u.vehicle) as cnt , SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and u.vehicle = 'Motorcycle' and o.status_id = 5 and  o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "'"))[0];
        $count_moto_drivers_last_month = $results->cnt;
        $total_delivery_moto_drivers_last_month = $results->total;
        $net_delivery_moto_drivers_last_month = $total_delivery_moto_drivers_last_month - ($count_moto_drivers_last_month * $moto_drivers_price);

        $net_delivery_drivers_last_month = $net_delivery_car_drivers_last_month + $net_delivery_moto_drivers_last_month;

        $net_drivers_revenue_percent = $this->cal_percentage($net_delivery_drivers_this_month, $net_delivery_drivers_last_month);



        // drivers stats
        $collection_price =env('COLLECTION_PRICE');
        $collection_product_price = env('COLLECTION_PRODUCT_PRICE');
        $drivers = User::where('status', 1)->where('role', 'driver')->get();
        $stores = Store::where('status', 1)->get();
        $data_from = Carbon::now()->startOfMonth() ;
        $data_to   = Carbon::now()->endOfMonth() ;
        $last_month_from = Carbon::now()->subMonth(1)->startOfMonth() ;
        $last_month_to = Carbon::now()->subMonth(1)->endOfMonth();
        $total_totals_earning = 0;
        $total_date_earning = 0;
        $total_last_month_earning = 0;
        $dataStats = [];
        foreach ($stores as $store) {
            foreach ($drivers as $driver) {
                $results = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . " and o.store_id = " . $store->id . " and o.created_at >= '" . $data_from . "' and o.created_at <= '" . $data_to . "' and o.status_id = 5"))[0];
                $results_total = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . " and o.store_id = " . $store->id . "  and o.status_id = 5"))[0];
                $results_last_month = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . " and o.store_id = " . $store->id . " and o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "' and o.status_id = 5"))[0];
                $collect = $this->collection($store->id,$driver->id,$data_from,$data_to,$last_month_from,$last_month_to);

                $dataStats []= [
                    'store' => $store->name,
                    'driver' => $driver->name,
                    'last_month_earning' => empty($results_last_month->total) ? number_format(0, 2) : number_format($results_last_month->total + $collect[0], 2),
                    'date_earning' => empty($results->total) ? number_format(0, 2) : number_format($results->total + $collect[1], 2),
                    'total_earning' => empty($results_total->total) ? number_format(0, 2) : number_format($results_total->total + $collect[2], 2)
                ];

                $total_last_month_earning += $results_last_month->total + $collect[0];
                $total_date_earning += $results->total + $collect[1];
                $total_totals_earning += $results_total->total + $collect[2];

            }
        }

        $date_start = Carbon::now()->startOfMonth()->isoFormat('DD/MM/YYYY');
        $date_end   = Carbon::now()->endOfMonth()->isoFormat('DD/MM/YYYY');
      //  dd($date_start . "|" .$date_end );

        $data = [

            'date_start' => $date_start,
            'date_end' =>$date_end,


            'data' => $dataStats,

            // params
            'stores' => Store::where('status', 1)->get(),
            'drivers' => User::where('role', 'driver')->where('status', 1)->get(),
            'parameters' => count($_GET),


            // total
            'total_orders' => $total_orders,
            'total_orders_percent' => number_format($this->filter_percent($total_orders_percent), 2),
            'total_orders_this_month' => $total_orders_this_month,
            'total_orders_last_month' => $total_orders_last_month,
            'total_orders_percent_color' => $total_orders_percent < 0 ? 'danger' : 'success',
            'total_orders_percent_arrow' => $total_orders_percent < 0 ? 'down' : 'up',
            // delivered
            'total_delivered_orders' => $total_orders_delivered,
            'total_delivered_this_month' => $total_orders_delivered_this_month,
            'total_delivered_last_month' => $total_orders_delivered_last_month,
            'delivered_orders_percent' => number_format($this->filter_percent($total_orders_delivered_percent), 2),
            'delivered_orders_percent_color' => $total_orders_delivered_percent < 0 ? 'danger' : 'success',
            'delivered_orders_percent_arrow' => $total_orders_delivered_percent < 0 ? 'down' : 'up',
            // pending
            'total_pending_orders' => $total_orders_pending,
            'total_pending_orders_this_month' => $total_orders_pending_this_month,
            'total_pending_orders_last_month' => $total_orders_pending_last_month,
            'pending_orders_percent' => number_format($this->filter_percent($total_orders_pending_percent), 2),
            'pending_orders_percent_color' => $total_orders_pending_percent < 0 ? 'danger' : 'success',
            'pending_orders_percent_arrow' => $total_orders_pending_percent < 0 ? 'down' : 'up',
            // refunded
            'total_refunded_orders' => $total_orders_refunded,
            'total_refunded_orders_this_month' => $total_orders_refunded_this_month,
            'total_refunded_orders_last_month' => $total_orders_refunded_last_month,
            'refunded_orders_percent' => number_format($this->filter_percent($total_orders_refunded_percent), 2),
            'refunded_orders_percent_color' => $total_orders_refunded_percent < 0 ? 'danger' : 'success',
            'refunded_orders_percent_arrow' => $total_orders_refunded_percent < 0 ? 'down' : 'up',

            // total revenue
            'total_revenue_orders' => $total_orders_revenue,
            'total_revenue_orders_this_month' => $total_orders_revenue_this_month,
            'total_revenue_orders_last_month' => $total_orders_revenue_last_month,
            'revenue_orders_percent' => number_format($this->filter_percent($total_orders_revenue_percent), 2),
            'revenue_orders_percent_color' => $total_orders_revenue_percent < 0 ? 'danger' : 'success',
            'revenue_orders_percent_arrow' => $total_orders_revenue_percent < 0 ? 'down' : 'up',

            // delivery revenue
            'delivery_revenue_orders' => $delivery_orders_revenue,
            'delivery_revenue_orders_this_month' => $delivery_orders_revenue_this_month,
            'delivery_revenue_orders_last_month' => $delivery_orders_revenue_last_month,
            'delivery_revenue_orders_percent' => number_format($this->filter_percent($delivery_orders_revenue_percent), 2),
            'delivery_revenue_orders_percent_color' => $delivery_orders_revenue_percent < 0 ? 'danger' : 'success',
            'delivery_revenue_orders_percent_arrow' => $delivery_orders_revenue_percent < 0 ? 'down' : 'up',

            // products revenue
            'products_orders_revenue' => $products_orders_revenue,
            'products_orders_revenue_this_month' => $products_orders_revenue_this_month,
            'products_orders_revenue_last_month' => $products_orders_revenue_last_month,
            'products_orders_revenue_percent' => number_format($this->filter_percent($products_orders_revenue_percent), 2),
            'products_orders_revenue_percent_color' => $products_orders_revenue_percent < 0 ? 'danger' : 'success',
            'products_orders_revenue_percent_arrow' => $products_orders_revenue_percent < 0 ? 'down' : 'up',

            // net revenue
            'net_delivery_total' => $net_delivery_total,
            'net_delivery_total_this_month' => $net_delivery_drivers_this_month,
            'net_delivery_total_last_month' => $net_delivery_drivers_last_month,
            'net_delivery_drivers_last_month' => number_format($net_delivery_drivers_last_month, 2),
            'net_drivers_revenue_percent' => number_format($this->filter_percent($net_drivers_revenue_percent), 2),
            'net_drivers_revenue_percent_color' => $net_drivers_revenue_percent < 0 ? 'danger' : 'success',
            'net_drivers_revenue_percent_arrow' => $net_drivers_revenue_percent < 0 ? 'down' : 'up',


        ];
        $data['total_last_month_earning'] = number_format($total_last_month_earning,2);
        $data['total_date_earning'] = number_format($total_date_earning,2);
        $data['total_totals_earning'] =  number_format($total_totals_earning,2);
        //dd($data['data']);

        return view('finances.index', $data);
    }


    public function stats(Request $request)
    {
        $data_from = Carbon::parse($request->date_from)->format('Y-m-d');
        $data_to = Carbon::parse($request->date_to)->format('Y-m-d');
        $last_month_from = Carbon::now()->subMonth(1)->startOfMonth() ;
        $last_month_to = Carbon::now()->subMonth(1)->endOfMonth();
        $store_id = isset($request->store_id) ? $request->store_id : 'all';
        $driver_id = isset($request->driver_id) ? $request->driver_id : 'all';

        $total_totals_earning = 0;
        $total_date_earning = 0;
        $total_last_month_earning = 0;

        // net delivery
        $moto_drivers_price = intval(env('DRIVER_MOTORCYCLE_PRICE'));
        $car_drivers_price = intval(env('DRIVER_CAR_PRICE'));
        $collection_price =env('COLLECTION_PRICE');
        $collection_product_price = env('COLLECTION_PRODUCT_PRICE');
        $drivers = User::where('status', 1)->where('role', 'driver')->get();
        $stores = Store::where('status', 1)->get();

        $data = array();
        if ($store_id == 'all' && $driver_id == "all") {

            foreach ($stores as $store) {
                foreach ($drivers as $driver) {
                    $results = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . " and o.store_id = " . $store->id . " and o.created_at >= '" . $data_from . "' and o.created_at <= '" . $data_to . "' and o.status_id = 5"))[0];
                    $results_total = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . " and o.store_id = " . $store->id . "  and o.status_id = 5"))[0];
                    $results_last_month = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . " and o.store_id = " . $store->id . " and o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "' and o.status_id = 5"))[0];
                    $collect = $this->collection($store->id,$driver->id,$data_from,$data_to,$last_month_from,$last_month_to);

                    $data['data'] []= [
                        'store' => $store->name,
                        'driver' => $driver->name,
                        'last_month_earning' => empty($results_last_month->total) ? number_format(0, 2) : number_format($results_last_month->total + $collect[0], 2),
                        'date_earning' => empty($results->total) ? number_format(0, 2) : number_format($results->total + $collect[1], 2),
                        'total_earning' => empty($results_total->total) ? number_format(0, 2) : number_format($results_total->total + $collect[2], 2)
                    ];

                    $total_last_month_earning += $results_last_month->total + $collect[0];
                    $total_date_earning += $results->total + $collect[1];
                    $total_totals_earning += $results_total->total + $collect[2];

                }
            }


        } elseif ($store_id != 'all' && $driver_id == "all") {

            //foreach ($stores as $store){
            $store = Store::whereId($store_id)->whereStatus(1)->first();
            foreach ($drivers as $driver) {
                $results = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . "  and o.store_id = " . $store->id . " and o.created_at >= '" . $data_from . "' and o.created_at <= '" . $data_to . "' and o.status_id = 5"))[0];
                $results_total = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . "  and o.store_id = " . $store->id . " and o.status_id = 5"))[0];
                $results_last_month = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . "  and o.store_id = " . $store->id . " and o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "' and o.status_id = 5"))[0];
                $collect = $this->collection($store->id,$driver->id,$data_from,$data_to,$last_month_from,$last_month_to);

                $data['data'][] = [
                    'store' => $store->name,
                    'driver' => $driver->name,
                    'last_month_earning' => empty($results_last_month->total) ? number_format(0, 2) : number_format($results_last_month->total + $collect[0], 2),
                    'date_earning' => empty($results->total) ? number_format(0, 2) : number_format($results->total + $collect[1], 2),
                    'total_earning' => empty($results_total->total) ? number_format(0, 2) : number_format($results_total->total + $collect[2], 2)
                ];

                $total_last_month_earning += $results_last_month->total + $collect[0];
                $total_date_earning += $results->total + $collect[1];
                $total_totals_earning += $results_total->total + $collect[2];
            }

        } elseif ($store_id == 'all' && $driver_id != "all") {

            //foreach ($stores as $store){
            $driver = User::whereId($driver_id)->whereStatus(1)->first();

            foreach ($stores as $store) {
                $results = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . "  and o.store_id = " . $store->id . " and o.created_at >= '" . $data_from . "' and o.created_at <= '" . $data_to . "' and o.status_id = 5"))[0];
                $results_total = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . "  and o.store_id = " . $store->id . " and o.status_id = 5"))[0];
                $results_last_month = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver->id . "  and o.store_id = " . $store->id . " and o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "' and o.status_id = 5"))[0];


                $collect = $this->collection($store->id,$driver->id,$data_from,$data_to,$last_month_from,$last_month_to);


                $data['data'][] = [
                    'store' => $store->name,
                    'driver' => $driver->name,
                    'last_month_earning' => empty($results_last_month->total) ? number_format(0, 2) : number_format($results_last_month->total + $collect[0], 2),
                    'date_earning' => empty($results->total) ? number_format(0, 2) : number_format($results->total + $collect[1], 2),
                    'total_earning' => empty($results_total->total) ? number_format(0, 2) : number_format($results_total->total + $collect[2], 2),
                     ];

                $total_last_month_earning += $results_last_month->total + $collect[0];
                $total_date_earning += $results->total + $collect[1];
                $total_totals_earning += $results_total->total + $collect[2];

            }

        }elseif ($store_id != 'all' && $driver_id != "all") {

            //foreach ($stores as $store){
            $store = Store::whereId($store_id)->whereStatus(1)->first();
            $driver = User::whereId($driver_id)->first();


            $collect = $this->collection($store->id,$driver->id,$data_from,$data_to,$last_month_from,$last_month_to);



            $results = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver_id . " 
             and o.store_id = " . $store->id . " and o.created_at >= '" . $data_from . "' and o.created_at <= '" . $data_to . "' and o.status_id = 5"))[0];
            $results_total = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver_id . "  and o.store_id = " . $store->id . " and o.status_id = 5"))[0];
            $results_last_month = DB::select(DB::raw("SELECT  SUM(o.delivery_price) as total FROM orders o , users u where u.id = o.user_id and o.user_id = " . $driver_id . "  and o.store_id = " . $store->id . " and o.created_at >= '" . Carbon::now()->subMonth(1)->startOfMonth() . "' and o.created_at <= '" . Carbon::now()->subMonth(1)->endOfMonth() . "' and o.status_id = 5"))[0];

            $data['data'][] = [
                'store' => $store->name,
                'driver' => $driver->name,
                'last_month_earning' => empty($results_last_month->total) ? number_format(0, 2) : number_format($results_last_month->total +  $collect[0], 2),
                'date_earning' => empty($results->total) ? number_format(0, 2) : number_format($results->total +  $collect[1], 2),
                'total_earning' => empty($results_total->total) ? number_format(0, 2) : number_format($results_total->total +  $collect[2], 2)
            ];

            $total_last_month_earning = $results_last_month->total + $collect[0];
            $total_date_earning = $results->total + $collect[1];
            $total_totals_earning = $results_total->total + $collect[2];

        }

        $data['total_last_month_earning'] = number_format($total_last_month_earning,2);
        $data['total_date_earning'] = number_format($total_date_earning,2);
        $data['total_totals_earning'] =  number_format($total_totals_earning,2);
        return response()->json($data);

    }

    public function collection($store_id,$driver_id,$date_from,$date_to,$date_last_month_from,$date_last_month_to){

        $order_for_collectables = Order::with('products')->where('store_id',$store_id)->where('user_id','=',$driver_id)->where('status_id','=','5')->where('created_at','>=',$date_from)->where('created_at','<=',$date_to)->get();
        $order_for_collectables_last_month = Order::with('products')->where('store_id',$store_id)->where('user_id','=',$driver_id)->where('status_id','=','5')->where('created_at','>=',$date_last_month_from)->where('created_at','<=',$date_last_month_to)->get();
        $order_for_collectables_total = Order::with('products')->where('store_id',$store_id)->where('user_id','=',$driver_id)->where('status_id','=','5')->get();
        $collection_price =env('COLLECTION_PRICE');
        $collection_product_price = env('COLLECTION_PRODUCT_PRICE');
        $collection_profit = 0;
        $collection_profit_last_month = 0;
        $collection_profit_total = 0;

        foreach($order_for_collectables as $order_for_collectable)
        {
            foreach($order_for_collectable->products as $product_for_collect)
            {
                if($product_for_collect->price > $collection_product_price)
                {
                    $collection_profit += $collection_price;
                }
            }
        }
        foreach($order_for_collectables_last_month as $order_for_collectable_last)
        {
            foreach($order_for_collectable_last->products as $product_for_collect_last)
            {
                if($product_for_collect_last->price > $collection_product_price)
                {
                    $collection_profit_last_month += $collection_price;
                }
            }
        }
        foreach($order_for_collectables_total as $order_for_collectable_total)
        {
            foreach($order_for_collectable_total->products as $product_for_collect_total)
            {
                if($product_for_collect_total->price > $collection_product_price)
                {
                    $collection_profit_total += $collection_price;
                }
            }
        }

        return [$collection_profit_last_month,$collection_profit,$collection_profit_total];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

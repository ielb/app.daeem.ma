<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Supermarket;
use App\Models\Store;
use App\Models\User;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\OrderHasStatus;
use App\Models\OrderHasProduct;
use App\Models\Product;
use App\Models\OrderRefund;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
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
        if(auth()->user()->role != 'admin' && auth()->user()->working == 0){
            abort(403);
        }

        $store = Store::where(['status'=>1])->get();
        $drivers = User::where([['status','=','1'],['role' ,'=', 'driver'],['working','=','1']])->get();
        $collectors = User::where([['status','=','1'],['role','=','collector'],['working','=','1']])->orWhere('role','=','driver')->get();
        $clients = Client::where(['status'=>1])->get();
        $status = Status::all();
        
        if(auth()->user()->role == "admin"){
            $orders = Order::latest()->get();
        }elseif(auth()->user()->role == "driver"){
            $orders = Order::latest()->where('user_id','=', auth()->user()->id)->get();
        }elseif(auth()->user()->role == "collector"){
            $orders = Order::latest()->where('collector_id','=', auth()->user()->id)->get();
        }
         //FILTER BT store
         if (isset($_GET['store_id'])) {
            $orders = $orders->where('store_id','=',$_GET['store_id']);
        }
        
        //FILTER BT client
        if (isset($_GET['client_id'])) {
           $orders = $orders->where('client_id','=',$_GET['client_id']); 
        }

         //FILTER BT status
         if (isset($_GET['status_id'])) {
            $orders = $orders->where('status_id','=',$_GET['status_id']);
        }

         //FILTER BT driver
         if (isset($_GET['driver_id'])) { 
       
            $orders = $orders->where('user_id','=',$_GET['driver_id']);
            
        }
        
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
        
        return view('orders.index',['orders' => $orders,'stores' => $store, 'drivers' =>$drivers,'clients' => $clients,'status'=> $status,'parameters'=>count($_GET) != 0,'collectors'=>$collectors,    ]);
    }


    public function refresh()
    {
        $drivers2 = User::where([['status','=','1'],['role' ,'=', 'driver'],['working','=','1']])->get();
        return json_encode(['data'=>$drivers2]);
    }


    public function refunds(){

        $refunds = OrderRefund::all();

        return view('orders.refunds',['refunds' =>$refunds]);
    }

    /**
     * live orders
     *
     * @return \Illuminate\Http\Response
     */
    public function liveapi()
    {

        //Today only
        $orders = Order::where('created_at', '>=', Carbon::today())->orderBy('id', 'desc')->get();


        $newOrders = [];
        $doneOrders = [];
        $preparedOrders = [];


        //----- ADMIN ------
        foreach ($orders as $key => $order) {
            if ($order['status_id'] == 1) {
                $order['pulse'] = 'blob green';
                array_push($newOrders, $order);
            } elseif ($order['status_id'] == 3 || $order['status_id'] == 4 || $order['status_id'] == 8 ) {
                if ($order['status_id'] == 4 || $order['status_id'] == 8 ) {
                    $order['pulse'] = 'blob greenstatic';
                }
                if ($order['status_id'] == 3) {
                    $order['pulse'] = 'blob orange';
                }
                array_push($preparedOrders, $order);
            } elseif ($order['status_id'] == 6 || $order['status_id'] == 7 ||  $order['status_id'] == 5) {
                $order['pulse'] = 'blob redstatic';
                array_push($doneOrders, $order);
            }
            $order['order_date'] = $order['created_at']->diffForHumans();
            $order['status_name'] = $order->status->name;
            $order['client_name'] = $order->client->name;
            $order['client_id'] = $order->client->id;
            $order['store_name'] = $order->store->name;
            $order['store'] = $order->store;
        }
        $toRespond = [
            'neworders'=>$newOrders,
            'prepared'=>$preparedOrders,
            'done'=>$doneOrders,
        ];

        return response()->json($toRespond);

    }

    /**
     * live orders
     *
     * @return \Illuminate\Http\Response
     */
    public function live()
    {
        return view('orders.live');
    }

    /**
     * accept orders
     *
     * @return \Illuminate\Http\Response
     */
    public function accept($order_id)
    {

        $order = Order::find($order_id);
        $result = $order->update([
            'status_id' => 2
        ]);
        $user = auth()->user()->id;

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $order->id,
            'status_id' => 2,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);

        $toRespond = [
            'count'=>0,
            'status'=>'error',
        ];
        if($result){

            $count = Order::where('created_at', '>=', Carbon::today())->where('status_id',1)->orderBy('id', 'desc')->get()->count();
            $toRespond['count'] = $count;
            $toRespond['status'] = 'success';
            return response()->json($toRespond);
        }

        return response()->json($toRespond);

    }

    /**
     * reject orders
     *
     * @return \Illuminate\Http\Response
     */
    public function reject($order_id)
    {

        $order = Order::find($order_id);
        $result = $order->update([
            'status_id' => 6
        ]);

        $user = auth()->user()->id;

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $order->id,
            'status_id' => 6,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);

        $toRespond = [
            'count'=>0,
            'status'=>'error',
        ];
        if($result){

            $count = Order::where('created_at', '>=', Carbon::today())->where('status_id',1)->orderBy('id', 'desc')->get()->count();
            $toRespond['count'] = $count;
            $toRespond['status'] = 'success';
            return response()->json($toRespond);
        }

        return response()->json($toRespond);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    //chnage action order
    public function accepted_by_admin($id)
    {
        # code...
        $order = Order::find($id);
        $user = auth()->user()->id;

        $changelaststaus = $order->update([
            'status_id' => 2
        ]);

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $id,
            'status_id' => 2,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);
        return redirect()->route('orders')->withStatus(__('Order status succesfully changed.'));

        
    }

    public function rejected_by_admin($id)
    {
        # code...
        $order = Order::find($id);
        $user = auth()->user()->id;

        $changelaststaus = $order->update([
            'status_id' => 6
        ]);

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $id,
            'status_id' => 6,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);
        return redirect()->route('orders')->withStatus(__('Order status succesfully changed.'));
        
    }
    public function asign_driver($id)
    {
        if (isset($_GET['driver'])) {
           
        # code...
        $order = Order::find($id);
        $user = auth()->user()->id;
        $changelaststaus = $order->update([
            'collector_id' => $_GET['collector'],
            'user_id' => $_GET['driver'],
            'status_id' => 3,
        ]);

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $id,
            'status_id' => 3,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);
  
        return redirect()->route('orders')->withStatus(__('Order status succesfully changed.'));
    }
    }

    public function accepted_by_driver($id)
    {
        # code...
        $order = Order::find($id);
        $user = auth()->user()->id;

        $changelaststaus = $order->update([
            'status_id' => 8
        ]);

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $id,
            'status_id' => 8,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);
        return redirect()->route('orders')->withStatus(__('Order status succesfully changed.'));

        
    }
    public function rejected_by_driver($id)
    {
        # code...
        $order = Order::find($id);
        $user = auth()->user()->id;
        $user_id = null;
        $changelaststaus = $order->update([
            'user_id' => $user_id,
            'status_id' => 7,
        ]);
        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $id,
            'status_id' => 7,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);
        return redirect()->route('orders')->withStatus(__('Order status succesfully changed.'));

        
    }

    public function prepared(Request $request ,$id)
    {
        $order = Order::find($id);
        if (isset($request->time)) {
           
        # code...
        $user = auth()->user()->id;
        $changelaststaus = $order->update([
            'delivery_pickup_interval' => $request->time,
            'status_id' => 4,
        ]);

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $id,
            'status_id' => 4,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);
        }


        if(isset($request->images))
        {
            $images=array();
            if($files=$request->file('images')){
                foreach($files as $file){
                    $name = rand().'_'.date('YmdHis').'.'.$file->extension();
                    $file->move(public_path('images/orders/'),$name);
                    $images[]=$name;
                }
            }
            $order->update( [
                'invoice_images' =>  implode("|",$images),
            ]);
        }
  
        return redirect()->route('orders')->withStatus(__('Order status/images succesfully changed.'));
    }
    public function delivered($id)
    {
        # code...
        $order = Order::find($id);
        $user = auth()->user()->id;

        $changelaststaus = $order->update([
            'status_id' => 5
        ]);

        $orderhasstatus = OrderHasStatus::create([
            'order_id' => $id,
            'status_id' => 5,
            'client_id' => $order->client_id,
            'user_id' => $user,
        ]);
        return redirect()->route('orders')->withStatus(__('Order status succesfully changed.'));

        
    }

    public function invoice($id)
    {
        # code...
        $order = Order::find($id);
        if($order->status_id == 5){

        $order_products = OrderHasProduct::with('product')->where('order_id','=',$order->id)->get();
       
        $products = [];
            for ($i=0; $i < count($order_products) ; $i++) { 
                # code...
              $products[] =  $order_products[$i]->product;
                
            }
           
        // foreach ($order_products as $order_product){
        //  $products = Product::where('id','=',$order_product->product_id)->get();
         
        // }

        
        return view('orders.partials.invoice',['order' => $order,'order_products' => $order_products,'products'=>$products]);

    }   
    abort(404);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order,$id)
    {
        if(auth()->user()->role != 'admin' && auth()->user()->working == 0){
            abort(403);
        }
        $order = Order::find($id);
        $order_products = OrderHasProduct::with('product')->where('order_id','=',$id)->get();
        $preview_image = explode('|', $order->invoice_images);
        $statuses = Status::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $drivers = User::where([['status','=','1'],['role' ,'=', 'driver']])->get();
        $collectors = User::where([['status','=','1'],['role','=','collector'],['working','=','1']])->orWhere('role','=','driver')->get();
       

        
        
        return view('orders.show',['order' => $order, 'statuses' => $statuses,'drivers' =>$drivers, 'users' => $users,'collectors'=>$collectors,'preview_image'=>$preview_image,'order_products' => $order_products]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function insert_image(Request $request, Order $order)
    {
        $input=$request->all();

        // dd($request->file('images')); 
        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name = rand().'_'.date('YmdHis').'.'.$file->extension();
                $file->move(public_path('images/orders/'),$name);
                $images[]=$name;
            }
        }
        
        /*Insert your data*/

        $order->update( [
            'invoice_images' =>  implode("|",$images),
        ]);


        return redirect()->back()->withStatus(__('Order invoice images succesfully inserted.'));
    }

    public function delete_image(Order $order,$image)
    {
        $new_images=array();
        $images = explode('|', $order->invoice_images);
        if(count($images) > 1)
        {
            foreach ($images as $img)
            {
                if($img != $image)
                {
                    $new_images = $img;
                }
            }
        }
        else
        {
            $new_images = NULL;
        }
        $order->invoice_images = $new_images;
        $order->update();

        return redirect()->back()->withStatus(__('Order invoice images succesfully deleted.'));
    }
}

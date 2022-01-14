<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }
    public function updatestatus($id,$status)
    {
        if ($status==1) {
          DB::table('clients')->where('id',$id)->update([
              'status' => 0 
          ]);

          return redirect()->route('clients.index')->withStatus(__('Client successfully deactivated.'));
        }
        else {
            DB::table('clients')->where('id',$id)->update([
                'status' => 1
            ]);
            return redirect()->route('clients.index')->withStatus(__('Client successfully activated.'));        }

        
    }

    public function show($id)
    {

        $client = Client::find($id);

        $totalorder = DB::table('orders')->where('client_id',$id)->count();

        $totalprice = Order::where('client_id',$id)->sum('order_price');

        // $orders = DB::table('orders')
        //     ->join('supermarkets', 'orders.supermarket_id', '=', 'supermarkets.id')
        //     ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        //     ->join('users', 'users.id', '=', 'orders.user_id')
        //     ->where('client_id',$id)
        //     ->select('orders.*', 'supermarkets.name as name_sup', 'users.name as name_user','statuses.name as name_status','supermarkets.id as super_id','users.id as user_id','statuses.color as color')
        //     ->get();

        $orders = Order::where('client_id',$id)->get();
     //   dd($orders[0]->user->name);
    
        return view('clients.show',compact('client','orders','totalorder','totalprice'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $clients = DB::table('clients')->latest()->get();
        return view('clients.index',compact('clients'));
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
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }


    public function login(Request $request){

        $client = array();

        $response = [
            'status' => 'error',
            'message' => 'login or password incorrect',
            'client' =>$client
        ];
        return $response;
    }
}

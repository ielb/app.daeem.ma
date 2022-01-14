<?php

namespace App\Http\Controllers;

#use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Client;

class notificationController extends Controller
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
        return view('notifications.index');
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

        $SERVER_API_KEY = '	AAAAr8Jfxfw:APA91bG5tICcx2PFX5Q6eeSvaJHdhE4VP3QuiJ1U6BPpHtxVDGN-YFvgLpaPYA-md5NtLUh-NWvhrCUMgU1KgXmQh2e8FAkWemVhyL8U3OKIYsplr_LK-gqV6x1JFzI4eWTEdZMeF3ga';
        $tokens = array();
        $clients = Client::where('status',1)->get();

        foreach ($clients as $client){

            $tokens[] = $client->client_token;
        }


        $data = [
            "registration_ids" => $tokens, // for multiple device ids
            "data" => array(
                "title" => $request->title,
                "body" =>  $request->body
            ),
            "notification" => array(
                "title" => $request->title,
                "body" =>  $request->body
            ),
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        curl_close($ch);

        return redirect()->route('notifications.index')->withStatus(__('Notifications pushed successfully.'));

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}

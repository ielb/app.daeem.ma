<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
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
        $setting = Setting::first();
        return view('settings.index',compact('setting'));
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
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }


    public static function changeEnvironmentVariable($key,$value)
    {
        $path = base_path('.env');
        $old = env($key);
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=".$old, "$key=".$value, file_get_contents($path)
            ));
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this::changeEnvironmentVariable('APP_NAME',$request->site_name);
        $this::changeEnvironmentVariable('description',$request->description);
        $this::changeEnvironmentVariable('facebook_link',$request->facebook_link);
        $this::changeEnvironmentVariable('instagram_link',$request->instagram_link);
        $this::changeEnvironmentVariable('playstore',$request->playstore);
        $this::changeEnvironmentVariable('appstore',$request->appstore);
        $this::changeEnvironmentVariable('maps_api_key',$request->maps_api_key);
      //  $this::changeEnvironmentVariable('APP_NAME','Daeem');

//         Setting::where('id',$request->id)->update([
//            'site_name'      => $request->site_name,
//            'description'    => $request->description,
//            'facebook_link'  => $request->facebook_link,
//            'instagram_link' => $request->instagram_link,
//            'playstore'      => $request->playstore,
//            'appstore'       => $request->appstore,
//            'maps_api_key'   => $request->maps_api_key
//        ]);
        return redirect()->route('settings')->withStatus(__('Successfully Update.')); 
    }

    public function update_logo(Request $req)
    {   
        if(isset($req->site_logo)){
            $req->site_logo->move(public_path('assets/img/brand/'),'daeem_blue.png');
        }
        if (isset($req->site_icon)) {
            $b = $req->site_icon->move(public_path('assets/img/brand/'),'favicon.png');
        }
        if (isset($req->site_avatar_client)) {
            $c = $req->site_avatar_client->move(public_path('assets/img/brand/'),'avatar_client.png');
        }
        if (isset($req->color_head)) {
            $color = substr($req->color_head, 1);
            $this::changeEnvironmentVariable('color_head',$color);
        }
        
        return redirect()->route('settings')->withStatus(__('Successfully Update.')); 
    }

    public function update_driver(Request $request)
    {   
        if (isset($request->DRIVER_MOTORCYCLE_PRICE)) {
            $this::changeEnvironmentVariable('DRIVER_MOTORCYCLE_PRICE',$request->DRIVER_MOTORCYCLE_PRICE);
        }
        if (isset($request->DRIVER_CAR_PRICE)) {
            $this::changeEnvironmentVariable('DRIVER_CAR_PRICE',$request->DRIVER_CAR_PRICE);
        }
        if (isset($request->COLLECTION_PRODUCT_PRICE)) {
            $this::changeEnvironmentVariable('COLLECTION_PRODUCT_PRICE',$request->COLLECTION_PRODUCT_PRICE);    
        }
        if (isset($request->COLLECTION_PRICE)) {
            $this::changeEnvironmentVariable('COLLECTION_PRICE',$request->COLLECTION_PRICE);
        }

        return redirect()->route('settings')->withStatus(__('Successfully Update.')); 
    }

    public function update_smtp(Request $request)
    {   
        
        $this::changeEnvironmentVariable('MAIL_MAILER',$request->MAIL_MAILER);
        $this::changeEnvironmentVariable('MAIL_HOST',$request->MAIL_HOST);
        $this::changeEnvironmentVariable('MAIL_PORT',$request->MAIL_PORT);
        $this::changeEnvironmentVariable('MAIL_ENCRYPTION',$request->MAIL_ENCRYPTION);
        $this::changeEnvironmentVariable('MAIL_USERNAME',$request->MAIL_USERNAME);
        $this::changeEnvironmentVariable('MAIL_PASSWORD',$request->MAIL_PASSWORD);
        $this::changeEnvironmentVariable('MAIL_FROM_ADDRESS',$request->MAIL_FROM_ADDRESS);
        $this::changeEnvironmentVariable('MAIL_FROM_NAME',$request->MAIL_FROM_NAME);
        

        return redirect()->route('settings')->withStatus(__('Successfully Update.')); 
    }

    // public function clear_cache()
    // {
    //     Artisan::call('cache:clear');
    //     return redirect()->route('settings')->withStatus(__('Successfully, you have cleared all cache of application.')); 
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    
    
}

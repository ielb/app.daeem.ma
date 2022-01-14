<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

class ZoneController extends Controller
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
        $zones = zone::all();
        return view('zones.index',['zones' => $zones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        zone::create([
            'radius' => json_decode($request->path),
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'msg' => '',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        
        $zone = zone::find($id);
        return view('zones.edit',['zone' => $zone]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        //
    }

    public function getzone(Zone $zone)
    {
        return response()->json([
            'data' => [
                'area' => $zone->radius,
                'id' => $zone->id,
            ],
            'status' => true,
            'errMsg' => '',
        ]);
    }

    public function get_zone_index()
    {
        $zone = Zone::first();
        return response()->json([
            'data' => [
                'area' => $zone->radius,
                'id' => $zone->id,
            ],
            'status' => true,
            'errMsg' => '',
        ]);
    }

    public function update_radius_zone(Zone $zone, Request $request)
    {

        $zone->radius = json_decode($request->path);
        $zone->update();

        return response()->json([
            'status' => true,
            'msg' => '',
        ]);
    }

    public function updatezone(Zone $zone, Request $request)
    {


        $zone->name = $request->name_zone;
        
        $zone->radius = json_decode($request->path);

        $zone->update();

        return response()->json([
            'status' => true,
            'msg' => '',
        ]);
    }

    public function update_name(Zone $zone, Request $request)
    {


        $zone->name = $request->name;

        $zone->update();

        return response()->json([
            'status' => true,
            'msg' => '',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::find($id);
        $zone -> delete();
        return redirect()->route('zones')->withStatus(__('successfully Delete.'));
    }
}

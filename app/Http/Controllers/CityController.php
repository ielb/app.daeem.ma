<?php

namespace App\Http\Controllers;

    use App\Models\City;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

class CityController extends Controller
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
        $cities = City::all();
        return view('cities.index',compact('cities'));
    }

    public function status($id,$status)
    {
        if ($status==0) {
            DB::table('cities')->where('id',$id)->update([
                'status' => 1 
            ]);
  
            return redirect()->route('cities')->withStatus(__('City successfully deactivated.'));
          }
          else {
              DB::table('cities')->where('id',$id)->update([
                  'status' => 0
              ]);
              return redirect()->route('cities')->withStatus(__('City successfully activated.'));        }
    }

    public function updatecity(Request $request)
    {
        
         City::where('id',$request->id)->update([
            'name' => $request->city,
            'code_postal' => $request->code_postal
        ]);

        return redirect()->route('cities')->withStatus(__('City successfully Update.')); 
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

        City::insert([
            'name' => $request->city,
            'code_postal' => $request->code_postal,
            'status' => 1,
        ]);
        return redirect()->route('cities')->withStatus(__('City successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        return view('cities.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}

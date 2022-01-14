<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftOption;
use App\Models\DriverShift;
use App\Models\Day;
use App\Models\Zone;
use App\Models\User;

use Illuminate\Http\Request;
use \DateTime;
use Carbon\Carbon;

class ShiftController extends Controller
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
        if(isset($_GET['week'])){
            $get = explode('-',$_GET['week'])[1];
            $week = str_replace('W','',$get);
        }else{
            $date = new DateTime(Date('Y-m-d'));
            $week = $date->format("W") + 1;
        }

        $zones = Zone::all();

        foreach ($zones as $zone){

            $shifts = Shift::where('week',$week)->where('zone_id',$zone->id)->get();
            foreach ($shifts as $shift){
                $shifts_arr = array();
                $shifts_ = ShiftOption::where('shift_id',$shift->id)->get();
                foreach ($shifts_ as $item){
                    $arr = array();
                    $str = explode(';',$item->shift);
                    $arr[] = $str[0];
                    $arr[] = $str[1];
                    $shifts_arr[] = $arr;
                }

                $zone->shifts_ = $shifts_arr;
            }
            $zone->shifts = $shifts;

        }

        $dates=$this->getStartAndEndDate($week,Date('Y'));

        return view('shifts.index',['zones' => $zones , 'week' => Date('Y').'-W'.$week , 'dates' => $dates]);
    }
    public function getStartAndEndDate($week, $year) {
        $dateTime = new DateTime();
        $dateTime->setISODate($year, $week);
        $result['start_date'] = $dateTime->format('d-M-Y');
        $dateTime->modify('+6 days');
        $result['end_date'] = $dateTime->format('d-M-Y');
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $days = Day::all();
        $zones = Zone::all();
        return view('shifts.create',['days' => $days,'zones' => $zones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $week_str = explode('-',trim($request->week));
        $week = str_replace('W','',$week_str[1]);
        $all_zones = isset($request->all_zones) ? 1 : 0;

        $days = $request->days;
        $shifts_from0 = $request->shift_from0;
        $shifts_to0 = $request->shift_to0;
        $shifts_from1 = $request->shift_from1;
        $shifts_to1 = $request->shift_to1;
        $shifts_from2 = $request->shift_from2;
        $shifts_to2 = $request->shift_to2;
        $shifts_from3 = $request->shift_from3;
        $shifts_to3 = $request->shift_to3;
        $shifts_from4 = $request->shift_from4;
        $shifts_to4 = $request->shift_to4;
        $shifts_from5 = $request->shift_from5;
        $shifts_to5 = $request->shift_to5;
        $shifts_from6 = $request->shift_from6;
        $shifts_to6 = $request->shift_to6;

        $data = [];
        foreach ($days as $key => $day){

            if($all_zones != 0){
                $zones = Zone::all();
                $data_zones = [];
                foreach ($zones as $zone){

                    $shift_result = Shift::create([
                        'week' => $week,
                        'day_id' => $day,
                        'zone_id' => $zone->id
                    ]);

                    $shifts = array();
                    switch ($key){
                        case 0:{
                            foreach ($shifts_from0 as $k => $shift){
                                $shifts[] = [
                                    'shift_id' => $shift_result->id,
                                    'day_id' => $day,
                                    'shift' => $shift.";".$shifts_to0[$k],
                                ];
                            }
                            break;
                        }
                        case 1:{
                            foreach ($shifts_from1 as $k => $shift){
                                $shifts[] = [
                                    'shift_id' => $shift_result->id,
                                    'day_id' => $day,
                                    'shift' => $shift.";".$shifts_to1[$k],
                                ];
                            }
                            break;
                        }
                        case 2:{
                            foreach ($shifts_from2 as $k => $shift){
                                $shifts[] = [
                                    'shift_id' => $shift_result->id,
                                    'day_id' => $day,
                                    'shift' => $shift.";".$shifts_to2[$k],
                                ];
                            }
                            break;
                        }
                        case 3:{
                            foreach ($shifts_from3 as $k => $shift){
                                $shifts[] = [
                                    'shift_id' => $shift_result->id,
                                    'day_id' => $day,
                                    'shift' => $shift.";".$shifts_to3[$k],
                                ];
                            }

                            break;
                        }
                        case 4:{
                            foreach ($shifts_from4 as $k => $shift){
                                $shifts[] = [
                                    'shift_id' => $shift_result->id,
                                    'day_id' => $day,
                                    'shift' => $shift.";".$shifts_to4[$k],
                                ];
                            }
                            break;
                        }
                        case 5:{
                            foreach ($shifts_from5 as $k => $shift){
                                $shifts[] = [
                                    'shift_id' => $shift_result->id,
                                    'day_id' => $day,
                                    'shift' => $shift.";".$shifts_to5[$k],
                                ];
                            }
                            break;
                        }
                        case 6:{
                            foreach ($shifts_from6 as $k => $shift){
                                $shifts[] = [
                                    'shift_id' => $shift_result->id,
                                    'day_id' => $day,
                                    'shift' => $shift.";".$shifts_to6[$k],
                                ];
                            }
                            break;
                        }
                    }

                    ShiftOption::insert($shifts);
                }
                $shift_result = Shift::insert($data_zones);
            }else{
                $shift_result = Shift::create([
                    'week' => $week,
                    'day_id' => $day,
                    'zone_id' => $request->zone
                ]);
                $shifts = array();
                switch ($key){
                    case 0:{
                        foreach ($shifts_from0 as $k => $shift){
                            $shifts[] = [
                                'shift_id' => $shift_result->id,
                                'shift' => $shift.";".$shifts_to0[$k],
                            ];
                        }
                        break;
                    }
                    case 1:{
                        foreach ($shifts_from1 as $k => $shift){
                            $shifts[] = [
                                'shift_id' => $shift_result->id,
                                'shift' => $shift.";".$shifts_to1[$k],
                            ];
                        }
                        break;
                    }
                    case 2:{
                        foreach ($shifts_from2 as $k => $shift){
                            $shifts[] = [
                                'shift_id' => $shift_result->id,
                                'shift' => $shift.";".$shifts_to2[$k],
                            ];
                        }
                        break;
                    }
                    case 3:{
                        foreach ($shifts_from3 as $k => $shift){
                            $shifts[] = [
                                'shift_id' => $shift_result->id,
                                'shift' => $shift.";".$shifts_to3[$k],
                            ];
                        }

                        break;
                    }
                    case 4:{
                        foreach ($shifts_from4 as $k => $shift){
                            $shifts[] = [
                                'shift_id' => $shift_result->id,
                                'shift' => $shift.";".$shifts_to4[$k],
                            ];
                        }
                        break;
                    }
                    case 5:{
                        foreach ($shifts_from5 as $k => $shift){
                            $shifts[] = [
                                'shift_id' => $shift_result->id,
                                'shift' => $shift.";".$shifts_to5[$k],
                            ];
                        }
                        break;
                    }
                    case 6:{
                        foreach ($shifts_from6 as $k => $shift){
                            $shifts[] = [
                                'shift_id' => $shift_result->id,
                                'shift' => $shift.";".$shifts_to6[$k],
                            ];
                        }
                        break;
                    }
                }

                ShiftOption::insert($shifts);
            }




        }

        return redirect()->route('shifts')->withStatus(__('Shift successfully created.'));



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $zones  = Zone::all();
        $drivers = User::where('role','driver')->where('status',1)->get();

        if(isset($_GET['week'])){
            $get = explode('-',$_GET['week'])[1];
            $week = str_replace('W','',$get);
        }else{
            $date = new DateTime(Date('Y-m-d'));
            $week = $date->format("W");
        }

        foreach ($drivers as $driver) {

            $driver_shifts = DriverShift::distinct('shift_id')->where('user_id',$driver->id)->where('week',$week)->get();

            $options_data = [];
            $ids = [];
            foreach ($driver_shifts as $k => $shift){


                if(!in_array($shift->shift_id,$ids)){
                    $zone    = Zone::whereId($shift->zone_id)->first();
                    $options = ShiftOption::where('shift_id',$shift->shift_id)->get();
                    // dd($options);
                    $day = Day::whereId($shift->day_id)->first();

                    $data = [
                        'day' =>$day->name,
                        'zone' =>$zone->name,
                        'week' =>$week,
                    ];
                    foreach ($options as $item){

                        $check = DriverShift::where('shift_option_id',$item->id)
                            ->where('user_id',$driver->id)
                            ->where('day_id',$shift->day_id)->count();
                        if($check != 0){
                            $data['shifts'][] = explode(';',$item->shift);
                        }

                    }
                    $options_data[] = $data;
                }
                $ids[] =$shift->shift_id;
            }

            $driver->shifts = $options_data;
            $driver->zone = isset($zone->name) ? $zone->name  :'';

        }


        $dates=$this->getStartAndEndDate($week,Date('Y'));

        return view('shifts.show',['zones' => $zones ,'drivers' => $drivers  , 'dates' => $dates]);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        $shifts_arr = array();
        $shifts_ = ShiftOption::where('shift_id',$shift->id)->get();
        foreach ($shifts_ as $item){
            $arr = array();
            $str = explode(';',$item->shift);
            $arr[] = $str[0];
            $arr[] = $str[1];
            $arr[] = $item->id;
            $shifts_arr[] = $arr;
        }
        $shift->shifts_ = $shifts_arr;

        return view('shifts.edit',[ 'shift' =>$shift , 'week' => Date('Y') .'-W'.$shift->week]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {



        $option_ids = $request->option_ids;
        $shifts_from = $request->shift_from;
        $shifts_to = $request->shift_to;
        $shift_id = $request->shift_id;
        $shift = Shift::whereId($shift_id)->first();

        $shifts = array();
        $shift_str = '';
        foreach ($shifts_from as $k => $sh){
            if($option_ids[$k] != -1){
                // update
                $shifOption = ShiftOption::whereId($option_ids[$k])->first();
                $shifOption->update([
                    'shift' => $sh.";".$shifts_to[$k]
                ]);
            }else{
                // insert
                ShiftOption::create([
                    'shift_id' => $shift->id,
                    'shift' => $sh.";".$shifts_to[$k]
                ]);
            }

        }

         return redirect()->back()->withStatus(__('Shift successfully updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        //
    }

    public function shifts_options(Shift $shift)
    {

        if(auth()->user()->role == 'driver' && auth()->user()->working == 0){
            abort(403);
        }

        $user_id = auth()->user()->id;
        $zones = Zone::all();
        $zone = null;
        $shifts = null;
        if(isset($_GET['week']) && isset($_GET['zones'])){
           $get = explode('-',$_GET['week'])[1];
           $week = str_replace('W','',$get);
            $zone_id = $_GET['zones'];
            $zone = Zone::whereId($zone_id)->first();
            $shifts = Shift::where('week',$week)->where('zone_id',$zone->id)->get();
            foreach ($shifts as $shift){
                $shifts_arr = array();
                $options = ShiftOption::where('shift_id',$shift->id)->get();
                foreach ($options as $option){
                    // check option
                    $check = DriverShift::where('shift_id',$shift->id)
                        ->where('shift_option_id',$option->id)
                        ->where('zone_id',$zone->id)->count();

                    if($check != 0){
                        $option->avaialability = false;

                    }else{
                        $option->avaialability = true;
                    }

                    $str = explode(';',$option->shift);
                    $option->shift = $str;

                }
                $shift->options = $options;
                $shifts_arr[] =  $shift;
                $zone->shifts = $shifts_arr;
            }

            $zone->shifts = $shifts;

        }else{
            $date = new DateTime(Date('Y-m-d'));
            $week = $date->format("W") + 1;
        }



//        foreach ($zones as $zone){
//
//            $shifts = Shift::where('week',$week)->where('zone_id',$zone->id)->get();
//            foreach ($shifts as $shift){
//                $shifts_arr = array();
//                $options = ShiftOption::where('shift_id',$shift->id)->get();
//                foreach ($options as $option){
//                   // check option
//                    $check = DriverShift::where('shift_id',$shift->id)
//                                        ->where('shift_option_id',$option->id)
//                                        ->where('zone_id',$zone->id)->count();
//
//                    if($check != 0){
//                        $option->avaialability = false;
//
//                    }else{
//                        $option->avaialability = true;
//                    }
//
//                  $str = explode(';',$option->shift);
//                  $option->shift = $str;
//
//                }
//                $shift->options = $options;
//                $shifts_arr[] =  $shift;
//                $zone->shifts = $shifts_arr;
//            }
//
//            $zone->shifts = $shifts;
//
//        }




        $dates=$this->getStartAndEndDate($week,Date('Y'));

        return view('shifts.shifts_options',['zones' => $zones , 'zone' => $zone , 'shifts' => $shifts , 'week' => Date('Y').'-W'.$week , 'dates' => $dates]);
    }

    public function shifts_save(Request $request){



     ///  dd($request);

        $zone_id = $request->zone;
        $driver_id = $user_id = auth()->user()->id;
        $get = explode('-',$request->week_submit)[1];
        $week = str_replace('W','',$get);
        $days = $request->day_ids;
        $shift_1 = isset($request->option1) ? $request->option1 : null;
        $shift_2 = isset($request->option2) ? $request->option2 : null;
        $shift_3 = isset($request->option3) ? $request->option3 : null;
        $shift_4 = isset($request->option4) ? $request->option4 : null;
        $shift_5 = isset($request->option5) ? $request->option5 : null;
        $shift_6 = isset($request->option6) ? $request->option6 : null;
        $shift_7 = isset($request->option7) ? $request->option7 : null;
        $data= [];

        if($shift_1 != null){
            foreach ($shift_1 as $sh){
                $str = explode('|',$sh);
                $shift_id = $str[0];
                $option_id = $str[1];
                $check = DriverShift::where('user_id',$driver_id)->where('day_id',$days[0])->where('week',$week)->where('zone_id','!=',$zone_id)->count();

                if($check == 0){
                    $data[]= [
                        'shift_id' => $shift_id,
                        'shift_option_id' => $option_id,
                        'zone_id' => $zone_id,
                        'user_id' => $driver_id,
                        'day_id' => $days[0],
                        'week' => $week,
                    ];
                }

            }
        }
        if($shift_2 != null){
            foreach ($shift_2 as $sh){
                $str = explode('|',$sh);
                $shift_id = $str[0];
                $option_id = $str[1];
                $check = DriverShift::where('user_id',$driver_id)->where('day_id',$days[1])->where('week',$week)->where('zone_id','!=',$zone_id)->count();
                if($check == 0) {
                    $data[] = [
                        'shift_id' => $shift_id,
                        'shift_option_id' => $option_id,
                        'zone_id' => $zone_id,
                        'user_id' => $driver_id,
                        'day_id' => $days[1],
                        'week' => $week,
                    ];
                }
            }
        }
        if($shift_3 != null){
            foreach ($shift_3 as $sh){
                $str = explode('|',$sh);
                $shift_id = $str[0];
                $option_id = $str[1];
                $check = DriverShift::where('user_id',$driver_id)->where('day_id',$days[2])->where('week',$week)->where('zone_id','!=',$zone_id)->count();
                if($check == 0) {
                    $data[] = [
                        'shift_id' => $shift_id,
                        'shift_option_id' => $option_id,
                        'zone_id' => $zone_id,
                        'user_id' => $driver_id,
                        'day_id' => $days[2],
                        'week' => $week,
                    ];
                }
            }
        }
        if($shift_4 != null){
            foreach ($shift_4 as $sh){
                $str = explode('|',$sh);
                $shift_id = $str[0];
                $option_id = $str[1];
                $check = DriverShift::where('user_id',$driver_id)->where('day_id',$days[3])->where('week',$week)->where('zone_id','!=',$zone_id)->count();
                if($check == 0) {
                    $data[] = [
                        'shift_id' => $shift_id,
                        'shift_option_id' => $option_id,
                        'zone_id' => $zone_id,
                        'user_id' => $driver_id,
                        'day_id' => $days[3],
                        'week' => $week,
                    ];
                }
            }
        }
        if($shift_5 != null){
            foreach ($shift_5 as $sh){
                $str = explode('|',$sh);
                $shift_id = $str[0];
                $option_id = $str[1];
                $check = DriverShift::where('user_id',$driver_id)->where('day_id',$days[4])->where('week',$week)->where('zone_id','!=',$zone_id)->count();
                if($check == 0) {
                    $data[] = [
                        'shift_id' => $shift_id,
                        'shift_option_id' => $option_id,
                        'zone_id' => $zone_id,
                        'user_id' => $driver_id,
                        'day_id' => $days[4],
                        'week' => $week,
                    ];
                }
            }
        }
        if($shift_6 != null){
            foreach ($shift_6 as $sh){
                $str = explode('|',$sh);
                $shift_id = $str[0];
                $option_id = $str[1];
                $check = DriverShift::where('user_id',$driver_id)->where('day_id',$days[5])->where('week',$week)->where('zone_id','!=',$zone_id)->count();
                if($check == 0) {
                    $data[] = [
                        'shift_id' => $shift_id,
                        'shift_option_id' => $option_id,
                        'zone_id' => $zone_id,
                        'user_id' => $driver_id,
                        'day_id' => $days[5],
                        'week' => $week,
                    ];
                }
            }
        }

        if($shift_7 != null){
            foreach ($shift_7 as $sh){
                $str = explode('|',$sh);
                $shift_id = $str[0];
                $option_id = $str[1];
                $check = DriverShift::where('user_id',$driver_id)->where('day_id',$days[6])->where('week',$week)->where('zone_id','!=',$zone_id)->count();
                if($check == 0) {
                    $data[] = [
                        'shift_id' => $shift_id,
                        'shift_option_id' => $option_id,
                        'zone_id' => $zone_id,
                        'user_id' => $driver_id,
                        'day_id' => $days[6],
                        'week' => $week,
                    ];
                }
            }
        }

        DriverShift::insert($data);

        return redirect()->back()->withStatus(__('Shift successfully added.'));


    }
}

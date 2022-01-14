<?php

namespace App\Http\Controllers;

use App\Models\StoreType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use File;

class StoreTypeController extends Controller
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
        $storeTypes = StoreType::latest()->get();
        return view('store_types.index', ['storeTypes' => $storeTypes]);
    }

    public function view()
    {
        $storeTypes = StoreType::all();
        return view('store_types.view', ['storeTypes' => $storeTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->type_image)) {
            $type_image = rand().'_'.time().'.'.$request->type_image->extension();
        }else {
            $type_image = "store_avatar.png";
        }
        $res = StoreType::create([
            'name'=>$request->type_name,
            'image'=>$type_image,
        ]);
        if (isset($res)) {
            if(isset($request->type_image)){
                $request->type_image->move(public_path('images/type-store'),$type_image);
            }
        }
        return redirect()->route('store_types.index')->withStatus(__('Store Type successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreType  $storeType
     * @return \Illuminate\Http\Response
     */
    public function show(StoreType $storeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreType  $storeType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = StoreType::find($id);
        return view('store_types.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreType  $storeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreType $storeType)
    {
        if (isset($request->type_image)) {
            $type_image = rand().'_'.time().'.'.$request->type_image->extension();
            $request->type_image->move(public_path('images/type-store'),$type_image);

            $image = StoreType::find($request->id)->image;
            $image_path = "images/type-store/$image";
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else {
            $type_image = "store_avatar.png";
        }

        StoreType::find($request->id)->update([
            'name' => $request->type_name,
            'image' => $type_image,
        ]);
        return redirect()->route('store_types.index')->withStatus(__('Type successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreType  $storeType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storetype = StoreType::find($id);
        $storetype -> delete();
        return redirect()->route('store_types.index')->withStatus(__('successfully Delete.'));
    }
}

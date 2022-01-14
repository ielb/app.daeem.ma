<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use MongoDB\Driver\Monitoring\Subscriber;

class SubcategoryController extends Controller
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
    public function index(Category $category)
    {
        $subcategories = Subcategory::all();
        return view('subcategories.index',['category' => $category, 'subcategories' => $subcategories]);
    }

    public function subcategories_select2(Request $request)
    {
        $subcategories = [];
        $subcategories =Subcategory::select("id", "name")->where('category_id','=', $request->category)->where('status' ,'=', 1)->latest()
            ->get();
        return response()->json($subcategories);
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
    public function store_multiple(Request $request,Category $category)
    {


        $category_id = $request->category_id;
        $subcategories_names = $request->subcategory_name;
        $subcategories_images = $request->subcategory_image;
        $data = [];
        foreach ($subcategories_names as $key => $subcategory){

            $subcategory_image_name = rand().'_'.date('YmdHis').'.'.$subcategories_images[$key]->extension();

            $data[] =  [
                'category_id' => $category_id ,
                'name' => $subcategory ,
                'image' => $subcategory_image_name,
                'status' => 1,
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s')
            ];

            $subcategories_images[$key]->move(public_path('images/subcategories/'),$subcategory_image_name);

        }


        Subcategory::insert($data);

        return redirect()->route('subcategories.index', ['category' => $category])->withStatus(__('Subcategories successfully created.'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        //Validate
        $request->validate([
            'subcategory_name' => ['required', 'string', 'max:255'],
        ]);

        if (isset($request->subcategory_image) ) {
            $subcategory_image_name = rand().'_'.date('YmdHis').'.'.$request->subcategory_image->extension();
        }
        else
        {
            $subcategory_image_name = NULL;
        }

        $result = Subcategory::create([
            'category_id' => $request->category_id,
            'name' => strip_tags($request->subcategory_name),
            'image' => strip_tags($subcategory_image_name),
            'status' => 1,
        ]);

        if($result){
            if(isset($request->subcategory_image)){
                $request->subcategory_image->move(public_path('images/subcategories/'),$subcategory_image_name);
            }
        }

        return redirect()->route('subcategories.index', ['category' => $category])->withStatus(__('Subcategory successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'subcategory_name_edit' => ['required', 'string', 'max:255'],
        ]);

        if (isset($request->subcategory_image_edit) ) {
            $subcategory_image_edited_name = rand().'_'.date('YmdHis').'.'.$request->subcategory_image_edit->extension();
        }
        else
        {
            $subcategory_image_edited_name = $subcategory->image;
        }

        if($request->subcategory_status_edit == "on")
        {
            $subcat_new_status = 1;
        }
        else
        {
            $subcat_new_status = 0;
        }

        $result = $subcategory->update([
            'name' => strip_tags($request->subcategory_name_edit),
            'image' => strip_tags($subcategory_image_edited_name),
            'status' => $subcat_new_status,
        ]);

        if($result){
            if(isset($request->subcategory_image_edit)){
                $request->subcategory_image_edit->move(public_path('images/subcategories/'),$subcategory_image_edited_name);
            }
        }

        return redirect()->route('products.index', ['subcategory' => $subcategory])->withStatus(__('Subcategory successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        //
    }
}

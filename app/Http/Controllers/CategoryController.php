<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Store;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Store $store)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('categories.index',['store' => $store, 'categories' => $categories, 'subcategories' => $subcategories]);
    }

    public function categories_select2(Request $request)
    {
        $categories = [];

        $categories =Category::select("id", "name")->where('store_id','=', $request->store)->where('status' ,'=', 1)->latest()
                ->get();

        return response()->json($categories);
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
    public function store_multiple(Request $request)
    {


        $store_id = $request->store_id;
        $categories_names = $request->category_name;
        $categories_images = $request->category_image;
        $data = [];
        foreach ($categories_names as $key => $category){

            $category_image_name = rand().'_'.date('YmdHis').'.'.$categories_images[$key]->extension();

            $data[] =  [
                'store_id' => $store_id ,
                'name' => $category ,
                'image' => $category_image_name,
                'status' => 1,
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s')
            ];

            $categories_images[$key]->move(public_path('images/categories/'),$category_image_name);

        }


         Category::insert($data);

        return redirect()->back()->withStatus(__('Categories successfully created.'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        if (isset($request->category_image) ) {
            $category_image_name = rand().'_'.date('YmdHis').'.'.$request->category_image->extension();
        }
        else
        {
            $category_image_name = NULL;
        }

        $result = Category::create([
            'store_id' => $request->store_id,
            'name' => strip_tags($request->category_name),
            'image' => strip_tags($category_image_name),
            'status' => 1,
        ]);

        if($result){
            if(isset($request->category_image)){
                $request->category_image->move(public_path('images/categories/'),$category_image_name);
            }
        }

        return redirect()->route('categories.index',['store' => $request->store_id])->withStatus(__('Category successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
//        if (isset($request->cat_image) ) {
//            $category_image_edited_name = rand().'_'.date('YmdHis').'.'.$request->cat_image->getClientOriginalExtension();
//            dd($category_image_edited_name);
//        }

        $request->validate([
            'cat_name' => ['required', 'string', 'max:255'],
        ]);

        if (isset($request->cat_image) ) {
            $category_image_edited_name = rand().'_'.date('YmdHis').'.'.$request->cat_image->extension();
        }
        else
        {
            $category_image_edited_name = $category->image;
        }

        if($request->cat_status == "on")
        {
            $cat_new_status = 1;
        }
        else
        {
            $cat_new_status = 0;
        }

        $result = $category->update([
            'name' => strip_tags($request->cat_name),
            'image' => strip_tags($category_image_edited_name),
            'status' => $cat_new_status,
        ]);

        if($result){
            if(isset($request->cat_image)){
                $request->cat_image->move(public_path('images/categories/'),$category_image_edited_name);
            }
        }

        return redirect()->route('subcategories.index', ['category' => $category])->withStatus(__('Category successfully updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}

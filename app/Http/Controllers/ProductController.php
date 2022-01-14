<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class ProductController extends Controller
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
    public function index(Subcategory $subcategory)
    {
        $products = Product::latest()->get();
        $subcategories = Subcategory::all();
        $categories = Category::all(); 
        return view('products.index',
            [
                'products' => $products,
                'subcategory' => $subcategory,
                'subcategories' => $subcategories,
                'categories' => $categories

            ]);
    }

    public function allproducts()
    {

        if(!isset($_GET['store_id'] , $_GET['category_id'] , $_GET['subcategory_id']))
        $products = Product::latest()->get();
//        $stores = store::where(['status' => 1])->get();
//        $categories = Category::where(['status' => 1])->get();
//        $subcategories = Subcategory::where(['status' => 1])->get();

        //FILTER BY store
        if (isset($_GET['store_id'] , $_GET['category_id'] , $_GET['subcategory_id']))
        {
            if($_GET['subcategory_id'] == '')
            {
                $idsarr = array();
                $subcat = Subcategory::where('category_id','=',$_GET['category_id'])->latest()->get();
                foreach ($subcat as $ids)
                {
                    $idsarr[] = $ids->id ;
                }
                $products  = Product::whereIn('subcategory_id',$idsarr)->latest()->get();
            }
            else
            {
                $products = Product::where('store_id','=',$_GET['store_id'])->where('subcategory_id','=',$_GET['subcategory_id'])->latest()->get();
            }
        }
        elseif (isset($_GET['store_id'] , $_GET['category_id']))
        {
            if($_GET['category_id'] == '')
            {
                $products = Product::where('store_id','=',$_GET['store_id'])->latest()->get();
            }
            else
            {
                $idsarr = array();
                $subcat = Subcategory::where('category_id','=',$_GET['category_id'])->latest()->get();
                foreach ($subcat as $ids)
                {
                    $idsarr[] = $ids->id ;
                }
                $products  = Product::whereIn('subcategory_id',$idsarr)->latest()->get();
            }
        }
        elseif (isset($_GET['store_id']))
        {
            $products = Product::where('store_id','=',$_GET['store_id'])->latest()->get();
        }

        $data = ['products' => $products,
            'parameters' => count($_GET) != 0 ,
            'store' => isset($_GET['store_id']) ? $_GET['store_id'] : '' ,
            'category' => isset($_GET['category_id']) ? $_GET['category_id'] : '' ,
            'subcategory' => isset($_GET['subcategory_id']) ? $_GET['subcategory_id'] : '' ,
        ];


//        'stores' => $stores, 'categories' => $categories, 'subcategories' => $subcategories,
        return view('products.allproducts', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subcategory $subcategory)
    {
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('products.create' ,['subcategories' => $subcategories, 'categories' => $categories, 'subcategory' => $subcategory]);
    }

    public function allcreate()
    {
        $subcategories = Subcategory::all();
        $categories = Category::all();
        $stores = Store::all();
        return view('products.allcreate' ,['subcategories' => $subcategories, 'categories' => $categories , 'stores' => $stores]);
    }

    public function stores_subcategory($id)
    {
        
        $sup_categories = Category::where('store_id','=',$id)->get();
        return json_encode(['data'=>$sup_categories]);
    }

    public function subcategory_categoty($id)
    {
        $subcategories = Subcategory::where('category_id','=',$id)->get();
        return json_encode(['data'=>$subcategories]);
    }


    public function store_multiple(Request $request){

        $products_skus  = $request->products_sku;
        $products_names = $request->products_name;
        $product_subcategories = $request->product_subcategory;
        $product_descriptions = $request->product_description;
        $products_prices = $request->products_price;
        $product_weights = $request->product_weight;
        $product_images = $request->product_image;

        $data = [];
        foreach ($products_skus as $key => $sku){

            $subcategory = Subcategory::find($product_subcategories[$key]);
            $category = Category::find($subcategory->category_id);
            $product_image_name = rand().'_'.date('YmdHis').'.'.$product_images[$key]->extension();
            $product_images[$key]->move(public_path('images/products/'),$product_image_name);

            $data[] =  [
                'store_id' => $category->store_id,
                'sku' => strip_tags($sku),
                'name' => strip_tags($products_names[$key]),
                'description' => strip_tags($product_descriptions[$key]),
                'image' => strip_tags($product_image_name),
                'price' => strip_tags($products_prices[$key]),
                'subcategory_id' => $product_subcategories[$key],
                'weight' => $product_weights[$key],
                'available' => 1,
                'has_variants' => 0,
                'status' => 1,
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s')
            ];

        }

        Product::insert($data);

        return redirect()->back()->withStatus(__('Products successfully created.'));

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
            'product_sku' => ['required', 'unique:products,sku'],
            'product_name' => ['required', 'string', 'max:255'],
            'product_description' => ['required', 'string'],
            'product_subcategory' => ['required'],
            'product_price' => ['required'],
        ]);


        if (isset($request->product_image) ) {
            $product_image_name = rand().'_'.date('YmdHis').'.'.$request->product_image->extension();
        }
        else
        {
            $product_image_name = NULL;
        }

        $returned_subcategory = Subcategory::where('id', $request->product_subcategory)->get();
        $category_id = Subcategory::where('id',$request->product_subcategory)->pluck('category_id');
        $store_id = Category::where('id',$category_id)->pluck('store_id');


        $result = Product::create([
            'store_id' => $store_id[0],
            'sku' => strip_tags($request->product_sku),
            'name' => strip_tags($request->product_name),
            'description' => strip_tags($request->product_description),
            'image' => strip_tags($product_image_name),
            'price' => strip_tags($request->product_price),
            'weight' => strip_tags($request->product_weight),
            'subcategory_id' => $request->product_subcategory,
            'available' => 1,
            'has_variants' => 0,
            'status' => 1,
        ]);

        if($result){
            if(isset($request->product_image)){
                $request->product_image->move(public_path('images/products/'),$product_image_name);
            }
        }

        return redirect()->route('products.create', ['subcategory' => $returned_subcategory[0]])->withStatus(__('Product successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }


    public function upload(Request $request){


        $theCollection = Excel::ToCollection([], $request->file('excel_input'))->toArray()[0];
        return response()->json($theCollection);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('products.edit', ['subcategories' => $subcategories, 'categories' => $categories, 'product' => $product, 'setup' => ['products' => $product->variants]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //Validate
//        dd($request->product_subcategory);
        $request->validate([
            'product_sku' => ['required', 'unique:products,sku,'.$product->id],
            'product_name' => ['required', 'string', 'max:255'],
            'product_description' => ['required', 'string'],
            'product_subcategory' => ['required'],
            'product_price' => ['required'],
        ]);

        if (isset($request->product_image) ) {
            $product_image_name = rand().'_'.date('YmdHis').'.'.$request->product_image->extension();
        }
        else
        {
            $product_image_name = $product->image;
        }

        $category_id = Subcategory::where('id',$request->product_subcategory)->pluck('category_id');
        $store_id = Category::where('id',$category_id)->pluck('store_id');

        if($request->product_available == "on")
        {
            $product_new_available = 1;
        }
        else
        {
            $product_new_available = 0;
        }

        if($request->product_status == "on")
        {
            $product_new_status = 1;
        }
        else
        {
            $product_new_status = 0;
        }

        if($request->has_variants == "on")
        {
            $product_variant = 1;
        }
        else
        {
            $product_variant = 0;
        }

        $result = $product->update([
            'store_id' => $store_id[0],
            'sku' => strip_tags($request->product_sku),
            'name' => strip_tags($request->product_name),
            'description' => strip_tags($request->product_description),
            'image' => strip_tags($product_image_name),
            'price' => strip_tags($request->product_price),
            'weight' => strip_tags($request->product_weight),
            'subcategory_id' => $request->product_subcategory,
            'has_variants' => $product_variant,
            'available' => $product_new_available,
            'status' => $product_new_status,
        ]);

        if($result){
            if(isset($request->product_image)){
                $request->product_image->move(public_path('images/products/'),$product_image_name);
            }
        }

        return redirect()->route('products.edit', ['product' => $product])->withStatus(__('Product successfully updated.'));

    }

    public function deactivate(Product $product)
    {
        $product->status = 0;
        $product->save();

        return redirect()->route('products.index', ['subcategory' => $product->subcategory_id])->withStatus(__('Product successfully deactivated.'));
    }

    public function deactivate_all(Product $product)
    {
        $product->status = 0;
        $product->save();

        return redirect()->route('products.allproducts')->withStatus(__('Product successfully deactivated.'));
    }

    public function activate(Product $product)
    {
        $product->status = 1;
        $product->update();

        return redirect()->route('products.index', ['subcategory' => $product->subcategory_id])->withStatus(__('Product successfully activated.'));
    }

    public function activate_all(Product $product)
    {
        $product->status = 1;
        $product->update();

        return redirect()->route('products.allproducts')->withStatus(__('Product successfully activated.'));
    }

    public function unavailable(Product $product)
    {
        $product->available = 0;
        $product->save();

        return redirect()->route('products.index', ['subcategory' => $product->subcategory_id])->withStatus(__('Product successfully set to unavailable.'));
    }

    public function unavailable_all(Product $product)
    {
        $product->available = 0;
        $product->save();

        return redirect()->route('products.allproducts')->withStatus(__('Product successfully set to unavailable.'));
    }

    public function available(Product $product)
    {
        $product->available = 1;
        $product->update();

        return redirect()->route('products.index', ['subcategory' => $product->subcategory_id])->withStatus(__('Product successfully set to available.'));
    }

    public function available_all(Product $product)
    {
        $product->available = 1;
        $product->update();

        return redirect()->route('products.allproducts')->withStatus(__('Product successfully set to available.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

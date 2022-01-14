<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Variant;
use App\Models\Product;
use Illuminate\Http\Request;

class OptionController extends Controller
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
    public function index(Product $product)
    {
        $options = Option::where('product_id', $product->id)->latest()->get();
        return view('products.options.index', [ 'product' => $product , 'options' => $options]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('products.options.create', [ 'product' => $product ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'options_name' => ['required', 'string', 'max:255'],
            'option_list' => ['required'],
        ]);

        Option::create([
            'product_id' => $product->id,
            'name' => strip_tags($request->options_name),
            'options' => strip_tags($request->option_list),
        ]);


        return redirect()->route('products.options.create', [ 'product' => $product ])->withStatus(__('Option successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        return view('products.options.edit' , [ 'option' => $option ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'options_name' => ['required', 'string', 'max:255'],
            'option_list' => ['required'],
        ]);

        $option->update([
            'name' => strip_tags($request->options_name),
            'options' => strip_tags($request->option_list),
        ]);

        return redirect()->route('products.options.edit', [ 'option' => $option ])->withStatus(__('Option successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return redirect()->route('products.options.index', [ 'product' => $option->product ])->withStatus(__('Option successfully deleted.'));
    }

    public function variants_index()
    {
        return view('products.variants.index');
    }

    public function variants_create(Product $product)
    {
        $options = Option::where('product_id', $product->id)->first();
        if( $options == null )
        {
            return redirect()->route('products.options.create', [ 'product' => $product ])->withError(__('You must enter the options first.'));
        }
        else
        {
            $variants_option = explode(',', $options->options);
        }
        return view('products.variants.create', [ 'variants_option' => $variants_option, 'options' => $options , 'product' => $product ]);
    }

    public function variants_store(Request $request, Product $product)
    {
        $request->validate([
            'variant_price' => ['required'],
            'variants_option' => ['required'],
        ]);

        Variant::create([
            'price' => $request->variant_price,
            'option' => strip_tags($request->variants_option),
            'product_id' => $product->id,
        ]);


        return redirect()->route('products.variants.create', [ 'product' => $product ])->withStatus(__('Variant successfully created.'));
    }

    public function variants_edit(Variant $variant)
    {
        $options = Option::where('product_id', $variant->product_id)->first();
        $variants_option = explode(',', $options->options);
        return view('products.variants.edit', [ 'variants_option' => $variants_option, 'variant' => $variant , 'option_name' => $options->name]);
    }

    public function variants_update(Request $request, Variant $variant)
    {
        $request->validate([
            'variant_price' => ['required'],
            'variants_option' => ['required'],
        ]);

        $variant->update([
            'price' => $request->variant_price,
            'option' => strip_tags($request->variants_option),
        ]);

        return redirect()->route('products.variants.edit', [ 'variant' => $variant ])->withStatus(__('Variant successfully updated.'));
    }

    public function variants_destroy(Variant $variant)
    {
        $variant->delete();
        return redirect()->route('products.edit', [ 'product' => $variant->product ])->withStatus(__('Variant successfully deleted.'));
    }
}

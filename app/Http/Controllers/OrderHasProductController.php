<?php

namespace App\Http\Controllers;

use App\Models\OrderHasProduct;
use Illuminate\Http\Request;

class OrderHasProductController extends Controller
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
        //
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
     * @param  \App\Models\OrderHasProduct  $orderHasProduct
     * @return \Illuminate\Http\Response
     */
    public function show(OrderHasProduct $orderHasProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderHasProduct  $orderHasProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderHasProduct $orderHasProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderHasProduct  $orderHasProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderHasProduct $orderHasProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderHasProduct  $orderHasProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderHasProduct $orderHasProduct)
    {
        //
    }
}

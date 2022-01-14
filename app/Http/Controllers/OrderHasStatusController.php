<?php

namespace App\Http\Controllers;

use App\Models\OrderHasStatus;
use Illuminate\Http\Request;

class OrderHasStatusController extends Controller
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
     * @param  \App\Models\OrderHasStatus  $orderHasStatus
     * @return \Illuminate\Http\Response
     */
    public function show(OrderHasStatus $orderHasStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderHasStatus  $orderHasStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderHasStatus $orderHasStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderHasStatus  $orderHasStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderHasStatus $orderHasStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderHasStatus  $orderHasStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderHasStatus $orderHasStatus)
    {
        //
    }
}

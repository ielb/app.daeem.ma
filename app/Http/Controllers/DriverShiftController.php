<?php

namespace App\Http\Controllers;

use App\Models\DriverShift;
use Illuminate\Http\Request;

class DriverShiftController extends Controller
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
     * @param  \App\Models\DriverShift  $driverShift
     * @return \Illuminate\Http\Response
     */
    public function show(DriverShift $driverShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DriverShift  $driverShift
     * @return \Illuminate\Http\Response
     */
    public function edit(DriverShift $driverShift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DriverShift  $driverShift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DriverShift $driverShift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DriverShift  $driverShift
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverShift $driverShift)
    {
        //
    }
}

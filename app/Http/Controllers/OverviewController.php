<?php

namespace App\Http\Controllers;

use App\Models\Overview;
use App\Http\Requests\StoreOverviewRequest;
use App\Http\Requests\UpdateOverviewRequest;

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $overviewData = Overview::fetchOverview();

        return view('overview.index', compact('overviewData'));
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
     * @param  \App\Http\Requests\StoreOverviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOverviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function show(Overview $overview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function edit(Overview $overview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOverviewRequest  $request
     * @param  \App\Models\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOverviewRequest $request, Overview $overview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Overview $overview)
    {
        //
    }
}

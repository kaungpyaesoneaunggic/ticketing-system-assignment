<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\CheckRole;
use App\Models\label;
use App\Http\Requests\StorelabelRequest;
use App\Http\Requests\UpdatelabelRequest;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdminRole::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $labels= label::all();
        return view ('label.index',compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('label.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelabelRequest $request)
    {
        //
        $label= new label();
        $label->name= $request->name;
        $label->save();
        return redirect()->route('label.index')->with('success', 'Stored Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(label $label)
    {
        //
        return view('label.edit',compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelabelRequest  $request
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelabelRequest $request, label $label)
    {
        //
        $label->name=$request->name;
        $label->update();
        return redirect()->route('label.index')->with("update", 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(label $label)
    {
        //
        if($label){
            $label->delete();
            return redirect()->route('label.index')->with('delete',"deleted successfully");
        }
        return redirect()->route('label.index')->with('delete',"Delete Failed");
    }
}

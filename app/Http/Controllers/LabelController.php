<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAdminRole;
use App\Models\Label;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;

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
        $labels= Label::all();
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
     * @param  \App\Http\Requests\StoreLabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabelRequest $request)
    {
        //
        $label= new Label();
        $label->name= $request->name;
        $label->save();
        return redirect()->route('label.index')->with('success', 'Stored Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        //
        return view('label.edit',compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLabelRequest  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabelRequest $request, Label $label)
    {
        //
        $label->name=$request->name;
        $label->update();
        return redirect()->route('label.index')->with("update", 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        //
        if($label){
            $label->delete();
            return redirect()->route('label.index')->with('delete',"deleted successfully");
        }
        return redirect()->route('label.index')->with('delete',"Delete Failed");
    }
}

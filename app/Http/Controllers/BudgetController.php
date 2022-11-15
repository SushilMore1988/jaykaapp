<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkType;
use App\Models\Budget;
use Illuminate\Support\Facades\Redirect;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {



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

        $request->validate([
            'work_type' => 'required',
            'budget' => 'required',
        ]);

        Budget::create($request->all());

        return Redirect::back()->with('success','Budget created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'work_type' => 'required',
            'project_id' => 'required',
            'budget' => 'required',
        ]);

        Budget::updateOrCreate([
            'work_type' => $request->work_type,
            'project_id' => $request->project_id,
        ],[
            'budget' => $request->budget,
        ]);

        return Redirect::back()->with('success','Budget created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

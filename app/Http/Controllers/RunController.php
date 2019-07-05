<?php

namespace App\Http\Controllers;

use App\Run;
use Illuminate\Http\Request;
use App\User;

class RunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('runs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::all();
        return view('runs.addrun', compact('user'));
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
        $input = $request->all();

        $convertedSeconds = ($input['hours'] * 3600) + ($input['minutes'] * 60) + $input['seconds'];

        $input['seconds'] = $convertedSeconds;

        // dd($input);

        Run::create($input);

        return redirect('/dashboard/run');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function show(Run $run)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function edit(Run $run)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Run $run)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $run)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Run;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;

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
        $runs = Run::all();

        $now = Carbon::now();
        // echo $now->year;
        // echo $now->month;
        // echo $now->weekOfYear;

        return view('runs.index', compact('runs'), compact('now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('runs.addrun');
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

        $input['user_id'] = Auth::user()->id;

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

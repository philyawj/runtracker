<?php

namespace App\Http\Controllers;

use App\Run;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\RunRequest;

class RunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // only return runs from logged in user
        $runs = Run::all()->where('user_id', Auth::user()->id);

        // display the current week and show how many miles run thus far this week
        $currentweek = Carbon::now()->weekOfYear;
        $milesthisweek = Run::all()->where('user_id', Auth::user()->id)->where('weekofyear', $currentweek)->sum('miles');

        // dd($thisweek);

        return view('runs.index', compact('runs'), ['milesthisweek' => $milesthisweek, 'currentweek' => $currentweek]);
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
    public function store(RunRequest $request)
    {
        //
        $input = $request->all();

        $convertedSeconds = ($input['hours'] * 3600) + ($input['minutes'] * 60) + $input['seconds'];
        $input['seconds'] = $convertedSeconds;

        $input['user_id'] = Auth::user()->id;

        $input['mph'] = $input['miles'] / ($convertedSeconds / 3600);

        $dt = Carbon::parse($input['date']);
        $input['year'] = $dt->year;
        $input['month'] = $dt->month;
        $input['weekofyear'] = $dt->weekOfYear;

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
        $run = Run::findOrFail($run->id);

        return view('runs.editrun', compact('run'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function update(RunRequest $request, Run $run)
    {
        //
        $input = $request->all();

        $convertedSeconds = ($input['hours'] * 3600) + ($input['minutes'] * 60) + $input['seconds'];
        $input['seconds'] = $convertedSeconds;

        $input['user_id'] = Auth::user()->id;

        $input['mph'] = $input['miles'] / ($convertedSeconds / 3600);

        $dt = Carbon::parse($input['date']);
        $input['year'] = $dt->year;
        $input['month'] = $dt->month;
        $input['weekofyear'] = $dt->weekOfYear;

        $run->update($input);

        return redirect('/dashboard/run');
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
        $run = Run::findOrFail($run->id);
        
        $run->delete();

        return redirect('dashboard/run');
    }
}

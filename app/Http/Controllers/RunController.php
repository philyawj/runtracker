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

    private $user_id;
    private $input;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = auth()->user()->id;
            return $next($request);
        });
    }

    public function process_run($request)
    {
        $this->input = $request->all();

        $convertedSeconds = ($this->input['hours'] * 3600) + ($this->input['minutes'] * 60) + $this->input['seconds'];
        $this->input['seconds'] = $convertedSeconds;

        $this->input['user_id'] = $this->user_id;

        $this->input['mph'] = $this->input['miles'] / ($convertedSeconds / 3600);

        $dt = Carbon::parse($this->input['date']);
        $this->input['year'] = $dt->year;
        $this->input['month'] = $dt->month;
        $this->input['week_of_year'] = $dt->weekOfYear;
    }

    public function index()
    {
        // only return runs from logged in user
        $runs = Run::all()->where('user_id', $this->user_id);

        return view('runs.index', compact('runs'));
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
        $this->process_run($request);

        Run::create($this->input);

        return redirect('/dashboard/runs');
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

        // convert seconds into hours/minutes/seconds
        $run['hours'] = date("G", $run->seconds);
        $run['minutes'] = date("i", $run->seconds);
        $run['seconds'] = date("s", $run->seconds);

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
        $this->process_run($request);

        $run->update($this->input);

        return redirect('/dashboard/runs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Run  $run
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $run)
    {   
        $run->delete();

        return redirect('dashboard/runs');
    }
}

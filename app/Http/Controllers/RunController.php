<?php

namespace App\Http\Controllers;

use App\Run;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\RunRequest;
use Session;

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

        $originalDate = $this->input['date'];
        $newDate = date("Y-m-d", strtotime($originalDate));

        $this->input['date'] = $newDate;

        $converted_seconds = ($this->input['hours'] * 3600) + ($this->input['minutes'] * 60) + $this->input['seconds'];
        $this->input['seconds'] = $converted_seconds;

        $this->input['user_id'] = $this->user_id;

        // $this->input['mph'] = $this->input['miles'] / ($converted_seconds / 3600);

        $dis_pace = $this->input['miles'];
        //getting seconds per mile
        $pace = $this->input['seconds'] / $dis_pace;
        //getting minutes from $pace
        $min = floor($pace / 60);
        //adding 0 before,  if lower than 10
        $min = ($min >= 10) ? $min : '0'.$min;
        //getting remaining seconds
        $sec = $pace % 60;
        //adding 0 before, if lower than 10
        $sec = ($sec >= 10) ? $sec : '0'.$sec;
    
        $this->input['pace'] = $min.":".$sec;

        $dt = Carbon::parse($this->input['date']);
        $this->input['year'] = $dt->year;
        $this->input['month'] = $dt->month;
        $this->input['week_of_year'] = $dt->weekOfYear;
    }

    public function index()
    {
        // only return runs from logged in user
        $runs = Run::where('user_id', $this->user_id)->orderBy('date', 'desc')->paginate(25);

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

        Session::flash('message', 'Run created.');
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

        // format date on load
        $run['date'] = date("m/d/Y",strtotime($run['date']));

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

        Session::flash('message', 'Run edited.');
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

        Session::flash('message', 'Run deleted.');
        return redirect('dashboard/runs');
    }
}

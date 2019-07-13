<?php

namespace App\Http\Controllers;

use App\Goal;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    private $currentweek;
    private $currentyear;



    // functions that appear throughout the model controller
    public function __construct()
    {
        $this->currentyear = Carbon::now()->year;
        $this->currentweek = Carbon::now()->weekOfYear;
    }

    

    public function index()
    {
        // only return goals from logged in user
     
        // dd($this->currentweek);

        // $currentweek = $this->$currentweek;
        // $currentyear = $this->$currentyear;
        // $currentyear = Carbon::now()->year;
        // $currentweek = Carbon::now()->weekOfYear;

        // $year = Carbon::now()->year;
        // default index page shows the current year
        $goals = Goal::select('weekofyear', 'miles')->where('user_id', Auth::user()->id)->where('year', $this->currentyear)->get();

        $combinedgoals = collect();

        $weeks = collect([1, 2, 3, 4, 5, 6, 7, 8, 9 , 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52]);

        foreach($weeks as $week) {
            $o = new \stdClass();

            $findmiles = $goals->filter(function($item) use ($week) {
                return $item->weekofyear == $week;
            })->first();

            if($findmiles === null) {
                $o->weekofyear = $week;
                $o->miles = 'not set';
                $startdate = Carbon::now();
                $startdate->setISODate($this->currentyear,$week);
                $o->startofweek = $startdate->startOfWeek()->format('n/j');
                $enddate = Carbon::now();
                $enddate->setISODate($this->currentyear,$week);
                $o->endofweek = $enddate->endOfWeek()->format('n/j');
                $combinedgoals->push($o);
            } else {
                $startdate = Carbon::now();
                $startdate->setISODate($this->currentyear,$week);
                $findmiles->startofweek = $startdate->startOfWeek()->format('n/j');
                $enddate = Carbon::now();
                $enddate->setISODate($this->currentyear,$week);
                $findmiles->endofweek = $enddate->endOfWeek()->format('n/j');
                $combinedgoals->push($findmiles);
            }

        }

        // dropdown - start by finding the first year the current user has set a goal
        $firstgoalyear = Goal::select('year')->where('user_id', Auth::user()->id)->orderBy('year', 'asc')->first();
        $firstgoalyear = $firstgoalyear['year'];

        $lastgoalyear = $this->currentyear + 1;

        $goalyeararray = array();
        $yearcounter = $firstgoalyear;

        while($yearcounter <= $lastgoalyear){
            array_push($goalyeararray, $yearcounter);
            $yearcounter++;
        }
        
        return view('goals.index', compact('combinedgoals'), ['year' => $this->currentyear, 'weeks' => $weeks, 'currentweek' => $this->currentweek, 'currentyear' => $this->currentyear, 'goalyeararray' => $goalyeararray]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($year, $weekofyear)
    {
        $goal = new \stdClass();
        $goal->year = $year;
        $goal->weekofyear = $weekofyear;
        
        return view('goals.addgoal', compact('goal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        // dd($input);
        Goal::create($input);

        return redirect('/dashboard/goals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    // public function show(Goal $goal)
    public function show($year)
    {
        // convert year to string
        $year = (int)$year;

        $currentyear = Carbon::now()->year;
        $currentweek = Carbon::now()->weekOfYear;

        $goals = Goal::select('weekofyear', 'miles')->where('user_id', Auth::user()->id)->where('year', $year)->get();

        $combinedgoals = collect();

        $weeks = collect([1, 2, 3, 4, 5, 6, 7, 8, 9 , 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52]);

        foreach($weeks as $week) {
            $o = new \stdClass();

            $findmiles = $goals->filter(function($item) use ($week) {
                return $item->weekofyear == $week;
            })->first();

            if($findmiles === null) {
                $o->weekofyear = $week;
                $o->miles = 'not set';
                $startdate = Carbon::now();
                $startdate->setISODate($year,$week);
                $o->startofweek = $startdate->startOfWeek()->format('n/j');
                $enddate = Carbon::now();
                $enddate->setISODate($year,$week);
                $o->endofweek = $enddate->endOfWeek()->format('n/j');
                $combinedgoals->push($o);
            } else {
                $startdate = Carbon::now();
                $startdate->setISODate($year,$week);
                $findmiles->startofweek = $startdate->startOfWeek()->format('n/j');
                $enddate = Carbon::now();
                $enddate->setISODate($year,$week);
                $findmiles->endofweek = $enddate->endOfWeek()->format('n/j');
                $combinedgoals->push($findmiles);
            }

        }

        // dropdown - start by finding the first year the current user has set a goal
        $firstgoalyear = Goal::select('year')->where('user_id', Auth::user()->id)->orderBy('year', 'asc')->first();
        $firstgoalyear = $firstgoalyear['year'];
        
        $lastgoalyear = $currentyear + 1;

        $goalyeararray = array();
        $yearcounter = $firstgoalyear;

        while($yearcounter <= $lastgoalyear){
            array_push($goalyeararray, $yearcounter);
            $yearcounter++;
        }

        // if user manually changes url to year that doesn't exists, automatically route to most recent year. 
        $isgoalyear = in_array($year, $goalyeararray);
        if($isgoalyear === false) {
            return redirect('dashboard/goals');
        } 

        return view('goals.index', compact('combinedgoals'), ['year' => $year, 'weeks' => $weeks, 'currentweek' => $currentweek, 'currentyear' => $currentyear, 'goalyeararray' => $goalyeararray]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit($year, $weekofyear)
    {
        $goal = Goal::where('user_id', Auth::user()->id)->where('year', $year)->where('weekofyear', $weekofyear)->first();

        return view('goals.editgoal', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        $input = $request->all();

        $goal->update($input);

        return redirect('/dashboard/goals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect('dashboard/goals');
    }

     /**
     * Reroute the goals dropdown submit to correct page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function reroute(Request $request)
    {
        $input = $request->all();
        $goal = $input['gotoyear'];

        return redirect()->route('goals.show', [$goal]);
    }
}

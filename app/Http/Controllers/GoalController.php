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

    private $current_week;
    private $current_year;
    private $combined_goals;
    private $weeks;
    private $user_id;
    private $goal_year_array;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = auth()->user()->id;
            return $next($request);
        });

        $this->current_year = Carbon::now()->year;
        $this->current_week = Carbon::now()->weekOfYear;
        $this->combined_goals = collect();
        $this->weeks = collect([1, 2, 3, 4, 5, 6, 7, 8, 9 , 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52]);

    }

    public function init_dropdowns() {
        // start by finding the first year the current user has set a goal
        $first_goal_year = Goal::select('year')->where('user_id', $this->user_id)->orderBy('year', 'asc')->first();
        $first_goal_year = $first_goal_year['year'];

        // one year in future
        $last_goal_year = $this->current_year + 1;

        $this->goal_year_array = array();
        $year_counter = $first_goal_year;

        // create all years in between first goal year and 1 year ahead of current year
        while($year_counter <= $last_goal_year){
            array_push($this->goal_year_array, $year_counter);
            $year_counter++;
        }
    }

    public function index()
    {
        // only return goals from logged in user
        // default index page shows the current year
        $goals = Goal::select('week_of_year', 'miles')->where('user_id', $this->user_id)->where('year', $this->current_year)->get();

        foreach($this->weeks as $week) {
            $o = new \stdClass();

            $find_miles = $goals->filter(function($item) use ($week) {
                return $item->week_of_year == $week;
            })->first();

            if($find_miles === null) {
                $o->week_of_year = $week;
                $o->miles = 'not set';
                $start_date = Carbon::now();
                $start_date->setISODate($this->current_year,$week);
                $o->startofweek = $start_date->startOfWeek()->format('n/j');
                $end_date = Carbon::now();
                $end_date->setISODate($this->current_year,$week);
                $o->endofweek = $end_date->endOfWeek()->format('n/j');
                $this->combined_goals->push($o);
            } else {
                $start_date = Carbon::now();
                $start_date->setISODate($this->current_year,$week);
                $find_miles->startofweek = $start_date->startOfWeek()->format('n/j');
                $end_date = Carbon::now();
                $end_date->setISODate($this->current_year,$week);
                $find_miles->endofweek = $end_date->endOfWeek()->format('n/j');
                $this->combined_goals->push($find_miles);
            }

        }

        $this->init_dropdowns();
        
        return view('goals.index', ['combined_goals' => $this->combined_goals, 'year' => $this->current_year, 'weeks' => $this->weeks, 'current_week' => $this->current_week, 'current_year' => $this->current_year, 'goal_year_array' => $this->goal_year_array]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($year, $week_of_year)
    {
        $goal = new \stdClass();
        $goal->year = $year;
        $goal->week_of_year = $week_of_year;
        
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
    public function show($selected_year)
    {
        // convert year to string
        $selected_year = (int)$selected_year;

        $goals = Goal::select('week_of_year', 'miles')->where('user_id', $this->user_id)->where('year', $selected_year)->get();

        foreach($this->weeks as $week) {
            $o = new \stdClass();

            $find_miles = $goals->filter(function($item) use ($week) {
                return $item->week_of_year == $week;
            })->first();

            if($find_miles === null) {
                $o->week_of_year = $week;
                $o->miles = 'not set';
                $start_date = Carbon::now();
                $start_date->setISODate($selected_year,$week);
                $o->startofweek = $start_date->startOfWeek()->format('n/j');
                $end_date = Carbon::now();
                $end_date->setISODate($selected_year,$week);
                $o->endofweek = $end_date->endOfWeek()->format('n/j');
                $this->combined_goals->push($o);
            } else {
                $start_date = Carbon::now();
                $start_date->setISODate($selected_year,$week);
                $find_miles->startofweek = $start_date->startOfWeek()->format('n/j');
                $end_date = Carbon::now();
                $end_date->setISODate($selected_year,$week);
                $find_miles->endofweek = $end_date->endOfWeek()->format('n/j');
                $this->combined_goals->push($find_miles);
            }

        }

        $this->init_dropdowns();

        return view('goals.index', ['combined_goals' => $this->combined_goals, 'year' => $selected_year, 'weeks' => $this->weeks, 'current_week' => $this->current_week, 'current_year' => $this->current_year, 'goal_year_array' => $this->goal_year_array]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit($year, $week_of_year)
    {
        $goal = Goal::where('user_id', $this->user_id)->where('year', $year)->where('week_of_year', $week_of_year)->first();

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

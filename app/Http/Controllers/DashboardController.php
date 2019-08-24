<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Run;
use App\User;
use App\Goal;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user_id = Auth::user()->id;

        $current_year = Carbon::now()->year;
        $current_week = Carbon::now()->weekOfYear;
        $current_month = Carbon::now()->month;

        $miles_this_week = Run::where('user_id', $user_id)->where('week_of_year', $current_week)->get()->sum('miles');
        $miles_this_month = Run::where('user_id', $user_id)->where('month', $current_month)->get()->sum('miles');
        $miles_this_year = Run::where('user_id', $user_id)->where('year', $current_year)->get()->sum('miles');
        $miles_all_time = Run::all()->where('user_id', $user_id)->sum('miles');

        $this_week_goal = Goal::select('miles')->where('user_id', $user_id)->where('week_of_year', $current_week)->first();
        $this_week_goal = $this_week_goal['miles'];

        if(isset($this_week_goal)){
            $weekly_progress = round(($miles_this_week / $this_week_goal) * 100, 2);
            if($weekly_progress > 100) {
                $weekly_progress = 100;
            }
        } else {
            // dummy value to prevent error
            $weekly_progress = 1;
        }

        // data for last 6 weeks chart
        $miles_one_week_ago = Run::where('user_id', $user_id)->where('week_of_year', $current_week - 1)->get()->sum('miles');
        $miles_two_weeks_ago = Run::where('user_id', $user_id)->where('week_of_year', $current_week - 2)->get()->sum('miles');
        $miles_three_weeks_ago = Run::where('user_id', $user_id)->where('week_of_year', $current_week - 3)->get()->sum('miles');
        $miles_four_weeks_ago = Run::where('user_id', $user_id)->where('week_of_year', $current_week - 4)->get()->sum('miles');
        $miles_five_weeks_ago = Run::where('user_id', $user_id)->where('week_of_year', $current_week - 5)->get()->sum('miles');
        $six_week_chart_miles = [$miles_five_weeks_ago, $miles_four_weeks_ago, $miles_three_weeks_ago, $miles_two_weeks_ago, $miles_one_week_ago];
        
        return view('dashboard', ['six_week_chart_miles' => $six_week_chart_miles, 'miles_this_week' => $miles_this_week, 'miles_this_month' => $miles_this_month, 'miles_this_year' => $miles_this_year, 'miles_all_time' => $miles_all_time, 'this_week_goal' => $this_week_goal, 'current_week' => $current_week, 'current_year' => $current_year, 'weekly_progress' => $weekly_progress]);
    }
}

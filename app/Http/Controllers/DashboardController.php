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

        $milesperweek = Run::select('weekofyear', 'miles')->where('user_id', $user_id)->get();

        $groupedmiles = $milesperweek->groupBy('weekofyear')->map(function ($row){
            return $row->sum('miles');
        });
        echo $groupedmiles;

        $lastthreeruns = Run::all()->where('user_id', $user_id)->sortByDesc('date')->take(3);

        $current_year = Carbon::now()->year;
        $current_week = Carbon::now()->weekOfYear;

        $milesthisweek = Run::where('user_id', $user_id)->where('weekofyear', $current_week)->get()->sum('miles');

        // how many miles run last month
        $lastweek = Carbon::now()->weekOfYear - 1;
        $mileslastweek = Run::all()->where('user_id', $user_id)->where('weekofyear', $lastweek)->sum('miles');

        // how many miles run thus far this month
        $currentmonth = Carbon::now()->month;
        $milesthismonth = Run::all()->where('user_id', $user_id)->where('month', $currentmonth)->sum('miles');

        // how many miles run last month
        $lastmonth = Carbon::now()->month - 1;
        $mileslastmonth = Run::all()->where('user_id', $user_id)->where('month', $lastmonth)->sum('miles');

        $thisweekgoal = Goal::select('miles')->where('user_id', $user_id)->where('weekofyear', $current_week)->first();
        $thisweekgoal = $thisweekgoal['miles'];

        if(isset($thisweekgoal)){
            $weeklyprogress = round(($milesthisweek / $thisweekgoal) * 100, 2);
            if($weeklyprogress > 100) {
                $weeklyprogress = 100;
            }
        } else {
            // dummy value to prevent error
            $weeklyprogress = 1;
        }
        
        return view('dashboard', compact('lastthreeruns'), ['milesthisweek' => $milesthisweek, 'mileslastweek' => $mileslastweek, 'milesthismonth' => $milesthismonth, 'mileslastmonth' => $mileslastmonth, 'thisweekgoal' => $thisweekgoal, 'current_week' => $current_week, 'current_year' => $current_year, 'weeklyprogress' => $weeklyprogress]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Run;
use App\User;
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

        $alldates = Run::all()->where('user_id', $user_id);
        $firstdate = $alldates->sortBy('date')->first()->date;
        $lastdate = $alldates->sortByDesc('date')->first()->date;
        echo 'The first date is ' . $firstdate . '  and the last date is ' . $lastdate;

        // only return last 3 runs from logged in user
        // $lastthreeruns = Run::all()->where('user_id', $user_id)->sortByDesc('date')->take(3);
        $lastthreeruns = Run::all();

        // how many miles run thus far this week
        $currentweek = Carbon::now()->weekOfYear;
        // echo $currentweek . " is the current week";
        // $milesthisweek = Run::all()->where('user_id', $user_id)->where('weekofyear', $currentweek)->sum('miles');
        // $milesthisweek = Run::where('user_id', $user_id)->where('weekofyear', $currentweek)->get()->sum('miles');
        $milesthisweek = Run::where('user_id', $user_id)->where('weekofyear', $currentweek)->get()->sum('miles');

        
        

        // how many miles run last month
        $lastweek = Carbon::now()->weekOfYear - 1;
        $mileslastweek = Run::all()->where('user_id', $user_id)->where('weekofyear', $lastweek)->sum('miles');

        // how many miles run thus far this month
        $currentmonth = Carbon::now()->month;
        $milesthismonth = Run::all()->where('user_id', $user_id)->where('month', $currentmonth)->sum('miles');

        // how many miles run last month
        $lastmonth = Carbon::now()->month - 1;
        $mileslastmonth = Run::all()->where('user_id', $user_id)->where('month', $lastmonth)->sum('miles');

        return view('dashboard', compact('lastthreeruns'), ['milesthisweek' => $milesthisweek, 'mileslastweek' => $mileslastweek, 'milesthismonth' => $milesthismonth, 'mileslastmonth' => $mileslastmonth]);
    }
}

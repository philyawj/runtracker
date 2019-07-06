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

        // only return runs from logged in user
        $runs = Run::all()->where('user_id', Auth::user()->id);

        // display the current week and show how many miles run thus far this week
        $currentweek = Carbon::now()->weekOfYear;
        $milesthisweek = Run::all()->where('user_id', Auth::user()->id)->where('weekofyear', $currentweek)->sum('miles');

        // dd($thisweek);

        // return view('runs.index', compact('runs'), ['milesthisweek' => $milesthisweek, 'currentweek' => $currentweek]);

        return view('dashboard', ['milesthisweek' => $milesthisweek]);
    }
}

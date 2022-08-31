<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ExerciseReport;

class HomeController extends Controller
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
        $user_id = auth()->user()->id;
        //return to the main landing page after the user logs in
        //add exercises / reportExercises to showcase most popular exercsies

        $exerciseReports = ExerciseReport::orderBy("created_at", "desc")->take(1)->get();
        return view('index')->with("exerciseReports", $exerciseReports);
    }
}

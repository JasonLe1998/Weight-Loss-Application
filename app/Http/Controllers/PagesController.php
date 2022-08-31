<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseReport;

class PagesController extends Controller
{
    /**
     * used to return the index page with the index view with the title for the routes
     */
    public function index(){
        $exerciseReports = ExerciseReport::orderBy("created_at", "desc")->take(1)->get();
        return view('index')->with("exerciseReports", $exerciseReports);
    }

    /**
     * used to return the about page with the about view with the title for the routes
     */
    public function about(){
        $data = array(
            'title' => 'About',
        );
        return view('about')->with($data);
    }

    /**
     * used to return the exercise page with the exercise view with the title for the routes
     */
    public function exercise(){
        $data = array(
            'title' => 'Exercise',
        );
        return view('exercise')->with($data);
    }

    /**
     * used to return the workout page with the workout view with the title for the routes
     */
    public function workout(){
        $data = array(
            'title' => 'Workout',
        );
        return view('workout')->with($data);
    }

    /**
     * used to return the report page with the report view with the title for the routes
     */
    public function report(){
        $data = array(
            'title' => 'Report',
        );
        return view('report')->with($data);
    }

    /**
     * used to return the community page with the community view with the title for the routes
     */
    public function community(){
        $data = array(
            'title' => 'Community',
        );
        return view('community')->with($data);
    }

    /**
     * used to return the login page with the login view with the title for the routes
     */
    public function login(){
        $data = array(
            'title' => 'Login',
        );
        return view('login')->with($data);
    }
}

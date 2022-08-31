<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;
use App\Models\ExerciseReport;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check if the userRole for the user is "admin". If the user is a admin, return the admin page for the exercise page to be able
        //to have crud over exercises. if the user is logged in return the regular page and if the user is not logged in also return the regular page
        if(Auth::check() && auth()->user()->userRole == "admin"){
            $data = Exercise::orderBy("name", "asc")->get();
            return view("exercise.admin", compact("data"));
        }else if (Auth::check()){
            $data = Exercise::orderBy("name", "asc")->get();
            return view("exercise", compact("data"));
        }else{
            $data = Exercise::orderBy("name", "asc")->get();
            return view("exercise", compact("data"));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExercise()
    {
        //create exercise form for the admin
        return view("exercise.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'name' => 'required',
            'rating' => 'required|integer|between:1,5',
            'category' => 'required',
            'MET' => 'required'
        ]);

        //get value from form and create new resource
        $exercises = new Exercise;
        $exercises->name = $request->input("name");
        $exercises->rating = $request->input("rating");
        $exercises->category = $request->input("category");
        $exercises->MET = $request->input("MET");
        $exercises->workoutID = 0;
        $exercises->counter = 0;
        $exercises->save();

        return redirect("/exercise/all")->with("success", "Exercise created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //editing form for the admin to be able to edit any exercise
        $exercises = Exercise::find($id);
        return view ("exercise.edit")->with("exercises", $exercises);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the form and make it so all sections are required and that rating can only be between 1 and 5
        $this->validate($request, [
            'name' => 'required',
            'rating' => 'required|between:1,5',
            'category' => 'required',
            'MET' => 'required'
        ]);

        //get value from form and create new resource
        $exercises = Exercise::find($id);
        $exercises->name = $request->input("name");
        $exercises->rating = $request->input("rating");
        $exercises->category = $request->input("category");
        $exercises->MET = $request->input("MET");
        $exercises->save();

        return redirect("/exercise/all")->with("success", "Exercise updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete any exercise for the admin
        $exercises = Exercise::find($id);
        $exercises->delete();

        return redirect('/exercise/all')->with("success", "Exercise deleted");
    }
    
    /**
     * function for when the user searches for exercises with the search bar. If the user entered a word, return all the exercises that match the word the user
     * searched. If the user entered nothing in the search bar but submits, return all of the exercises in the database
     */
    public function search(Request $request){
        //if search is empty, return all the data from the database. Else, return exercises from the searched word
        if(empty($_GET["search"])){
            $products = Exercise::sortable()->paginate(10);
            return view("exercise.search", compact("products"));
        }else{
            $searchValue = $_GET["search"];
            $products = Exercise::sortable()->where("name", "LIKE", "%".$searchValue."%")->paginate(10);
            return view("exercise.search", compact("products"));
        }
    }

    /**
     * rating method used to do the rating for the exercises. The method will find the exercise being rated and update the rating depending on what the user rated
     */
    public function rating(Request $request, $id){
        $exercise = Exercise::find($id);
        //rating calculation
        $ratingRounded = round(($request->input("result") + $exercise->rating) / 2, 1);
        $exercise->rating = $ratingRounded;
        $exercise->name = $exercise->name;
        $exercise->MET = $exercise->MET;
        $exercise->category = $exercise->category;
        $exercise->save();

        return redirect("/exercise")->with("success", "Rating updated");
    }

    /**
     * function to return the view with all the exercises with CRUD for the admin.
     */
    public function all(){

        //check if the userRole for the user is "admin". If the user is a admin, return the admin page for the exercise page to be able
        //to have crud over exercises. if the user is logged in return the regular page and if the user is not logged in also return the regular page
        if(Auth::check() && auth()->user()->userRole == "admin"){
            $datas = Exercise::orderBy("name", "asc")->get();
            return view("exercise.all", compact("datas"));
        }else{
            return redirect("/exercise")->with("error", "Unauthorized page");
        }
    }

    /**
     * function to return the view for the reports for the most popular exercises page for the admin
     */
    public function reports(){

        //check if the userRole for the user is "admin". If the user is a admin, return the admin page for the exercise page to be able
        //to have crud over exercises. if the user is logged in return the regular page and if the user is not logged in also return the regular page
        if(Auth::check() && auth()->user()->userRole == "admin"){
            $exercises = Exercise::orderBy("counter", "desc")->paginate(10);
            return view("exercise.reports", compact("exercises"));
        }else{
            return redirect("/exercise")->with("error", "Unauthorized page");
        }
        
    }

    /**
     * function for the admin to create a new report for the most popular exercises
     */
    public function createPopular(){
        return view("exercise.createPopular");
    }

    /**
     * Store a newly created resource in storage. This method is used for when the admin creates a new report for the most popular exercises. It will create
     * a new row depending on the form data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePopular(Request $request)
    {
        //validation
        $this->validate($request, [
            'firstExercise' => 'required',
            'secondExercise' => 'required',
            'thirdExercise' => 'required'
        ]);

        //get value from form and create new resource
        $exerciseReports = new ExerciseReport;
        $exerciseReports->firstExercise = $request->input("firstExercise");
        $exerciseReports->secondExercise = $request->input("secondExercise");
        $exerciseReports->thirdExercise = $request->input("thirdExercise");
        $exerciseReports->save();

        return redirect("/exercise/reports")->with("success", "New report for exercises created");
    }

}

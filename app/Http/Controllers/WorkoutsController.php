<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WorkoutsController extends Controller
{

    /**
     * Create a new controller instance. Middleware for users that are not logged in to be able to go in these pages without logging in.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ["except"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get values depending on user_id to display correct information only about the user logged in
        //if the user is not logged in, return the login view
        if(!Auth::guest()){
            $user_id = auth()->user()->id;
        }else{
            return redirect("/login")->with("error", "Must login first");
        }

        $user = User::find($user_id);
        return view('workout')->with("workouts", $user->workouts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("workouts.create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExercise($workoutID, $exerciseID)
    {
        //used for the workout plan to show the form for creating workouts to add to the workout plan
        $workouts = Workout::find($workoutID);
        $exercises = Exercise::find($exerciseID);
        return view("workouts.createExercise")->with("exercises", $exercises)->with("workouts", $workouts);
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
            'workout' => 'required',
        ]);

        //get value from form and create new workout plan
        $workouts = new Workout;
        $workouts->workoutName = $request->input("workout");
        $workouts->user_id = auth()->user()->id;
        $workouts->save();

        return redirect("/workout")->with("success", "Workout Created!");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExercise(Request $request)
    {
        //get value from form and create a new exercise 
        $exercises = new Exercise;
        $exercises->name = $request->input("name");
        $exercises->rating = $request->input("rating");
        $exercises->category = $request->input("category");
        $exercises->MET = $request->input("MET");
        $exercises->workoutID = $request->input("workoutID");
        $exercises->counter = 1;
        $exercises->save();

        return redirect("/workout")->with("success", "Exercise added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($workoutID)
    {
        $workouts = Workout::find($workoutID);
        //using the $id, I did a where statement to if the topicID = $id, get all of the records and orderby created_at in descending order. 
        //the reason I used the where with the topicID is because we want to display all of the data from the topic id. Which means if the topic id is 5
        //for example, each new reply will have a topicID of 5 and it will return all the topicIDs of 5 to display all the replies for each topic.

        $exercises = Exercise::orderBy("name", "asc")->where("workoutID", "=", $workoutID)->get();
        return view("workouts.show")->with("workouts", $workouts)->with("exercises", $exercises);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workouts = Workout::find($id);

        //checks if the user is the correct user when the user tries to delete a workout
        if(auth()->user()->id !== $workouts->user_id){
            return redirect("/workout")->with("error", "Unauthorized page");
        }

        $workouts->delete();

        return redirect('/workout')->with("success", "Workout plan deleted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyExercise($id)
    {
        $exercises = Exercise::find($id);
        
        $exercises->delete();

        return redirect('/workout')->with("success", "Exercise deleted from workout plan");
    }

    /**
     * function for when the user searches for exercises with the search bar. If the user entered a word, return all the exercises that match the word the user
     * searched. If the user entered nothing in the search bar but submits, return all of the exercises in the database
     */
    public function search(Request $request, $id){
        $workouts = Workout::find($id);

        //if search is empty, return all the data from the database. Else, return exercises from the searched word
        if(empty($_GET["search"])){
            $searchExercises = Exercise::sortable()->paginate(10);
            return view("workouts.show", compact("searchExercises"))->with("workouts", $workouts);
        }else{
            $searchValue = $_GET["search"];
            $searchExercises = Exercise::sortable()->where("name", "LIKE", "%".$searchValue."%")->paginate(10);
            return view("workouts.show", compact("searchExercises"))->with("workouts", $workouts);
        }
    }
}

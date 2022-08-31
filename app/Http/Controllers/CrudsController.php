<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\weight;
use App\Models\BodyMetric;
use App\Models\User;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

use App\Charts\bodyMetricsChart;

class CrudsController extends Controller
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
        //if the user is not logged in, return the login view with error message
        if(!Auth::guest()){
            $user_id = auth()->user()->id;
        }else{
            return redirect("/login")->with("error", "Must login first");
        }
        $user = User::find($user_id);

        //chart data to use for the chart for the body metrics. The lables will be the body part name and the values will be the measurements for the body part names
        //will then display the chart and results in a line graph
        $chart = new bodyMetricsChart;
        $chart->labels($user->bodyMetrics->pluck("measurement", "bodyPart")->keys());

        $chart->dataset("Body Metrics (inches)", "line", $user->bodyMetrics->pluck("measurement", "bodyPart")->values())->options(['backgroundColor' => "#708090",]);

        
        return view('report', compact("chart"))->with('weights' , $user->weights)->with("bodyMetrics" , $user->bodyMetrics)->with("histories", $user->histories);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bodyMetrics.create');
    }

    /**
     * Show the form for creating a new resource. Used for the weight records
     *
     * @return \Illuminate\Http\Response
     */
    public function createW()
    {
        return view ("weights.create");
    }

    /**
     * Show the form for creating a new resource. Used for the history records
     *
     * @return \Illuminate\Http\Response
     */
    public function createH()
    {
        return view ("histories.create");
    }

    /**
     * Show the form for creating a new resource. This method will be from the exercise page where the user clicks on a exercise and clicks the "track" button. 
     * This will then take them to a form page to create a new tracked exercise with the exercise they selected.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTrack($id)
    {
        $exercises = Exercise::find($id);
        return view ("histories.createTrack")->with("exercises", $exercises);
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
            'bodyPart' => 'required',
            'measurement' => 'required'
        ]);

        // Create a new body_metrics row
        $bodyMetrics = new BodyMetric;
        $bodyMetrics->bodyPart = $request->input("bodyPart");
        $bodyMetrics->measurement = $request->input("measurement");
        $bodyMetrics->user_id = auth()->user()->id;
        $bodyMetrics->save();

        return redirect("/report")->with('success', "Body Metric Created");
    }

    /**
     * Store a newly created resource in storage. Used for the new weight record created
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeW(Request $request)
    {
        //validation
        $this->validate($request, [
            'weightValue' => 'required',
            'heightValue' => 'required'
        ]);

        // Create a new weights row
        $weights = new weight;
        $weights->weightValue = $request->input("weightValue");
        $weights->heightValue = $request->input("heightValue");
        $weights->user_id = auth()->user()->id;
        $weights->save();

        return redirect("/report")->with('success', "Body Metric Created");
    }

    /**
     * Store a newly created resource in storage. Used for the new history record created without the exercise id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeHSolo(Request $request)
    {
        //validation
        $this->validate($request, [
            'workout' => 'required',
            'timeSpent' => 'required',
            'reps' => 'required',
            'sets' => 'required',
            'weight' => 'required'
        ]);

        // Create a new history row
        $histories = new History;
        $histories->workout = $request->input("workout");
        $histories->timeSpent = $request->input("timeSpent");
        $histories->reps = $request->input("reps");
        $histories->sets = $request->input("sets");
        $histories->weight = $request->input("weight");
        $histories->user_id = auth()->user()->id;
        $histories->save();

        return redirect("/report")->with('success', "History Created");
    }

    /**
     * Store a newly created resource in storage. Used for when the admin creates a new record 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeH(Request $request, $id)
    {
        //validation
        $this->validate($request, [
            'workout' => 'required',
            'timeSpent' => 'required',
            'reps' => 'required',
            'sets' => 'required',
            'weight' => 'required'
        ]);

        // Create a new history row (tracking what exercises you've done)
        $histories = new History;
        $histories->workout = $request->input("workout");
        $histories->timeSpent = $request->input("timeSpent");
        $histories->reps = $request->input("reps");
        $histories->sets = $request->input("sets");
        $histories->weight = $request->input("weight");
        $histories->user_id = auth()->user()->id;
        $histories->save();

        // also update the counter for the exercise if the user adds the exercise to a workout plan to increase the counter so the admin can get the most
        // popular exercises
        $exercises = Exercise::find($id);
        $exercises->counter = $request->input("counter");
        $exercises->save();

        return redirect("/report")->with('success', "History Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bodyMetrics = BodyMetric::find($id);
        return view("bodyMetrics.show")->with("bodyMetrics", $bodyMetrics);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showH($id)
    {
        $histories = History::find($id);
        return view("histories.show")->with("histories", $histories);
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
        $bodyMetrics = BodyMetric::find($id);

        //check if the user is the correct user to delete otherwise redirect with an error message
        if(auth()->user()->id !==$bodyMetrics->user_id){
            return redirect("/workout")->with("error", "Unauthorized page");
        }

        $bodyMetrics->delete();

        return redirect('/report')->with("success", "Body Metric Measurement Deleted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyW($id)
    {
        $weights = weight::find($id);

        //check if the user is the correct user to delete otherwise redirect with an error message
        if(auth()->user()->id !==$weights->user_id){
            return redirect("/workout")->with("error", "Unauthorized page");
        }

        $weights->delete();

        return redirect('/report')->with("success", "Weight Measurement Deleted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyH($id)
    {
        $histories = History::find($id);

        //check if the user is the correct user to delete otherwise redirect with an error message
        if(auth()->user()->id !==$histories->user_id){
            return redirect("/workout")->with("error", "Unauthorized page");
        }

        $histories->delete();

        return redirect('/report')->with("success", "History record deleted");
    }

}

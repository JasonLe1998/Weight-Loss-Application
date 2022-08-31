@extends("layouts.app")

@section("content")
<a href = "{{url('workout')}}" class = "btn btn-default" style = color:red>Return</a>
{{-- conformation to add a exercise to a workout plan. This will show all the forms data hidden and will only show the user the button to submit if they would
  like to add the exercise to the workout plan --}}
  <h1>Add to workout plan?</h1>

  {!! Form::open(['action' => ['App\Http\Controllers\WorkoutsController@storeExercise', $exercises->id], 'method' => 'POST']) !!}
    <div class ="form-group">
    {{Form::hidden("name", $exercises->name)}}
    </div>

    <div class ="form-group">
        {{Form::hidden("rating", $exercises->rating)}}
    </div>

    <div class ="form-group">
        {{Form::hidden("category", $exercises->category)}}
    </div>

    <div class ="form-group">
        {{Form::hidden("MET", $exercises->MET)}}
    </div>

    <div class ="form-group">
        {{Form::hidden("workoutID", $workouts->id)}}
    </div>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
  

@endsection

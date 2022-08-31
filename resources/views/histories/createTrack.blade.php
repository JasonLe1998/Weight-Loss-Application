@extends("layouts.app")

@section("content")
{{-- history create form for when the user clicks on the track button on the exercises page which will automatically enter the exercise name and not allow the 
    user to edit the form for the exercise name --}}
  <h1>Create tracked exercise</h1>
  <a href = "{{url('exercise')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => ['App\Http\Controllers\CrudsController@storeH', $exercises->id], 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('workout', "Exercise")}}
        {{Form::text('workout', $exercises->name, ['class' => 'form-control', "readonly"])}}
    </div>

    <div class ="form-group">
        {{Form::label('timeSpent', "Time Spent (Minutes)")}}
        {{Form::text('timeSpent', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('reps', "Reps (if not applicable enter 0)")}}
        {{Form::text('reps', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('sets', "Sets (if not applicable enter 0)")}}
        {{Form::text('sets', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('weight', "Weight (Dumbbell or self for non dumbbell workouts in Pounds)")}}
        {{Form::text('weight', "", ['class' => 'form-control'])}}
    </div>

    {{-- hidden form for the counter which will add one everytime the exercise is added to a workout plan to show how many times the exercise was used for
        the admin report --}}
    <div class ="form-group">
        {{Form::hidden('counter', $exercises->counter + 1, ['class' => 'form-control'])}}
    </div>
    {{Form::hidden("_method", "PUT")}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

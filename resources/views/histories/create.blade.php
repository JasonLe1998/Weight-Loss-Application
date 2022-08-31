@extends("layouts.app")

@section("content")
{{-- history create form --}}
  <h1>Track exercise</h1>
  <a href = "{{url('report')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => 'App\Http\Controllers\CrudsController@storeHSolo', 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('workout', "Workout")}}
        {{Form::text('workout', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('timeSpent', "Time Spent (Minutes)")}}
        {{Form::text('timeSpent', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('reps', "Reps")}}
        {{Form::text('reps', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('sets', "Sets")}}
        {{Form::text('sets', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('weight', "Weight (Dumbbell or self for non dumbbell workouts in Pounds)")}}
        {{Form::text('weight', "", ['class' => 'form-control'])}}
    </div>
    
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

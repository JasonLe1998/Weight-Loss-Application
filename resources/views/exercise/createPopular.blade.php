@extends("layouts.app")

@section("content")
{{-- exercise create form for admin --}}
  <h1>Create report for most popular exercises</h1>
  <a href = "{{url('exercise')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => 'App\Http\Controllers\ExerciseController@storePopular', 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('firstExercise', "First exercise")}}
        {{Form::text('firstExercise', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('secondExercise', "Second exercise")}}
        {{Form::text('secondExercise', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('thirdExercise', "Third exercise")}}
        {{Form::text('thirdExercise', "", ['class' => 'form-control'])}}
    </div>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

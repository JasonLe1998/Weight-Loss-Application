@extends("layouts.app")

@section("content")
{{-- exercise create form for admin --}}
  <h1>Create Exercise</h1>
  <a href = "{{url('exercise/all')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => 'App\Http\Controllers\ExerciseController@store', 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('name', "Name")}}
        {{Form::text('name', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('rating', "Rating (1 - 5)")}}
        {{Form::number('rating', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('category', "Category")}}
        {{Form::text('category', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('MET', "MET Value")}}
        {{Form::number('MET', "", ['class' => 'form-control', "step" => "0.1"])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

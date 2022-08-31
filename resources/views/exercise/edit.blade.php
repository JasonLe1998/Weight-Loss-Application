@extends("layouts.app")

@section("content")
{{-- exercise edit form for admin --}}
  <h1>Edit Exercise</h1>
  <a href = "{{url('exercise/all')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => ['App\Http\Controllers\ExerciseController@update', $exercises->id], 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('name', "Name")}}
        {{Form::text('name', $exercises->name, ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('rating', "Rating (1 - 5)")}}
        {{Form::number('rating', $exercises->rating, ['class' => 'form-control', "step" => "0.1"])}}
    </div>

    <div class ="form-group">
        {{Form::label('category', "Category")}}
        {{Form::text('category', $exercises->category, ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::label('MET', "MET Value")}}
        {{Form::number('MET', $exercises->MET, ['class' => 'form-control', "step" => "0.1"])}}
    </div>
    {{Form::hidden("_method", "PUT")}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

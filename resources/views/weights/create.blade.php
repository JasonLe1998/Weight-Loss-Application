@extends("layouts.app")

@section("content")
{{-- weight create form --}}
  <h1>Create new weight record</h1>
  <a href = "{{url('report')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => 'App\Http\Controllers\CrudsController@storeW', 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('weightValue', "Weight (Pounds)")}}
        {{Form::text('weightValue', "", ['class' => 'form-control' , 'placeholder' => "190"])}}
    </div>

    <div class ="form-group">
        {{Form::label('heightValue', "Height (cm)")}}
        {{Form::text('heightValue', "", ['class' => 'form-control' , 'placeholder' => "167.64"])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

@extends("layouts.app")

@section("content")
{{--Body metrics create form --}}
  <h1>Create body metrics</h1>
  <a href = "{{url('report')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => 'App\Http\Controllers\CrudsController@store', 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('bodyPart', "Body Part")}}
        {{Form::text('bodyPart', "", ['class' => 'form-control' , 'placeholder' => "Waist"])}}
    </div>

    <div class ="form-group">
        {{Form::label('measurement', "Measurement (Inches)")}}
        {{Form::text('measurement', "", ['class' => 'form-control' , 'placeholder' => "35"])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

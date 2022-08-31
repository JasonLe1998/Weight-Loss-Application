@extends("layouts.app")

@section("content")
{{-- workout plan create form --}}
  <h1>Create workout plan</h1>
  <a href = "{{url('workout')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => 'App\Http\Controllers\WorkoutsController@store', 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('workout', "Workout Name")}}
        {{Form::text('workout', "", ['class' => 'form-control' , 'placeholder' => "Upper Body", "autocomplete" => "off"])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

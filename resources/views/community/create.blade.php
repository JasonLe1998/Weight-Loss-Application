@extends("layouts.app")

@section("content")
{{--community create form --}}
  <h1>New post</h1>
  <a href = "{{url('community')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => 'App\Http\Controllers\CommunitiesController@store', 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('title', "Title")}}
        {{Form::text('title', "", ['class' => 'form-control'])}}
    </div>
    <div class ="form-group">
        {{Form::label('description', "Description")}}
        {{Form::textarea('description', "", ['class' => 'form-control'])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection


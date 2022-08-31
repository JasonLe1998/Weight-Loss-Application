@extends("layouts.app")

@section("content")
{{--reply create form --}}
  <h1>New reply</h1>
  <a href = "{{url('community')}}" class = "btn btn-default" style = color:red>Return</a>

  {!! Form::open(['action' => ['App\Http\Controllers\CommunitiesController@storeR', $communities->id], 'method' => 'POST']) !!}
    <div class ="form-group">
        {{Form::label('message', "Description")}}
        {{Form::textarea('message', "", ['class' => 'form-control'])}}
    </div>

    <div class ="form-group">
        {{Form::hidden("id", $communities->id)}}
    </div>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}

@endsection

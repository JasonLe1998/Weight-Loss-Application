@extends("layouts.app")

@section("content")
{{-- displays all the exercises for the admin for CRUD functionality  --}}
  <h1>All Exercises</h1>
  <a href = "{{url('exercise')}}" class = "btn btn-default" style = color:red>Return</a>

  <a href = "{{url("exercise/all/create")}}">Create new exercise</a>

  <table class="table">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  @if(count($datas) > 0 )
    @foreach($datas as $data)
      <tr>
        <td>{{$data->name}}</td>
        <td>{{$data->category}}</td>
        <td><a href = "http://vast-headland-62539.herokuapp.com/exercise/{{$data->id}}/edit">Update</td>
        <td>
            {!! Form::open(['action' => ['App\Http\Controllers\ExerciseController@destroy', $data->id], 'method' => 'POST']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete')}}
            {!!Form::close()!!}
          </td>
      </tr>
    @endforeach
    </table>
  @else
    <p>No exercises Found</p>
  @endif
  

@endsection

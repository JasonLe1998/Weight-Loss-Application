@extends("layouts.app")

@section("content")
<h1>Create Workouts</h1>

<a class="nav navbar-nav navbar-right" href="{{url('/workout/create')}}">Create A New Workout Plan</a>

  @if(count($workouts) > 0 )
  <table class="table">
    <tr>
      <th scope="col">Workout Name</th>
      <th scope="col">Delete</th>
    </tr>
    @foreach($workouts as $workout)
      <tr>
        <td><a href ="http://vast-headland-62539.herokuapp.com/workout/{{$workout->id}}">{{$workout->workoutName}}</a></td>
        <td>
          {!! Form::open(['action' => ['App\Http\Controllers\WorkoutsController@destroy', $workout->id], 'method' => 'POST']) !!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Delete')}}
          {!!Form::close()!!}
        </td>
      </tr>
    @endforeach
    </table>
  @else
    <p>No workout plans found</p>
  @endif
@endsection

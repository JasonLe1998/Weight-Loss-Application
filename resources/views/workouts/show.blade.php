@extends("layouts.app")

@section("content")
  <h1>Workout Plan</h1>
  <a href = "{{url('workout')}}" class = "btn btn-default" style = color:red>Return</a>

  {{-- searchbar for the workouts page to look through the exercises to choose which exercises to add to the workout plan --}}
  {!! Form::open(['action' => ['App\Http\Controllers\WorkoutsController@search', $workouts->id], 'method' => 'GET']) !!}
    <div class ="form-group">
        {{Form::label('search', "Search for exercises to add")}}
        {{Form::text('search', "", ['class' => 'form-control', "autocomplete"=> "off"])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
  <br>
  <br>

  @isset($searchExercises)
  <caption>Search Results</caption>
    <table class="table">
        <tr>
          {{-- sortablelink to sort the table from name and category --}}
          <th scope="col">@sortablelink('name')</th>
          <th scope="col">@sortablelink('category')</th>
          <th scope="col">Add exercise</th>
        </tr>

        @foreach($searchExercises as $searchExercise)
        <tr>
            <td>{{$searchExercise->name}}</td>
            <td>{{$searchExercise->category}}</td>
            {{-- if the user is not logged in, do not show the add button to add to a workout plan --}}
            @if(!Auth::guest())
              <th><a id = "reply" href="http://vast-headland-62539.herokuapp.com/workout/{{$workouts->id}}/createExercise/{{$searchExercise->id}}">Add</a></th>
            @endif
        </tr>
        @endforeach
        </table>
        {!! $searchExercises->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
  @endisset

  <br>
  <br>
  <br>

  @isset($exercises)
    @if(count($exercises) > 0 )
    <caption>Exercises in workout plan</caption>
    <table class="table">
      <tr>
      <th scope="col">Exercise Name</th>
      <th scope="col">Delete</th>
      </tr>
    @foreach($exercises as $exercise)
      <tr>
        <td>{{$exercise->name}}</td>
        <td>
          {!! Form::open(['action' => ['App\Http\Controllers\WorkoutsController@destroyExercise', $exercise->id], 'method' => 'POST']) !!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Delete')}}
          {!!Form::close()!!}
        </td>
        
      </tr>
    @endforeach
    </table>
  @else
    <p>No exercises found in workout plan</p>
  @endif
  @endisset


  


@endsection

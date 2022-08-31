@extends("layouts.app")

@section("content")
  <h1>History</h1>

  <a href = "{{url('report')}}" class = "btn btn-default" style = color:red>Return</a>
  <h3>{{$histories->created_at}}</h3>

  <table class="table">
    <tr>
        <th scope="col">Exercise</th>
        <th scope="col">Time Spent</th>
        <th scope="col">Reps</th>
        <th scope="col">Sets</th>
        <th scope="col">Weight</th>
    </tr>
    <tr>
        <td>{{$histories->workout}}</td>
        <td>{{$histories->timeSpent}}</td>
        <td>{{$histories->reps}}</td>
        <td>{{$histories->sets}}</td>
        <td>{{$histories->weight}}</td>
    </tr>
    </table>


@endsection

@extends("layouts.app")

@section("content")
{{-- search view for when the user searches for exercises through the search bar --}}
  <h1>Exercise report for most popular exercises</h1>
  <div>
    <a href = "{{url("exercise/reports/createPopular")}}">Create new report for the new most popular exercises for the month</a>
  </div>

  <a href = "{{url('exercise')}}" class = "btn btn-default" style = color:red>Return</a>

  <table class="table">
    <tr>
      {{-- sortablelink to be able to sort the table by name, category or rating --}}
      <th scope="col">Exercise name</th>
      <th scope="col">Number of uses</th>
      <th scope="col">Created at</th>
    </tr>
  @if(count($exercises) > 0 )
    @foreach($exercises as $exercise)
      <tr>
        <td>{{$exercise->name}}</td>
        <td>{{$exercise->counter}}</td>
        <td>{{$exercise->created_at}}</td>
      </tr>
    @endforeach
    </table>
    {!! $exercises->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
  @else
    <p></p>
  @endif
  

@endsection

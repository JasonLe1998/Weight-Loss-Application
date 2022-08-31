@extends("layouts.app")

@section("content")
{{--results for body metrics --}}
  <h1>Body Metrics</h1>

  <a href = "{{url('report')}}" class = "btn btn-default" style = color:red>Return</a>
  <h3>{{$bodyMetrics->created_at}}</h3>

  <table class="table">
    <tr>
        <th scope="col">Body Part</th>
        <th scope="col">Measurement</th>
    </tr>
    <tr>
        <td>{{$bodyMetrics->bodyPart}}</td>
        <td>{{$bodyMetrics->measurement}}</td>
    </tr>
    </table>


@endsection

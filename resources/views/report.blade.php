@extends("layouts.app")

@section("content")
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset = "utf-8"></script>
{{-- report page that takes data from three different tables. The data includes the history records, the body metric records and the weight records --}}

  <h1>Reports Page</h1>
  
  <h2>History</h2>
  <a class="nav navbar-nav navbar-right" href="{{url('/report/createH')}}">Create New History Measurements</a>
  @if(count($histories) > 0 )
  <table class="table">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Delete</th>
    </tr>
    @foreach($histories as $history)
      <tr>
        <td><a href ="https://vast-headland-62539.herokuapp.com/report/showH/{{$history->id}}">{{$history->created_at}}</a></td>
        <td>
          {!! Form::open(['action' => ['App\Http\Controllers\CrudsController@destroyH', $history->id], 'method' => 'POST']) !!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Delete')}}
          {!!Form::close()!!}
        </td>
      </tr>
    @endforeach
    </table>
  @else
    <p>No History Found</p>
  @endif

  <h2>Body Metrics</h2>
  <a class="nav navbar-nav navbar-right" href="{{url('/report/create')}}">Create New Body Metric Measurement</a>
  @if(count($bodyMetrics) > 0 )
  <table class="table">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Delete</th>
    </tr>
    @foreach($bodyMetrics as $bodyMetric)
      <tr>
        <td><a href ="https://vast-headland-62539.herokuapp.com/report/{{$bodyMetric->id}}">{{$bodyMetric->created_at}}</a></td>
        <td>
          {!! Form::open(['action' => ['App\Http\Controllers\CrudsController@destroy', $bodyMetric->id], 'method' => 'POST']) !!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Delete')}}
          {!!Form::close()!!}
        </td>
      </tr>
    @endforeach
    </table>
  @else
    <p>No Body Metrics Found</p>
  @endif

  <h2>Weight</h2>
  <a class="nav navbar-nav navbar-right" href="{{url('/report/createW')}}">Create New Weight Measurement</a>
  @if(count($weights) > 0 )
  <table class="table">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Weight</th>
      <th scope="col">BMI</th>
      <th scope="col">Delete</th>
    </tr>
    @foreach($weights as $weight)
      <tr>
        <td>{{$weight->created_at}}</td>
        <td>{{$weight->weightValue}}</td>
        <td>{{round(((($weight->weightValue * 0.453592) / $weight->heightValue) / $weight->heightValue) * 10000, 2)}}</td>
        <td>
          {!! Form::open(['action' => ['App\Http\Controllers\CrudsController@destroyW', $weight->id], 'method' => 'POST']) !!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Delete')}}
          {!!Form::close()!!}
        </td>
      </tr>
    @endforeach
    </table>
  @else
    <p>No Weight Found</p>
  @endif

  {{-- used to display the chart that will show data for the body metrics at the bottom of the page --}}
    <div class = "flex">
      <div class = "w-1/2">
        {!! $chart->container() !!}
      </div>
    </div>



  {!! $chart->script() !!}
@endsection

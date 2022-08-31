@extends("layouts.app")

@section("content")
{{-- search view for when the user searches for exercises through the search bar --}}
  <h1>Search Results</h1>
  <a href = "{{url('exercise')}}" class = "btn btn-default" style = color:red>Return</a>

  <table class="table">
    <tr>
      {{-- sortablelink to be able to sort the table by name, category or rating --}}
      <th scope="col">@sortablelink('name')</th>
      <th scope="col">@sortablelink('category')</th>
      <th scope="col">@sortablelink('rating')</th>
      @if(!Auth::guest())
        <th scope="col">Track</th>
      @endif
    </tr>
  @if(count($products) > 0 )
    @foreach($products as $product)
      <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->category}}</td>
        <td>{{$product->rating}}
        {{-- If the user is not logged in, do not let them see the rating button to add a rating --}}
        @if(!Auth::guest())
          {!! Form::open(['action' => ['App\Http\Controllers\ExerciseController@rating', $product->id], 'method' => 'POST']) !!}
            <div class ="form-group">
              {{ Form::radio('result', '1' , false) }}
              {{ Form::radio('result', '2' , false) }}
              {{ Form::radio('result', '3' , false) }}
              {{ Form::radio('result', '4' , false) }}
              {{ Form::radio('result', '5' , false) }}
            </div>
            {{Form::hidden("_method", "PUT")}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
          {!!Form::close()!!}
        @endif
        </td>
        @if(!Auth::guest())
          <td><a href ="http://vast-headland-62539.herokuapp.com/report/{{$product->id}}/createTrack">Track</a></td>
        @endif
      </tr>
    @endforeach
    </table>
    {!! $products->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
  @else
    <p>No Exercises Found</p>
  @endif
  

@endsection

@extends("layouts.app")

@section("content")
<h1>Community Page</h1>
<h3>Forums</h3>
{{-- if the user is not logged in, don't let them create a new thread / post --}}
@if(!Auth::guest())
  <a id = "reply" href="{{url('/community/create')}}">Create new thread</a>
@endif
  @if(count($communities) > 0 )
  <table class="table">
    <tr>
      {{-- sortablelink to sort the table with title and created_at --}}
      <th scope="col">@sortablelink("title")</th>
      <th scope = "col">@sortablelink("created_at")</th>
      <th scope="col">User</th>
      {{-- if the user is not logged in, don't show the delete button --}}
      @if(!Auth::guest())
        <th scope="col">Delete</th>
      @endif
    </tr>
    @foreach($communities as $community)
      <tr>
        <td><a href ="http://vast-headland-62539.herokuapp.com/community/{{$community->id}}">{{$community->title}}</a></td>
        <td>{{$community->created_at}}</td>
        <td>{{$community->userName}}</td>

        {{--First check if the user is logged in to show any deletes. Then check if the Auth::user()->id isset, if it isset check the user id and compare
           to the $community id to make sure only the user with the same id as the community id can delete their posts--}}
        @if(!Auth::guest())
          @isset(Auth::user()->id)
            @if(Auth::user()->id == $community->user_id)
              <td>
                {!! Form::open(['action' => ['App\Http\Controllers\CommunitiesController@destroy', $community->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete')}}
                {!!Form::close()!!}
              </td>
            @endif
          @endisset
        @endif
      </tr>
    @endforeach
    </table>
    {!! $communities->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
  @else
    <p>No forum posts Found</p>
  @endif

@endsection

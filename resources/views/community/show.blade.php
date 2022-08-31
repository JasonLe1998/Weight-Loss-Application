@extends("layouts.app")
<style>
    #reply{
        text-align: right;
        float: right;
    }

    #title{
        text-align: center;
        float: center;
    }

</style>

@section("content")
<h1>Community Page</h1>
<h3>Forums</h3>
<h4 id = "title">{{$communities->title}}</h4>
<a href = "{{url('community')}}" class = "btn btn-default" style = color:red>Return</a>

{{--if the user is not logged in, do not show the reply to forum button --}}
@if(!Auth::guest())
  <a id = "reply" href="http://vast-headland-62539.herokuapp.com/community/{{$communities->id}}/createR">Reply to forum</a>
@endif
<table class="table">
    <thead class="thead-light">
    <tr>
      {{--sortablelink to be able to sort from the userName --}}
      <th scope="col">@sortablelink('userName')</th>
      <th scope="col">Description</th>
      <th scope="col">Posted on</th>
      {{--if the user is not logged in, do not show the delete button --}}
      @if(!Auth::guest())
        <th scope="col">Delete</th>
      @endif
    </tr>
    </thead>
    <tr>
      {{--First check if the user is logged in to show any deletes. Then check if the Auth::user()->id isset, if it isset check the user id and compare
           to the $community id to make sure only the user with the same id as the community id can delete their posts--}}
        <td>{{$communities->userName}}</td>
        <td>{{$communities->description}}</td>
        <td>{{$communities->created_at}}</td>
        @if(!Auth::guest())
          @isset(Auth::user()->id)
            @if(Auth::user()->id == $communities->user_id)
              <td>
                {!! Form::open(['action' => ['App\Http\Controllers\CommunitiesController@destroy', $communities->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete')}}
                {!!Form::close()!!}
              </td>
            @endif
          @endisset
        @endisset
    </tr>

    @if(count($messages) > 0 )
    @foreach($messages as $message)
      <tr>
        <td>{{$message->userName}}</td>
        <td>{{$message->message}}</td>
        <td>{{$message->created_at}}</td>
        {{--First check if the user is logged in to show any deletes. Then check if the Auth::user()->id isset, if it isset check the user id and compare
           to the $community id to make sure only the user with the same id as the community id can delete their posts--}}
        @if(!Auth::guest())
          @isset(Auth::user()->id)
            @if(Auth::user()->id == $message->user_id)
              <td>
                {!! Form::open(['action' => ['App\Http\Controllers\CommunitiesController@destroyReply', $message->id], 'method' => 'POST']) !!}
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
    {!! $messages->appends(\Request::except('page'))->render('pagination::bootstrap-4') !!}
  @else
    <p>No Replies Found</p>
  @endif

</table>

@endsection

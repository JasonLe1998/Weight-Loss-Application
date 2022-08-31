<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request\segment;
use App\Models\Community;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class CommunitiesController extends Controller
{
    /**
     * Create a new controller instance. Middleware for access control
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ["except" => ['index', "show"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::sortable()->orderBy('created_at', 'desc')->paginate(10);
        return view("community")->with("communities", $communities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("community.create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createR($id)
    {
        $communities = Community::find($id);
        return view("community.createReply")->with("communities", $communities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'description' => 'required',
            'title' => 'required'
        ]);

        // Create a new forum post
        $communities = new Community;
        $communities->description = $request->input("description");
        $communities->title = $request->input('title');
        $communities->userName = Auth::user()->name;
        $communities->user_id = auth()->user()->id;
        $communities->save();

        return redirect("/community")->with('success', "Forum topic has been posted!");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeR(Request $request)
    {
        //validation
        $this->validate($request, [
            'message' => 'required',
        ]);

        // Create a new reply to a forum post
        $messages = new Message();
        $messages->message = $request->input("message");
        $messages->topicID = $request->input("id");
        $messages->userName = Auth::user()->name;
        $messages->user_id = auth()->user()->id;
        $messages->save();

        return redirect("/community")->with('success', "Reply has been posted!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $communities = Community::sortable()->find($id);
        //using the $id, I did a where statement to if the topicID = $id, get all of the records and orderby created_at in descending order. 
        //the reason I used the where with the topicID is because we want to display all of the data from the topic id. Which means if the topic id is 5
        //for example, each new reply will have a topicID of 5 and it will return all the topicIDs of 5 to display all the replies for each forum topic.
        $messages = Message::sortable()->orderBy('created_at', 'desc')->where("topicID", "=", $id)->paginate(10);

        return view("community.show")->with("communities", $communities)->with("messages", $messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deletes the forum post
        $communities = Community::find($id);
        $communities->delete();

        return redirect('/community')->with("success", "Forum topic deleted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyReply($id)
    {
        //deletes the reply to the forum post
        $messages = Message::find($id);
        $messages->delete();

        return redirect('/community')->with("success", "Reply deleted");
    }
}

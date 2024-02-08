<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $ticket = Ticket::findOrFail($id);
        $ticketCategoryIds = $ticket->categories->pluck('id')->toArray();
        $ticketLabelIds = $ticket->labels->pluck('id')->toArray();
        $ticketImageIds = $ticket->images->pluck('id')->toArray();
        $comments=Comment::where('ticket_id',$id)->get();
        return view('comment.index',compact('ticket','comments','ticketLabelIds','ticketCategoryIds','ticketImageIds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,StoreCommentRequest $request)
    {
        //
        $ticket= Ticket::find($id);
        if($ticket){
            $comment= new Comment();
            $comment->ticket_id=$ticket->id;
            $comment->user_id=Auth::user()->id;
            $comment->comment_body=$request->comment_body;
            $comment->save();
            return redirect()->route('comment.index',$ticket->id);
        }
        return 'error';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($ticketId,$commentId)
    {
        //
        $comment = Comment::findOrFail($commentId);
        if($comment){
            $comment->delete();
            return redirect()->route('comment.index',$ticketId);
            
        }
        return redirect()->route('ticket.index',$ticketId)->with('delete','Error Occured');
    }
}

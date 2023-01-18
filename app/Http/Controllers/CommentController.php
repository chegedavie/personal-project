<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comment $comment)
    {
        return $comment->comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $validated=$request->validated();
        $validated['user_id']=$request->user()->id;
        return Comment::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $comment->comments;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $validated=$request->validated();
        $comment->body=$validated['body'];
        return $comment->save();
    }

    public function clap(Request $request, Comment $comment){
        $user=$request->user();
        $user->clapOnce($comment);
        $clappersCount=$comment->clappers->count();
        if($clappersCount > 1000){
            $clapped=$comment->clappersCountForHumans();
        }
        else{
            $clapped=$clappersCount;
        }
        return $clapped;
    }

    public function unclap(Request $request, Comment $comment){
        $user=$request->user();
        return $user->unclap($comment);
    }

    public function claps(Comment $comment){
        $clappersCount=$comment->clappers->count();
        if($clappersCount > 1000){
            $clapped=$comment->clappersCountForHumans();
        }
        else{
            $clapped=$clappersCount;
        }
        return $clapped;
    }

    public function like(Request $request, Comment $comment){
        $user=$request->user();
        $comment->like($user->id);
    }

    public function unlike(Request $request, Comment $comment){
        $user=$request->user();
        $comment->unlike($user->id);
    }

    public function likes(Comment $comment){
        return $comment->likeCount;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}

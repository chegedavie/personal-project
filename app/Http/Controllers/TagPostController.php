<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagPostRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\TagPost;


class TagPostController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Tag::class);
        $this->authorizeResource(TagPost::class);
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Blog $blog)
    {
        return $blog->tags;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tagPost=new TagPost();
        $tagPost->blog_id=$request->blog_id;
        $tagPost->tag_id=$request->tag_id;
        $tagPost->save();
        return $tagPost;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Http\Response
     */
    public function show($blog,TagPost $tagPost)
    {
        return $tagPost;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tagPost)
    {
        $tagPivot=TagPost::findOrFail($tagPost);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog,TagPost $tagPost)
    {
        return $tagPost->delete();
    }
}

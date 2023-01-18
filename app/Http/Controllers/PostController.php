<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Blog;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Blog::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::where('published', 1)->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments')->paginate();
    }

    public function userPosts(Request $request)
    {
        return Blog::where('user_id', $request->user()->id)->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments')->paginate();
    }

    public function userPost(Request $request, Blog $blog)
    {
        return $blog;
    }
	public function tagPosts(Tag $tag){
		//echo $tag;
		return Blog::whereHas('tags', function (Builder $query)use($tag) {
    $query->where('tag_id', $tag->id)
	->where('published',true);
	//echo $tag;
},'=')->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments')->paginate();
		//->posts->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments')->paginate()
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $validate['published'] = false;
        return Blog::create($validated);
    }

    public function clap(Request $request, Blog $blog)
    {
        $user = $request->user();
        $user->clapOnce($blog);
        $clappersCount = $blog->clappers->count();
        if ($clappersCount > 1000) {
            $clapped = $blog->clappersCountForHumans();
        } else {
            $clapped = $clappersCount;
        }
        return $clapped;
    }

    public function unclap(Request $request, Blog $blog)
    {
        $user = $request->user();
        return $user->unclap($blog);
    }

    public function claps(Blog $blog)
    {
        $clappersCount = $blog->clappers->count();
        if ($clappersCount > 1000) {
            $clapped = $blog->clappersCountForHumans();
        } else {
            $clapped = $clappersCount;
        }
        return $clapped;
    }

    /**
     * Display the specified resource.
     *
     * @param  Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Blog $blog)
    {
        $userId = $request->user()->id;
        $blog->writer;
        $blog->comments;
        $blog->tags;
        $blog->clappersCount();
        $blog->like_count;
        $blog->isLiked = $blog->liked($userId);
        return $blog;
    }

    public function like(Request $request, Blog $blog)
    {
        $user = $request->user();
        $blog->like($user->id);
        return $blog->like_count;
    }

    public function unlike(Request $request, Blog $blog)
    {
        $user = $request->user();
        $blog->unlike($user->id);
    }

    public function likes(Blog $blog)
    {
        return $blog->like_count;
    }

    public function featured()
    {
        $blog = new Blog();
        return $blog->featured()->with(['writer'])->limit(5)->get();
    }

    public function searchPublished(Request $request)
    {
        return Blog::search($request->search)->where('published', true)->query(fn ($query) => $query->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments'))->paginate(24);
    }
    public function searchAll(Request $request)
    {
        return Blog::search($request->search)->query(fn ($query) => $query->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments'))->paginate(24);
    }
    public function searchUserPosts(Request $request)
    {
        return Blog::search($request->search)->where('user_id', $request->user()->id)->query(fn ($query) => $query->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments'))->paginate(24);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Blog $blog)
    {
        $validated = $request->validated();
        return $blog->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Blog $blog)
    {
        $blog->forceDelete();
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
    }
    public function publish(Blog $blog){
        $blog->published=true;
        return $blog->save();
    }
	public function unpublish(Blog $blog){
        $blog->published=false;
        return $blog->save();
    }
    public function setFeatured(Blog $blog){
        $blog->featured=true;
        return $blog->save();
    }
	public function unsetFeatured(Blog $blog){
        $blog->featured=false;
        return $blog->save();
    }
}

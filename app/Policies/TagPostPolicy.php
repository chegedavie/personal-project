<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\TagPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TagPostPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, TagPost $tagPost)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create-blog-posts')
            ?Response::allow()
            :Response::deny('You are not allowed to tag posts');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TagPost $tagPost)
    {
        $blog=Blog::find($tagPost->blog_id);
        if($user->can('edit-blog-posts')){
            return $blog->writer === $user
            ?Response::allow()
            :Response::deny('This post does not belong to you');
        }
        else{
            return Response::deny('You are unauthorized to perform this action.');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TagPost $tagPost)
    {
        $blog=Blog::find($tagPost->blog_id);
        if($user->can('edit-blog-posts')){
            return $blog->writer === $user
            ?Response::allow()
            :Response::deny('This post does not belong to you');
        }
        else{
            return Response::deny('You are unauthorized to perform this action.');
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TagPost $tagPost)
    {
        $blog=Blog::find($tagPost->blog_id);
        if($user->can('edit-blog-posts')){
            return $blog->writer === $user
            ?Response::allow()
            :Response::deny('This post does not belong to you');
        }
        else{
            return Response::deny('You are unauthorized to perform this action.');
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TagPost  $tagPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TagPost $tagPost)
    {
        $blog=Blog::find($tagPost->blog_id);
        if($user->can('edit-blog-posts')){
            return $blog->writer === $user
            ?Response::allow()
            :Response::deny('This post does not belong to you');
        }
        else{
            return Response::deny('You are unauthorized to perform this action.');
        }
    }
}

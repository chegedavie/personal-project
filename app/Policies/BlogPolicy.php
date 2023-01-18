<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class BlogPolicy
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Blog $blog)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Request $request)
    {
        return $user->can('create-blog-posts') ?
            Response::allow() :
            Response::deny(`You are not allowed to create posts`);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Request $request, Blog $blog)
    {
        if ($user->can('edit-blog-posts')) {
            return $blog->writer === $user || $user->hasRole('Admin') ?
                Response::allow() :
                Response::deny(`You cannot update post ${blog}`);
        } else return Response::deny('You are not allowed to update posts');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user,Blog $blog)
    {
        if ($user->can('edit-blog-posts')) {
            return ($blog->writer === $user || $user->hasRole('Admin')) ?
                Response::allow() :
                Response::deny(`You cannot delete post ${blog}`);
        } else return Response::deny('You are not allowed to delete posts');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Blog $blog)
    {
        if ($user->can('edit-blog-posts')) {
            return $blog->writer === $user || $user->hasRole('Admin') ?
                Response::allow() :
                Response::deny(`You cannot update ${blog}`);
        } else return Response::deny('You are not allowed to update posts');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Blog $blog)
    {
        if ($user->can('delete-blog-posts')) {
            return $blog->writer === $user || $user->hasRole('Admin') ?
                Response::allow() :
                Response::deny(`You cannot update ${blog}`);
        } else return Response::deny('You are not allowed to update posts');
    }
}

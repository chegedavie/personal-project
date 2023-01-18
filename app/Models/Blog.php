<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelInteraction\Clap\Concerns\Clappable;
use Laravel\Scout\Searchable;

class Blog extends Model
{
    use \Conner\Likeable\Likeable, Searchable, HasFactory, Notifiable, SoftDeletes, Clappable;

    protected $perPage = 24;

    protected $fillable = ['title', 'body', 'description', 'keywords', 'featured', 'published', 'id', 'user_id'];

    protected function makeAllSearchableUsing($query)
    {
        return $query->with('writer')->withCount('comments');
    }

    public function shouldBeSearchable()
    {
        return $this->isPublished();
    }

    public function latestBlog()
    {
        return $this->hasOne(Blog::class)->latest();
    }
    public function isPublished()
    {
        return $this->wherePublished(true);
    }

    public function featured()
    {
        return $this->whereFeatured(true);
    }

    public function comments()
    {
        //return comments
        return $this->morphMany(Comment::class, 'commentable')->with(['comments', 'user', 'likeCounter'])->withClappersCount();
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'username' => 'Guest'
        ]);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_blog')->withPivot('blog_id', 'tag_id', 'id');
    }
}

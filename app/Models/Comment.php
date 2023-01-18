<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelInteraction\Clap\Concerns\Clappable;
use \Conner\Likeable\Likeable;

class Comment extends Model
{
    use HasFactory,Clappable, \Conner\Likeable\Likeable;

    protected $fillable = ['body', 'commentable_type', 'commentable_id', 'user_id'];

    public function commentable()
    {
        return $this->morphTo(Comment::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->with(['comments', 'user','likeCounter'])->withClappersCount();
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

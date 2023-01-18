<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    function posts(){
        return $this->BelongsToMany(Blog::class,'tag_blog')->with(['writer', 'tags', 'likeCounter'])->withClappersCount()->withCount('comments');
    }
}

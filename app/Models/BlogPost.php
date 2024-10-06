<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'blog_posts';
    protected $fillable = ['title', 'content', 'author_id'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
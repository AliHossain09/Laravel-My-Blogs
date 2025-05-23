<?php

namespace App\Models;
use App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function posts()
    {
        // return $this->belongsToMany(Post::class)->withTimestamps();
        return $this->belongsToMany(Post::class, 'post_tag')->withTimestamps();
    }
}

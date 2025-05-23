<?php

namespace App\Models;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'view_count',
        'status',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    public function categories()
    {
        // return $this->belongsToMany(Category::class)->withTimestamps();
        return $this->belongsToMany(Category::class, 'category_post')->withTimestamps();
        
    }
    public function tags()
    {
        // return $this->belongsToMany(Tag::class)->withTimestamps();
        return $this->belongsToMany(Tag::class, 'post_tag')->withTimestamps();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Post extends Model implements Viewable
{

    use InteractsWithViews;

    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $removeViewsOnDelete = true;

    public function blog_category()
    {
        return $this->belongsTo(\App\Models\Blog\Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}


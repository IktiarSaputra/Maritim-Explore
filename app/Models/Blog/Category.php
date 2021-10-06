<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'blog_categories';

    protected $guarded = [];

    public function post()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
}

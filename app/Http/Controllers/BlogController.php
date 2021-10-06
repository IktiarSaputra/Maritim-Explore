<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Travel;
use App\Models\Comment;
use App\Models\Blog\Category;
use App\Models\Tags;

class BlogController extends Controller
{
    public function isi_blog($slug)
    {
        $blog = Post::orderByViews()->take(4)->get();
        $post = Post::with(['comments', 'comments.child'])->where('slug', $slug)->first();
        $tags = Tags::orderBy('created_at', 'DESC')->take(6)->get();
        $kategori = Category::orderBy('created_at', 'DESC')->take(4)->get();
        $travel = Travel::orderByViews()->take(4)->get();
        $blogpos = Post::orderBy('created_at', 'ASC')->take(6)->get();
        views($post)->record();
        return view('education.isi_blog',['post' => $post, 'kategori' => $kategori, 'tags' => $tags, 'blog' => $blog, 'blogpos' => $blogpos, 'travel' => $travel]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $id = $category->id;
        $post = Post::where('blog_category_id',$id)->get();
        return view('education.category', compact('post'));
    }

    public function comment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        Comment::create([
            'post_id' => $request->id,
            'parent_id' => $request->parent_id != '' ? $request->parent_id:NULL,
            'user_id' => $request->user_id,
            'comment' => $request->comment
        ]);
        return redirect()->back()->with(['success' => 'Komentar Ditambahkan']);
    }
}
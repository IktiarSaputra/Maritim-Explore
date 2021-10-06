<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tags;
use Illuminate\Support\Str;
use App\Models\Blog\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::paginate();
        return view('owner.blog.post.index', ['post' => $post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $kategori = Category::all();
        return view('owner.blog.post.add', ['kategori' => $kategori, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'gambar' => 'required|image|mimes:png,jpeg,jpg' 
        ]);

        $post = Post::create([
            'title' => $request->title,
            'blog_category_id' => $request->blog_category_id,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'user_id' => $request->user_id,
        ]);
        if($request->hasfile(['gambar'])){
            $request->file(['gambar'])->move('gambar/',$request->file(['gambar'])->getClientOriginalName());
            $post->gambar = $request->file(['gambar'])->getClientOriginalName();
            $post->slug = Str::slug($request->title);
            $post->save();
        }
        
        $post->tags()->attach($request->tags);
        return redirect(route('post'))->with('insert', "Sukses");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $post = Post::onlyTrashed()->paginate();
        return view('owner.blog.post.delete', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tags::all();
        $kategori = Category::all();
        $post = Post::find($id);
        return view('owner.blog.post.edit',['post' => $post, 'tags' => $tags, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Post::find($id);
        $post = [
            'title' => $request->title,
            'blog_category_id' => $request->category_id,
            'content' => $request->content,
            'slug' => Str::slug($request->title)
        ];
        if($request->hasfile(['gambar'])){
            $request->file(['gambar'])->move('gambar/',$request->file(['gambar'])->getClientOriginalName());
            $posts->gambar = $request->file(['gambar'])->getClientOriginalName();
            $posts->save();
        }
        
        $posts->tags()->sync($request->tags);
        $posts->update($post);
        return redirect(route('post'))->with('update', "Sukses");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  Post::withTrashed()->where('id', $id)->first();
        $post->delete();
        return redirect()->back()->with('delete', "Sukses");
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect(route('post'))->with('restore', "Sukses");
    }

    public function delete($id)
    {
        $post =  Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        return redirect(route('post'))->with('trash', "Sukses");        
    }

    public function uploadImage(Request $request)
    {
        //JIKA ADA DATA YANG DIKIRIMKAN
        if ($request->hasFile('upload')) {
            $file = $request->file('upload'); //SIMPAN SEMENTARA FILENYA KE VARIABLE
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); //KITA GET ORIGINAL NAME-NYA
            //KEMUDIAN GENERATE NAMA YANG BARU KOMBINASI NAMA FILE + TIME
            $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $fileName); //SIMPAN KE DALAM FOLDER PUBLIC/UPLOADS

            //KEMUDIAN KITA BUAT RESPONSE KE CKEDITOR
            $ckeditor = $request->input('CKEditorFuncNum');
            $url = asset('uploads/' . $fileName); 
            $msg = 'Image uploaded successfully'; 
            //DENGNA MENGIRIMKAN INFORMASI URL FILE DAN MESSAGE
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";

            //SET HEADERNYA
            @header('Content-type: text/html; charset=utf-8'); 
            return $response;
        }
    }

}

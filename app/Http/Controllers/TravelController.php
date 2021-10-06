<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\TravelImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Travel;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travel = Travel::orderBy('created_at', 'DESC')->get();
        return view('admin.travel.index', compact('travel'));
    }

    public function list()
    {
        $travel = Travel::all();
        return view('travel.index',compact('travel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.travel.add');
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
            'gambar' => 'required|image|mimes:png,jpeg,jpg', 
            'lang' => 'required|string|max:100',
            'ltd' => 'required|string|max:100'
        ]);

        $post = Travel::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'lang' => $request->lang,
            'ltd' => $request->ltd,
            'user_id' => $request->user_id,
        ]);

        if($request->hasfile(['gambar'])){
            $request->file(['gambar'])->move('gambar/',$request->file(['gambar'])->getClientOriginalName());
            $post->gambar = $request->file(['gambar'])->getClientOriginalName();
            $post->slug = Str::slug($request->title);
            $post->save();
        }
        return redirect(route('travel.index'));
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel = Travel::find($id);
        return view('admin.travel.edit', compact('travel'));
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
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:png,jpeg,jpg',
        ]);

        $travel = Travel::find($id);
        $travel->update([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'user_id' => $request->user_id,
        ]);
        if($request->hasfile(['gambar'])){
            $request->file(['gambar'])->move('gambar/',$request->file(['gambar'])->getClientOriginalName());
            $travel->gambar = $request->file(['gambar'])->getClientOriginalName();
            $travel->slug = Str::slug($request->title);
            $travel->save();
        }

        return redirect(route('travel.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travel = Travel::find($id);
        $travel->delete();
        return redirect()->back()->withInput();
    }

    public function import(Request $request) 
    {
        // validasi
        $this->validate($request, [
        'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        // menangkap file excel
        $file = $request->file('file');
        
        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
        
        $file->move('storage/file_travel',$nama_file);
        
        Excel::import(new TravelImport, public_path('/storage/file_travel/'.$nama_file));
        
        return redirect()->back();
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village;
use Illuminate\Support\Str;
use App\Imports\VillageImport;
use Maatwebsite\Excel\Facades\Excel;

class VillageController extends Controller
{
    public function index()
    {
        $village = Village::orderBY('created_at','DESC')->get();
        return view('admin.village.index',compact('village'));
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
        
        $file->move('storage/file_village',$nama_file);
        
        Excel::import(new VillageImport, public_path('/storage/file_village/'.$nama_file));
        
        return redirect()->back();
    }

    public function list()
    {
        $village = Village::all();
        return view('footer.desa',compact('village'));
    }

    public function destroy($id)
    {
        $village = Village::find($id);
        $village->delete();
        return redirect()->back()->withInput();
    }
}

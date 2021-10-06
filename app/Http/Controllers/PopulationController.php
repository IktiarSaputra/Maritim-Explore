<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Population;
use Illuminate\Support\Str;
use App\Imports\PopulationImport;
use Maatwebsite\Excel\Facades\Excel;

class PopulationController extends Controller
{
    public function index()
    {
        $population = Population::all();
        return view('admin.population.index', compact('population'));
    }

    public function import(Request $request)
    {
        $this->validate($request, [
        'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        // menangkap file excel
        $file = $request->file('file');
        
        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
        
        $file->move('storage/file_population',$nama_file);
        
        Excel::import(new PopulationImport, public_path('/storage/file_population/'.$nama_file));
        
        return redirect()->back();
    }

    public function population()
    {
        $population19 = Population::orderBy('created_at', 'DESC')->where('tahun', 2019)->get();

        $categories = [];
        $laki = [];
        $wanita = [];
        $total = [];

        foreach ($population19 as $key) {
            $categories[] = $key->nama_wilayah;
            $laki[] = $key->pria;
            $wanita[] = $key->wanita;
            $total[] = $key->jumlah_penduduk;
        }

        $population18 = Population::orderBy('created_at', 'DESC')->where('tahun', 2018)->get();

        $categories18 = [];
        $laki18 = [];
        $wanita18 = [];
        $total18 = [];

        foreach ($population18 as $key) {
            $categories18[] = $key->nama_wilayah;
            $laki18[] = $key->pria;
            $wanita18[] = $key->wanita;
            $total18[] = $key->jumlah_penduduk;
        }

        $population17 = Population::orderBy('created_at', 'DESC')->where('tahun', 2017)->get();

        $categories17 = [];
        $laki17 = [];
        $wanita17 = [];
        $total17 = [];

        foreach ($population17 as $key) {
            $categories17[] = $key->nama_wilayah;
            $laki17[] = $key->pria;
            $wanita17[] = $key->wanita;
            $total17[] = $key->jumlah_penduduk;
        }

        return view('footer.kependudukan', compact(['population19','categories','laki','wanita','total','categories18','laki18','wanita18','total18','categories17','laki17','wanita17','total17']));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Travel;
use App\Models\Post;
use App\Charts\CovidChart;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    public function welcome()
    {
        // $response = Http::get('https://covid19.mathdro.id/api/countries/id')->json();
        // dd($response);

        $product = Product::orderBy('created_at', 'DESC')->take(2)->where('status', 1)->get();
        $post = Post::orderBy('created_at', 'DESC')->take(1)->get();
        $travel = Travel::orderBy('created_at', 'DESC')->take(1)->get();
        $response = Http::get('https://covid19.mathdro.id/api/countries/id');
        $data = $response->json();
        
        $response = Http::get('https://indonesia-covid-19.mathdro.id/api/provinsi/')->json();
        $jakarta = $response['data'][0]['kasusPosi'];
        $jabar = $response['data'][1]['kasusPosi'];
        $jateng = $response['data'][2]['kasusPosi'];
        $jatim = $response['data'][3]['kasusPosi'];
        $sulsel = $response['data'][4]['kasusPosi'];
        $kaltim = $response['data'][5]['kasusPosi'];
        $bali = $response['data'][6]['kasusPosi'];
        $riau = $response['data'][7]['kasusPosi'];
        $banten = $response['data'][8]['kasusPosi'];
        $sumbar = $response['data'][9]['kasusPosi'];
        $diy = $response['data'][10]['kasusPosi'];
        $sumut = $response['data'][11]['kasusPosi'];
        $kalsel = $response['data'][12]['kasusPosi'];
        $papua = $response['data'][13]['kasusPosi'];
        $sumsel = $response['data'][14]['kasusPosi'];
        $sulut = $response['data'][15]['kasusPosi'];
        $kalteng = $response['data'][16]['kasusPosi'];
        $lampung = $response['data'][17]['kasusPosi'];
        $sultenggara = $response['data'][18]['kasusPosi'];
        $sulteng = $response['data'][19]['kasusPosi'];
        $kalut = $response['data'][20]['kasusPosi'];
        $aceh = $response['data'][21]['kasusPosi'];
        $ntt = $response['data'][22]['kasusPosi'];
        $kepriau = $response['data'][23]['kasusPosi'];
        $ntb = $response['data'][24]['kasusPosi'];
        $papuabarat = $response['data'][25]['kasusPosi'];
        $bangka = $response['data'][26]['kasusPosi'];
        $maluku = $response['data'][27]['kasusPosi'];
        $jambi = $response['data'][28]['kasusPosi'];
        $sulbar = $response['data'][29]['kasusPosi'];
        $bengkulu = $response['data'][30]['kasusPosi'];
        $gorontalo = $response['data'][31]['kasusPosi'];
        $kalbar = $response['data'][32]['kasusPosi'];
        $malut = $response['data'][33]['kasusPosi'];

        return view('welcome', compact('product','post','travel','data','jakarta','jabar','jateng','jatim','sulsel','aceh','sumut','riau','sumbar','bengkulu','jambi','lampung','sumsel','bangka','kepriau','banten','bali','ntb','ntt','maluku','kalbar','kalteng','kalsel','kaltim','kalut','sulsel','sultenggara','sulteng','sulbar','malut','diy','gorontalo','sulut','papua','papuabarat'));
    }

    public function healthy()
    {
        $response_covid = Http::get('https://covid19.mathdro.id/api/countries/id');
        $response_rujukan = Http::get('https://dekontaminasi.com/api/id/covid19/hospitals')->json();
        $covid = $response_covid->json();
        $rujukan = $response_rujukan;

        $response = Http::get('https://indonesia-covid-19.mathdro.id/api/provinsi/')->json();
        $jakarta = $response['data'][0]['kasusPosi'];
        $jabar = $response['data'][1]['kasusPosi'];
        $jateng = $response['data'][2]['kasusPosi'];
        $jatim = $response['data'][3]['kasusPosi'];
        $sulsel = $response['data'][4]['kasusPosi'];
        $kaltim = $response['data'][5]['kasusPosi'];
        $bali = $response['data'][6]['kasusPosi'];
        $riau = $response['data'][7]['kasusPosi'];
        $banten = $response['data'][8]['kasusPosi'];
        $sumbar = $response['data'][9]['kasusPosi'];
        $diy = $response['data'][10]['kasusPosi'];
        $sumut = $response['data'][11]['kasusPosi'];
        $kalsel = $response['data'][12]['kasusPosi'];
        $papua = $response['data'][13]['kasusPosi'];
        $sumsel = $response['data'][14]['kasusPosi'];
        $sulut = $response['data'][15]['kasusPosi'];
        $kalteng = $response['data'][16]['kasusPosi'];
        $lampung = $response['data'][17]['kasusPosi'];
        $sultenggara = $response['data'][18]['kasusPosi'];
        $sulteng = $response['data'][19]['kasusPosi'];
        $kalut = $response['data'][20]['kasusPosi'];
        $aceh = $response['data'][21]['kasusPosi'];
        $ntt = $response['data'][22]['kasusPosi'];
        $kepriau = $response['data'][23]['kasusPosi'];
        $ntb = $response['data'][24]['kasusPosi'];
        $papuabarat = $response['data'][25]['kasusPosi'];
        $bangka = $response['data'][26]['kasusPosi'];
        $maluku = $response['data'][27]['kasusPosi'];
        $jambi = $response['data'][28]['kasusPosi'];
        $sulbar = $response['data'][29]['kasusPosi'];
        $bengkulu = $response['data'][30]['kasusPosi'];
        $gorontalo = $response['data'][31]['kasusPosi'];
        $kalbar = $response['data'][32]['kasusPosi'];
        $malut = $response['data'][33]['kasusPosi'];

        
        //$labelsdata = $covid19->pluck('kasusPosi');
        //dd($labelsdata);
        return view('health', compact('covid','rujukan','jakarta','jabar','jateng','jatim','sulsel','aceh','sumut','riau','sumbar','bengkulu','jambi','lampung','sumsel','bangka','kepriau','banten','bali','ntb','ntt','maluku','kalbar','kalteng','kalsel','kaltim','kalut','sulsel','sultenggara','sulteng','sulbar','malut','diy','gorontalo','sulut','papua','papuabarat'));
    }
    public function education()
    {
        $post = Post::orderBy('created_at', 'DESC')->paginate(12);
        $blog = Post::orderByViews()->paginate(12);
        $banner = Post::orderByViews('asc')->take(1)->get();
        return view('education.index', compact('post','blog','banner'));
    }

    public function vaksin()
    {
        $response = Http::get('http://vaksincovid19-api.now.sh/api/vaksin');
        $data = $response->json();

        return view('healthy.vaksinasi',compact('data'));
    }
}

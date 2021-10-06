<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\Post;

class TouristController extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->has('cari')) {
            $travel = Travel::where('title','LIKE','%' . $request->cari . '%')->get();
            $wisata = Travel::orderByViews()->take(12)->get();
            return view('travel.index', compact('travel','wisata'));
        }else {
            $travel = Travel::orderBy('created_at', 'DESC')->take(5)->get();
            $wisata = Travel::orderByViews()->take(12)->get();
            return view('travel.index', compact('travel','wisata'));
        }
    }

    public function show($slug)
    {
        $travel = Travel::where('slug', $slug)->first();
        $blog = Post::orderByViews()->take(4)->get();
        $tourist = Travel::orderByViews()->take(4)->get();
        $wisata = Travel::orderBy('created_at', 'DESC')->take(4)->get();
        views($travel)->record();
        return view('travel.detail-travel', compact('travel','tourist','blog','wisata'));
    }
}

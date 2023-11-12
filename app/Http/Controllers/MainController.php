<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Research;
use App\Models\Slide;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $slides = Slide::orderBy('priority')->get();
        $researches = Research::latest()->take(2)->get();
        $products = Product::inRandomOrder()->take(6)->get();

        return view('home.index', compact('slides', 'researches', 'products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $resultsCount = 0;
        if($keyword == '') {
            return view('search.results', compact('resultsCount'));
        }

        $searchProducts = Product::where('name', 'LIKE', '%' . $keyword . '%')
                            ->select('url', 'name')
                            ->orderBy('name')
                            ->get();

        $searchResearches = Research::where('title', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('subtitle', 'LIKE', '%' . $keyword . '%')
                            ->select('url', 'title')
                            ->orderBy('title')
                            ->get();

        $resultsCount = count($searchProducts) + count($searchResearches);

        return view('search.results', compact('searchProducts', 'searchResearches', 'resultsCount'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researches = Research::latest()->get();

        return view('researches.index', compact('researches'));
    }

    /**
     * Display list of items in dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardIndex(Request $request)
    {
        // for search
        $items = Research::select('title', 'id')->orderBy('title')->get();
        $editRoute = 'researches.edit';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'title';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $researches = Research::join('products', 'research.product_id', '=', 'products.id')
                        ->select('research.*', 'products.name as productName')
                        ->orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.researches.index', compact('items', 'editRoute', 'researches', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select('name', 'id')
                    ->orderBy('name')
                    ->get();

        return view('dashboard.researches.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationRules = [
            "title" => "unique:research"
        ];
        $validationMessages = [
            "title.unique" => "Исследования с таким заголовком уже существует !",
        ];
        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        $research = new Research();
        $fields = ['title', 'subtitle', 'body', 'product_id'];
        Helper::fillFields($request, $research, $fields);
        $research->url = Helper::transliterateIntoLatin($request->title);
        
        Helper::uploadFiles($request, $research, 'image', uniqid(), Helper::RESEARCHES_PATH, 620);
        $research->save();

        return redirect()->route('dashboard.researches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $research = Research::where('url', $url)->first();
        $anotherResearch = Research::where('id', '!=', $research->id)->inRandomOrder()->first();
        return view('researches.show', compact('research', 'anotherResearch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $research = Research::find($id);

        $products = Product::select('name', 'id')
                ->orderBy('name')
                ->get();

        return view('dashboard.researches.edit', compact('research', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $research = Research::find($request->id);

        $validationErrors = [];
        if($request->title != $research->title) {
            $duplicate = Research::where('title', $request->title)->first();
            if ($duplicate) array_push($validationErrors, "Исследования с таким заголовком уже существует!");
        }

        if(count($validationErrors) > 0) return back()->withInput()->withErrors($validationErrors);

        $fields = ['title', 'subtitle', 'body', 'product_id'];
        Helper::fillFields($request, $research, $fields);
        $research->url = Helper::transliterateIntoLatin($request->title);
        
        Helper::uploadFiles($request, $research, 'image', uniqid(), Helper::RESEARCHES_PATH, 620);
        $research->save();
        
        return redirect()->back();
    }

    /**
     * Request for deleting items by id may come in integer type (single destroy form) 
     * or in array type (multiple destroy form)
     * That`s why we need to get them in array type and delete them by loop
     *
     * @param  int/array  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $ids = (array) $request->id;
        
        foreach($ids as $id) {
            Research::find($id)->delete();
        }
        
        return redirect()->route('dashboard.researches.index');
    }

    /**
     * Also destroy researches of product while destroying product
     *
     * @param array $ids
     * @return void
     */
    public static function destroyOnProductsDestroy($ids)
    {
        foreach($ids as $id) {
            Research::find($id)->delete();
        }
    }
}

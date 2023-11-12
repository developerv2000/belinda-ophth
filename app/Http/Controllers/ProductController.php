<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Form;
use App\Models\Impact;
use App\Models\Prescription;
use App\Models\Product;
use App\Models\Substance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of Filtered products
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $products = $this->filter($request);

        $prescriptions = Prescription::all();
        $impacts = Impact::orderBy('title')->get();
        $substances = Substance::orderBy('title')->get();

        return view('products.index', compact('request', 'products', 'prescriptions', 'impacts', 'substances'));
    }

    /**
     * Return filtered products for AJAX Requests
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxGet(Request $request)
    {
        $products = $this->filter($request);
        $products->withPath(route('products.index'));

        return view('components.products-list', compact('products'));
    }

    /**
     * Return filtered products
     *
     * @return \Illuminate\Http\Response
     */
    public function filter($request)
    {
        $products = Product::query();

        $prescription_id = $request->prescription_id;
        if($prescription_id) {
            $products = $products->where('prescription_id', $prescription_id);
        }

        $impact_id = $request->impact_id;
        if($impact_id) {
            $products = $products->where('impact_id', $impact_id);
        }

        $substance_id = $request->substance_id;
        if($substance_id) {
            $products = $products->whereHas('substances', function ($q) use ($substance_id) {
                $q->where('id', $substance_id);
            });
        }

        $products = $products->orderBy('name')
                            ->paginate(12)
                            ->appends($request->except(['page', 'token']))
                            ->fragment('products-warning');

        return $products;
    }

    /**
     * Display list of items in dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardIndex(Request $request)
    {
        // for search
        $items = Product::select('name as title', 'id')->orderBy('title')->get();
        $editRoute = 'products.edit';

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'name';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $products = Product::join('forms', 'products.form_id', '=', 'forms.id')
                        ->join('prescriptions', 'products.prescription_id', '=', 'prescriptions.id')
                        ->select('products.*', 'forms.title as formTitle', 'prescriptions.title as prescriptionTitle')
                        ->orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.products.index', compact('items', 'editRoute', 'products', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prescriptions = Prescription::all();
        $forms = Form::orderBy('title')->get();
        $impacts = Impact::orderBy('title')->get();
        $substances = Substance::orderBy('title')->get();

        return view('dashboard.products.create', compact('prescriptions', 'forms', 'impacts', 'substances'));
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
            "name" => "unique:products"
        ];
        $validationMessages = [
            "name.unique" => "Продукт с таким названием уже существует !",
        ];
        Validator::make($request->all(), $validationRules, $validationMessages)->validate();

        $product = new Product();
        $fields = ['name', 'description', 'body', 'obtain_link', 'form_id', 'prescription_id', 'impact_id'];
        Helper::fillFields($request, $product, $fields);
        $product->url = Helper::transliterateIntoLatin($request->name);

        Helper::uploadFiles($request, $product, 'image', $product->url, Helper::PRODUCTS_PATH, 500);
        Helper::uploadFiles($request, $product, 'instruction', $product->url, Helper::INSTRUCTIONS_PATH);
        $product->save();

        $product->substances()->attach($request->substances);

        return redirect()->route('dashboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $product = Product::where('url', $url)->first();

        if($product->impact) {
            $similarProducts = Product::where('impact_id', $product->impact_id)
            ->where('id', '!=', $product->id)
            ->take(8)
            ->get();
        } else {
            $similarProducts = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        }

        return view('products.show', compact('product', 'similarProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        $prescriptions = Prescription::all();
        $forms = Form::orderBy('title')->get();
        $impacts = Impact::orderBy('title')->get();
        $substances = Substance::orderBy('title')->get();

        return view('dashboard.products.edit', compact('product', 'prescriptions', 'forms', 'impacts', 'substances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);

        $validationErrors = [];
        if($request->name != $product->name) {
            $duplicate = Product::where('name', $request->name)->first();
            if ($duplicate) array_push($validationErrors, "Продукт с таким названием уже существует!");
        }

        if(count($validationErrors) > 0) return back()->withInput()->withErrors($validationErrors);

        $fields = ['name', 'description', 'body', 'obtain_link', 'form_id', 'prescription_id', 'impact_id'];
        Helper::fillFields($request, $product, $fields);
        $product->url = Helper::transliterateIntoLatin($request->name);

        Helper::uploadFiles($request, $product, 'image', $product->url, Helper::PRODUCTS_PATH, 500);
        Helper::uploadFiles($request, $product, 'instruction', $product->url, Helper::INSTRUCTIONS_PATH);
        $product->save();

        $product->substances()->detach();
        $product->substances()->attach($request->substances);

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
            $product = Product::find($id);
            $product->substances()->detach();

            //also delete products researches if exists
            $researches = $product->researches()->pluck('id');
            ResearchController::destroyOnProductsDestroy($researches);

            $product->delete();
        }

        return redirect()->route('dashboard.index');
    }
}

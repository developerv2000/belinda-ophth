<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductRelationContoller extends Controller
{
    /**
     * Display list of items in dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = $request->model;
        $modelFullName = 'App\Models\\' . $model;

        $items =  $modelFullName::orderBy('title', 'asc')->get();
        $relationTitle = $this->getTitle($model);

        return view('dashboard.products.relations.index', compact('items', 'model', 'relationTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $model = $request->model;
        $relationTitle = $this->getTitle($model);

        return view('dashboard.products.relations.create', compact('model', 'relationTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $request->model;
        $modelFullName = 'App\Models\\' . $model;

        $item = new $modelFullName();
        $item->title = $request->title;
        if($model == 'Impact') {
            $item->highlight = $request->highlight;
        }
        $item->save();

        return redirect()->route('products.relations.index', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $model = $request->model;
        $modelFullName = 'App\Models\\' . $model;
        $relationTitle = $this->getTitle($model);

        $item = $modelFullName::find($id);

        return view('dashboard.products.relations.edit', compact('model', 'modelFullName', 'relationTitle', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $model = $request->model;
        $modelFullName = 'App\Models\\' . $model;

        $item = $modelFullName::find($request->id);
        $item->title = $request->title;
        if($model == 'Impact') {
            $item->highlight = $request->highlight;
        }
        $item->save();

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
        $model = $request->model;
        $modelFullName = 'App\Models\\' . $model;
        $ids = (array) $request->id;
        
        switch ($model) {
            case 'Substance':
                // BelongsToMany
                foreach($ids as $id) {
                    $item = $modelFullName::find($id);
                    $item->products()->detach();
                    $item->delete();
                }
                break;

            case 'Impact':
                foreach($ids as $id) {
                    $item = $modelFullName::find($id);
                    $productsCount = $item->products()->count();
                    // Redirect back with errors if there are products with the current impact
                    if($productsCount) {
                        return back()->withErrors(['У воздействии «' . $item->title . '» имеются несколько (' . $productsCount . ') продуктов. Необходимо поменять воздействие этих продуктов на другой существующий, прежде чем удалять текущее воздействие!']);
                    } else {
                        $item->delete();
                    }
                }
                break;

            case 'Form':
                foreach($ids as $id) {
                    $item = $modelFullName::find($id);
                    $productsCount = $item->products()->count();
                    // Redirect back with errors if there are products with the current form
                    if($productsCount) {
                        return back()->withErrors(['У формы «' . $item->title . '» имеются несколько (' . $productsCount . ') продуктов. Необходимо поменять форму этих продуктов на другой существующий, прежде чем удалять текущую форму!']);
                    } else {
                        $item->delete();
                    }
                }
                break;
        }
        
        return redirect()->route('products.relations.index', ['model' => $model]);
    }

    /**
     * Generate title for header due to model
     *
     * @param [type] $model
     * @return void
     */
    private function getTitle($model)
    {
        switch($model) {
            case 'Substance':
                $title = 'действующее вещество';
            break;

            case 'Impact':
                $title = 'Воздействие';
            break;

            case 'Form':
                $title = 'Форма';
            break;
        }

        return $title;
    }
}

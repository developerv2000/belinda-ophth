<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display list of items in dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardIndex(Request $request)
    {
        //for count
        $items = Slide::select('id')->get();

        $slides = Slide::orderBy('priority')->get();

        return view('dashboard.slides.index', compact('slides', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slide = new Slide();
        $fields = ['title', 'body', 'button', 'link', 'priority'];
        Helper::fillFields($request, $slide, $fields);
    
        Helper::uploadFiles($request, $slide, 'image', uniqid(), Helper::SLIDES_PATH, 1300);
        $slide->save();

        return redirect()->route('dashboard.slides.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = Slide::find($id);

        return view('dashboard.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slide = Slide::find($request->id);

        $fields = ['title', 'body', 'button', 'link', 'priority'];
        Helper::fillFields($request, $slide, $fields);
    
        Helper::uploadFiles($request, $slide, 'image', uniqid(), Helper::SLIDES_PATH, 1300);
        $slide->save();
        
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
            Slide::find($id)->delete();
        }
        
        return redirect()->route('dashboard.slides.index');
    }
}

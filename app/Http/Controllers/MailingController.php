<?php

namespace App\Http\Controllers;

use App\Models\Mailing;
use Illuminate\Http\Request;

class MailingController extends Controller
{
    /**
     * Subscribe for mailing by User/Visitor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->email;
        //escape storing duplicate
        $duplicate = Mailing::where('email', $email)->first();
        if(!$duplicate) {
            Mailing::create([
                'email' => $email,
                'ip' => $request->ip()
            ]);
        }

        //need to store on session because of canceling mailing
        session(['mailing' => $email]);

        return true;
    }

    /**
     * Cancel mailing by User/Visitor
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Mailing::where('email', session('mailing'))->delete();
        //remove from session
        $request->session()->forget('mailing');

        return true;
    }

    /**
     * Display list of items in dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardIndex(Request $request)
    {
        // for count
        $items = Mailing::select('id')->get();

        // Generate parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'created_at';
        $orderType = $request->orderType ? $request->orderType : 'desc';
        $activePage = $request->page ? $request->page : 1;

        $subscriptions = Mailing::orderBy($orderBy, $orderType)
                        ->paginate(30, ['*'], 'page', $activePage)
                        ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.mailing.index', compact('items', 'subscriptions', 'orderBy', 'orderType', 'activePage', 'reversedOrderType'));
    }

    /**
     * Request for deleting items by id may come in integer type (single destroy form) 
     * or in array type (multiple destroy form)
     * That`s why we need to get them in array type and delete them by loop
     *
     * @param  int/array  $id
     * @return \Illuminate\Http\Response
     */
    public function dashDestroy(Request $request)
    {   
        $ids = (array) $request->id;
        
        foreach($ids as $id) {
            Mailing::find($id)->delete();
        }
        
        return redirect()->route('dashboard.mailing.index');
    }
}

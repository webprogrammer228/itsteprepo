<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class newController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $new = new News();
        return view('news.create', ['news' => $new]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'summary' => 'required|max:50',
           'shortDescription' => 'required|max:150',
           'fullDescription' => 'required|max:5000'
        ]);

        $new = new News();
        $fname = $request->file('imagePath');

        if ($fname != null)
        {
            $originalname = $request->file('imagePath')->getClientOriginalName();
            $request->file('imagePath')->move(public_path().'/images', $originalname);
            $new->imagePath = '/images/'.$originalname;
        }
        else {
            $new->imagePath = '';
        }


        $new->summary = $request->summary;
        $new->short_description = $request->shortDescription;
        $new->full_description = $request->fullDescription;

        if (!$new->save())
        {
            $err = $new->getErrors();
            return redirect()->action('newController@index')->with('error', $err)->withInput();
        }
        return redirect()->action('newController@index')->with('message', 'New message was been added with id='.$new->id.'!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        $id = 0;

        return view('news.index', ['page' => 'home', 'news' => $news, 'id' => $id]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::where('id', '=', $id)->get();
        return view('news.new', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = News::find($id);
        return view('news.edit')->with('news', $new);
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
        $validatedData = $request->validate([
            'summary' => 'required|max:50',
            'shortDescription' => 'required|max:150',
            'fullDescription' => 'required|max:5000'
        ]);

        $new = News::find($id);
        $fname = $request->file('imagePath');
        $new->summary = $request->summary;
        $new->short_description = $request->shortDescription;
        $new->full_description = $request->fullDescription;

        if ($fname != null)
        {
            $originalname = $request->file('imagePath')->getClientOriginalName();
            $request->file('imagePath')->move(public_path().'/images', $originalname);
            $new->imagePath = '/images/'.$originalname;
        }
        else {
            $new->imagePath = '';
        }
        $new->save();
        return redirect('index/'.$new->id);
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

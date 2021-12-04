<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Claim;
use App\Models\Role;
use App\Models\Sound;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoundController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->category + 1;
        $search = '%'. $search. '%';
        $sounds = Sound::all();
        $songs = Sound::where([
            ['categoryid', 'like', $search]
        ])->get();
        $categories = Category::pluck('name');
        return view('index', ['data' => $sounds, 'categories' => $categories, 'songs' => $songs]);
    }

    public function download()
    {
        if (!Auth::check()) {
            return redirect('register');
        }
        $sound = new Sound();
        $categories = Category::pluck('name', 'id');
        return view('download', ['sound' => $sound, 'categories' => $categories]);
    }

    public function claim()
    {
        return view('claim', ['page' => 'claim']);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|unique:sounds',
            'artist' => 'required',
            'imagePath' => 'required|mimes:jpg,jpeg',
            'soundPath' => 'required|mimes:mp3,mpeg'
        ]);

        $data = new Sound();


        $data->title = $request->title;
        $data->artist = $request->artist;
        $data->categoryid = $request->category;
        $data->imagePath = $request->imagePath;
        $data->soundPath = $request->soundPath;

        $newImage = $request->file('imagePath');
        $newSound = $request->file('soundPath');

        if ($newImage != null) {
            $originalName = $request->file('imagePath')->getClientOriginalName();
            $request->file('imagePath')->move(public_path() . '/images', $originalName);
            $data->imagePath = '/images/' . $originalName;
        } else {
            $data->imagePath = '';
        }

        if ($newSound != null) {
            $originalName1 = $request->file('soundPath')->getClientOriginalName();
            $request->file('soundPath')->move(public_path() . '/sounds', $originalName1);
            $data->soundPath = '/sounds/' . $originalName1;
        } else {
            $data->soundPath = '';
        }

        if (Auth::user()->id == 2) {
            $data->roleid = 2;
        }
        else $data->roleid = 1;

        if (!$data->save()) {
            $err = $data->getErrors();
            return redirect()->back()
                ->withErrors('error', $err)
                ->withInput();
        } else {
            return redirect()->back()
                ->with('message', 'New sound is added!');
        }
    }

    public function getUsers()
    {
        $user = User::all();
        return view('block', ['user' => $user]);
    }

    public function block($id)
    {
        $users = User::find($id);
        if ($users->status === 0) {
            $users->status = 1;
            $users->update();
        }
        else if ($users->status === 1) {
            $users->status = 0;
            $users->update();
        }
        return redirect('users');
    }
}

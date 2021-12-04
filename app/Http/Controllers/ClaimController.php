<?php

namespace App\Http\Controllers;

use App\Block;
use App\Models\Claim;
use App\Models\Sound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::all();
        $sound = Sound::pluck('title');
        $sounds = DB::table('sounds')->join('claims', 'sounds.id', '=', 'sound_id')
            ->select('sounds.title', 'claims.sound_id')->get()->unique();

        return view('claim', ['claims' => $claims, 'sounds' => $sound, 'sound' => $sounds]);
    }

    public function store(Request $request)
    {
        $claim = new Claim();

        $validate = $request->validate([
            'reason' => 'required|unique:claims',
            'claimbody' => 'required'
        ]);

        $claim->reason = $request->reason;
        $claim->sound_id = $request->sound + 1;
        $claim->claimbody = $request->claimbody;

        if (!$claim->save()) {
            $err = $claim->getErrors();
            return redirect()->back()
                ->withErrors('error', $err)
                ->withInput();
        } else {
            return redirect()->back()
                ->with('message', 'Ваша жалоба зарегистрирована, мы примем меры!');
        }
    }


    public function destroy($id)
    {
        $claim = Claim::find($id);
        $claim->delete();
        return redirect('claims');
    }
}

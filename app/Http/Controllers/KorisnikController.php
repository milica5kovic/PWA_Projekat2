<?php

namespace App\Http\Controllers;

use App\Models\Korpa;
use App\Models\Proizvod;
use App\Models\PredmetKorpe;
use Auth;

class KorisnikController extends Controller
{
    public function korpa()
    {
        $korpa = Korpa::where(['korisnik_id' => Auth::user()->id])->orderBy('created_at', 'desc')->first();

        if(!$korpa)
            $korpa = Korpa::create(["korisnik_id" => Auth::user()->id]);

        $sadrzaj = PredmetKorpe::where(['korpa_id'=> $korpa->id])->get();
        $data["proizvodi"] = [];
        foreach ($sadrzaj as $s) {
            $data["proizvodi"][$s->id] = Proizvod::find($s->proizvod_id);
        }

        return view('korisnik.korpa')->with($data);
    }
}

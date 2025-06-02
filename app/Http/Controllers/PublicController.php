<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use App\Models\Korpa;
use App\Models\Proizvod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function pocetna()
    {
        $data["najnovije"] = Proizvod::latest()->limit(10)->get();

        $kategorije = Kategorija::all();
        $data["kategorije"] = $kategorije;
        $data["proizvodi_kategorije"] = [];
        $data["izdvajamo"] = Proizvod::where('oznaceno', 1)->limit(10)->get();

        if ($data["izdvajamo"]->isNotEmpty()) {
            $data["hero"] = $data["izdvajamo"]->random();
        } else {
            $data["hero"] = Proizvod::latest()->first();
        }


        foreach ($kategorije as $kategorija) {
            $data["proizvodi_kategorije"][$kategorija->ime] = Proizvod::where('kategorija_id', $kategorija->id)->limit(10)->get();
        }

        return view('public.pocetna')->with($data);
    }

    public function kontakt()
    {
        return view('public.kontakt');
    }

    public function prijava()
    {
        return view('public.prijava');
    }

    public function registracija()
    {
        return view('public.registracija');
    }

    public function proizvodi($filter = null)
    {
        if(Auth::check())
            $data["korpa"] = Korpa::where(["korisnik_id" => Auth::user()->id])->first();

        if ($filter) {
            $data["proizvodi"] = Proizvod::where('kategorija_id', $filter)->get();
        } else {
            $data["proizvodi"] = Proizvod::all();
        }

        return view('public.proizvodi')->with($data);
    }

    public function proizvod($id = 1) {
        if(Auth::check())
            $data["korpa"] = Korpa::where(["korisnik_id" => Auth::user()->id])->first();

        $data["proizvod"] = Proizvod::find($id);
        $data["slicniProizvodi"] = Proizvod::where('kategorija_id', $data["proizvod"]->kategorija_id)->limit(5)->get();
        return view('public.proizvod')->with($data);
    }

    public function kategorije()
    {
        if(Auth::check())
            $data["korpa"] = Korpa::where(["korisnik_id" => Auth::user()->id])->first();
        $data["kategorije"] = Kategorija::all();
        return view('public.kategorije')->with($data);
    }
}

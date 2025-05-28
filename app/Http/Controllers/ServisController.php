<?php

namespace App\Http\Controllers;

use App\Models\Korpa;
use App\Models\Porudzbina;
use App\Models\Proizvod;
use App\Models\PredmetKorpe;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServisController extends Controller
{
    public function dodaj_u_korpu($id)
    {
        $proizvod = Proizvod::find($id);

        $user = Auth::user();
        $korpa = Korpa::where('korisnik_id', $user->id)->orderBy("created_at", "desc")->first();

        if (!$korpa) {
            $korpa = Korpa::create(["korisnik_id" => $user->id]);
        }

        PredmetKorpe::create(["korpa_id" => $korpa->id, "proizvod_id" => $proizvod->id, "kolicina" => 1]);

        return Redirect::back();
    }

    public function brisi_iz_korpe($id)
    {
        $sadrzaj = PredmetKorpe::find($id);
        $sadrzaj->delete();
        return Redirect::back();
    }

    public function porudzbina(Request $request)
    {
        $user = Auth::user();
        $staraKorpa = Korpa::where('korisnik_id', $user->id)->first();

        $validatedData = $request->validate([
            'ulica' => 'required|string|max:255',
            'broj' => 'required|string|max:255',
            'grad' => 'required|string|max:255',
            'posta' => 'required|string|max:255',
        ]);

        $porudzbina = new Porudzbina();
        $porudzbina->korpa_id = $staraKorpa->id;
        $porudzbina->ulica = $validatedData['ulica'];
        $porudzbina->broj = $validatedData['broj'];
        $porudzbina->grad = $validatedData['grad'];
        $porudzbina->posta = $validatedData['posta'];
        $porudzbina->save();

        Korpa::create(["korisnik_id" => $user->id]);

        return Redirect::route('korpa')->with('success', 'Porudžbina je uspešno kreirana!');
    }

    public function prikaziFormuZaPorudzbinu()
    {
        $user = Auth::user();
        $korpa = Korpa::where('korisnik_id', $user->id)->orderBy("created_at", "desc")->first();

        $sadrzaj = PredmetKorpe::where(['korpa_id'=> $korpa->id])->get();
        $data["proizvodi"] = [];

        foreach ($sadrzaj as $s) {
            $data["proizvodi"][$s->id] = Proizvod::find($s->proizvod_id);
        }

        return view('korisnik.forma_za_porudzbinu', ['sadrzaj' => $data["proizvodi"]]);
    }


}

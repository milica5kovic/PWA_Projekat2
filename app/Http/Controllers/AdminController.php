<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use App\Models\Porudzbina;
use App\Models\Proizvod;
use App\Models\User;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function pocetna(): View
    {
        $this->adminCheck();

        $porudzbineData = Porudzbina::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->map(function ($item) {
                return [$item->date, $item->count];
            })
            ->prepend(['Datum', 'Broj Porudžbina'])
            ->toJson();

        $proizvodiData = Proizvod::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->map(function ($item) {
                return [$item->date, $item->count];
            })
            ->prepend(['Datum', 'Broj Proizvoda'])
            ->toJson();

        $kategorijeData = Kategorija::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->map(function ($item) {
                return [$item->date, $item->count];
            })
            ->prepend(['Datum', 'Broj Kategorija'])
            ->toJson();

        return view('admin.pocetna', compact('porudzbineData', 'proizvodiData', 'kategorijeData'));
    }


    public function proizvodi(): View
    {
        $this->adminCheck();

        return view('admin.proizvodi')->with(["proizvodi" => Proizvod::all(), "kategorije" => Kategorija::all()]);
    }

    public function kategorije(): View
    {
        $this->adminCheck();

        $kategorije = Kategorija::all();

        return view('admin.kategorije')->with(["kategorije" => $kategorije]);
    }

    public function korisnici(): View
    {
        $this->adminCheck();

        $this->adminOnly();

        return view('admin.korisnici');
    }

    public function narudzbe(): View
    {
        $this->adminCheck();

        $this->adminOnly();

        return view('admin.narudzbe')->with(["porudzbine" => Porudzbina::all()]);
    }

    public function dodaj($tip): RedirectResponse
    {
        $this->adminCheck();

        switch ($tip) {
            case 'proizvod':
                $data = request()->except('_token');

                if (request()->hasFile('slika')) {
                    $data['slika'] = request()->file('slika')->store('proizvodi', 'public');
                }

                Proizvod::factory()->create($data);
                return Redirect::back();

            case 'kategorija':
                $data = request()->except('_token');
                Kategorija::factory()->create($data);
                return Redirect::back();
            case 'porudzbina':
                break;
            default:
                return Redirect::back();
        }

        return Redirect::back();
    }

    public function izmeni($tip, $id): View|RedirectResponse
    {
        $this->adminCheck();

        return match ($tip) {
            'proizvod' => view('admin.izmeni.proizvod')->with(['proizvod' => Proizvod::find($id), "kategorije" => Kategorija::all()]),
            'kategorija' => view('admin.izmeni.kategorija')->with(['kategorija' => Kategorija::find($id)]),
            'porudzbina' => view('admin.izmeni.porudzbina')->with(['porudzbina' => Porudzbina::find($id)]),
            default => Redirect::back(),
        };
    }

    public function izmeniAkcija($tip, $id): RedirectResponse
    {
        $this->adminCheck();

        match ($tip) {
            'proizvod' => (function () use ($id) {
                $data = request()->except(['_token', '_method']);
                if (request()->hasFile('slika')) {
                    $data['slika'] = request()->file('slika')->store('proizvodi', 'public');
                }
                Proizvod::find($id)->update($data);
            })(),
            'kategorija' => Kategorija::find($id)->update(request()->all()),
            'porudzbina' => Porudzbina::find($id)->update(request()->all()),
        };

        return Redirect::back();
    }

    public function obrisi($tip = null, $id = null): RedirectResponse
    {
        $this->adminCheck();
        $this->adminOnly();

        switch ($tip) {
            case 'proizvod':
                Proizvod::destroy($id);
                break;
            case 'kategorija':
                Kategorija::destroy($id);
                break;
            case 'korisnik':
                User::destroy($id);
                break;
            case 'narudzba':
                Porudzbina::destroy($id);
                break;
            default:
                break;
        }

        return redirect()->back();
    }

    public function prijava(): View
    {
        return view('admin.prijava');
    }

    public function odjava(): RedirectResponse
    {
        Auth::logout();

        return Redirect::to('admin/prijava');
    }

    public function auth(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if ($this->checkRole()) {
                $request->session()->regenerate();
                return redirect()->intended('admin');
            }
            Auth::logout();
            return back()->withErrors([
                'email' => 'Niste admin hehe.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Ko si ti?',
        ]);
    }

    public function checkRole(): bool
    {
        return (Auth::user()->role === 'admin' || Auth::user()->role === 'editor');
    }

    private function adminOnly(): void
    {
        if (Auth::user()->role !== 'admin') {
            throw new HttpResponseException(
                Redirect::back()->withErrors("Stranica koju ste pokusali posetiti je za admine samo!", "admin")
            );
        }
    }

    private function adminCheck(): void
    {
        if (!Auth::check() || !$this->checkRole()) {
            throw new HttpResponseException(
                redirect()->to('admin/prijava')->withErrors("Morate biti admin da bi ste dobili pristup ovoj stranici!", "email")
            );
        }
    }

}

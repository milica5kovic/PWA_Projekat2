@extends('public.template.main')
@section('content')
    <style>
        footer {
            position: relative;
            top: 150px;
        }
    </style>
    <section class="container section mt-5">
        <div class="row">
            <div class="col-md-7">
                <h1>{{ $proizvod->ime }}</h1>
                <hr>
                <p class="lead">{!! nl2br(e($proizvod->opis)) !!}</p>
            </div>

            <div class="col-md-5">
                @if($proizvod->slika)
                    <img src="{{ asset('storage/' . $proizvod->slika) }}" alt="{{ $proizvod->ime }}"
                         class="img-fluid rounded mb-3"
                         style="max-height: 400px; width: auto; display: block; margin-left: auto; margin-right: auto;">
                @else
                    <img src="{{ asset('img/logo.png') }}" alt="Nema slike" class="img-fluid rounded mb-3"
                         style="max-height: 400px; width: auto; display: block; margin-left: auto; margin-right: auto;">
                @endif

                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">Cena: {{ number_format($proizvod->cena, 2, ',', '.') }} RSD</h4>
                        @auth
                            <form action="{{ route('korpa.dodaj', ['productId' => $proizvod->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg w-100">Dodaj u korpu</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success btn-lg w-100">Prijavite se za
                                kupovinu</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5">

        @if($slicniProizvodi && $slicniProizvodi->count() > 0)
            <div class="row mt-4" style="background-color: #f9f9ff;">
                <div class="col-12">
                    <h3>Slični proizvodi:</h3>
                </div>
                @foreach($slicniProizvodi as $slicanProizvod)
                    @if($slicanProizvod->id !== $proizvod->id)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100">
                                @if($slicanProizvod->slika)
                                    <a href="{{ route('proizvod', ['id' => $slicanProizvod->id]) }}">
                                        <img src="{{ asset('storage/' . $slicanProizvod->slika) }}" class="card-img-top"
                                             alt="{{ $slicanProizvod->ime }}" style="height: 200px; object-fit: cover;">
                                    </a>
                                @else
                                    <a href="{{ route('proizvod', ['id' => $slicanProizvod->id]) }}">
                                        <img src="{{ asset('img/logo.png') }}" class="card-img-top" alt="Nema slike"
                                             style="height: 200px; object-fit: cover;"> {{-- Резервна слика --}}
                                    </a>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        <a href="{{ route('proizvod', ['id' => $slicanProizvod->id]) }}"
                                           class="text-decoration-none text-dark">{{ $slicanProizvod->ime }}</a>
                                    </h5>
                                    <p class="card-text mt-auto">
                                        <strong>Cena: {{ number_format($slicanProizvod->cena, 2, ',', '.') }}
                                            RSD</strong></p>
                                    <a href="{{ route('proizvod', ['id' => $slicanProizvod->id]) }}"
                                       class="btn btn-outline-primary mt-2">Pogledaj detalje</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="row mt-4">
                <div class="col-12">
                    <p>Nema sličnih proizvoda u ovoj kategoriji.</p>
                </div>
            </div>
        @endif
    </section>
@endsection

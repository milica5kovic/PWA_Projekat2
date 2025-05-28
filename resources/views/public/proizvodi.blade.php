@extends('public.template.main')
@section("content")
    <style>
        footer {
            position: relative;
            top: 150px;
        }
    </style>
    <section class="section container">
        <div class="row">
            @if(isset($proizvodi) && $proizvodi->count() > 0)
                @foreach($proizvodi as $proizvod)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $proizvod->ime }}</h5>
                                <p class="card-text"><strong>Cena:</strong> {{ $proizvod->cena }} RSD</p>
                                <p class="card-text">{{ Str::limit($proizvod->opis, 100) }}</p>
                                <a href="{{ url('proizvod/' . $proizvod->id) }}" class="btn btn-primary">Pogledaj
                                    više</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col">
                    <p>Nema dostupnih proizvoda.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

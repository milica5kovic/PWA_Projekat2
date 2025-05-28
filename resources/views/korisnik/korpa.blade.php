@extends('public.template.main')

@section('content')
    <style>
        footer {
            position: relative;
            top: 150px;
        }
        .product-list-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>

    <section class="container mt-5 mb-5 section">
        <h2 class="mb-4">Vaša Korpa</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(isset($proizvodi) && count($proizvodi) > 0)
            <ul class="list-group">
                @foreach($proizvodi as $id => $proizvod)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if(isset($proizvod->slika) && $proizvod->slika)
                                <img src="{{ asset('storage/' . $proizvod->slika) }}" alt="{{ $proizvod->ime ?? 'Proizvod' }}" class="img-thumbnail product-list-image me-3">
                            @else
                                <img src="{{ asset('img/logo.png') }}" alt="Nema slike" class="img-thumbnail product-list-image me-3"> {{-- Fallback image --}}
                            @endif
                            <div>
                                <h5 class="mb-1">{{ $proizvod->ime ?? 'Naziv proizvoda nije dostupan' }}</h5>
                                <p class="mb-1"><strong>Cena:</strong> {{ number_format($proizvod->cena ?? 0, 2, ',', '.') }} RSD</p>
                            </div>
                        </div>

                        <form action="{{ route('korpa.brisi', ['id' => $id]) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da uklonite ovaj proizvod iz korpe?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Ukloni
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <div class="text-end mt-3">
                <a href="{{ route('korpa.forma_za_porudzbinu') }}" class="btn btn-primary">Poruči</a>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                Vaša korpa je trenutno prazna.
            </div>
            <div class="text-center">
                <a href="{{ route('proizvodi') }}" class="btn btn-outline-primary">Pogledajte proizvode</a>
            </div>
        @endif
    </section>
@endsection

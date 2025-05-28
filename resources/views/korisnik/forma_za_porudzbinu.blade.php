@extends('public.template.main')

@section('content')
    <style>
        footer {
            position: relative;
            top: 150px;
        }
        .product-list-image {
            max-width: 80px;
            max-height: 80px;
            object-fit: cover;
        }
        .order-summary-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .order-summary-item:last-child {
            border-bottom: none;
        }
    </style>

    <section class="container mt-5 mb-5 section">
        <h2 class="mb-4">Potvrda Porudžbine i Unos Podataka za Dostavu</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($sadrzaj && count($sadrzaj) > 0)
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h4>Detalji Porudžbine</h4>
                    <ul class="list-group mb-4">
                        @foreach($sadrzaj as $id => $predmet)
                            @if($predmet)
                            <li class="list-group-item d-flex justify-content-between align-items-center order-summary-item">
                                <div class="d-flex align-items-center">
                                    @if(isset($predmet->slika))
                                        <img src="{{ asset('storage/' . $predmet->slika) }}" alt="{{ $predmet->ime ?? 'Proizvod' }}" class="img-thumbnail product-list-image me-3">
                                    @else
                                        <img src="{{ asset('img/logo.png') }}" alt="Nema slike" class="img-thumbnail product-list-image me-3">
                                    @endif
                                    <div>
                                        <h5 class="mb-1">{{ $predmet->ime ?? 'Naziv proizvoda' }}</h5>
                                        <p class="mb-0"><strong>Cena:</strong> {{ number_format($predmet->cena ?? 0, 2, ',', '.') }} RSD</p>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-5">
                    <h4>Podaci za Dostavu</h4>
                    <form action="{{ route('korpa.poruci') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ulica" class="form-label">Ulica</label>
                            <input type="text" class="form-control @error('ulica') is-invalid @enderror" id="ulica" name="ulica" value="{{ old('ulica', Auth::user()->ulica ?? '') }}" required>
                            @error('ulica')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="broj" class="form-label">Broj</label>
                            <input type="text" class="form-control @error('broj') is-invalid @enderror" id="broj" name="broj" value="{{ old('broj', Auth::user()->broj ?? '') }}" required>
                            @error('broj')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="grad" class="form-label">Grad</label>
                            <input type="text" class="form-control @error('grad') is-invalid @enderror" id="grad" name="grad" value="{{ old('grad', Auth::user()->grad ?? '') }}" required>
                            @error('grad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="posta" class="form-label">Poštanski broj</label>
                            <input type="text" class="form-control @error('posta') is-invalid @enderror" id="posta" name="posta" value="{{ old('posta', Auth::user()->posta ?? '') }}" required>
                            @error('posta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Potvrdi Porudžbinu</button>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Vaša korpa je prazna ili je došlo do greške prilikom učitavanja stavki. Molimo vas <a href="{{ route('proizvodi') }}" class="alert-link">vratite se na proizvode</a> i pokušajte ponovo.
            </div>
        @endif
    </section>
@endsection

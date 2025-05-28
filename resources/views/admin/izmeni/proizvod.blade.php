@extends('admin.templates.main')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Izmeni Proizvod
                    </div>
                    <div class="card-body">
                        @if(isset($proizvod))
                            <form method="POST"
                                  action="{{ route('admin.izmeniAkcija', ['tip' => 'proizvod', 'id' => $proizvod->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="ime" class="form-label">Ime</label>
                                    <input type="text" class="form-control" id="ime" name="ime" value="{{ old('ime', $proizvod->ime) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="opis" class="form-label">Opis</label>
                                    <textarea class="form-control" id="opis" name="opis" rows="3">{{ old('opis', $proizvod->opis ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="cena" class="form-label">Cena</label>
                                    <input type="number" class="form-control" id="cena" name="cena" value="{{ old('cena', $proizvod->cena ?? '') }}" step="0.01" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stanje" class="form-label">Stanje (Količina)</label>
                                    <input type="number" class="form-control" id="stanje" name="stanje" value="{{ old('stanje', $proizvod->stanje ?? 0) }}" step="1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kategorija_id" class="form-label">Kategorija</label>
                                    <select class="form-select" id="kategorija_id" name="kategorija_id" required>
                                        <option value="">Izaberi kategoriju</option>
                                        @if(isset($kategorije))
                                            @foreach($kategorije as $kategorija_item)
                                                <option value="{{ $kategorija_item->id }}" {{ old('kategorija_id', $proizvod->kategorija_id ?? null) == $kategorija_item->id ? 'selected' : '' }}>
                                                    {{ $kategorija_item->ime }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="slika" class="form-label">Slika Proizvoda</label>
                                    <input type="file" class="form-control" id="slika" name="slika">
                                    @if($proizvod->slika)
                                        <div class="mt-2">
                                            <small>Trenutna slika:</small>
                                            <img src="{{ asset('storage/' . $proizvod->slika) }}" alt="{{ $proizvod->ime }}" style="max-height: 100px; display: block;">
                                        </div>
                                    @endif
                                    <input type="hidden" name="trenutna_slika" value="{{ $proizvod->slika ?? '' }}">
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="hidden" name="oznaceno" value="0">
                                    <input type="checkbox" class="form-check-input" id="oznaceno_checkbox" name="oznaceno" value="1" {{ old('oznaceno', $proizvod->oznaceno ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="oznaceno_checkbox">Označeno (npr. Istaknuto)</label>
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('admin.proizvodi') }}" class="btn btn-secondary">Nazad</a>
                                    <button type="submit" class="btn btn-primary">
                                        Sacuvaj izmene
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="text-danger">Proizvod nije pronađen.</p>
                            <div class="text-end">
                                <a href="{{ route('proizvodiAdmin') }}" class="btn btn-secondary">Nazad na listu proizvoda</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

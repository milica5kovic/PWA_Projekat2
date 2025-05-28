@php use App\Models\Kategorija; @endphp
@extends("admin.templates.main")
@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title h5 mb-0">Dodaj Novi Proizvod</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.dodaj', ["tip" => "proizvod"]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="naziv" class="form-label">Naziv Proizvoda</label>
                                <input type="text" class="form-control" id="ime" name="ime" required>
                            </div>

                            <div class="mb-3">
                                <label for="opis" class="form-label">Opis</label>
                                <textarea class="form-control tinymce" id="opis" name="opis" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="cena" class="form-label">Cena</label>
                                <input type="number" class="form-control" id="cena" name="cena" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="stanje" class="form-label">Stanje</label>
                                <input type="number" class="form-control" id="stanje" name="stanje" min="0" value="0">
                            </div>

                            <div class="mb-3">
                                <label for="slika" class="form-label">Slika Proizvoda</label>
                                <input type="file" class="form-control" id="slika" name="slika">
                            </div>

                            <div class="mb-3">
                                <label for="kategorija" class="form-label">Kategorija</label>
                                <select class="form-select" id="kategorija" name="kategorija_id" required>
                                    <option value="">Izaberite kategoriju</option>
                                    @foreach ($kategorije as $kategorija)
                                        <option value="{{ $kategorija->id }}">{{ $kategorija->ime }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Dodaj Proizvod</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <h2>Lista Proizvoda</h2>
                <hr>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" style="width: 100px;">Slika</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Stanje</th>
                        <th scope="col">Kategorija</th>
                        <th scope="col" style="width: 150px;">Akcije</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse ($proizvodi ?? [] as $proizvod)
                        <tr>
                            <th scope="row">{{ $proizvod->id }}</th>
                            <td>
                                @if($proizvod->slika)
                                    <img src="{{ asset('storage/' . $proizvod->slika) }}" alt="{{ $proizvod->naziv }}"
                                         class="img-fluid img-thumbnail"
                                         style="max-width: 80px; height: auto; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/80x80.png?text=Nema+Slike" alt="Nema slike"
                                         class="img-fluid img-thumbnail"
                                         style="max-width: 80px; height: auto; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $proizvod->naziv }}</td>
                            <td>{{ Str::limit($proizvod->opis, 50) }}</td>
                            <td>{{ number_format($proizvod->cena, 2, ',', '.') }} RSD</td>
                            <td>{{ $proizvod->stanje }} kom.</td>
                            <td>{{ Kategorija::find($proizvod->kategorija_id)->ime }}</td>
                            <td>
                                <a href="{{ route('admin.izmeni', ["tip" => "proizvod", "id" => $proizvod->id]) }}"
                                   class="btn btn-sm btn-warning mb-1 w-100">Izmeni</a>
                                <form action="{{ route('admin.brisi', ["tip" => "proizvod", "id" => $proizvod->id]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj proizvod?');"
                                      class="d-inline w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Brisi</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nema dostupnih proizvoda.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/pvtk21pe4n8sugkutyeid599lzctfcw1nyyn2pfu3izpo683/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection

@extends("admin.templates.main")

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Kreiraj Kategoriju</h2>
            <form method="POST" action="{{ route("admin.dodaj", ["tip" => "kategorija"]) }}" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="ime">Ime</label>
                    <input type="text" class="form-control" id="ime" name="ime" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Kreiraj</button>
            </form>
        </div>
        <h2>Kategorije</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Ime</th>
                <th>Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($kategorije as $kategorija)
                <tr>
                    <td>{{ $kategorija->id }}</td>
                    <td>{{ $kategorija->ime }}</td>
                    <td>
                        <a href="{{ route("admin.izmeni", ["tip" => "kategorija", "id" => $kategorija->id]) }}"
                           class="btn btn-primary btn-sm">Izmeni</a>
                        <form action="{{ route("admin.brisi", ["tip" => "kategorija", "id" => $kategorija->id]) }}" method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Da li ste sigurni?')">Obriši
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

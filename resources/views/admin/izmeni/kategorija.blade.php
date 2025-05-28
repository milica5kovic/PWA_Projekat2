@extends('admin.templates.main')
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('admin.izmeniAkcija', ['tip' => 'kategorija', 'id' => $kategorija->id]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="ime" class="form-label">Ime</label>
                                <input type="text" class="form-control" id="ime" name="ime" value="{{ $kategorija->ime }}" required>
                                @error('ime')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    Sacuvaj
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

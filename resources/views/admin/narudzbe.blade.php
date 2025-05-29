@extends('admin.templates.main')
@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Pregled porudzbina</h2>
    @if($porudzbine->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Korisnik</th>
                        <th scope="col">Datum Porudžbine</th>
                        <th scope="col">Adresa za dostavu</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($porudzbine as $porudzbina)
                        <tr>
                            <th scope="row">{{ $porudzbina->id }}</th>
                            <td>
                                @if($porudzbina->korpa && $porudzbina->korpa)
                                    {{ $porudzbina->korpa->korisnik->name }} ({{ $porudzbina->korpa->korisnik->email }})
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $porudzbina->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                {{ $porudzbina->ulica }} {{ $porudzbina->broj }}, <br>
                                {{ $porudzbina->posta }} {{ $porudzbina->grad }}
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">Obrada</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Trenutno nema narudžbi.
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endpush

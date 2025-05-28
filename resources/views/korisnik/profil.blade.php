@php use Illuminate\Contracts\Auth\MustVerifyEmail; @endphp
@extends('public.template.main')
@section('content')
    <style>
        footer {
            position: relative;
            top: 150px;
        }
    </style>

    <section class="container mt-5 mb-5 section">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Informacije o profilu su uspešno ažurirane.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Lozinka je uspešno ažurirana.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Informacije o profilu</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">Ažurirajte informacije o profilu i email adresu vašeg
                            naloga.</p>

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">Ime</label>
                                <input id="name" name="name" type="text"
                                       class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                       value="{{ old('name', auth()->user()->name) }}" required autofocus
                                       autocomplete="name">
                                @error('name', 'updateProfileInformation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email adresa</label>
                                <input id="email" name="email" type="email"
                                       class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                       value="{{ old('email', auth()->user()->email) }}" required
                                       autocomplete="username">
                                @error('email', 'updateProfileInformation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-sm text-warning">
                                            Vaša email adresa nije verifikovana.
                                            <button form="send-verification"
                                                    class="btn btn-link p-0 m-0 align-baseline text-decoration-none">
                                                Kliknite ovde da ponovo pošaljete email za verifikaciju.
                                            </button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 fw-medium text-sm text-success">
                                                Novi link za verifikaciju je poslat na vašu email adresu.
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Sačuvaj promene</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-none">
                        @csrf
                    </form>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Promena lozinke</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">Osigurajte da vaš nalog koristi dugu, nasumičnu lozinku da biste
                            ostali sigurni.</p>

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Trenutna lozinka</label>
                                <input id="current_password" name="current_password" type="password"
                                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                       autocomplete="current-password" required>
                                @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nova lozinka</label>
                                <input id="password" name="password" type="password"
                                       class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                       autocomplete="new-password" required>
                                @error('password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Potvrdite novu lozinku</label>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                       class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                       autocomplete="new-password" required>
                                @error('password_confirmation', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Sačuvaj lozinku</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

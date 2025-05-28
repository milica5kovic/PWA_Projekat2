@extends('public.template.main')
@section("content")
    <style>
        footer {
            position: relative;
            top: 150px;
        }

        .category-list-title {
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .category-list-item a {
            display: block;
            padding: 0.75rem 1.25rem;
            color: #495057;
            text-decoration: none;
        }

        .category-list-item a:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }
    </style>
    <section class="section container mt-4 mb-5">
        <h2 class="text-center category-list-title">Kategorije Proizvoda</h2>

        @if(isset($kategorije) && $kategorije->count() > 0)
            <div class="list-group shadow-sm">
                @foreach($kategorije as $kategorija)
                    <a href="{{ url('proizvodi/' . $kategorija->id) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center category-list-item">
                        {{ $kategorija->ime }}
                        <span
                            class="badge bg-primary rounded-pill">></span>
                    </a>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                Nema dostupnih kategorija.
            </div>
        @endif
    </section>
@endsection

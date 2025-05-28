@extends('public.template.main')

@section('title', 'Kontakt Lokacija - ' . config('app.name', 'Milica Petkovic'))

@section("content")
    <style>

        .contact-map iframe {
            border: 0;
            width: 100%;
            height: 450px;
        }
        .contact-info-section {
            padding-top: 60px;
            padding-bottom: 60px;
        }
        .contact-details .info-item {
            margin-bottom: 25px;
        }
        .contact-details .info-item i {
            font-size: 22px;
            color: #0d6efd;
            float: left;
            width: 48px;
            height: 48px;
            background: #eef7ff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            transition: all 0.3s ease-in-out;
            margin-right: 15px;
        }
        .contact-details .info-item h4 {
            padding: 0;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #37517e;
        }
        .contact-details .info-item p {
            padding: 0;
            margin-bottom: 0;
            font-size: 15px;
            color: #5a76a0;
        }
        .contact-details .info-item:hover i {
            background: #0d6efd;
            color: #fff;
        }
    </style>

    {{-- Main Contact Section --}}
    <section class="contact-info-section">
        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="contact-details p-4 p-md-5 shadow rounded bg-white h-100">
                        <div class="text-center mb-4">
                            <h3>Naša Lokacija i Kontakt</h3>
                            <p class="text-muted">Posetite nas ili nas kontaktirajte putem dostupnih kanala.</p>
                        </div>

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt-fill"></i> {{-- Bootstrap Icon example --}}
                            <div>
                                <h4>Adresa:</h4>
                                <p>Bulevar Kralja Aleksandra 123,<br>11000 Beograd, Srbija</p>
                            </div>
                        </div>

                        <hr class="my-3"> {{-- Separator --}}

                        <div class="info-item d-flex">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <h4>Telefon:</h4>
                                <p>+381 11 456 7890<br>+381 65 123 4567 (Mobilni)</p>
                            </div>
                        </div>

                        <hr class="my-3"> {{-- Separator --}}

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>info@smartwatch.rs<br>prodaja@smartwatch.rs</p>
                            </div>
                        </div>

                        <hr class="my-3"> {{-- Separator --}}

                        <div class="info-item d-flex">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <h4>Radno Vreme:</h4>
                                <p>Ponedeljak - Petak: 09:00 - 18:00<br>Subota: 10:00 - 15:00<br>Nedelja: Ne radimo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="contact-map shadow rounded overflow-hidden h-100">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.8193993901707!2d20.47386531545225!3d44.8024349790987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7a66dd5f1a01%3A0xdec56f8bda8e0786!2sBulevar%20kralja%20Aleksandra%2C%20Beograd!5e0!3m2!1sen!2srs!4v1678886500000!5m2!1sen!2srs" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

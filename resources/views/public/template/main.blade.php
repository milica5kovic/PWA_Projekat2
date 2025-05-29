<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset("img/fav.png") }}">
    <meta name="author" content="codepixer">
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'MPetkovic') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/linearicons.css") }}">
    <link rel="stylesheet" href="{{ asset("css/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("css/magnific-popup.css") }}">
    <link rel="stylesheet" href="{{ asset("css/nice-select.css") }}">
    <link rel="stylesheet" href="{{ asset("css/animate.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/owl.carousel.css") }}">
    <link rel="stylesheet" href="{{ asset("css/main.css") }}">
</head>
<body>
<header id="header" id="home">
    <div class="container">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="{{ route('pocetna') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo" title="Logo"/></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="{{ route("pocetna") }}">Pocetna</a></li>
                    <li><a href="{{ route("kategorije") }}">Kategorije</a></li>
                    <li><a href="{{ route("proizvodi") }}">Proizvodi</a></li>
                    <li><a href="{{ route("kontakt") }}">Kontakt</a></li>
                    @if(Auth::check())
                        <li class="menu-has-children"><a href="{{ route("dashboard") }}">{{ Auth::user()->name }}</a>
                            <ul>
                                <li><a href="{{ route("korpa") }}">Korpa</a></li>
                                <li><a href="{{ route("dashboard") }}">Profil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); this.closest('form').submit();">Odjavite
                                            se</a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route("login") }}">Prijava</a></li>
                        <li><a href="{{ route("register") }}">Registracija</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
@if(Route::currentRouteName() == 'proizvodi' || Route::currentRouteName() == "kategorije" || Route::currentRouteName() == "proizvod")
    @if(Auth::check())
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <div class="sticky-sidebar">
                        <div class="korpa-content bg-light">
                            <h3 class="mb-3">Moja korpa</h3>
                            <ol class="list-unstyled">
                                @foreach($korpa->predmetiKorpe as $item)
                                    <li class="mb-2">
                                        <p class="mb-0">
                                            {{ $item->proizvod->ime }} <br>
                                            <span class="text-primary">{{ $item->proizvod->cena }} rsd</span>
                                        </p>
                                    </li>
                                @endforeach
                            </ol>
                            <a href="{{route('korpa')}}" class="btn btn-primary mt-3">Pregledaj korpu</a>
                        </div>
                    </div>
                </div>
                <main class="col-md-9 col-lg-10">
                    @yield("content")
                </main>
            </div>
        </div>

        <style>
            .sticky-sidebar {
                position: relative;
                top: 120px;
                height: 100%;
            }

            .korpa-content {
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin: 15px;
                height: 100%;
            }

            .sticky-sidebar::-webkit-scrollbar {
                display: none;
            }

            .sticky-sidebar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            @media (max-width: 768px) {
                .sticky-sidebar {
                    position: fixed;
                    top: auto;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    height: auto;
                    max-height: 50vh;
                    z-index: 1000;
                    background: white;
                }

                .korpa-content {
                    margin: 0;
                    border-radius: 10px 10px 0 0;
                }
            }
        </style>
    @else
        @yield("content")
    @endif
@else
    @yield("content")
@endif
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <p class="footer-text">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | This template is made with <i class="fa fa-heart-o"
                                                                            aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-5  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                <div class="single-footer-widget">
                    <h6>Follow Us</h6>
                    <p>Let us be social</p>
                    <div class="footer-social d-flex align-items-center">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="{{ asset('js/easing.min.js') }}"></script>
<script src="{{ asset('js/hoverIntent.js') }}"></script>
<script src="{{ asset('js/superfish.min.js') }}"></script>
<script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/parallax.min.js') }}"></script>
<script src="{{ asset('js/mail-script.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>

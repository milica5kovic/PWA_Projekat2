@extends("public.template.main")
@section("content")
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content col-lg-10">
                    <h5 class="text-white text-uppercase">{{ $hero->opis }} moze biti tvoj sada!</h5>
                    <h1>
                        {{ $hero->ime }}
                    </h1>
                    <img src="storage/{{ $hero->slika }}"  class="img-fluid img-thumbnail" style="width: 300px; height: 300px"><br><br>
                    <a href="{{ route('proizvod', ["id" => $hero->id]) }}" class="primary-btn text-uppercase">Pogledaj</a>
                </div>
            </div>
        </div>
    </section>
    <section class="unique-feature-area section-gap" id="unique">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10 text-white">Izdvajamo</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($izdvajamo as $proizvod)
                <div class="col-lg-3 col-md-6">
                    <div class="single-unique-product">
                        <img class="img-fluid" src="/storage/{{ $proizvod->slika }}" alt="{{ $proizvod->ime }}">
                        <div class="desc">
                            <h4>
                                {{ $proizvod->ime }}
                            </h4>
                            <h6>{{ $proizvod->cena }}rsd</h6>
                            <a class="text-uppercase primary-btn" href="{{ route('proizvod', ["id" => $proizvod->id]) }}">Vidi jos</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-gap" id="cats" style="background-color: #f2f2f2f2">
        @foreach($proizvodi_kategorije as $kategorija => $proizvodi)
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10 text-black">{{ $kategorija }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($proizvodi as $proizvod)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-unique-product">
                            <img class="img-fluid" src="/storage/{{ $proizvod->slika }}" alt="{{ $proizvod->ime }}">
                            <div class="desc">
                                <h4>
                                    {{ $proizvod->ime }}
                                </h4>
                                <h6>{{ $proizvod->cena }}rsd</h6>
                                <a class="text-uppercase primary-btn" href="{{ route('proizvod', ["id" => $proizvod->id]) }}">Vidi jos</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </section>

    <section class="unique-feature-area section-gap" id="unique">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10 text-white">Najnovije</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($najnovije as $proizvod)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-unique-product">
                            <img class="img-fluid" src="/storage/{{ $proizvod->slika }}" alt="{{ $proizvod->ime }}">
                            <div class="desc">
                                <h4>
                                    {{ $proizvod->ime }}
                                </h4>
                                <h6>{{ $proizvod->cena }}rsd</h6>
                                <a class="text-uppercase primary-btn" href="{{ route('proizvod', ["id" => $proizvod->id]) }}">Vidi jos</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

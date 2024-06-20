@extends('layouts.app')

@section('content')

    <div class="container default_setup">
        <div class="row">

            <div class="col-12 mb-5 default_title">
                <h2>Kapcsolat</h2>
            </div>
        </div>
        <div class="row kapcsolat">
            <div class="col-6">
                <h6>PecAdmin Csapatának tartózkodási helye:</h6>
                <p>
                    Magyarország 2225 Üllő Tamási Áron 47.
                </p>

                <h6>PecAdmin Telefonszám:</h6>
                <p>
                    +36942080085
                </p>
                <h6>PecAdmin Email Címe:</h6>
                <p>
                    PecAdmin@gmail.com
                </p>
                <h6>PecAdmin Elérhetősége:</h6>
                <p>
                    0/24
                </p>
                @guest
                    @if (Route::has('login'))

                        <p>  Amennyiben versenyszervezésen töröd a fejedet akkor jó helyen jársz. A PecAdmin nagy társad lesz ebben. Ha még nincs fíokod és már felvetted velünk a kapcsolatot, akkor kattits <a href="{{route("register")}}">ide!</a></p>

                    @endif
                @else

                    <p>Köszönjük, hogy felkereste a PecAdmin weboldalát, várjuk észrevételeit és kérdéseit!</p>


                @endguest

            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <img src="images\allo_koi_sajat.jpg" alt="csoka" class="img-fluid default_kepsetup">
            </div>
        </div>

    </div>

@endsection

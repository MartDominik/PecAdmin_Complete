@extends('layouts.app')

@section('content')

    <div class="container default_setup">
        <div class="row">

            <div class="col-12 default_title">
                <h2>Szervezőinknek</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-6">

                <p>
                    A PecAdmin azért jött létre, hogy segítse horgásztárainkat a versenyekre való nevezésekre, illetve a szervező társaiknak a versenyeknek a gyors és egyszerű lezavarását ezzel is időt és energiát és fejfájást spórolva meg.
                </p>
                <p>
                    Ha versenyét szeretné a weboldalon hirdetni akkor a Verseny Hirdetése gombra kattintva létrehozhat egy hirdetést amire tudnak jelentkezni a versenyzők ön láthatja ezt a saját hirdetései menüpont alatt!
                </p>
                @guest
                    @if (Route::has('login'))

                        <p>
                            Rendelkezel már fiókkal? Kattits <a href="{{route("login")}}">ide.</a>
                        </p>


                        <p>
                            Amennyiben versenyszervezésen töröd a fejedet akkor jó helyen jársz. A PecAdmin nagy társad
                            lesz ebben. Ha még nincs fíokod akkor kattits <a
                                href="{{route("PecAdmin.kapcsolat")}}">ide</a>, hogy felvedd velünk a kapcsolatot és mi
                            jóváhagyjuk a jelentkezésedet.
                        </p>

                    @endif

                @else
                    <a class="btn btn-outline-dark form-control mb-4" href="{{route("Hirdetes.create")}}" role="button">Verseny
                        Hirdetése</a>
                    <br>
                    <a class="btn btn-outline-danger form-control mb-4" href="{{asset('app/PecAdmin.zip')}}" role="button" download="">Kliens Letöltése</a>
                @endguest

                <p>
                    Ha a hirdetés funkcióra nincsen szüksége akkor is használhatja az alkalmazást mivel külön funkció van a manuális versenykezelésre lehetőség!
                </p>

                <p>

                </p>

            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <img src="images/ponty.jpg" alt="csoka" class="img-fluid default_kepsetup">
            </div>
        </div>

    </div>

@endsection

    @extends('layouts.app')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/sajattas.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>PecAdmin mindenkinek a segítségére válik.</h5>
                <p>Mind Szervezőinknek és Sporttársainknak.</p>
                <p><a href="{{ route("PecAdmin.rolunk")}}">Kattints ide több infóért.</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/cseppalso2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Versenyeink</h5>
                <p>Versenyeinket profik szervezik nagy díjazásokkal.</p>
                <p><a href="{{ route("Hirdetes.index")}}">Kattints ide több infóért.</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/fohatter_sajat1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Szervezés</h5>
                <p>Ha a verseny szervezésén töröd a fejed akkor jó helyen jársz.</p>
                <p><a href="{{ route("PecAdmin.szervezoinknek")}}">Kattints ide több infóért.</a></p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

@endsection

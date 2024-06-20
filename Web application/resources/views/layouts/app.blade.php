<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PecAdmin</title>
    <link rel="icon" href="images/logo_semmim.png" type="icon">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

    <!-- stylesheet eleje-->
    <link rel="stylesheet" href="{{ URL::asset('css/ujstilus.css') }}">
    <!-- stylesheet vége -->

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" style=" transition: 500ms ease;" id="navbar">
    <div class="container">
        <a class="navbar-brand"  href="{{ url('/') }}"> <img src="{{ URL::asset('images/logo_semmim.png') }}" alt="" heigth="50" width="80">PecAdmin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>

                <script>
                    window.addEventListener("scroll", () =>{
                    if(window.scrollY > 25){
                    document.getElementById("navbar").classList.add("navbar_scrolled");
                    document.getElementById("navbar").classList.remove("navbar_not_scrolled");
                }
                    if(window.scrollY < 25){
                    document.getElementById("navbar").classList.add("navbar_not_scrolled");
                    document.getElementById("navbar").classList.remove("navbar_scrolled");

                }
                })
            </script>

        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route("Hirdetes.index")}}">Versenyeink</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("PecAdmin.szervezoinknek")}}">Szervezőinknek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("PecAdmin.rolunk")}}">Rólunk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("PecAdmin.kapcsolat")}}">Kapcsolat</a>
                </li>


                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn btn-success form-control nav-link header_gomb" href="{{ route('login') }}">Bejelentkezés</a>

                            </li>
                        @endif


                    @else
                        <li class="nav-item dropdown dropdown-menu-dark ">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark "
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route("indexPrivate")}}">
                                    Hirdetéseid
                                </a>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Kijelentkezés
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>
        </div>
    </div>

</nav>

<div >
    @yield('content')
</div>



</body>
</html>


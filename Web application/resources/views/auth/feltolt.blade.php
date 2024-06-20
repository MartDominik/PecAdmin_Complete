@extends('layouts.app')

@section('content')

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card kartya_stilus" style="border-radius: 1rem; ">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="images\allo_dobo_sajat1_vagott.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; " />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('') }}">
                                        @csrf

                                        <div class="d-grid gap-2  mb-4">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #E695D8;"></i>
                                            <span class="h1 fw-bold mb-0"> <img src="images/logo_semmim.png" alt="" height="80" width="120"> PecAdmin</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registráció</h5>

                                        <div class="" style="background-color: rgba(50,50,50,0.3); border-radius: 10px;">
                                            @if($errors->any())
                                                @foreach($errors->all() as $error)
                                                    <li class="text-danger">{{$error}}</li>
                                                @endforeach

                                            @endif
                                        </div>
                                        <br>

                                        <div class="form-outline mb-2">
                                            <input type="text" id="lastname" name="lastname" class="form-control form-control-lg adatok @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" required autocomplete="lastname" placeholder="Vezetéknév"/>
                                        </div>


                                        <div class="form-outline mb-2">
                                            <input type="text" id="firstname" name="firstname" class="form-control form-control-lg adatok @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" required autocomplete="firstname" placeholder="Keresztnév" />
                                        </div>


                                        <div class="form-outline mb-2">
                                            <input type="email" id="email" name="email" class="form-control form-control-lg adatok @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" placeholder="Email cím" />
                                        </div>


                                        <div class="form-outline mb-2">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg adatok @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Jelszó" />
                                        </div>



                                        <div class="form-outline mb-4">
                                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control form-control-lg adatok"  required autocomplete="new-password"placeholder="Jelszó megerősítése" />

                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-4">
                                            <input class="form-check-input me-2" type="checkbox" value="1" id="tos" name="tos" />
                                            <label class="form-check-label" for="tos">
                                                Egyetértek a feltételekkel <a href="#!">Terms of service</a>
                                            </label>
                                        </div>


                                        <div class="d-grid gap-2 ">
                                            <button type="submit" name="submit" id="submit" class="btn btn-dark btn-lg btn-block" >{{ __("Regisztráció")}}</button>
                                        </div>


                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

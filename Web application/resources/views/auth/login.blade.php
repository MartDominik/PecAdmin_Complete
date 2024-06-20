@extends('layouts.app')

@section('content')


        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-9 py-4">
                    <div class="card kartya_stilus" style="border-radius: 1rem; ">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="images/alloversenysajat.jpg" alt="login form" class="img-fluid"
                                     style="border-radius: 1rem 0 0 1rem; height: 100%;"/>
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">


                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="d-grid gap-2  mb-4">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #E695D8;"></i>
                                            <span class="h1 fw-bold mb-0"> <img src="images/logo_semmim.png" alt=""
                                                                                height="80" width="120"> PecAdmin</span>
                                        </div>
                                        <div class="" style="background-color: rgba(50,50,50,0.3); border-radius: 10px;">
                                            @if($errors->any())
                                                @foreach($errors->all() as $error)
                                                    <li class="text-danger">{{$error}}</li>
                                                @endforeach

                                            @endif
                                        </div>
                                        <br>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Lépj be a
                                            fiókodba</h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email"
                                                   class="form-control form-control-lg adatok @error('email') is-invalid @enderror "
                                                   value="{{ old('email') }}" placeholder="Email cím"/>



                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password"
                                                   class="form-control form-control-lg adatok @error('password') is-invalid @enderror"
                                                   required autocomplete="current-password" placeholder="Jelszó"/>

                                        </div>

                                        <div class="d-grid gap-2  mb-4 ">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit" name="submit"
                                                    id="submit">{{ __('Bejelentkezés') }}</button>
                                        </div>


                                        @if (Route::has('password.request'))
                                            <a class="small text-muted" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                        <p class="mb-8 pb-lg-2" style="color: #393f81;">Nincs még fiókod? <br> <a
                                                href="{{route("PecAdmin.kapcsolat")}}" style="color: #393f81;">Vedd fel
                                                velünk a
                                                kapcsolatot itt!</a></p>

                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

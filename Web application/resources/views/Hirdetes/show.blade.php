@extends('layouts.app')

@section('content')

    <div class="container  default_setup">
        @foreach($hirdet as $hird)
            <div class="container  default_jelentkezes">
            <div class="row">
                <div class="col-12 default_title">
                    <h2>{{$hird->versenynev}}</h2>

                </div>
            </div>
                <div class="row">
                    <div class="col-12 ">
                        <br>
                        <img src="/images/{{$hird->kep}}" class="reszletek_img">
                    </div>
                </div>

                <div class="row">
                <div class="col-12 ">
                    <p style="white-space: pre-line">{{$hird->rovidleiras}}</p>
                </div>
            </div>
                <div class="row">
                    <div class="col-12 ">
                        <h4>Helyszin:</h4>
                        <p>{{$hird->nev}}</p>
                        <p>({{$hird->helyszin}})</p>
                        <h4>Időpont:</h4>
                        <p>{{$hird->idopont}}</p>
                        <h4>Szervező:</h4>
                        <p>{{$hird->lastname}} {{$hird->firstname}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>Leírás:</h4>
                        <p class="leirasok">{{$hird->leiras}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ">
                        <h4>Szabályzat:</h4>
                        <p class="leirasok" >{{$hird->szabalyzat}}</p>
                    </div>
                </div>


            </div>
    </div>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-7">
                <div class="card kartya_stilus" style="border-radius: 1rem; border-color: #1a202c ">
                        <div class="col-md-6 col-lg-12 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form  action="{{route('jelentkezesStore', $hird->hirdetesId)}}" method="POST">
                                    @csrf

                                    <div class="d-grid gap-2  mb-4">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #E695D8;"></i>
                                        <span class="h1 fw-bold mb-0"> <img src="/images/logo_semmim.png" alt="" height="80" width="120"> PecAdmin</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Jelentkezés</h5>

                                    <div class="" style="background-color: rgba(50,50,50,0.3); border-radius: 10px;">
                                        @if($errors->any())
                                            @foreach($errors->all() as $error)
                                                <li class="text-danger">{{$error}}</li>
                                            @endforeach

                                        @endif
                                    </div>
                                    <br>

                                    <div class="form-outline mb-2">
                                        <input type="text" id="nev" name="nev" class="form-control form-control-lg adatok @error('nev') is-invalid @enderror" value="{{ old('nev') }}" required autocomplete="nev" placeholder="Név"/>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <input type="text" id="tel" name="telefonszam" class="form-control form-control-lg adatok @error('telefonszam') is-invalid @enderror" value="{{ old('telefonszam') }}" required autocomplete="telefonszam" placeholder="Telefonszám" />
                                    </div>



                                    <div class="form-outline mb-2">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg adatok @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" placeholder="Email cím" />
                                    </div>



                                    <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input me-2" type="checkbox" value="{{$hird->hirdetesId}}" id="hirdetId" name="hirdetId" />
                                        <label class="form-check-label" for="hirdetId">
                                            Egyetértek a <a href="#!">feltételekkel!</a>
                                        </label>
                                    </div>


                                    <div class="d-grid gap-2 ">
                                        <button type="submit" name="submit" id="submit" class="btn btn-dark btn-lg btn-block" >{{ __("Jelentkezés")}}</button>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endforeach




@endsection

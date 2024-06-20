@extends('layouts.app')

@section('content')

        <div class="container h-100" style="padding-top: 100px;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-7 py-4" >
                    <div class="card kartya_stilus" style="border-radius: 1rem; ">
                        <div class="row g-0">

                            <div class="col-md-6 col-lg-12 d-flex align-items-center" style="margin-left: auto; margin-right: auto">
                                <div class="card-body p-4 p-lg-5 text-black">


    @foreach($hirdet as $hird)
                                        <form method="POST" action="{{route('update', $hird->hirdetesId)}}">
                                            @csrf
                                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">{{$hird->versenynev}} Szerkesztése</h5>
                                            <div class="" style="background-color: rgba(50,50,50,0.3); border-radius: 10px;">
                                                @if($errors->any())
                                                    @foreach($errors->all() as $error)
                                                        <li class="text-danger">{{$error}}</li>
                                                    @endforeach

                                                @endif
                                            </div>
                                            <br>


                                        <div class="form-outline mb-2">
                                            <input type="text" id="versenynev" name="versenynev" class="form-control form-control-lg adatok @error('versenynev') is-invalid @enderror" value="{{$hird->versenynev}}" required autocomplete="cím">
                                        </div>
                                        @error('versenynev')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="form-outline  mb-2">

                                            <select class="form-select form-control form-control-lg adatok " aria-label="Default select example" name="helyszinid">
                                                <option selected disabled>Válassz Helyszínt</option>
                                                @foreach($helyszinek as $helyszin)
                                                    <option value="{{$helyszin->id}}">{{$helyszin->nev}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-outline  mb-2">

                                            <select class="form-select form-control form-control-lg adatok " aria-label="Default select example" name="tipus">
                                                <option selected disabled>Válassz Típust</option>
                                                <option value="Feeder">Feeder</option>
                                                <option value="úszós">Úszós</option>
                                                <option value="Freestyle">Freestyle</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-2">
                                            <input type="date" id="idopont" name="idopont" class="form-control form-control-lg adatok @error('idopont') is-invalid @enderror" value="{{$hird->idopont}}" required autocomplete="idopont" placeholder="Időpont" />
                                        </div>

                                        <div class="form-outline mb-2">
                                            <textarea  id="rovidleiras" name="rovidleiras" style="white-space: pre-line" class="form-control form-control-lg  @error('rovidleiras') is-invalid @enderror" value="{{ old('rovidleiras') }}" required autocomplete="rovidleiras"   cols="20" rows="6">{{$hird->rovidleiras}}</textarea>

                                        </div>
                                        @error('rovidleiras')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                        <div class="form-outline mb-2">
                                            <textarea type="text" id="leiras" name="leiras" style="white-space: pre-line" class="form-control form-control-lg  @error('leiras') is-invalid @enderror" value="{{ old('leiras') }}" required autocomplete="leiras"  cols="20" rows="6" >{{$hird->leiras}}</textarea>

                                        </div>
                                        @error('leiras')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="form-outline mb-2">
                                            <textarea type="text" id="szabalyzat" name="szabalyzat" style="white-space: pre-line" class="form-control form-control-lg  @error('szabalyzat') is-invalid @enderror" value="{{ old('szabalyzat') }}" required autocomplete="szabalyzat" cols="50" rows="6">{{$hird->szabalyzat}}</textarea>
                                        </div>
                                        @error('szabalyzat')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                        <div class="d-grid gap-2 ">
                                            <button type="submit" name="submit" id="submit" class="btn btn-secondary btn-outline-dark btn-lg btn-block" >{{ __("Verseny Szerkesztése")}}</button>
                                        </div>


                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>


    </script>


@endsection

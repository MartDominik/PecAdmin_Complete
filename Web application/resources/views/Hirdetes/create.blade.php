@extends('layouts.app')

@section('content')


        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-7 py-4" >
                    <div class="card kartya_stilus" style="border-radius: 1rem; ">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-12 d-flex align-items-center" style="margin-left: auto; margin-right: auto">
                                <div class="card-body p-4 p-lg-5 text-black">


                                    <form method="POST" action="{{ route('Hirdetes.store') }}">
                                        @csrf

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Verseny Hirdetése</h5>

                                        <div class="" style="background-color: rgba(50,50,50,0.3); border-radius: 10px;">
                                            @if($errors->any())
                                                @foreach($errors->all() as $error)
                                                    <li class="text-danger">{{$error}}</li>
                                                @endforeach

                                            @endif
                                        </div>
                                        <br>

                                        <div class="form-outline mb-2">
                                            <input type="text" id="versenynev" name="versenynev" class="form-control form-control-lg adatok @error('versenynev') is-invalid @enderror" value="{{ old('versenynev') }}" required autocomplete="cím" placeholder="Verseny Megnevezése"/>
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
                                            <input type="date" id="idopont" name="idopont" class="form-control form-control-lg adatok @error('idopont') is-invalid @enderror" value="{{ old('idopont') }}" required autocomplete="idopont" placeholder="Időpont" />
                                        </div>

                                        <div class="form-outline mb-2">
                                            <textarea  id="rovidleiras" name="rovidleiras" maxlength="200"  id="text"   class="form-control form-control-lg  @error('rovidleiras') is-invalid @enderror" value="{{ old('rovidleiras') }}" required autocomplete="rovidleiras" placeholder="Rövid Leírás"  cols="20" rows="6"></textarea>
                                            <span class="pull-rigth label label-default" id="szamol" ></span>
                                        </div>
                                        @error('rovidleiras')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                        <div class="form-outline mb-2">
                                            <textarea type="text" id="leiras" name="leiras" maxlength="4000"  id="szamol" onkeyup="validalj()"   class="form-control form-control-lg  @error('leiras') is-invalid @enderror" value="{{ old('leiras') }}" required autocomplete="leiras" placeholder="Leírás/Fizetés/Verseny menete/Díjazás" cols="20" rows="6" ></textarea>
                                            <span id="szo_szam" class="d-none"><span id="szovszam"></span> / 4000</span>
                                        </div>
                                        @error('leiras')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="form-outline mb-2">
                                            <textarea type="text" name="szabalyzat" maxlength="4500" id="summary" onkeyup="validate()" class="form-control form-control-lg  @error('szabalyzat') is-invalid @enderror" value="{{ old('szabalyzat') }}" required autocomplete="szabalyzat" placeholder="Szabályzat" cols="50" rows="6"></textarea>
                                            <span id="words_count" class="d-none"><span id="textcount"></span> / 4500</span>
                                        </div>
                                        @error('szabalyzat')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                        <div class="d-grid gap-2 ">
                                            <button type="submit" name="submit" id="submit" class="btn btn-secondary btn-outline-dark btn-lg btn-block" >{{ __("Verseny Hirdetése")}}</button>
                                        </div>


                                    </form>

                                    <script>
                                        function validalj(){
                                            let areatex = document.querySelector("#szamol").value.length;
                                            let textcoun = document.querySelector("#szovszam");
                                            let wordcoun = document.querySelector("#szo_szam");
                                            textcoun.innerHTML = areatex;

                                            if(areatex < 1){
                                                wordcoun.classList.add("d-none");
                                            }else{
                                                wordcoun.classList.remove("d-none");
                                            }
                                        }
                                    </script>
                                    <script>


                                        function validate(){
                                            const areatext = document.querySelector("#summary").value.length;
                                            const textcount = document.querySelector("#textcount");
                                            const wordcount = document.querySelector("#words_count");
                                            textcount.innerHTML = areatext;

                                            if(areatext < 1){
                                                wordcount.classList.add("d-none");
                                            }else{
                                                wordcount.classList.remove("d-none");
                                            }
                                        }


                                    </script>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





@endsection

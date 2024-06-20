@extends('layouts.app')

@section('content')
    @if(session()->has('success'))
        <h1>{{session('success')}}</h1>
    @endif

    <div class="container default_setup">
            <div class="row">
                <div class="col-12 mb-5 default_title">
                    <h2>Versenyeink</h2>
                </div>
            </div>
        <div class="row">
            @foreach($hirdetes as  $hirdete)
                <div class="col-4 pt-5 mt-5">
                    <div class="card bg-secondary" style="width: 18rem;">
                        <img class="card-img-top" src="images/{{$hirdete->kep}}" alt="borito">
                        <div class="card-body bg-secondary">
                            <h5 class="card-title">{{ $hirdete->versenynev}}</h5>
                            <p>{{ $hirdete->tipus}} </p>
                            <p>{{ $hirdete->nev}} </p>
                            <p>{{ $hirdete->rovidleiras}} </p>





                                @if($hirdete->userid == Auth::id())
                                <div class="col-12">
                                    <form action="{{ route('edit', $hirdete->hirdetesId)}}" method="P">
                                        <div class="d-grid gap-2 mb-1">
                                        <button type="submit" name="submit" id="submit" class="btn btn-outline-dark btn-warning ">Szerkesztés</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12">
                                    <form action="{{ route('destroy', $hirdete->hirdetesId)}}" method="P">
                                        <div class="d-grid gap-2 mb-1">
                                        <button type="submit" name="submit" id="submit" class="btn btn-outline-dark btn-danger ">Törlés</button>
                                        </div>
                                    </form>
                                </div>

                                @else

                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ route('reszletek', $hirdete->hirdetesId)}}" method="P">
                                            <div class="d-grid gap-2 mb-1">
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-dark btn-info ">Részletek</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @endif



                        </div>
                    </div>

                </div>


            @endforeach


        </div>
    </div>

@endsection

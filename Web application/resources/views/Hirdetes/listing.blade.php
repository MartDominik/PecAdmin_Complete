@extends('layouts.app')

@section('content')

    <div class="container default_setup">
        <div class="row">

            <div class="col-12 default_title text-center ">
                @foreach($adatok as $adat)
                    <h2>{{$adat->versenynev}}</h2>
                    <h5>({{$adat->datum}})</h5>
                    <h5>({{$adat->lokacio}})</h5>
                    <h5>({{$adat->tipus}})</h5>

                    @break($adat)
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col-12 pt-5">
                <table class="table table-success table-striped align-middle">

                        <thead>
                        <tr>

                            <th>Név</th>
                            <th>Email</th>
                            <th>Telefonszám</th>
                            <th>Törlés</th>
                        </tr>

                        </thead>
                        <tbody>

                    @foreach($adatok as $adat)
                        <tr>

                            <td>{{$adat->jelentkezoneve}}</td>
                            <td>{{$adat->email}}</td>
                            <td>{{$adat->telefonszam}}</td>
                            <td>
                                <form action="{{ route('destroylist', $adat->id)}}" method="P">
                                    <button type="submit" name="submit" id="submit" class="btn btn-outline-dark btn-danger ">Törlés</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                        </tbody>

                </table>

            </div>
        </div>

    </div>

@endsection

@extends('layouts/base')


@section('content')
    <input type="hidden" id="calculateRoute" value="{{ route('calculator.calculate') }}">



    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="header-text card-header">
                        <div class="text-center fs-4">
                            Fertige Aufträge
                        </div>
                    </div>
                    <div class="card-body completedTaskList">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col fs-5 d-flex justify-content-evenly">
                                        <div class="text-white-50">Station:</div>
                                        <div class="ms-3 text-info w-50 text-center">ARC-L2</div>
                                    </div>
                                    <div class="col fs-5 d-flex justify-content-evenly">
                                        <div class="text-white-50">Spieleranzahl:</div>
                                        <div class="ms-3 text-info">4</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col fs-5 d-flex justify-content-evenly">
                                        <div class="text-white-50">Erze:</div>
                                        <div class="ms-3 text-info w-50">
                                            <select class="form-select text-center form-select-sm"
                                                name="ores">
                                                <option value="" class="" hidden="" selected=""
                                                    disabled="">
                                                    Bitte wählen</option>
                                                <option value="1">
                                                    ARC-L1
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col fs-5 d-flex justify-content-evenly">
                                        <div class="text-white-50">Units:</div>
                                        <div  class="ms-3 text-success">4</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="fs-5 d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-outline-warning"
                                        >Kombinieren</button>
                                    <button type="button" class="btn btn-outline-success">Verkaufen</button>
                                    <button type="button" class="btn btn-outline-danger">Löschen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="header-text card-header text-center fs-4">
                        Zu bezahlende Spieler
                    </div>
                    <div class="card-body payablePlayerList" >
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col fs-5 d-flex justify-content-evenly">
                                        <div class="text-white-50">Spielername:</div>
                                        <div  class="ms-3 text-info w-50 text-center">DochSergeantTV</div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col fs-5 d-flex justify-content-evenly">
                                        <div class="text-white-50">Betrag:</div>
                                        <div class="ms-3 w-50 text-center"><span
                                                class="text-success fs-5">234234</span><span> aUEC</span></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="fs-5 d-flex justify-content-evenly">
                                    <button type="button" class="btn btn-outline-success">Bezahlen</button>
                                    <button type="button" class="btn btn-outline-danger">Löschen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="header-text card-header">
                <div class="row">
                    <div class="col text-center fs-4">
                        Laufende Aufträge
                    </div>

                </div>
            </div>

            <div class="card-body">

            </div>
        </div>
    </div>
    </div>
    @vite('resources/js/dashboard.js')
@endsection

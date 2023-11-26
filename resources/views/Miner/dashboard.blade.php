@extends('layouts/base')


@section('content')
    <input type="hidden" id="calculateRoute" value="{{ route('calculator.calculate') }}">



    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    @livewire('dashboard-finished-tasks')
                </div>
            </div>

            <div class="col ">
                <div class="card">
                    <div>
                        <div class="header-text card-header text-center fs-4">
                            Zu bezahlende Spieler
                        </div>
                        <div class="card-body payablePlayerList">

                            <div class="row listItems align-items-center ms-2 me-2">
                                <div class="col fs-5 d-flex justify-content-evenly">
                                    <div class="text-white-50">Spielername:</div>
                                    <div class="ms-2 text-info text-center">DochSergeantTV</div>
                                </div>
                                <div class="col fs-5 d-flex justify-content-evenly">
                                    <div class="text-white-50">Betrag:</div>
                                    <div><span class="text-danger">234</span><span> aUEC</span></div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>


                    {{-- <div>
                        <div class="header-text card-header text-center fs-4">
                            <div class="row">
                                <div class="col-9 text-center fs-4 my-auto">
                                    Verkaufen
                                </div>
                                <div class="col-3 d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-warning">Kombinieren</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row align-items-center ms-2 me-2 mt-2">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4 col-6 fs-4">
                                    <div class="text-white-50">Erzmetall:</div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="ms-2">
                                        <select class="form-select text-center">
                                            <option value="1">
                                                Quantianium
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center ms-2 me-2 mt-2">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4 col-6 fs-4">
                                    <div class="text-white-50">Einheiten:</div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="ms-2 fs-4 text-center">
                                        <span>2342</span> <span class="text-white-50">units</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row align-items-center ms-2 me-2 mt-2">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4 col-6 fs-4">
                                    <div class="text-white-50">Verkaufsstation:</div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="ms-2">
                                        <select class="form-select text-center">
                                            <option value="1">
                                                Area18
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center ms-2 me-2 mt-2">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4 col-6 fs-4">
                                    <div class="text-white-50">Verkaufspreis:</div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="ms-2 fs-4">
                                        <input id="massStone" type="text" class="form-control text-center"
                                            placeholder="69420 aUEC" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-evenly mt-3">
                                <button type="button" class="btn btn-outline-success btn-lg">Speichern</button>
                                <button type="button" class="btn btn-outline-danger btn-lg">Abbrechen</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="header-text card-header">
                <div class="text-center fs-4">
                    Laufende Aufträge
                </div>
            </div>
            <div class="card-body">
                <div class="listItems">
                    <div class="row align-items-center ms-2 me-2">
                        <div class="col fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">Station:</div>
                            <div class="ms-2 text-center">ARC-L2</div>
                        </div>
                        <div class="col fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">Erze:</div>
                            <div class="ms-2 ">
                                <select class="form-select text-center form-select-sm">
                                    <option value="1">
                                        Quantianium: 2022
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">Spieleranzahl:</div>
                            <div class="ms-2 ">4</div>
                        </div>
                        <div class="col fs-5 d-flex justify-content-evenly">
                            <div class="text-white-50">Fertig am:</div>
                            <div class="ms-2 ">10.10.2023 22:20</div>
                        </div>
                    </div>
                    <div class="mt-3 ms-5 me-4">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <hr>

            </div>
        </div>
    </div>

    @vite('resources/js/dashboard.js')
@endsection

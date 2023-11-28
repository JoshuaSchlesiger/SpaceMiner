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
                    @livewire('dashboard-payable-player')
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

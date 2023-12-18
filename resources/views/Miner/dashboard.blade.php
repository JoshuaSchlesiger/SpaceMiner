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
                @livewire('dashboard-running-tasks')
            </div>
        </div>
    </div>

    @livewire('dashboard-modal')

    @vite('resources/js/dashboard.js')
@endsection

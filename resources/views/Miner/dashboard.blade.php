@extends('layouts/base')


@section('content')
    <input type="hidden" id="calculateRoute" value="{{ route('calculator.calculate') }}">

    <div class="container mt-5">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    @livewire('dashboard-finished-tasks')
                </div>
            </div>

            <div class="col-xl mt-xl-0 mt-5">
                <div class="card">
                    @livewire('dashboard-payable-player')
                </div>
            </div>
        </div>

        <div class="card mt-4">
            @livewire('dashboard-running-tasks')
        </div>
    </div>

    @livewire('dashboard-modal')

    @vite('resources/js/dashboard.js')
@endsection

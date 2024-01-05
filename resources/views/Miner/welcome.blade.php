@extends('layouts/base')


@section('content')
    <header>
        <div class="index-bg">
            <div class="index-bg-text">
                <h1>@lang('welcome.view.header')</h1>
                <p>@lang('welcome.view.subHeader')</p>
            </div>

            <img class="index-bg-image" src="{{ url('/images/u-mining.png') }}" alt="Miningbild" title="Miningbild" />
        </div>

    </header>

    <div class="row">
        <div class="col mt-5 ms-5 me-5">
            <div class="index-vertical-center card">
                <h5 class="card-header">@lang('welcome.view.cardTitle')</h5>
                <div class="card-body">
                    <h5 class="card-title">@lang('welcome.view.cardTextTitle')</h5>
                    <p class="card-text">
                        @lang('welcome.view.cardText')
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class=" d-flex justify-content-center ">
                <img src="{{ url('/images/t-stone.png') }}" class="index-ustone" alt="Geiler Quantaniumstein ^^"
                    title="Quantaniumstein">
            </div>
        </div>
    </div>
@endsection

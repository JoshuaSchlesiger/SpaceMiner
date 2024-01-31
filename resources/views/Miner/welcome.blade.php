@extends('layouts/base')


@section('content')
    <section>
        <div class="index-bg">
            <div class="index-bg-text">
                <h1>@lang('welcome.view.header')</h1>
                <p>@lang('welcome.view.subHeader')</p>
            </div>

            <img class="index-bg-image" src="{{ url('/images/u-mining.png') }}" alt="Miningimage" title="Miningimage" />
        </div>
    </section>
    <article>
        <div class="row">
            <div class="col mt-5 ms-5 me-5">
                <div class="index-vertical-center card">
                    <p class="card-header fs-4">@lang('welcome.view.cardTitle')</p>
                    <div class="card-body">
                        <p class="card-title fs-5">@lang('welcome.view.cardTextTitle')</p>
                        <p class="card-text">
                            @lang('welcome.view.cardText')
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="d-flex justify-content-center ">
                    <img src="{{ url('/images/t-stone.png') }}" class="index-ustone" alt="Quantanium ^^"
                        title="Quantanium">
                </div>
            </div>
        </div>
    </article>
@endsection

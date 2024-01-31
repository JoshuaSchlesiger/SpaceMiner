@extends('layouts/base')


@section('content')
    <article>
        <div class="row">
            <div class="col-xxl-7 col-xl-5 col-sm-10 mt-5 ms-5">
                <div class="vertical-center card">
                    <h5 class="card-header">@lang('aboutMe.view.cardTitle')</h5>
                    <div class="card-body">
                        <h5 class="card-title">@lang('aboutMe.view.cardTextTitle')</h5>
                        <p class="card-text">
                            @lang('aboutMe.view.cardText')
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-5 col-xxl-4 col-xl-5 col-sm-10">
                <div class="d-flex justify-content-center skin">
                    <img src="{{ url('/images/skin.png') }}" class="" alt="me ^^" title="Katzenich">
                </div>
            </div>
        </div>
    </article>
@endsection

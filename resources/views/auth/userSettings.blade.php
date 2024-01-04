@extends('layouts/base')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fs-3 text-center">@lang('userSettings.view.header')</div>
                <div class="card-body">

                    @livewire('user-settings')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts/base')


@section('content')
@vite(["resources/css/calculator.css"])
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="header-text card-header">
                            <div class="row">
                                <div class="col-8 text-center fs-4">
                                    @lang('calculator.view.input.header')
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <div class="form-check form-switch d-flex">
                                        <div class="moveIcon"><label for="inputSwitch" class="switchGem" data-tippy-content="{{ __('calculator.view.hint.stone') }}"><i class="bi bi-gem" alt="rock"></i></label></div>
                                        <div><input class="form-check-input switch" type="checkbox" role="switch" id="inputSwitch"></div>
                                        <div class=""><label for="inputSwitch" class="switchRocket" data-tippy-content="{{ __('calculator.view.hint.ship') }}"><i class="bi bi-rocket" alt="ship"></i></label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="inputsRock">
                                <div class="row">
                                    <div class="col-6 text-center fs-5 mt-1">
                                        <label for="massStone" class="text-white-50">@lang('calculator.view.input.mass')</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-outline">
                                            <input id="massStone" type="number" class="form-control" placeholder="69 SCU"
                                                max="99999" min="0" />
                                        </div>
                                        <div class="form-text">
                                            @lang('calculator.view.input.mass.hint')
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-dark table-striped text-center">
                                    <thead>
                                        <tr class="fs-5">
                                            <th scope="col" class="text-white-50">@lang('calculator.view.input.oreType')</th>
                                            <th scope="col" class="text-white-50">@lang('calculator.view.input.shares')</th>
                                            <th scope="col" class="text-white-50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="inputTableBodyRock">
                                        <tr id="oreTableEntry">
                                            <th scope="row" class="w-50">
                                                <div class="d-flex justify-content-center">
                                                    <select class="form-select text-center w-75 fs-5 oreTypeRock">
                                                        <option value="" class="" hidden selected disabled>
                                                            @lang('calculator.view.input.pleaseSelect')</option>
                                                        @foreach ($ores as $ore)
                                                            @if ($loop->index < 1)
                                                                <option value={{ $ore->id }} class="text-success">
                                                                    {{ $ore->name }}</option>
                                                            @elseif ($loop->index < 4)
                                                                <option value={{ $ore->id }} class="text-primary">
                                                                    {{ $ore->name }}</option>
                                                            @elseif ($loop->index < 10)
                                                                <option value={{ $ore->id }} class="text-warning">
                                                                    {{ $ore->name }}</option>
                                                            @elseif($loop->index < 17)
                                                                <option value={{ $ore->id }} class="text-danger">
                                                                    {{ $ore->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="w-75">
                                                        <input type="number" class="form-control fs-5 inputMass"
                                                            placeholder="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-outline-danger deletePart">X</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="d-flex flex-row-reverse me-2 mt-4 mb-1">
                                    <button type="button" class="btn btn-outline-success"
                                        id="btnAddPartRock">@lang('calculator.view.input.additionalShare')</button>
                                </div>
                            </div>
                            <div id="inputsShip" hidden>
                                <table class="table table-dark table-striped text-center">
                                    <thead>
                                        <tr class="fs-5">
                                            <th scope="col" class="text-white-50">@lang('calculator.view.input.oreType')</th>
                                            <th scope="col" class="text-white-50">@lang('calculator.view.input.mass')</th>
                                            <th scope="col" class="text-white-50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="inputTableBodyShip">
                                        <tr>
                                            <th scope="row" class="w-50">
                                                <div class="d-flex justify-content-center">
                                                    <select class="form-select text-center w-75 fs-5 oreTypeRock">
                                                        <option value="" class="" hidden selected disabled>
                                                            @lang('calculator.view.input.pleaseSelect')</option>
                                                        @foreach ($ores as $ore)
                                                            @if ($loop->index < 1)
                                                                <option value={{ $ore->id }} class="text-success">
                                                                    {{ $ore->name }}</option>
                                                            @elseif ($loop->index < 4)
                                                                <option value={{ $ore->id }} class="text-primary">
                                                                    {{ $ore->name }}</option>
                                                            @elseif ($loop->index < 10)
                                                                <option value={{ $ore->id }} class="text-warning">
                                                                    {{ $ore->name }}</option>
                                                            @else
                                                                <option value={{ $ore->id }} class="text-danger">
                                                                    {{ $ore->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="w-75">
                                                        <input type="number" class="form-control fs-5 inputMass"
                                                            placeholder="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-outline-danger deletePart">X</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="d-flex flex-row-reverse me-2 mt-4 mb-1">
                                    <button type="button" class="btn btn-outline-success"
                                        id="btnAddPartShip">@lang('calculator.view.input.additionalShare')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="header-text card-header text-center fs-4">
                            @lang('calculator.view.result.header')
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center text-center">
                                <div class="col-5"><span class="fs-5 text-white-50">@lang('calculator.view.result.valuableRock')</span> <span
                                        class="text-info fs-5" id="valuableMass">0</span> <span class="">SCU</span>
                                </div>
                                <div class="col-5"><span class="fs-5 text-white-50">@lang('calculator.view.result.proceeds') </span><span
                                        class="text-info fs-5" id="rawProfit">0</span> <span class="-">aUEC</span>
                                </div>
                            </div>
                        </div>
                        <div class="header-text card-header text-center fs-4 border-top ">
                            @lang('calculator.view.result.refinery')
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center text-center">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="refineryMethod" class="text-white-50">@lang('calculator.view.result.method')</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <select class="form-select text-center w-75" id="refineryMethod">
                                            @foreach ($methods as $method)
                                                @if ($loop->index < 1)
                                                    <option value={{ $method->id }} class="text-success">
                                                        {{ $method->name }}</option>
                                                @elseif ($loop->index < 4)
                                                    <option value={{ $method->id }} class="text-warning">
                                                        {{ $method->name }}</option>
                                                @else
                                                    <option value={{ $method->id }} class="text-danger">
                                                        {{ $method->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="station" class="text-white-50">@lang('calculator.view.result.station')</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <select class="form-select text-center w-75" id="station">
                                            @foreach ($stations as $station)
                                                <option value={{ $station->id }}>{{ $station->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center text-center">
                                <div class="col-5"><span class="fs-5 text-white-50">@lang('calculator.view.result.costs') </span> <span
                                        class="text-danger fs-5" id="costs">0</span> <span class="">aUEC</span>
                                </div>
                                <div class="col-5"><span class="fs-5 text-white-50">@lang('calculator.view.result.profit') </span><span
                                        class="text-success fs-5" id="refinedProfit">0</span> <span
                                        class="-">aUEC</span>
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-2">
                                <div class="col-5"><span class="fs-5 text-white-50">@lang('calculator.view.result.duration') </span> <span
                                        class="text-danger fs-5" id="duration">00:00</span> <span
                                        class="">HH:MM</span>
                                </div>
                                <div class="col-5"><span class="fs-5 text-white-50">@lang('calculator.view.result.units') </span><span
                                        class="text-success fs-5" id="unitCount">0</span> <span
                                        class="-">units</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @vite('resources/js/calculator.js')
@endsection

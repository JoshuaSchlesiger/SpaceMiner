@extends('layouts/base')


@section('content')
@vite(["resources/css/task.css"])
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success text-center" id="successMessage">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center" id="successMessage">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('task') }}" id="form">
            @csrf
            <div class="row">
                <div class="col-md-10 col-lg-4">
                    <div class="card">
                        <div class="header-text card-header">
                            <div class="text-center fs-4">
                                @lang('task.view.refinery')
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center text-center">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="refineryStaion" class="text-white-50">@lang('task.view.refineryStation'):</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <select
                                            class="form-select text-center w-100 @error('refineryStation') is-invalid @enderror"
                                            id="refineryStaion" name="refineryStation">
                                            <option value="" class="" hidden selected disabled>
                                                @lang('task.view.pleaseSelect')</option>
                                            @foreach ($stations as $station)
                                                <option value={{ $station->id }}
                                                    {{ old('refineryStation') == $station->id ? 'selected' : '' }}>
                                                    {{ $station->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('refineryStation')
                                        @if ($message !== 'null')
                                            <span class="fst-italic text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="method" class="text-white-50">@lang('task.view.method'):</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <select class="form-select text-center w-100 @error('method') is-invalid @enderror"
                                            id="method" name="method">
                                            <option value="" class="" hidden selected disabled>
                                                @lang('task.view.pleaseSelect'):</option>
                                            @foreach ($methods as $method)
                                                <option value="{{ $method->id }}"
                                                    {{ old('method') == $method->id ? 'selected' : '' }}
                                                    class="{{ $loop->index < 1 ? 'text-success' : ($loop->index < 4 ? 'text-warning' : 'text-danger') }}">
                                                    {{ $method->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('method')
                                        @if ($message !== 'null')
                                            <span class="fst-italic text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="costs" class="text-white-50">@lang('task.view.costs'):</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <input type="number" class="form-control @error('method') is-invalid @enderror"
                                            placeholder="aUEC" id="costs" value="{{ old('costs') }}" name="costs">
                                    </div>
                                    @error('costs')
                                        @if ($message !== 'null')
                                            <span class="fst-italic text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="duration" class="text-white-50">@lang('task.view.duration'):</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                            placeholder="HH:MM" id="duration" value="{{ old('duration') }}"
                                            name="duration">
                                    </div>
                                    @error('duration')
                                        @if ($message !== 'null')
                                            <span class="fst-italic text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-lg-4 mt-5 mt-lg-0">
                    <div class="card">
                        <div class="header-text card-header">
                            <div class="row">
                                <div class="col-2 text-start" @popper({{ __('task.view.hint') }})>
                                    <i class="bi bi-info-circle"></i>
                                </div>
                                <div class="col-5 text-center fs-4">
                                    @lang('task.view.player')
                                </div>
                                <div class="col-5 text-end">
                                    <button type="button" class="btn btn-outline-secondary w-100" id="btnOnldGroup"
                                        data-ajax-url="{{ route('ajax.task') }}"> @lang('task.view.oldGroup')</button>
                                </div>
                                <div class="text-end">
                                    <span class="fst-italic text-danger" id="messageOldGroup" role="alert"><span>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="alert-container text-center"></div>
                            <div class="row justify-content-center text-center">
                                <div class="col-3 fs-5 mt-1">
                                    <label for="miner" class="text-white-50">Miner:</label>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <input type="text" class="form-control" placeholder="" id="miner">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <select class="form-select text-center text-white-50 multiple"
                                            id="selectMinerHidden" name="selectMiner[]" multiple hidden>
                                            @if (null !== old('selectMiner'))
                                                @foreach (old('selectMiner') as $miner)
                                                    <option value="{{ $miner }}">
                                                        {{ $miner }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="{{ Auth::user()->name }}">
                                                    {{ Auth::user()->name }}
                                                </option>
                                            @endif
                                        </select>
                                        <select
                                            class="form-select text-center text-white-50 multiple @error('selectMiner') is-invalid @enderror"
                                            id="selectMiner">
                                            @if (null !== old('selectMiner'))
                                                @foreach (old('selectMiner') as $miner)
                                                    <option value="{{ $miner }}">
                                                        {{ $miner }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="{{ Auth::user()->name }}">
                                                    {{ Auth::user()->name }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                @error('selectMiner')
                                    <span class="fst-italic text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="row justify-content-center text-center mt-1">
                                <div class="offset-xxl-3 col-4">
                                    <div class="d-flex justify-content-end">
                                        <div> <button type="button" class="btn btn-outline-success btn-sm"
                                                id="addMiner">ADD</button></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div> <button type="button" class="btn btn-outline-danger btn-sm"
                                                id="delMiner">DEL</button></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-3 fs-5 mt-1">
                                    <label for="scouts" class="text-white-50">Scouts:</label>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <input type="text" class="form-control" placeholder="" id="scouts">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <select class="form-select text-center text-white-50 multiple"
                                            id="selectScoutsHidden" name="selectScout[]" multiple hidden>

                                            @if (null !== old('selectScout'))
                                                @foreach (old('selectScout') as $scout)
                                                    <option value="{{ $scout }}">
                                                        {{ $scout }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                    </select>
                                    <select class="form-select text-center text-white-50 multiple" id="selectScouts">

                                        @if (null !== old('selectScout'))
                                            @foreach (old('selectScout') as $scout)
                                                <option value="{{ $scout }}">
                                                    {{ $scout }}
                                                </option>
                                            @endforeach
                                        @endisset
                                </select>
                            </div>
                        </div>

                        @error('selectScout')
                            <span class="fst-italic text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="row justify-content-center text-center mt-1">
                        <div class="offset-xxl-3 col-4">
                            <div class="d-flex justify-content-end">
                                <div> <button type="button" class="btn btn-outline-success btn-sm"
                                        id="addScouts">ADD</button></div>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div> <button type="button" class="btn btn-outline-danger btn-sm"
                                        id="delScouts">DEL</button></div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <div class="mt-1">
                            <div class="text-white-50">Scout:</div>
                            <div id="ratioScouts">50%</div>
                        </div>
                        <div><label for="payoutRatio"
                                class="form-label text-white-50 fs-5">@lang('task.view.payoutRatio')</label></div>
                        <div class="mt-1">
                            <div class="text-white-50">Miner:</div>
                            <div id="ratioMiner">50%</div>
                        </div>
                    </div>
                    <input type="range" class="form-range" min="0" max="100" step="1"
                        id="payoutRatio" name="payoutRatio">

                </div>
            </div>
        </div>
        <div class="col-md-10 col-lg-4 mt-5 mt-lg-0">
            <div class="card">
                <div class="header-text card-header">
                    <div class="text-center fs-4">
                        @lang('task.view.ores')
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-dark table-striped text-center">
                        <thead>
                            <tr class="fs-5">
                                <th scope="col" class="text-white-50">@lang('task.view.oresType')</th>
                                <th scope="col" class="text-white-50">@lang('task.view.units')</th>
                                <th scope="col" class="text-white-50"></th>
                            </tr>
                        </thead>
                        <tbody id="oreTableEntries">
                            @if (null !== old('oreUnits'))
                                @php
                                    $oreUnits = old('oreUnits');
                                    $oreTypes = old('oreTypes');
                                @endphp

                                @foreach (old('oreUnits') as $index => $units)
                                    <tr>
                                        <th scope="row" class="w-50">

                                            <div class="d-flex justify-content-center">
                                                @php
                                                    $selectedOre = new \stdClass();
                                                    $selectedOre->name = '';
                                                    if ($oreTypes[$index] === 'null') {
                                                        $selectedOre->name = __('task.view.pleaseSelect');
                                                    } else {
                                                        $selectedOre = $ores->firstWhere('id', $oreTypes[$index]);
                                                        if (empty($selectedOre)) {
                                                            $selectedOre = new \stdClass();
                                                            $oreTypes[$index] = 'null';
                                                            $selectedOre->name = __('task.view.pleaseSelect');
                                                        }
                                                    }
                                                @endphp

                                                <select class="form-select text-center w-75 text-white-50 oreType"
                                                    id=selectOretype name="oreTypes[]">

                                                    <option value={{ $oreTypes[$index] }} selected hidden>
                                                        {{ $selectedOre->name }}</option>
                                                    @foreach ($ores as $ore)
                                                        @if ($loop->index < 1)
                                                            <option value={{ $ore->id }}
                                                                class="text-success">
                                                                {{ $ore->name }}</option>
                                                        @elseif ($loop->index < 4)
                                                            <option value={{ $ore->id }}
                                                                class="text-primary">
                                                                {{ $ore->name }}</option>
                                                        @elseif ($loop->index < 10)
                                                            <option value={{ $ore->id }}
                                                                class="text-warning">
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
                                                    <input min="1" type="number"
                                                        class="form-control oreUnit" placeholder="cSCU"
                                                        value="@php
                                                            if (null !== $oreUnits){
                                                        echo $units;
                                                    } @endphp"
                                                        name="oreUnits[]">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="button"
                                                    class="btn btn-outline-danger deletePart btn-sm">X</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr id="oreTableEntry">
                                    <th scope="row" class="w-50">
                                        <div class="d-flex justify-content-center">
                                            <select class="form-select text-center w-75 text-white-50 oreType"
                                                name="oreTypes[]">
                                                <option class="" value="null" hidden selected>
                                                    @lang('task.view.pleaseSelect')</option>
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
                                                <input type="number" min="1" max="99999" class="form-control oreUnit"
                                                    placeholder="cSCU" name="oreUnits[]">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button"
                                                class="btn btn-outline-danger deletePart btn-sm">X</button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @error('oreTypes')
                        <span class="fst-italic text-danger" role="alert">
                            {{ $message }}
                        </span>
                        <br>
                    @enderror
                    @error('oreUnits')
                        <span class="fst-italic text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror


                    <div class="d-flex flex-row-reverse me-2 mt-4 mb-1">
                        <button type="button" class="btn btn-outline-success"
                            id="btnAddOrePart">@lang('task.view.addPart')</button>
                    </div>
                </div>

                <div class="header-text card-header border border-top">
                    <div class="text-center fs-5">
                        <span>@lang('task.view.expectedProceeds'):</span>
                        <span class="text-success fs-5" id="expectedProceeds">0</span> <span>aUEC</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-4">
                        <div class="d-flex justify-content-center"><button type="button"
                                class="btn btn-outline-success btn-lg" id="btnSave">@lang('task.view.save')</button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center"><button type="button"
                                class="btn btn-outline-info btn-lg"
                                id="btnSaveToDashboard">@lang('task.view.saveToDashboard')</button></div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center"><button type="button"
                                class="btn btn-outline-warning btn-lg" id="btnReset">@lang('task.view.reset')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

@vite('resources/js/task.js')
@endsection

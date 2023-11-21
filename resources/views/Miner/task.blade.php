@extends('layouts/base')


@section('content')
    <div class="container mt-5">
        <form method="POST" action="{{ route('task') }}" id="form">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="header-text card-header">
                            <div class="text-center fs-4">
                                Refinery
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center text-center">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="refineryStaion" class="text-white-50">Refinery Station:</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <select class="form-select text-center w-100" id="refineryStaion"
                                            name="refineryStation">
                                            <option value="" class="" hidden selected disabled>
                                                Bitte wählen</option>
                                            @foreach ($stations as $station)
                                                <option value={{ $station->id }}
                                                    {{ old('refineryStation') == $station->id ? 'selected' : '' }}>
                                                    {{ $station->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('refineryStation')
                                        <span class="fst-italic text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="method" class="text-white-50">Methode:</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <select class="form-select text-center w-100" id="method" name="method">
                                            <option value="" class="" hidden selected disabled>
                                                Bitte wählen</option>
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
                                        <span class="fst-italic text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="costs" class="text-white-50">Kosten:</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <input type="number" class="form-control" placeholder="aUEC" id="costs"
                                            value="{{ old('costs') }}" name="costs">
                                    </div>
                                    @error('costs')
                                        <span class="fst-italic text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center text-center mt-3">
                                <div class="col-5 fs-5 mt-1">
                                    <label for="duration" class="text-white-50">Dauer:</label>
                                </div>
                                <div class="col-5">
                                    <div class="d-flex justify-content-center">
                                        <input type="text" class="form-control" placeholder="HH:MM" id="duration"
                                            value="{{ old('duration') }}" name="duration">
                                    </div>
                                    @error('duration')
                                        <span class="fst-italic text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="header-text card-header">
                            <div class="row">
                                <div class="col-8 text-center fs-4">
                                    Mitspieler
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary" id="btnOnlGroup">Alte
                                        Gruppe</button>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
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
                                        <select class="form-select text-center text-white-50 multiple" id="selectMiner"
                                            name="selectMiner[]" multiple>
                                            @if( null !== old('selectMiner'))
                                                @foreach (old('selectMiner') as $miner)
                                                    <option value="{{ $miner }}">
                                                        {{ $miner }}
                                                    </option>
                                                @endforeach
                                            @endisset
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
                                        <select class="form-select text-center text-white-50 multiple" id="selectScouts"
                                            name="selectScout[]" multiple>

                                            @if( null !== old('selectScout'))
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
                                        class="form-label text-white-50 fs-5">Auszahlungsverhältis</label></div>
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
                <div class="col">
                    <div class="card">
                        <div class="header-text card-header">
                            <div class="text-center fs-4">
                                Erze
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-dark table-striped text-center">
                                <thead>
                                    <tr class="fs-5">
                                        <th scope="col" class="text-white-50">Erztyp</th>
                                        <th scope="col" class="text-white-50">Units</th>
                                        <th scope="col" class="text-white-50"></th>
                                    </tr>
                                </thead>
                                <tbody id="oreTableEntries">
                                    <tr id="oreTableEntry">
                                        <th scope="row" class="w-50">
                                            <div class="d-flex justify-content-center">
                                                <select class="form-select text-center w-75 text-white-50 oreType"
                                                    id=selectOretype name="oreTypes[]">
                                                    <option value="" class="" hidden selected disabled>
                                                        Bitte wählen</option>
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
                                                    <input type="number" class="form-control oreUnit" placeholder=""
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
                                <button type="button" class="btn btn-outline-success" id="btnAddOrePart">Weiterer
                                    Anteil</button>
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
                                        class="btn btn-outline-success btn-lg" id="btnSave">Speichern</button></div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center"><button type="button" name="action"
                                        value="saveToDashboard" class="btn btn-outline-info btn-lg"
                                        id="btnSaveToDashboard">Speichern und zum
                                        Dashboard</button></div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center"><button type="button"
                                        class="btn btn-outline-warning btn-lg" id="btnReset">Zurücksetzen</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @vite('resources/js/task.js')
@endsection

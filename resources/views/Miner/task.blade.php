@extends('layouts/base')


@section('content')


    <div class="container mt-5">
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
                                    <select class="form-select text-center w-100" id="refineryStaion">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center mt-3">
                            <div class="col-5 fs-5 mt-1">
                                <label for="method" class="text-white-50">Methode:</label>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-center">
                                    <select class="form-select text-center w-100" id="method">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center mt-3">
                            <div class="col-5 fs-5 mt-1">
                                <label for="costs" class="text-white-50">Kosten:</label>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-center">
                                    <input type="number" class="form-control" placeholder="aUEC" id="costs">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center mt-3">
                            <div class="col-5 fs-5 mt-1">
                                <label for="duration" class="text-white-50">Dauer:</label>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-center">
                                    <input type="number" class="form-control" placeholder="HH:MM" id="duration">
                                </div>
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
                                    <select class="form-select text-center text-white-50" id="selectMiner">

                                    </select>
                                </div>
                            </div>
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
                                    <select class="form-select text-center text-white-50" id="selectScouts">

                                    </select>
                                </div>
                            </div>
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
                            <div><label for="customRange3"
                                    class="form-label text-white-50 fs-5">Auszahlungsverhältis</label></div>
                            <div class="mt-1">
                                <div class="text-white-50">Miner:</div>
                                <div id="ratioMiner">50%</div>
                            </div>
                        </div>

                        <input type="range" class="form-range" min="0" max="100" step="1"
                            id="payoutRatio">
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
                                            <select class="form-select text-center w-75 text-white-50" id=selectOretype>
                                                <option value="" class="" hidden selected disabled>
                                                    Bitte wählen</option>

                                            </select>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="w-75">
                                                <input type="number" class="form-control" placeholder="">
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
                            <div class="d-flex justify-content-center"><button type="button"
                                    class="btn btn-outline-info btn-lg" id="btnSaveToDashboard">Speichern und zum
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
    </div>

    @vite('resources/js/task.js')
@endsection

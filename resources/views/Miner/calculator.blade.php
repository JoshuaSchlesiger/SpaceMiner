@extends('\layouts/base')


@section('content')
    <div class="container mt-5">
        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="header-text card-header">
                        <div class="row">
                            <div class=" col-8 text-center fs-4">
                                Eingabe der Werte
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <div class="form-check form-switch d-flex">
                                    <div class="switchGem"><label for="inputSwitch"><i class="bi bi-gem"></i></label></div>
                                    <div><input class="form-check-input switch" type="checkbox" role="switch"
                                            id="inputSwitch"></div>
                                    <div class="switchRocket"><label for="inputSwitch"><i class="bi bi-rocket"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="inputsRock">
                            <div class="row">
                                <div class="col-6 text-center fs-5 mt-1">
                                    <label for="massStone" class="text-white-50">Masse des Steines:</label>
                                </div>
                                <div class="col-6">
                                    <div class="form-outline">
                                        <input id="massStone" type="text" class="form-control" placeholder="69 SCU" />
                                    </div>
                                    <div class="form-text">
                                        Masse in SCU
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <table class="table table-dark table-striped text-center">
                                <thead>
                                    <tr class="fs-5">
                                        <th scope="col" class="text-white-50">Erztyp</th>
                                        <th scope="col" class="text-white-50">Anteile (%)</th>
                                        <th scope="col" class="text-white-50"></th>
                                    </tr>
                                </thead>
                                <tbody id="inputTableBodyRock">
                                    <tr id="oreTableEntry">
                                        <th scope="row" class="w-50">
                                            <div class="d-flex justify-content-center">
                                                <select class="form-select text-center w-75 fs-5 oreTypeRock">
                                                    @foreach ($ores as $ore)
                                                        @if ($loop->index < 1)
                                                            <option id={{ $ore->id }} class="text-success">
                                                                {{ $ore->name }}</option>
                                                        @elseif ($loop->index < 4)
                                                            <option id={{ $ore->id }} class="text-primary">
                                                                {{ $ore->name }}</option>
                                                        @elseif ($loop->index < 10)
                                                            <option id={{ $ore->id }} class="text-warning">
                                                                {{ $ore->name }}</option>
                                                        @else
                                                            <option id={{ $ore->id }} class="text-danger">
                                                                {{ $ore->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="w-75">
                                                    <input type="number" class="form-control fs-5" name=""
                                                        id="" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-outline-danger deletePart">X</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex flex-row-reverse me-2 mt-4 mb-1">
                                <button type="button" class="btn btn-outline-success" id="btnAddPartRock">Weiterer
                                    Anteil</button>
                            </div>
                        </div>
                        <div id="inputsShip" hidden>
                            <table class="table table-dark table-striped text-center">
                                <thead>
                                    <tr class="fs-5">
                                        <th scope="col" class="text-white-50">Erztyp</th>
                                        <th scope="col" class="text-white-50">Masse (SCU)</th>
                                        <th scope="col" class="text-white-50"></th>
                                    </tr>
                                </thead>
                                <tbody id="inputTableBodyShip">
                                    <tr>
                                        <th scope="row" class="w-50">
                                            <div class="d-flex justify-content-center">
                                                <select class="form-select text-center w-75 fs-5 oreType">
                                                    @foreach ($ores as $ore)
                                                        @if ($loop->index < 1)
                                                            <option id={{ $ore->id }} class="text-success">
                                                                {{ $ore->name }}</option>
                                                        @elseif ($loop->index < 4)
                                                            <option id={{ $ore->id }} class="text-primary">
                                                                {{ $ore->name }}</option>
                                                        @elseif ($loop->index < 10)
                                                            <option id={{ $ore->id }} class="text-warning">
                                                                {{ $ore->name }}</option>
                                                        @else
                                                            <option id={{ $ore->id }} class="text-danger">
                                                                {{ $ore->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="w-75">
                                                    <input type="number" class="form-control fs-5 orePercentage"
                                                        name="" id="" aria-describedby="helpId"
                                                        placeholder="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-outline-danger deletePart">X</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex flex-row-reverse me-2 mt-4 mb-1">
                                <button type="button" class="btn btn-outline-success" id="btnAddPartShip">Weiterer
                                    Anteil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="header-text card-header text-center fs-4">
                        Ergebnisse
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center text-center">
                            <div class="col-5"><span class="fs-5 text-white-50">Wertvolles Gestein: </span> <span
                                    class="text-info fs-5" id="valuableRock">0</span> <span class="">SCU</span>
                            </div>
                            <div class="col-5"><span class="fs-5 text-white-50">Rohgewinn: </span><span
                                    class="text-info fs-5" id="rawProfit">0</span> <span class="-">aUEC</span></div>
                        </div>
                    </div>
                    <div class="header-text card-header text-center fs-4 border-top ">
                        Refinery
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center text-center">
                            <div class="col-5 fs-5 mt-1">
                                <label for="refineryMethod" class="text-white-50">Methode:</label>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-center">
                                    <select class="form-select text-center w-75" id="refineryMethod">
                                        @foreach ($methods as $method)
                                        @if ($loop->index < 1)
                                            <option id={{ $method->id }} class="text-success">
                                                {{ $method->name }}</option>
                                        @elseif ($loop->index < 4)
                                            <option id={{ $method->id }} class="text-warning">
                                                {{ $method->name }}</option>
                                        @else 
                                            <option id={{ $method->id }} class="text-danger">
                                                {{ $method->name }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center mt-3">
                            <div class="col-5 fs-5 mt-1">
                                <label for="refineryMethod" class="text-white-50">Station:</label>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-center">
                                    <select class="form-select text-center w-75" id="refineryMethod">
                                        @foreach ($stations as $station)
                                            <option id={{ $station->id }}>{{ $station->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center text-center">
                            <div class="col-5"><span class="fs-5 text-white-50">Kosten: </span> <span
                                    class="text-danger fs-5" id="valuableRock">0</span> <span class="">aUEC</span>
                            </div>
                            <div class="col-5"><span class="fs-5 text-white-50">Gewinn: </span><span
                                    class="text-success fs-5" id="rawProfit">0</span> <span class="-">aUEC</span>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center mt-2">
                            <div class="col-5"><span class="fs-5 text-white-50">Dauer: </span> <span
                                    class="text-danger fs-5" id="valuableRock">0</span> <span class="">HH:MM</span>
                            </div>
                            <div class="col-5"><span class="fs-5 text-white-50">Einheiten: </span><span
                                    class="text-success fs-5" id="rawProfit">0</span> <span class="-">units</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

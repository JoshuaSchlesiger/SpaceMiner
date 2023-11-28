<div>
    <div>
        <div class="header-text card-header text-center fs-4">
            Zu bezahlende Spieler
        </div>
        <div class="card-body payablePlayerList">
            @foreach ($payablePlayer as $username => $player)
            <div class="row listItems align-items-center ms-2 me-2">
                <div class="col row fs-5 d-flex justify-content-evenly">
                    <div class="col-6 text-white-50 text-center">Spielername:</div>
                    <div class="col text-info text-center">{{$username}}</div>
                </div>
                <div class="col row fs-5 d-flex justify-content-evenly">
                    <div class="col-4 text-white-50 text-center">Betrag:</div>
                    <div class="col"><span class="text-danger">{{$playerValue[$username]}}</span><span> aUEC</span></div>
                </div>
            </div>
            <hr>
            @endforeach



        </div>
    </div>


    {{-- <div>
        <div class="header-text card-header text-center fs-4">
            <div class="row">
                <div class="col-9 text-center fs-4 my-auto">
                    Verkaufen
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-warning">Kombinieren</button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row align-items-center ms-2 me-2 mt-2">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-6 fs-4">
                    <div class="text-white-50">Erzmetall:</div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="ms-2">
                        <select class="form-select text-center">
                            <option value="1">
                                Quantianium
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row align-items-center ms-2 me-2 mt-2">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-6 fs-4">
                    <div class="text-white-50">Einheiten:</div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="ms-2 fs-4 text-center">
                        <span>2342</span> <span class="text-white-50">units</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row align-items-center ms-2 me-2 mt-2">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-6 fs-4">
                    <div class="text-white-50">Verkaufsstation:</div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="ms-2">
                        <select class="form-select text-center">
                            <option value="1">
                                Area18
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row align-items-center ms-2 me-2 mt-2">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-6 fs-4">
                    <div class="text-white-50">Verkaufspreis:</div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="ms-2 fs-4">
                        <input id="massStone" type="text" class="form-control text-center"
                            placeholder="69420 aUEC" />
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-evenly mt-3">
                <button type="button" class="btn btn-outline-success btn-lg">Speichern</button>
                <button type="button" class="btn btn-outline-danger btn-lg">Abbrechen</button>
            </div>
        </div>
    </div> --}}
</div>

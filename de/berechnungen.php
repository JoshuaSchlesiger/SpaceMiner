<?php

require "structure/header.php";
require "functions/database.php";

session_start();

if (isset($_POST["logout"])) {
    $_SESSION["loggedIn"] = "false";
    session_destroy();
}


$conn = connect();
$_SESSION['oreTypes'] = getOreTypes($conn);


?>



<body>

    <nav class="nv navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid ps-4">
            <a class="navbar-brand mb-auto nv-brand" href="index.php">SpaceMiner</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <?php
                    if (isset($_SESSION["loggedIn"])) {
                        if ($_SESSION["loggedIn"] == "true") {
                            echo '
                                <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="auftraege.php">Aufträge</a>
                                </li>
                                ';
                        }
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="berechnungen.php">Berechnungen</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="uebermich.php">Über Mich</a>
                    </li>
                    <?php
                    if (isset($_SESSION["loggedIn"])) {
                        if ($_SESSION["loggedIn"] == "true") {
                            echo '<li class="nav-item">
                                <form action="" method="post">
                                    <button type="submit" class="btn btn-link hyperlink" name="logout">Logout</button>
                                </form>
                            </li>';
                        } else {
                            echo '<li class="nav-item">
                                        <a class="nav-link " href="registrieren.php">Registrieren</a>
                                    </li>
                                    <li class="nav-item me-2">
                                        <a class="nav-link" href="login.php">Login</a>
                                    </li>';
                        }
                    } else {
                        echo '<li class="nav-item">
                            <a class="nav-link" href="registrieren.php">Registrieren</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>';
                    }
                    ?>
                    <form class="d-flex" role="search">
                        <button class="btn btn-outline-success mt-2 mb-2 language" type="submit">DE</button>
                    </form>

                </ul>
            </div>
        </div>
    </nav>


    <div class="calculate">
        <div class="calculate_sub card">
            <h5 class="header-text card-header text-center">Berechne den Wert eines Steins</h5>
            <div class="card-body">


                <form action="">
                    <div class="mt-2 row ">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">Masse des Steins:</div>
                        <div class="col-lg-2">
                            <input type="number" value="0" min="0" max="9999" id="massStone" class="form-control">
                        </div>
                        <div class="col-lg-2 job-addcrew helptext">
                            <span>
                                <i>Zum Beispiel 6900</i>
                            </span>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2"></div>
                    </div>

                    <hr>

                    <div class="mt-4 row justify-content-center">
                        <div class="col-lg-1">
                        </div>
                        <div class="col-lg-2">Erztyp:</div>
                        <div class="col-lg-2">Anteil (%):</div>
                        <div class="col-lg-2">Menge (SCU):</div>
                        <div class="col-lg-2">Preis (ROH):</div>
                        <div class="col-lg-2">Preis (BESSER):</div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="mt-2 row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">
                            <div class="col-3 text-info calculateOre">
                                <select class="form-select" id="select1">
                                    <?php
                                    for ($i = 0; $i < count($_SESSION['oreTypes']); $i++) {
                                        echo '<option value="$i">';
                                        echo $_SESSION['oreTypes'][$i][1];
                                        echo '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" value="0" min="0" max="100" id="proportion1" class="form-control">
                        </div>
                        <div class="col-lg-2 ">
                            <input class="form-control" type="text" value="" id="mass1" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" id="priceRaw1" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" id="priceRefined1" disabled readonly>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="mt-4 row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">
                            <div class="col-3 text-info calculateOre">
                                <select class="form-select" id="select2">
                                    <?php
                                    for ($i = 0; $i < count($_SESSION['oreTypes']); $i++) {
                                        echo '<option value="$i">';
                                        echo $_SESSION['oreTypes'][$i][1];
                                        echo '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" value="0" min="0" max="100" id="proportion2" class="form-control">
                        </div>
                        <div class="col-lg-2 ">
                            <input class="form-control" type="text" value="" id="mass2" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" id="priceRaw2" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" id="priceRefined2" disabled readonly>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="mt-4 row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">
                            <div class="col-3 text-info calculateOre">
                                <select class="form-select" id="select3">
                                    <?php
                                    for ($i = 0; $i < count($_SESSION['oreTypes']); $i++) {
                                        echo '<option value="$i">';
                                        echo $_SESSION['oreTypes'][$i][1];
                                        echo '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" value="0" min="0" max="100" id="proportion3" class="form-control">
                        </div>
                        <div class="col-lg-2 ">
                            <input class="form-control" type="text" value="" id="mass3" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" id="priceRaw3" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" id="priceRefined3" disabled readonly>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>

                    <hr>

                    <div class="mt-4 row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 text-center"><img src="/de/images/icons/weight.png" alt="Gewicht" class="icon_calc"></i> Steingewicht</div>
                        <div class="col-lg-2 text-center"><img src="/de/images/icons/gem.png" alt="Mineral" class="icon_calc"> Mineralisches Gewicht</div>
                        <div class="col-lg-2 text-center"><img src="/de/images/icons/trash-can.png" alt="Müll" class="icon_calc"> Müllgewicht</div>
                        <div class="col-lg-2 text-center"><img src="/de/images/icons/raw-materials.png" alt="Roh" class="icon_calc"> Rohgewinn</div>
                        <div class="col-lg-2 text-center"><img src="/de/images/icons/adjust.png" alt="Aufgewertet" class="icon_calc"> Aufgearbeiteter Gewinn</div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="mt-2 row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 h5 text-center" id="weightPureSmall">0 cSCU</div>
                        <div class="col-lg-2 h5 text-center" id="weightMineralSmall">0 cSCU</div>
                        <div class="col-lg-2 h5 text-center text-warning" id="weightTrashSmall">0 cSCU</div>
                        <div class="col-lg-2 h5 text-center text-success" id="rawProfit">0 aUEC</div>
                        <div class="col-lg-2 h5 text-center text-success" id="refinedProfit">0 aUEC</div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 h6 text-center" id="weightPureBig">0 SCU</div>
                        <div class="col-lg-2 h6 text-center" id="weightMineralBig">0 SCU</div>
                        <div class="col-lg-2 h6 text-center text-warning" id="weightTrashBig">0 SCU</div>
                        <div class="col-lg-2 h6 text-center text-success"></div>
                        <div class="col-lg-2 h6 text-center text-success"></div>
                        <div class="col-lg-1"></div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="calculate">
        <div class="calculate_sub card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#quantanium" role="tab" aria-controls="quantanium" aria-selected="true">Quantanium-ACHTUNG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aaronHalo" role="tab" aria-controls="aaronHalo" aria-selected="false">Aaron Halo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#refineries" role="tab" aria-controls="refineries" aria-selected="false">Raffinerien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sellingstation" role="tab" aria-controls="sellingstation" aria-selected="false">Verkaufsstationen</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="quantanium" role="tabpanel" aria-labelledby="quantanium-tab">
                        <div class="card-text">
                            <h3 class="text-center font mt-4">Quantanium und die Zeiten</h3>
                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-xxl">
                                        Quantanium ist ein empfindliches, höchst instabiles Mineral, das abgebaut und zu
                                        Quantenbrennstoff aufbereitet werden kann. Einmal abgebaut, baut sich Quantanium
                                        mit der Zeit ab.
                                        Stöße auf das transportierende Schiff beschleunigen diesen Abbau ebenfalls.
                                        Sobald es ein bestimmtes Ausmaß erreicht hat, besteht die Gefahr, dass es
                                        explodiert. Der Pilot erhält dann eine optische und akustische Warnung und hat
                                        die Möglichkeit, die gesamte Ladung über eine Taste im Cockpit auszustoßen. Wird
                                        der Auswurf nicht rechtzeitig durchgeführt, führt dies in den meisten Fällen zu
                                        einer Explosion und dem Tod des Spielers.
                                        In Anbetracht des Risikos ist die erfolgreiche Lieferung von Quantanium ein
                                        lukratives Unterfangen und sollte nur mit Übung im Bergbau in Angriff genommen
                                        werden.
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-xxl">
                                        <div class="row">
                                            <div class="col-2">
                                                Stufe 1 ->
                                            </div>
                                            <div class="col-3">
                                                <span class="text-warning">Gelb blinkend</span>
                                            </div>
                                            <div class="col-3">
                                                Stunfenzeit: 8min
                                            </div>
                                            <div class="col-4">
                                                Informationen: Keine
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                Stufe 2 ->
                                            </div>
                                            <div class="col-3">
                                                <span class="text-warning">Orange blinkend (schnell)</span>
                                            </div>
                                            <div class="col-3">
                                                Stunfenzeit: 6min
                                            </div>
                                            <div class="col-4">
                                                Informationen: Keine
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                Stufe 3 ->
                                            </div>
                                            <div class="col-3">
                                                <span class="text-danger">Rot blinkend (schnell)</span>
                                            </div>
                                            <div class="col-3">
                                                Stunfenzeit: 2min
                                            </div>
                                            <div class="col-4">
                                                Informationen: Abstoßen von Quantanium
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-2">
                                                Stufe 4 ->
                                            </div>
                                            <div class="col-3">
                                                <span class="text-danger">Rot blinkend (sehr schnell)</span>
                                            </div>
                                            <div class="col-3">
                                                Stunfenzeit: 0.25min
                                            </div>
                                            <div class="col-4">
                                                Informationen: Wird oft nicht angezeigt
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="aaronHalo" role="tabpanel">
                        <h3 class="text-center font mt-4">Die Asteroiden und wo ich Sie finde</h3>
                        <div class="container text-center mt-4">
                            <div>
                                <div class="row">
                                    <div class="col text-danger">
                                        ARC-L1
                                    </div>
                                    <div class="col text-info">
                                        CRU-L4
                                    </div>
                                    <div class="col text-info">
                                        CRUSADER
                                    </div>
                                    <div class="col text-info">
                                        CRU-L5
                                    </div>
                                    <div class="col text-info">
                                        HURSTON
                                    </div>
                                    <div class="col text-info">
                                        CRU-L3
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-success">
                                        Band 1
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>12.725.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>11.277.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>32.494.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>7.182.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>38.835.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>6.332.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>12.670.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>7.640.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10.966.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>11.746.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 3
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>13.961.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>10.041.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>33.043.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>6.608.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>39.321.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>5.847.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>13.297.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>7.013.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>12.324.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>10.388.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 5
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>15.027.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>8.975.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>33.591.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>6.060.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>39.788.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>5.380.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>13.892.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>6.419.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>13.462.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>9.251.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 7
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>15.952.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>8.050.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>34.105.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>5.546.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>40.231.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>4.937.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>14.446.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>5.865.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>14.439.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>7.976.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-4">

                            <div class="mt-4">
                                <div class="row">
                                    <div class="col text-danger">
                                        HUR-L1
                                    </div>
                                    <div class="col text-info">
                                        ARC-L3
                                    </div>
                                    <div class="col text-info">
                                        MICRTECH
                                    </div>
                                    <div class="col text-info">
                                        ARC-L4
                                    </div>
                                    <div class="col text-info">
                                        ARCCORP
                                    </div>
                                    <div class="col text-info">
                                        ARC-L5
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-success">
                                        Band 7
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>7.947.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>31.414.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>24.070.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>14.680.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>7.899.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>9.743.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.755.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>14.483.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.421.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>26.203.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 5
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.398.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>30.963.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>24.592.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>14.158.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.347.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>9.296.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.276.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>13.962.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.911.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>25.712.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 3
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.877.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>30.484.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>25.148.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>13.601.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.820.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>8.822.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.832.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>13.407.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.533.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>25.190.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 1
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.373.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>29.988.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>25.732.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>13.018.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.312.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>8.331.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10.413.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>12.825.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.978.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>24.645.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4">

                            <div class="mt-4">
                                <div class="row">
                                    <div class="col text-danger">
                                        MIC-L4
                                    </div>
                                    <div class="col text-info">
                                        ARCCORP
                                    </div>
                                    <div class="col text-info">
                                        HURSTON
                                    </div>
                                    <div class="col text-info">
                                        HUR-L4
                                    </div>
                                    <div class="col text-info">
                                        CRUSADER
                                    </div>
                                    <div class="col text-info">
                                        CRU-L5
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-success">
                                        Band 1
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>25861000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>29782000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>12416000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>21852000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>6846000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>19407000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>32152000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>21143000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8053000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>28853000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 3
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>27724000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>27919000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>13041000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>21227000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>7331000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>18921000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>32731000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>20565000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10213000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>27276000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col text-success">
                                        Band 5
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>29123000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>26520000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>13632000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>20636000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>7799000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>18453000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>33284000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>20012000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10894000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>26012000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col text-success">
                                        Band 7
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>30260000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>25383000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>14186000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>20082000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8240000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>18012000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>33803000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>19493000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>11953000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>24953000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4">

                            <div class="mt-4">
                                <div class="row">
                                    <div class="col text-danger">
                                        HUR-L2
                                    </div>
                                    <div class="col text-info">
                                        MICROTECH
                                    </div>
                                    <div class="col text-info">
                                        ARC-L4
                                    </div>
                                    <div class="col text-info">
                                        ARCCORP
                                    </div>
                                    <div class="col text-info">
                                        ARC-L5
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-success">
                                        Band 7
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>25.243.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>12.864.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>7.973.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>7.224.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.484.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>13.111.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.672.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>27.600.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 5
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>25.832.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>12.275.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.426.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>6.770.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10.075.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>12.520.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.185.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>27.088.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 3
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>26.467.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>11.640.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>8.906.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>6.290.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10.713.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>11.882.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.732.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>26.540.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 1
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>27.138.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>10.968.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>9.405.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>5.791.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>11.387.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>11.208.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>19.304.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>25.968.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-4">

                            <div class="mt-4">
                                <div class="row">
                                    <div class="col text-danger">
                                        CRU-L1
                                    </div>
                                    <div class="col text-info">
                                        ARC-L3
                                    </div>
                                    <div class="col text-info">
                                        MICROTECH
                                    </div>
                                    <div class="col text-info">
                                        ARCCORP
                                    </div>
                                    <div class="col text-info">
                                        ARC-L5
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-success">
                                        Band 7
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10.587.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>8.062.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>23.929.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>32.112.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>6.020.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>32.130.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>10.951.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>14.842.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 5
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>11.307.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>7.343.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>24.337.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>31.603.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>6.523.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>31.621.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>11.718.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>14.075.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 3
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>12.096.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>6.553.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>24.881.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>31.060.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>7.059.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>31.079.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>12.571.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>13.223.000
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col text-success">
                                        Band 1
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>12.955.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>5.695.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>25.448.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>30.493.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>7.622.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>30.510.000
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="text-warning">↑</span>13.500.000
                                            </div>
                                            <div class="col">
                                                <span class="text-warning">↓</span>12.284.000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="refineries" role="tabpanel" aria-labelledby="refineries-tab">

                        <div class="container ">
                            <div class="row">
                                <div class="col-xxl mt-3">
                                    <h3 class="text-center font">Die Raffenerien in Star Citizen</h3>
                                    <div class="row">
                                        <div class="col mt-3 text-center">
                                            <p class="text-info">STATION</p>
                                            <p>ARC-L1 Wide Forest Station</p>
                                            <p>CRU-L1 Ambitious Dream Station</p>
                                            <p>HUR-L1 Green Glade Station</p>
                                            <p>HUR-L2 Faithful Dream Station</p>
                                            <p>MIC-L1 Shallow Frontier Station</p>
                                        </div>
                                        <div class="col mt-3 text-center">
                                            <p class="text-info">SYSTEM</p>
                                            <p>Stanton system</p>
                                            <p>Stanton system</p>
                                            <p>Stanton system</p>
                                            <p>Stanton system</p>
                                            <p>Stanton system</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl mt-3">
                                    <h3 class="text-center font">Prozessarten</h3>
                                    <div class="row">
                                        <div class="col-4 mt-3 text-center">
                                            <p class="text-info">Methode</p>
                                            <p>Cormack Method</p>
                                            <p>Dinyx Solvention</p>
                                            <p>Electrostarolysis</p>
                                            <p>Ferron Exchange</p>
                                            <p>Gaskin Process</p>
                                            <p>Kazen Winnowing</p>
                                            <p>Pyrometric Chromalysis</p>
                                            <p>Thermonatic Deposition</p>
                                            <p>XCR Reaction</p>
                                        </div>
                                        <div class="col mt-3 text-center">
                                            <p class="text-info">Geschwindigkeit</p>
                                            <p>Hoch</p>
                                            <p>Sehr niedrig</p>
                                            <p>Mäßig</p>
                                            <p>Niedrig</p>
                                            <p>Hoch</p>
                                            <p>Mäßig</p>
                                            <p>Niedrig</p>
                                            <p>Niedrig</p>
                                            <p>Hoch</p>
                                        </div>
                                        <div class="col mt-3 text-center">
                                            <p class="text-info">Kosten</p>
                                            <p>Mäßig</p>
                                            <p>Niedrig</p>
                                            <p>Mäßig</p>
                                            <p>Mäßig</p>
                                            <p>Hoch</p>
                                            <p>Niedrig</p>
                                            <p>Hoch</p>
                                            <p>Niedrig</p>
                                            <p>Hoch</p>
                                        </div>
                                        <div class="col mt-3 text-center">
                                            <p class="text-info">Ertrag</p>
                                            <p>Niedrig</p>
                                            <p>Hoch</p>
                                            <p>Mäßig</p>
                                            <p>Hoch</p>
                                            <p>Mäßig</p>
                                            <p>Niedrig</p>
                                            <p>Hoch</p>
                                            <p>Mäßig</p>
                                            <p>Niedrig</p>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="sellingstation" role="tabpanel" aria-labelledby="sellingstation-tab">
                        <p class="card-text">Immerseghgfhgf traditions of Emilia-Romagna with a holiday in Bologna, and
                            discover the city's rich artistic heritsage.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    require "structure/footer.php";
    ?>

    <script src="scripts/calculator.js"></script>


</body>

</html>
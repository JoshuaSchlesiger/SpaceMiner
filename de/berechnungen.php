<?php

require "structure/header.php";
require "functions/database.php";

if (isset($_POST["logout"])) {
    $_SESSION["loggedIn"] = "false";
    session_destroy();
}

session_start();
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
                    <div class="tab-pane active" id="quantanium" role="tabpanel" aria-labelledby="quantanium-tab">
                        <div class="card-text">
                            <h3 class="text-center font mt-4">Quantanium und die Zeiten</h3>
                            
                        </div>
                    </div>

                    <div class="tab-pane text-center" id="aaronHalo" role="tabpanel">
                        <h3>Der Asteroidengürtel</h3>
                        <h5>Aber wie finde Ich ihn?</h5>
                    </div>

                    <div class="tab-pane" id="refineries" role="tabpanel" aria-labelledby="refineries-tab">
                        <p class="card-text">Immerse yourself in the colours, aromas and traditions of Emilia-Romagna with a holiday in Bologna, and discover the city's rich artistic heritage.</p>
                    </div>

                    <div class="tab-pane" id="sellingstation" role="tabpanel" aria-labelledby="sellingstation-tab">
                        <p class="card-text">Immerseghgfhgf traditions of Emilia-Romagna with a holiday in Bologna, and discover the city's rich artistic heritage.</p>
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
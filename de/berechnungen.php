<?php
require "structure/header.php";
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
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auftraege.php">Aufträge</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="berechnungen.php">Berechnungen</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="uebermich.php">Über Mich</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registrieren.php">Registrieren</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

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
                            <input type="text" id="massStone" class="form-control">
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
                                <select class="form-select">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" id="proportion" class="form-control">
                        </div>
                        <div class="col-lg-2 ">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="mt-4 row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">
                            <div class="col-3 text-info calculateOre">
                                <select class="form-select">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" id="proportion" class="form-control">
                        </div>
                        <div class="col-lg-2 ">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="mt-4 row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">
                            <div class="col-3 text-info calculateOre">
                                <select class="form-select">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" id="proportion" class="form-control">
                        </div>
                        <div class="col-lg-2 ">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
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
                        <div class="col-lg-2 h5 text-center">0 cSCU</div>
                        <div class="col-lg-2 h5 text-center">0 cSCU</div>
                        <div class="col-lg-2 h5 text-center text-warning">0 cSCU</div>
                        <div class="col-lg-2 h5 text-center text-success">0 aUEC</div>
                        <div class="col-lg-2 h5 text-center text-success">0 aUEC</div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 h6 text-center">0 SCU</div>
                        <div class="col-lg-2 h6 text-center">0 SCU</div>
                        <div class="col-lg-2 h6 text-center text-warning">0 SCU</div>
                        <div class="col-lg-2 h6 text-center text-success"></div>
                        <div class="col-lg-2 h6 text-center text-success"></div>
                        <div class="col-lg-1"></div>
                    </div>

                </form>

            </div>
        </div>

    </div>


    
    <?php
    require "structure/footer.php";
    ?>


</body>

</html>
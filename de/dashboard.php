<?php
require "structure/header.php";

//Variables
$username = "User";

//Statistiks
$totalProfit = 0;
$numberToClaim = 0;
$totalToClaim = 0;
$bestSpots = "Aberdeen";
$bestFriend = "DochSergeantTV";
$numberCrashes = 0;
$numberJobs = 0;
$totalSCU = 0;
$numberUserCount = 0;

//Varuables per job
$jobNumber = 0;
$jobDate = "23/02/2003";
$jobUser = "0";
$jobTotalSCU = 0;
$jobStatus = "Done";
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
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="auftraege.php">Aufträge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="berechnungen.php">Berechnungen</a>
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
                    <button class="btn btn-outline-success mt-2 mb-2" type="submit" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">DE</button>
                </form>

            </ul>
        </div>
    </div>
</nav>

    <h1 class="dashboard-text text-center font">Wilkommen <?= $username ?></h1>

    <div class="dashboard-box card">
        <h5 class="dashboard-header-text card-header">Statistiken</h5>
        <div class="dashboard-box-text card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-4 mb-1">
                    <div class="row mt-2">
                        <div class="col-md-5">Gesamter Profit: </div>
                        <div class="col-md-6"><span class="text-info"><?= $totalProfit ?> aUEC </span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-5">Abholbereit: </div>
                        <div class="col-md-6"><span class="text-info"><?= $numberToClaim ?></span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-5">Wert zum Abholen: </div>
                        <div class="col-md-6"><span class="text-info"><?= $totalToClaim ?> aUEC </span></div>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="row mt-2">
                        <div class="col-md-5">Bester Miningspot: </div>
                        <div class="col-md-6"><span class="text-info"><?= $bestSpots ?> </span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-5">Bester Freund: </div>
                        <div class="col-md-6"><span class="text-info"><?= $bestFriend ?></span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-5">Gesamtgewicht: </div>
                        <div class="col-md-6"><span class="text-info"><?= $totalSCU ?> SCU </span></div>
                    </div>
                </div>

                <div class="col-md-3  mb-1">
                    <div class="row mt-2">
                        <div class="col-md-7">Bruchlandungen: </div>
                        <div class="col-md-5"><span class="text-info"><?= $numberCrashes ?> </span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-7">Auftrangsanzahl: </div>
                        <div class="col-md-5"><span class="text-info"><?= $numberJobs ?></span></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-7">Mitarbeiter: </div>
                        <div class="col-md-5"><span class="text-info"><?= $numberUserCount ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-box card">
        <h5 class="header-text card-header">Laufende Aufträge</h5>
        <div class="box-text card-body">

            <div class="dashboard-box-inline-yellow card mb-3">
                <div class="box-text card-body">
                    <div class="row ">
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Jobnummer: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobNumber ?></span></div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Datum: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobDate ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Mitarbeiter: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobUser ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Gewicht: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobTotalSCU ?> SCU </span></div>
                            </div>
                        </div>

                        <div class="container mt-3">
                            <div class="progress" style="height: 26px;">
                                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                    40%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <span>Status: </span><span class="text-warning"> <?= $jobStatus ?></span>
                    </div>
                    <div class="d-flex ">
                        <form action="">
                            <a href="#" type="button" class="btn btn-outline-success mt-3">Auftrag beabeiten</a>
                        </form>
                        <form class="ms-3" action="">
                            <a href="#" type="button" class="btn btn-outline-danger mt-3">Auftrag löschen</a>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-box-inline-red card mb-3">
                <div class="box-text card-body">
                    <div class="row ">
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Jobnummer: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobNumber ?></span></div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Datum: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobDate ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Mitarbeiter: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobUser ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Gewicht: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobTotalSCU ?> SCU </span></div>
                            </div>
                        </div>

                        <div class="container mt-3">
                            <div class="progress" style="height: 26px;">
                                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                    40%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <span>Status: </span><span class="text-warning"> <?= $jobStatus ?></span>
                    </div>
                    <div class="d-flex ">
                        <form action="">
                            <a href="#" type="button" class="btn btn-outline-success mt-3">Auftrag beabeiten</a>
                        </form>
                        <form class="ms-3" action="">
                            <a href="#" type="button" class="btn btn-outline-danger mt-3">Auftrag löschen</a>
                        </form>
                    </div>
                </div>


            </div>
            <div class="dashboard-box-inline-blue card mb-3">
                <div class="box-text card-body">
                    <div class="row ">
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Jobnummer: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobNumber ?></span></div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Datum: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobDate ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Mitarbeiter: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobUser ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Gewicht: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobTotalSCU ?> SCU </span></div>
                            </div>
                        </div>

                        <div class="container mt-3">
                            <div class="progress" style="height: 26px;">
                                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                    40%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <span>Status: </span><span class="text-warning"> <?= $jobStatus ?></span>
                    </div>
                    <div class="d-flex ">
                        <form action="">
                            <a href="#" type="button" class="btn btn-outline-success mt-3">Auftrag beabeiten</a>
                        </form>
                        <form class="ms-3" action="">
                            <a href="#" type="button" class="btn btn-outline-danger mt-3">Auftrag löschen</a>
                        </form>
                    </div>
                </div>


            </div>
            <div class="dashboard-box-inline-green card mb-3">
                <div class="box-text card-body">
                    <div class="row ">
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Jobnummer: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobNumber ?></span></div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Datum: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobDate ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Mitarbeiter: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobUser ?> </span></div>
                            </div>
                        </div>
                        <div class="col-md-3  mb-1">
                            <div class="row mt-2">
                                <div class="col-md-5">Gewicht: </div>
                                <div class="col-md-6"><span class="text-info"><?= $jobTotalSCU ?> SCU </span></div>
                            </div>
                        </div>

                        <div class="container mt-3">
                            <div class="progress" style="height: 26px;">
                                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                    40%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <span>Status: </span><span class="text-warning"> <?= $jobStatus ?></span>
                    </div>
                    <div class="d-flex ">
                        <form action="">
                            <a href="#" type="button" class="btn btn-outline-success mt-3">Auftrag beabeiten</a>
                        </form>
                        <form class="ms-3" action="">
                            <a href="#" type="button" class="btn btn-outline-danger mt-3">Auftrag löschen</a>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    
    <div class="alert text-center cookiealert" role="alert">
        <b>Magst du auch so Kekse wie ich?</b> &#x1F36A; Wir brauchen Kekse, um dir die besten Funktionen dieser Seite zu geben.
        <a href="https://cookiesandyou.com/" target="_blank">Erfahre mehr</a> |
        <a href="datenschutz.php" target="_blank">Datenschutz</a>

        <button type="button" class="btn btn-primary btn-sm acceptcookies">
            Zustimmen
        </button>
    </div>
    
    <?php
    require "structure/footer.php";
    ?>

   
</body>
</html>
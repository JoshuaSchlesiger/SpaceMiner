<?php

require "structure/header.php";
require "functions/handleJobs.php";
require "functions/database.php";


require "objects/Crew.php";
require "objects/Job.php";
require "objects/Player.php";

session_start();

if(isset($_SESSION["alert"])){
    $msg = $_SESSION['alert'];
    echo "<script type='text/javascript'>alert('$msg');</script>";
    unset($_SESSION['alert']);
}


if (isset($_POST["logout"])) {
    $_SESSION["loggedIn"] = "false";
    session_destroy();
}

if (isset($_SESSION["loggedIn"])) {
    if ($_SESSION["loggedIn"] == "false") {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}



setSingleJobs_Session();

$hello = unserialize($_SESSION["jobs"]);
print_r($hello);



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
$jobCrewCount = 0;
$jobCargoWeight = 0;
$jobProceeds = 0;
$jobProfit = 0;
$jobCrewProfit = 0;
?>


<body>

    <nav class="nv navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid ps-4">
            <a class=" navbar-brand mb-auto nv-brand" href="index.php">SpaceMiner</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="auftraege.php">Aufträge</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berechnungen.php">Berechnungen</a>
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

    <div class="job-topboxes">
        <div class="jobAdd-box card">
            <h5 class="header-text card-header text-center">Erstelle einen neuen Auftrag</h5>
            <div class="card-body">

                <div class="container">
                    <div class="row">
                        <div class="col-xxl-2 text-center mt-3">
                            <label for="crewname" class="col-form-label">Crewname: </label>
                        </div>
                        <div class="col-xxl-4 mt-3">
                            <input type="text" id="crewname" class="form-control">
                        </div>

                        <div class="col-xxl-6 mt-3">
                            <div class="mt-1">
                                <span>
                                    <i>Muss zwischen 5 und 20 Zeichen lang sein</i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-xxl-2 col-xxl-4 mt-3">
                            <button class="job-addcrew button add form-control btn btn-outline-success" onclick="add_crew()">ADD</button>
                        </div>
                    </div>
                </div>


                <hr>

                <div class="container">
                    <div class="row">
                        <div class="col-xxl-2 text-center mt-3">
                            <label for="selectCrew" class="col-form-label">Crew wählen: </label>
                        </div>
                        <div class="col-xxl-4 mt-3">
                            <div class="dropdown">
                                <a class="btn btn-primary form-control" id="selectCrew" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">&nbsp</a>

                                <div class="collapse" id="collapseExample">
                                    <div class="list-group list-group-light list-group-small " id="crewList">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 mt-3">
                            <div class="mt-1">
                                <span>
                                    <i>Wähle die Crew, die du bearbeiten möchtest</i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-4">


                <div id="boxMinerScouts">
                    <h4 class="header-text text-center mb-2 mt-4" id="crewHeader">CrewNick</h4>

                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-2 text-center mt-3">
                                <label for="minername" class="col-form-label">Miner: </label>
                            </div>
                            <div class="col-xxl-4 mt-3">
                                <input type="text" id="minername" class="form-control">
                            </div>

                            <div class="col-xxl-4 mt-3">
                                <div class="dropdown">
                                    <a class="btn btn-warning form-control" id="selectMiner" data-bs-toggle="collapse" href="#collapseMiner" role="button" aria-expanded="false" aria-controls="collapseMiner">
                                        &nbsp
                                    </a>
                                    <div class="collapse" id="collapseMiner">
                                        <div class="list-group list-group-light list-group-small" id="minerList">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-xxl-2 col-xxl-4 mt-3">
                                <button class="job-addcrew button add form-control btn btn-outline-success" onclick="add_miner()">ADD</button>
                            </div>
                            <div class="col-xxl-4 mt-3">
                                <button class="job-addcrew button add del form-control btn btn-outline-danger" onclick="del_miner()">DEL</button>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-2 text-center mt-3">
                                <label for="scoutname" class="col-form-label">Scouts: </label>
                            </div>
                            <div class="col-xxl-4 mt-3">
                                <input type="text" id="scoutname" class="form-control">
                            </div>

                            <div class="col-xxl-4 mt-3">
                                <div class="dropdown">
                                    <a class="btn btn-warning form-control" id="selectScout" data-bs-toggle="collapse" href="#collapseScout" role="button" aria-expanded="false" aria-controls="collapseScout">
                                        &nbsp
                                    </a>
                                    <div class="collapse" id="collapseScout">
                                        <div class="list-group list-group-light list-group-small" id="scoutList">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="offset-xxl-2 col-xxl-4 mt-3">
                                <button class="job-addcrew button add form-control btn btn-outline-success" onclick="add_scout()">ADD</button>
                            </div>
                            <div class="col-xxl-4 mt-3">
                                <button class="job-addcrew button add del form-control btn btn-outline-danger" onclick="del_scout()">DEL</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>


                <div class="container">
                    <div class="row ">
                        <div class="offset-xxl-2 col-xxl-4 mt-3">
                            <button class="job-addcrew buttonForm btn btn-outline-light" onclick="save()"><span>SAVE</span></button>
                        </div>
                        <div class="col-xxl-4 mt-3">
                            <button class="job-addcrew buttonForm btn btn-outline-warning" onclick="reset()"><span>RESET</span></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="jobAdd-box right card">
            <h5 class="header-text card-header text-center">Bearbeite einen laufenden Auftrag</h5>

            <div class="job-scroll box-text card-body">

                <div class="dashboard-box-inline-yellow card mb-3">
                    <div class="box-text card-body">
                        <div class="row">
                            <div class="col-md mb-1">
                                <div class="row mt-2">
                                    <div class="col-md-5">Jobnummer: </div>
                                    <div class="col-md-6"><span class="text-info"><?= $jobNumber ?></span></div>
                                </div>
                            </div>
                            <div class="col-md mb-1">
                                <div class="row mt-2">
                                    <div class="col-md-5">Datum: </div>
                                    <div class="col-md-6"><span class="text-info"><?= $jobDate ?> </span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md  mb-1">
                                <div class="row mt-2">
                                    <div class="col-md-5">Mitarbeiter: </div>
                                    <div class="col-md-6"><span class="text-info"><?= $jobUser ?> </span></div>
                                </div>
                            </div>
                            <div class="col-md  mb-1">
                                <div class="row mt-2">
                                    <div class="col-md-5">Gewicht: </div>
                                    <div class="col-md-6"><span class="text-info"><?= $jobTotalSCU ?> SCU </span>
                                    </div>
                                </div>
                            </div>

                            <div class="container mt-3">
                                <div class="progress">
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

    </div>

    <div class="jobEdit-box card">
        <h5 class="header-text card-header">Dein Auftrag</h5>
        <div class="box-text card-body mt-2">
            <div class="row justify-content-center">
                <div class="col offset-xl-1">Jobnummer: </div>
                <div class="col"><span class="text-info"><?= $jobNumber ?></div>

                <div class="col">Teilnehmeranzahl:</div>
                <div class="col"><span class="text-info"><?= $jobUser ?></div>

                <div class="col">Crewanzahl:</div>
                <div class="col"><span class="text-info"><?= $jobCrewCount ?></div>

                <div class="col">Gesamtgewicht:</div>
                <div class="col"><span class="text-info"><?= $jobCargoWeight ?> SCU</div>
            </div>

            <hr>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <div class="h3 font jobDiv">ERTRAG</div>
                    </div>
                    <div class="col text-center">
                        <div class="h3 font jobDiv">GEWINN</div>
                    </div>
                </div>
            </div>
            <div class="container mt-1">
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <div class="h4 text-success"><?= $jobProceeds ?> aUEC</div>
                    </div>
                    <div class="col text-center">
                        <div class="h4 text-success"><?= $jobProceeds ?> aUEC</div>
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <div class="progress">
                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                        40%
                    </div>
                </div>
            </div>

            <div class="mt-5 d-flex justify-content-center">
                <div class="job-addcrew align-items-center">
                    <div class="dropdown">
                        <a class="btn btn-outline-warning btn-lg form-control" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                            <i>'Wähle deine Crew'</i>
                        </a>

                        <div class="collapse" id="collapseExample2">
                            <div class="list-group list-group-light list-group-small ">
                                <a href="#" class="list-group-item list-group-item-action text-center">A</a>
                                <a href="#" class="list-group-item list-group-item-action text-center">A</a>
                                <a href="#" class="list-group-item list-group-item-action text-center">A</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-md-stretch">
                <div class="col-md-6 mt-5">
                    <div class="h-100 border rounded-3">

                        <div class="container">
                            <div class="mt-5 text-center">
                                <div class="h2 font jobDiv">Verkaufen</div>
                            </div>

                            <div class="row mt-5 mb-4 d-flex justify-content-center">
                                <div class="col-6 ">Wähle den Lagerist/ Verkäufer: </div>
                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4 d-flex justify-content-center">
                                <div class="col-6 ">Wähle die Miningstation: </div>
                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4 d-flex justify-content-center">
                                <div class="col-6 ">Wähle den Auftrag: </div>
                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>


                            <div class="progress crew mb-5">
                                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:45%">
                                    40%
                                </div>
                            </div>

                            <hr>


                            <div class="mt-5">
                                <div class="row mt-4 d-flex justify-content-center">
                                    <div class="col-6 ">Wähle die Verkaufsstation: </div>
                                    <div class="col-3 text-info jobSelectCrewOptions">
                                        <select class="form-select">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-evenly mt-5 mb-5 jobCrewButtonstop">

                                <a href="#" type="button" class="btn btn-outline-success jobCrewButtons">Abschließen</a>
                                <a href="#" type="button" class="btn btn-outline-danger jobCrewButtons">Löschen</a>

                            </div>


                            <hr class="mt-4">

                            <div class="justify-content-center">
                                <div class="text-center mt-4">
                                    <span class="h3 font">Crew-ertrag</span>
                                </div>
                                <div class="justify-content-center">
                                    <div class="text-center mt-2 mb-3">
                                        <span class="h4 text-success"><?= $jobCrewProfit ?> aUEC</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 mt-5">
                    <div class="h-100 border rounded-3">

                        <div class="container">
                            <div class="mt-5 text-center">
                                <div class="h2 font jobDiv">Einlagern</div>
                            </div>

                            <div class="row mt-5 mb-4 d-flex justify-content-center">
                                <div class="col-6 ">Wähle die Miningstation </div>
                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>

                            <hr>


                            <div class="row mt-4 d-flex justify-content-center">
                                <div class="col-6">Steinart: </div>

                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row mt-4 d-flex justify-content-center">
                                <div class="col-6">Gewicht: </div>

                                <div class="col-3 jobSelectCrewOptions">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row  mt-3 d-flex justify-content-center">
                                <div class="col-6"></div>

                                <div class="col-3 jobSelectCrewOptions">
                                    <button type="button" class="button btn btn-outline-success">ADD</button>
                                </div>
                            </div>
                            </form>

                            <hr>


                            <div class="row mt-4 d-flex justify-content-center">
                                <div class="col-6">Einlagerung bearbeiten: </div>

                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row  mt-3 d-flex justify-content-center">
                                <div class="col-6"></div>

                                <div class="col-3 jobSelectCrewOptions">
                                    <button type="button" class="button btn btn-outline-danger">DEL</button>
                                    <button type="button" class="button btn btn-outline-info">SEL</button>
                                </div>
                            </div>

                            <div class="row mt-5 d-flex justify-content-center">
                                <div class="col-6">Dauer des Auftrags: </div>

                                <div class="col-3 jobSelectCrewOptions">
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="text" placeholder="h" class="form-control">
                                        </div>
                                        <div class="col-5">
                                            <input type="text" placeholder="min" class="form-control">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row mt-4 d-flex justify-content-center">
                                <div class="col-6">Kosten: </div>

                                <div class="col-3 jobSelectCrewOptions">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <hr class="mt-4">

                            <div class="d-flex justify-content-evenly mt-4 mb-4 jobCrewButtonstop">

                                <button class="btn btn-outline-success jobCrewButtons">Hinzufügen</button>
                                <button class="btn btn-outline-warning jobCrewButtons">Zurücksetzen</button>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 mb-5">
                <hr>
                <hr>
            </div>

            <div class="row align-items-md-stretch mt-3">
                <div class="col-md-6">
                    <div class="h-100 border rounded-3">

                        <div class="container">
                            <div class="mt-5 text-center">
                                <div class="h2 font jobDiv">Eingehende Bezahlung:</div>
                            </div>

                            <div class="row mt-5 mb-4 d-flex justify-content-center">
                                <div class="col-6 ">Wähle Spieler: </div>
                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <hr>

                            <div class="justify-content-center">
                                <div class="text-center mt-4 ">
                                    <span class="h3 font">Profit:</span>
                                </div>
                                <div class="justify-content-center">
                                    <div class="text-center mt-2 mb-3">
                                        <span class="h4 text-success"><?= $jobCrewProfit ?> aUEC</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-evenly mt-4 mb-4 jobCrewButtonstop">

                                <button class="btn btn-outline-success jobCrewButtons">Einholen</button>
                                <button class="btn btn-outline-warning jobCrewButtons">Zurücksetzen</button>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="h-100 border rounded-3">

                        <div class="container">
                            <div class="mt-5 text-center">
                                <div class="h2 font jobDiv">Ausgehende Bezahlung:</div>
                            </div>

                            <div class="row mt-5 mb-4 d-flex justify-content-center">
                                <div class="col-6 ">Wähle Spieler: </div>
                                <div class="col-3 text-info jobSelectCrewOptions">
                                    <select class="form-select">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="justify-content-center">
                                <div class="text-center mt-4 ">
                                    <span class="h3 font">Profit:</span>
                                </div>
                                <div class="justify-content-center">
                                    <div class="text-center mt-2 mb-3">
                                        <span class="h4 text-success"><?= $jobCrewProfit ?> aUEC</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-evenly mt-4 mb-4 jobCrewButtonstop">

                                <button class="btn btn-outline-success jobCrewButtons">Auszahlen</button>
                                <button class="btn btn-outline-warning jobCrewButtons">Zurücksetzen</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-4">
            <div class="row ">
                <div class="offset-xxl-1 col-xxl-4 mt-3">
                    <button class="button form-control btn btn-outline-success btn-lg">Abschließen</button>
                </div>
                <div class="offset-xxl-2 col-xxl-4 mt-3">
                    <button class="button form-control btn btn-outline-info btn-lg">Alle bezahlen</button>
                </div>
            </div>

            <div class="row ">
                <div class="offset-xxl-1 col-xxl-4 mt-3">
                    <button class="button form-control btn btn-outline-warning btn-lg">Bezahlungen löschen</button>
                </div>
                <div class="offset-xxl-2 col-xxl-4 mt-3">
                    <button class="button form-control btn btn-outline-danger btn-lg">Löschen</button>
                </div>
            </div>
        </div>






    </div>

    <div class="jobEdit-box card">
        <h5 class="header-text card-header">Abgeschlossene Aufträge</h5>
        <div class="box-text card-body">

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


    <?php
    require "structure/footer.php";
    ?>

    <script src="scripts/add_crew.js"></script>
    <script src="scripts/add_crew_workers.js"></script>

</body>

</html>
<?php

require "structure/header.php";
require "functions/handleJobs.php";
require "functions/database.php";
require "functions/handleSession.php";

require "objects/Crew.php";
require "objects/Job.php";
require "objects/Player.php";
require "objects/Task.php";


session_start();

$conn = connect();



if (isset($_SESSION["alert"])) {
    $msg = $_SESSION['alert'];
    echo "<script type='text/javascript'>alert('$msg');</script>";
    unset($_SESSION['alert']);
}


#region Login/Logout

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

#endregion



if (isset($_POST["delete"])) {

    deleteJob_Session($_POST["delete"]); // Führt auch das SQL aus
    unset($_SESSION["edit"]);
}


$jobs = unserialize($_SESSION["jobs"]);
$crews = unserialize($_SESSION["crews"]);
$players = unserialize($_SESSION["players"]);
$tasks = unserialize($_SESSION["tasks"]);


#region EDIT JOB

if (isset($_POST["edit"])) {
    $_SESSION["edit"] = $_POST["edit"];
}

if (isset($_SESSION["edit"])) {

    $_SESSION["selectedJobID"] = $_SESSION["edit"];
    echo '<script src="scripts/scrollView.js"></script>';

    $JobPosInArray = 0;

    for ($i = 0; $i < count($jobs); $i++) {
        if ($jobs[$i]->getID() == $_SESSION["selectedJobID"]) {
            $JobPosInArray = $i;
        }
    }
}

if(isset($_POST["selectedCrew"])){
    $_SESSION["selectedCrew"] = $_POST["selectedCrew"];


}



#endregion



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

                <?php
                for ($i = count($jobs) - 1; $i >= 0; $i--) {
                ?>
                    <div class="dashboard-box-inline-yellow card mb-3">
                        <div class="box-text card-body">
                            <div class="row">
                                <div class="col-md mb-1">
                                    <div class="row mt-2">
                                        <div class="col-md-5">Jobnummer: </div>
                                        <div class="col-md-6"><span class="text-info"><?= $jobs[$i]->getNumber() ?></span></div>
                                    </div>
                                </div>
                                <div class="col-md mb-1">
                                    <div class="row mt-2">
                                        <div class="col-md-5">Datum: </div>
                                        <div class="col-md-6"><span class="text-info"><?= getDateofJob($i) ?> </span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md  mb-1">
                                    <div class="row mt-2">
                                        <div class="col-md-5">Mitarbeiter: </div>
                                        <div class="col-md-6"><span class="text-info"><?= getPeopleCount($i) ?></span></div>
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
                            <div class="d-flex">
                                <form method="POST">
                                    <button class="btn btn-outline-success mt-3" name="edit" value="<?= $jobs[$i]->getID(); ?>">Auftrag beabeiten</button>
                                </form>
                                <form class="ms-3" method="POST">
                                    <button class="btn btn-outline-danger mt-3" name="delete" value="<?= $jobs[$i]->getID(); ?>">Auftrag löschen</button>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="jobEdit-box card" id="yourJob">
        <h5 class="header-text card-header">Bearbeite deinen Auftrag</h5>
        <?php


        if (isset($_SESSION["edit"])) {
        ?>
            <div class="box-text card-body mt-2">
                <div class="row justify-content-center">
                    <div class="col offset-xl-1">Jobnummer: </div>
                    <div class="col"><span class="text-info"><?= $jobs[$JobPosInArray]->getNumber(); ?></div>

                    <div class="col">Teilnehmeranzahl:</div>
                    <div class="col"><span class="text-info"><?= getPeopleCount($JobPosInArray); ?></div>

                    <div class="col">Crewanzahl:</div>
                    <div class="col"><span class="text-info"><?= getCrewCount($JobPosInArray) ?></div>

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
                            <a class="btn btn-outline-warning btn-lg form-control job-editCrewButton" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                <?php
                                if (isset($_POST["selectedCrew"])) { 
                                ?>
                                    <i><?= $crews[$_POST["selectedCrew"]]->getName(); ?></i>

                                <?php
                                } else {
                                    echo "<i>'Wähle deine Crew'</i>";
                                }
                                ?>

                            </a>

                            <div class="collapse" id="collapseExample2">
                                <div class="list-group list-group-light list-group-small">
                                    <form method="POST">
                                        <?php
                                        for ($i = 0; $i < count($_SESSION["crewPosInArray"]); $i++) {
                                            $pos = $_SESSION["crewPosInArray"][$i];
                                        ?>
                                            <button class="list-group-item list-group-item-action text-center" value="<?= $pos ?>" name="selectedCrew"><?= $crews[$pos]->getName(); ?></button>
                                        <?php
                                        }

                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST["selectedCrew"])) {
                ?>
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
                                                <?php

                                                $crewPlayer = getPeoplenOfCrew($crews[$_POST["selectedCrew"]]->getId());
                                                for ($i = 0; $i < count($crewPlayer); $i++) {
                                                    echo '<option value=' . $crewPlayer[$i]->getID() . '>' . $crewPlayer[$i]->getName() . '</option>';
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-4 d-flex justify-content-center">
                                        <div class="col-6 ">Wähle die Miningstation: </div>
                                        <div class="col-3 text-info jobSelectCrewOptions">
                                            <select class="form-select">
                                                <?php
                                                for ($i = 0; $i < count($_SESSION["refineryStations"]); $i++) {
                                                    echo '<option value=' . $_SESSION["sellingStations"][$i]["id"] . '>' . $_SESSION["refineryStations"][$i]["name"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-4 d-flex justify-content-center">
                                        <div class="col-6 ">Wähle den Auftrag: </div>
                                        <div class="col-3 text-info jobSelectCrewOptions">
                                            <select class="form-select" onchange="getTimeOfTask()" id="selectTask">
                                                <?php

                                                $tasksCrew = getTasksOfCrew($crews[$_POST["selectedCrew"]]->getId());
                                                for ($i = 0; $i < count($tasksCrew); $i++) {

                                                    if(count($tasksCrew[$i]->getTypeId()) >= 2){
                                                        echo '<option value=' . $tasksCrew[$i]->getID() . '>' . substr($_SESSION['oreTypes'][$tasksCrew[$i]->getTypeId()[0] - 1]["name"], 0, 2) . ": " . $tasksCrew[$i]->getMass()[0] . ", " . substr($_SESSION['oreTypes'][$tasksCrew[$i]->getTypeId()[1] - 1]["name"], 0, 2) . ": " . $tasksCrew[$i]->getMass()[1]. " ..." .  '</option>';
                                                    }
                                                    else{
                                                        echo '<option value=' . $tasksCrew[$i]->getID() . '>' .  substr($_SESSION['oreTypes'][$tasksCrew[$i]->getTypeId()[0] - 1]["name"], 0, 2) . ": " . $tasksCrew[$i]->getMass()[0] .  '</option>';
                                                    }


                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <?php

                                    $taskThere = false;

                                    if(count($tasksCrew) >= 1){

                                        $duration = $tasksCrew[0]->getDuration() * 60;
                                        $createTime = $tasksCrew[0]->getCreateTime();
                                        $currentTime = time();
                                            
                                        $remainingTime = $duration - ($currentTime - $createTime);

                                        $taskThere = true;
                                                
                                    }

                                    ?>


                                    <div class="progress crew mb-3">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar"  id="progressBarTask" aria-valuemin="0" aria-valuemax="100" style="width:                                            <?php
                                                if($taskThere){
                                                    if($remainingTime <= 0){
                                                        echo ("100");
                                                    } else{
                                                        echo (round($duration/$remainingTime *10));
                                                    }

                                                }
                                                else{
                                                    echo ("0");
                                                }
                                            ?>%">
                                            
                                            <?php
                                                if($taskThere){
                                                    if($remainingTime <= 0){
                                                        echo ("100%");
                                                    } else{
                                                        echo (round($duration/$remainingTime *10) . "%");
                                                    }
                                                }
                                                else{
                                                    echo ("0%");
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="text-center h6 text-info mb-3" id="duration">
                                        <?php 

                                        if($taskThere){
                                                if($remainingTime<=0){
                                                    echo("Der Shit ist durch!");
                                                }else{
                                                    $minuten = floor(($remainingTime/60));

                                                    $stunden = floor($minuten / 60); 
                                                    $restminuten = $minuten % 60; 
                                                    echo("Restzeit: ");
                                                    echo($stunden . "h ");
                                                    echo($restminuten . "min");
                                                }
                                        }
                                        ?>
                                    </div>

                                    <hr>

                                    <div class="mt-5">
                                        <div class="row mt-4 d-flex justify-content-center">
                                            <div class="col-6 ">Wähle die Verkaufsstation: </div>
                                            <div class="col-3 text-info jobSelectCrewOptions">
                                                <select class="form-select">
                                                    <?php
                                                    for ($i = 0; $i < count($_SESSION["sellingStations"]); $i++) {
                                                        echo '<option value=' . $_SESSION["sellingStations"][$i]["id"] . '>' . $_SESSION["sellingStations"][$i]["name"] . '</option>';
                                                    }
                                                    ?>
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


                                    <div class="row mt-5 d-flex justify-content-center">
                                        <div class="col-6">Steinart: </div>

                                        <div class="col-3 text-info jobSelectCrewOptions">
                                            <select class="form-select" id="oretype">
                                                <?php
                                                for ($i = 0; $i < count($_SESSION['oreTypes']); $i++) {
                                                    echo '<option value=' . $_SESSION['oreTypes'][$i]["id"] . '>';
                                                    echo $_SESSION['oreTypes'][$i]["name"];
                                                    echo '</option>';
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mt-4 d-flex justify-content-center ">
                                        <div class="col-6">Gewicht: </div>
                                        <div class="col-3 jobSelectCrewOptions">
                                            <input type="number" class="form-control" id="weight" placeholder="0 cSCU" min="1" max="99999" required>
                                        </div>



                                    </div>
                                    <div class="row mt-2 mb-4 d-flex justify-content-center">
                                        <div class="col-6"></div>

                                        <div class="col-3 jobSelectCrewOptions">
                                            <button type="button" class="button btn btn-outline-success" onclick="addTypeWeight()" id="addTypeWeight">ADD</button>
                                        </div>
                                    </div>
                                    </form>

                                    <hr>


                                    <div class="row mt-4 d-flex justify-content-center">
                                        <div class="col-6">Einlagerung bearbeiten: </div>

                                        <div class="col-3 text-info jobSelectCrewOptions">
                                            <select class="form-select" id="typeWeightList">
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mt-2 mb-4 d-flex justify-content-center">
                                        <div class="col-6"></div>

                                        <div class="col-3 jobSelectCrewOptions">
                                            <button type="button" class="button btn btn-outline-danger" onclick="deleteTypeWeight()" id="deleteTypeWeight">DEL</button>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row mt-4 d-flex justify-content-center">
                                        <div class="col-6 ">Wähle die Miningstation </div>
                                        <div class="col-3 text-info jobSelectCrewOptions">
                                            <select class="form-select" id="miningStation">
                                                <?php
                                                for ($i = 0; $i < count($_SESSION["refineryStations"]); $i++) {
                                                    echo '<option value=' . $_SESSION["refineryStations"][$i]["id"] . '>' . $_SESSION["refineryStations"][$i]["name"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mt-5 d-flex justify-content-center">
                                        <div class="col-6">Dauer des Auftrags: </div>

                                        <div class="col-3 jobSelectCrewOptions">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="number" placeholder="h" class="form-control" min="0" max="999" id="hours">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" placeholder="min" class="form-control" min="0" max="59" id="minutes">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row mt-4 d-flex justify-content-center">
                                        <div class="col-6">Kosten: </div>

                                        <div class="col-3 jobSelectCrewOptions">
                                            <input type="number" class="form-control" min="0" max="999999" id="costs">
                                        </div>
                                    </div>

                                    <hr >

                                    <div class="d-flex justify-content-evenly mt-4 mb-4 jobCrewButtonstop">

                                        <button class="btn btn-outline-success jobCrewButtons" onclick="saveTask()">Hinzufügen</button>
                                        <button class="btn btn-outline-warning jobCrewButtons" onclick="resetTask()">Zurücksetzen</button>

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

                <?php
                } else {
                    echo '<hr class="mt-4 mb-4">';
                }
                ?>



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
                            <form method="POST">
                                <button class="button form-control btn btn-outline-danger btn-lg" name="delete" value="<?= $jobs[$JobPosInArray]->getID(); ?>">Löschen</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>

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

                    <div class="mt-3" id="test">
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
    <script src="scripts/add_task.js"></script>

</body>

</html>
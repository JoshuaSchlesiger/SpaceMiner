<?php


function setJobs_Session()
{

    $conn = connect();

    $jobs = [];
    $crews = [];
    $players = [];
    $tasks = [];

    $dataJobs = getJobs($conn);

    for ($i = 0; $i < count($dataJobs); $i++) {
        $job = new Job($dataJobs[$i]["id"], $dataJobs[$i]["number"], $dataJobs[$i]["time"]);
        array_push($jobs, $job);

        $dataCrews = getCrews($conn, $dataJobs[$i]["id"]);

        for ($y = 0; $y < count($dataCrews); $y++) {
            $crew = new Crew($dataJobs[$i]["id"], $dataCrews[$y]["name"], $dataCrews[$y]["id"]);
            array_push($crews, $crew);

            $dataPlayer = getPlayers($conn, $dataCrews[$y]["id"]);

            for ($x = 0; $x < count($dataPlayer); $x++) {
                $player = new Player($dataPlayer[$x]["name"], $dataPlayer[$x]["id"], $dataCrews[$y]["id"], $dataPlayer[$x]["type"]);
                array_push($players, $player);
            }

            $dataTasks = getTask($conn, $dataCrews[$y]["id"]);
            for ($u = 0; $u < count($dataTasks); $u++) {

                $dataTypeTask = getTypeTask($conn, $dataTasks[$u]["id"]);
                $masses = [];
                $types = [];
                for ($q = 0; $q < count($dataTypeTask); $q++) {
                    $mass = $dataTypeTask[$q]["mass"];
                    array_push($masses, $mass);

                    $type = $dataTypeTask[$q]["type_id"];
                    array_push($types, $type);
                }

                $task = new Task($dataTasks[$u]["id"], $dataTasks[$u]["duration"], $dataCrews[$y]["id"], $dataTasks[$u]["refinery_station_id"], $masses, $type, $dataTasks[$u]["costs"], $dataTasks[$u]["create_time"]);
                array_push($tasks, $task);
            }
        }
    }


    $_SESSION["jobs"] = array();
    $_SESSION["crews"] = array();
    $_SESSION["players"] = array();
    $_SESSION["tasks"] = array();

    $_SESSION["jobs"] = serialize($jobs);
    $_SESSION["crews"] = serialize($crews);
    $_SESSION["players"] = serialize($players);
    $_SESSION["tasks"] = serialize($tasks);
}

function setSingleJobs_Session()
{

    $jobs = unserialize($_SESSION["jobs"]);
    $crews = unserialize($_SESSION["crews"]);
    $players = unserialize($_SESSION["players"]);

    $conn = connect();

    $numJobs = count($jobs);

    if ($numJobs != 0) {
        $dataJobs = getLatestJob($conn);

        if ($dataJobs["id"] != $jobs[$numJobs - 1]->getid()) {

            $job = new Job($dataJobs["id"], $dataJobs["number"], $dataJobs["time"]);
            array_push($jobs, $job);

            $dataCrews = getCrews($conn, $dataJobs["id"]);

            for ($y = 0; $y < count($dataCrews); $y++) {
                $crew = new Crew($dataJobs["id"], $dataCrews[$y]["name"], $dataCrews[$y]["id"]);
                array_push($crews, $crew);

                $dataPlayer = getPlayers($conn, $dataCrews[$y]["id"]);

                for ($x = 0; $x < count($dataPlayer); $x++) {
                    $player = new Player($dataPlayer[$x]["name"], $dataPlayer[$x]["id"], $dataCrews[$y]["id"], $dataPlayer[$x]["type"]);
                    array_push($players, $player);
                }
            }

            $_SESSION["jobs"] = serialize($jobs);
            $_SESSION["crews"] = serialize($crews);
            $_SESSION["players"] = serialize($players);
        }
    } else {

        $dataJobs = getLatestJob($conn);

        $job = new Job($dataJobs["id"], $dataJobs["number"], $dataJobs["time"]);
        array_push($jobs, $job);

        $dataCrews = getCrews($conn, $dataJobs["id"]);

        for ($y = 0; $y < count($dataCrews); $y++) {
            $crew = new Crew($dataJobs["id"], $dataCrews[$y]["name"], $dataCrews[$y]["id"]);
            array_push($crews, $crew);

            $dataPlayer = getPlayers($conn, $dataCrews[$y]["id"]);

            for ($x = 0; $x < count($dataPlayer); $x++) {
                $player = new Player($dataPlayer[$x]["name"], $dataPlayer[$x]["id"], $dataCrews[$y]["id"], $dataPlayer[$x]["type"]);
                array_push($players, $player);
            }
        }

        $_SESSION["jobs"] = serialize($jobs);
        $_SESSION["crews"] = serialize($crews);
        $_SESSION["players"] = serialize($players);
    }
}

function setSingleTask_Session($crew_id){
    $tasks = unserialize($_SESSION["tasks"]);

    $conn = connect();

    $numTasks = count($tasks);

    if ($numTasks != 0) {
        $dataTasks = getLatestTask($conn, $crew_id);

        if ($dataTasks["id"] != $tasks[$numTasks - 1]->getId()) {


                $dataTypeTask = getTypeTask($conn, $dataTasks["id"]);
                $masses = [];
                $types = [];
                for ($q = 0; $q < count($dataTypeTask); $q++) {
                    $mass = $dataTypeTask[$q]["mass"];
                    array_push($masses, $mass);

                    $type = $dataTypeTask[$q]["type_id"];
                    array_push($types, $type);
                }

                $task = new Task($dataTasks["id"], $dataTasks["duration"], $crew_id, $dataTasks["refinery_station_id"], $masses, $type, $dataTasks["costs"], $dataTasks["create_time"]);
                array_push($tasks, $task);


            $_SESSION["tasks"] = serialize($tasks);
        }
    } else {

        $dataTasks = getLatestTask($conn, $crew_id);

            $dataTypeTask = getTypeTask($conn, $dataTasks["id"]);
            $masses = [];
            $types = [];
            for ($q = 0; $q < count($dataTypeTask); $q++) {
                $mass = $dataTypeTask[$q]["mass"];
                array_push($masses, $mass);

                $type = $dataTypeTask[$q]["type_id"];
                array_push($types, $type);
            }

            $task = new Task($dataTasks["id"], $dataTasks["duration"], $crew_id, $dataTasks["refinery_station_id"], $masses, $type, $dataTasks["costs"], $dataTasks["create_time"]);
            array_push($tasks, $task);



        $_SESSION["tasks"] = serialize($tasks);
    }

}

function deleteJob_Session($job_id)
{

    $conn = connect();
    deleteJob($conn, $job_id);

    $jobs = unserialize($_SESSION["jobs"]);
    $crews = unserialize($_SESSION["crews"]);
    $players = unserialize($_SESSION["players"]);
    $tasks = unserialize($_SESSION["tasks"]);



    for ($i = 0; $i < count($jobs); $i++) {

        if ($jobs[$i]->getID() == $job_id) {
            for ($y = 0; $y < count($crews); $y++) {

                if ($crews[$y]->getJobid() == $job_id) {

                    for ($x = 0; $x < count($players); $x++) {

                        if ($players[$x]->getCrewID() == $crews[$y]->getID()) {
                            array_splice($players, $x);
                        }
                    }


                    for($u = 0; $u < count($tasks); $u++){

                        if ($tasks[$u]->getCrewid() == $crews[$y]->getID()){
                            array_splice($tasks, $u);
                        }
                    }
                    array_splice($crews, $y);
                }
            }
            array_splice($jobs, $i);
        }
    }

    $_SESSION["jobs"] = serialize($jobs);
    $_SESSION["crews"] = serialize($crews);
    $_SESSION["players"] = serialize($players);
    $_SESSION["tasks"] = serialize($tasks);
}

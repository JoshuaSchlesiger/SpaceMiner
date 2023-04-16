<?php


function setJobs_Session()
{

    $conn = connect();

    $jobs = [];
    $crews = [];
    $players = [];

    $dataJobs = getJobs($conn);

    for($i = 0; $i< count($dataJobs); $i++){
        $job = new Job($dataJobs[$i]["id"], $dataJobs[$i]["number"], $dataJobs[$i]["time"]);
        array_push($jobs, $job);

        $dataCrews = getCrews($conn, $dataJobs[$i]["id"]);

        for($y = 0; $y< count($dataCrews); $y++){
            $crew = new Crew($dataJobs[$i]["id"], $dataCrews[$y]["name"], $dataCrews[$y]["id"]);
            array_push($crews, $crew);

            $dataPlayer = getPlayers($conn,$dataCrews[$y]["id"]);

            for($x = 0; $x< count($dataPlayer); $x++){
                $player = new Player($dataPlayer[$x]["name"],$dataPlayer[$x]["id"], $dataCrews[$y]["id"], $dataPlayer[$x]["type"]);
                array_push($players, $player);
            }
        }

    }


    $_SESSION["jobs"] = array();
    $_SESSION["crews"] = array();
    $_SESSION["players"] = array();

    $_SESSION["jobs"] = serialize($jobs);
    $_SESSION["crews"] = serialize($crews);
    $_SESSION["players"] = serialize($players);
}

function setSingleJobs_Session()
{


    $jobs = unserialize($_SESSION["jobs"]);
    $crews = unserialize($_SESSION["crews"]);
    $players = unserialize($_SESSION["players"]);

    $conn = connect();

    $dataJobs = getLatestJob($conn);

    $numJobs = count($jobs);

        if ($dataJobs["id"] != $jobs[$numJobs-1]->getid()) {

            $job = new Job($dataJobs["id"], $dataJobs["number"], $dataJobs["time"]);
            array_push($jobs, $job);

            $dataCrews = getCrews($conn, $dataJobs["id"]);

            for($y = 0; $y< count($dataCrews); $y++){
                $crew = new Crew($dataJobs["id"], $dataCrews[$y]["name"], $dataCrews[$y]["id"]);
                array_push($crews, $crew);
    
                $dataPlayer = getPlayers($conn,$dataCrews[$y]["id"]);
    
                for($x = 0; $x< count($dataPlayer); $x++){
                    $player = new Player($dataPlayer[$x]["name"], $dataPlayer[$x]["id"], $dataCrews[$y]["id"], $dataPlayer[$x]["type"]);
                    array_push($players, $player);
                }

            }
            
            $_SESSION["jobs"] = serialize($jobs);
            $_SESSION["crews"] = serialize($crews);
            $_SESSION["players"] = serialize($players);
        }
}

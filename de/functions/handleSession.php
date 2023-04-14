<?php


function getPeopleCount(int $jobInArray){
    $jobs = unserialize($_SESSION["jobs"]);
    $crews = unserialize($_SESSION["crews"]);
    $players = unserialize($_SESSION["players"]);

    $jobID = $jobs[$jobInArray]->getID();
    
    $number = 0;

    $playerPosInArray = [];

    for($y = 0; $y < count($crews); $y++){
        if($jobID == $crews[$y]->getJobid()){
            for($x = 0; $x < count($players); $x++){
                if($crews[$y]->getid() == $players[$x]->getCrewid()){
                    $number++;
                    array_push($playerPosInArray, $y);
                    $_SESSION["playerPosInArray"] = $playerPosInArray;
                }
            }
        }
    }
    return $number;
}

function getDateofJob(int $jobInArray){
    $jobs = unserialize($_SESSION["jobs"]);
    $jobID = $jobs[$jobInArray]->getID();

    $jobPosInArray = [];

    for($y = 0; $y < count($jobs); $y++){
        if($jobID == $jobs[$y]->getID()){
            $time = $jobs[$y]->getTime();
            return date("d/m/Y", $time);
            
            array_push($jobPosInArray, $y);
            $_SESSION["jobPosInArray"] = $jobPosInArray;
        }
    }
    return "error";
}

function getCrewCount(int $jobInArray){
    $jobs = unserialize($_SESSION["jobs"]);
    $crews = unserialize($_SESSION["crews"]);
    $jobID = $jobs[$jobInArray]->getID();

    $number = 0;

    $crewPosInArray = [];

    for($y = 0; $y < count($crews); $y++){
        if($jobID == $crews[$y]->getJobid()){
            $number++;
            array_push($crewPosInArray, $y);
            $_SESSION["crewPosInArray"] = $crewPosInArray;
        }
    }

    return $number;
}

?>
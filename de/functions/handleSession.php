<?php


function getPeopleCount(int $jobInArray){
    $jobs = unserialize($_SESSION["jobs"]);
    $crews = unserialize($_SESSION["crews"]);
    $players = unserialize($_SESSION["players"]);

    $jobID = $jobs[$jobInArray]->getID();
    
    $number = 0;

    for($y = 0; $y < count($crews); $y++){
        if($jobID == $crews[$y]->getJobid()){
            for($x = 0; $x < count($players); $x++){
                if($crews[$y]->getid() == $players[$x]->getCrewid()){
                    $number++;
                }
            }
        }
    }

    return $number;
}

?>
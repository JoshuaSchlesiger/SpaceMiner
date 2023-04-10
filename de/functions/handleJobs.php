<?php

$conn = connect();

$output = getJobs($conn);

$jobs = [];
$crews = [];
$players = [];

for($i = 0; $i< count($output); $i++){

    $scan = true;
    for($y = 0; $y < count($jobs); $y++){
        if($output[$i]["jid"] == $jobs[$y]->getJid()){
            $scan = false;
        }
    }
    if($scan){
        $job = new Job($output[$i]["jid"], $output[$i]["number"]);
        array_push($jobs, $job);
    }

    $scan2 = true;
    for($y = 0; $y < count($crews); $y++){
        if($output[$i]["cid"] == $crews[$y]->getCid()){
            $scan2 = false;
        }
    }
    if($scan2){
        $crew = new Crew($output[$i]["jid"], $output[$i]["cname"], $output[$i]["cid"]);
        array_push($crews, $crew);
    }


    $player = new Player($output[$i]["pname"], $output[$i]["pid"], $output[$i]["cid"], $output[$i]["type"]);
    array_push($players, $player);
}

$_SESSION["jobs"] = $jobs;
$_SESSION["crews"] = $crews;
$_SESSION["players"] = $players;

var_dump($_SESSION["crews"]);

?>
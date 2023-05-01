<?php

require "../objects/Task.php";

session_start();

/*
 Gibt nicht nur die Zeit zurück, sondern auch die Station, damit man weiß wo die Task liegt
*/

if(isset($_POST["id"])){

    $tasks = unserialize($_SESSION["tasks"]);

    for($i = 0; $i < count($tasks); $i++){
        if($tasks[$i]->getID() == $_POST["id"]){
            echo json_encode([$tasks[$i]->getDuration(), $tasks[$i]->getCreateTime(), time(), $_SESSION["refineryStations"][$tasks[$i]->getRefineryStationId() - 1]["name"]]);
        }
    }
}

?>
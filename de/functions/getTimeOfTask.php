<?php

require "../objects/Task.php";

session_start();


if(isset($_POST["id"])){

    $tasks = unserialize($_SESSION["tasks"]);

    for($i = 0; $i < count($tasks); $i++){
        if($tasks[$i]->getID() == $_POST["id"]){
            echo json_encode([$tasks[$i]->getDuration(), $tasks[$i]->getCreateTime(), time()]);
        }
    }
}

?>
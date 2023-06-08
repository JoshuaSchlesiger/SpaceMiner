<?php
require "database.php";
require "handleJobs.php";
require "handleSession.php";

require "../objects/Job.php";
require "../objects/Crew.php";
require "../objects/Task.php";

session_start();


if(isset($_POST["value"])){

    $data["Error"] = null;

    $buffer = $_POST["value"];
    $value = json_decode($buffer);

    if(is_numeric($value)){

        $check = false;

        $tasks = unserialize($_SESSION["tasks"]);

        for($u = 0; $u < count($tasks); $u++){
            if ($value == $tasks[$u]->getID()){
                array_splice($tasks, $u, 1);
                $check = true;
            }
        }

        $_SESSION["tasks"] = serialize($tasks);

        if($check){
            $conn = connect();
            deleteTask($conn, $value);
        }

    }
    else{
        $data["Error"] = "Fehler bei der Überprüfung der TaskID";
    }

    echo json_encode($data);

}
<?php
require "database.php";
require "handleJobs.php";
require "handleSession.php";

require "../objects/Job.php";
require "../objects/Crew.php";
require "../objects/Task.php";

session_start();


if(isset($_POST["values"])){

    $buffer = $_POST["values"];
    $values = json_decode($buffer);

    $data["Error"] = "null";

    echo json_encode($data);

}
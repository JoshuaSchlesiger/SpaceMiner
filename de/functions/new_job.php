<?php
require "database.php";


session_start();

if(isset($_POST["crews"])){
    $crews = json_decode($_POST["crews"]);
    $_SESSION["crews"] = $crews;
    createJob();
}


?>
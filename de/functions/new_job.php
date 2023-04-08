<?php
require "database.php";


session_start();

$crews = json_decode($_POST["crews"]);

createJob();

?>
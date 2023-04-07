<?php

session_start();

$_SESSION["crews"] = json_decode($_POST["crews"]);

?>
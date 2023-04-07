<?php

session_start();

$crews = json_decode($_POST["crews"]);

var_dump($crews[0]->crews[1]);
createJob();

?>
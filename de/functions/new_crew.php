<?php
session_start();
array_push($_SESSION["crewnames"], $_POST["crewname"]);

?>
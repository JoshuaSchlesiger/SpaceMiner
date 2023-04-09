<?php
require "database.php";


session_start();

if(isset($_POST["crews"])){
    $crews = json_decode($_POST["crews"]);



    $numCrews = count($crews);

    $scan = true;

    for ($i = 0; $i < $numCrews; $i++) {
        if (!preg_match('/^[a-z0-9 .\-]+$/i', $crews[$i]->CrewName))
        {
            $scan = false;
        }

        for ($y = 0; $y < $numCrews; $y++) {
            if($y == $i){
                continue;
            }
            if($crews[$i]->CrewName == $crews[$y]->CrewName){
                $scan = false;
            }
        }

        for($y = 0; $y < count($crews[$i]->MinerNames); $y++) {
            if (!preg_match('/^[a-z0-9 .\-]+$/i', $crews[$i]->Minernames[$y]))
                {
                    $scan = false;
                }
        }
        for($y = 0; $y < count($crews[$i]->ScoutNames); $y++) {
            if (!preg_match('/^[a-z0-9 .\-]+$/i', $crews[$i]->ScoutNames[$y]))
                {
                    $scan = false;
                }
        }
    }



    if($scan == true){
        $_SESSION["crews"] = $crews;
        createJob();
    }else{
        $_SESSION['alert'] = "Auftrag konnte aufgrund falscher Angaben nicht erstellt werden!";
    }

    }
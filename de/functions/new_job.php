<?php
require "database.php";
require "handleJobs.php";

session_start();

if(isset($_POST["crews"])){
    $crews = json_decode($_POST["crews"]);

    $numCrews = count($crews);

    $scan = true;
    $missingPlayer = true;

    for ($i = 0; $i < $numCrews; $i++) {

        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $crews[$i]->CrewName))
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

        for($x = 0; $x < count($crews[$i]->MinerNames); $x++) {
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $crews[$i]->MinerNames[$x]))
                {
                    $scan = false;
                }
        }
        
        for($y = 0; $y < count($crews[$i]->ScoutNames); $y++) {
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $crews[$i]->ScoutNames[$y]))
                {
                    $scan = false;
                }
        }

        if(count($crews[$i]->ScoutNames) == 0 && count($crews[$i]->MinerNames) == 0){

            $missingPlayer = false;
        }
    }



    if($scan && $missingPlayer){
        $_SESSION["crews2"] = $crews;
        createJob();
        setSingleJobs_Session();
    } elseif(!$missingPlayer){
        $_SESSION["alert"] = "Es muss mindestens jeder Crew ein Spieler zugeordnet sein";
    } elseif($scan){
        $_SESSION["alert"] = "Auftrag konnte aufgrund falscher Angaben nicht erstellt werden!";
    } else{
        $_SESSION["alert"] = "Es gab einen fatalen Fehler beim erstellen eines Jobs, bitte erneut Anmelden und versuchen, sonst Support schreiben";
    }
}
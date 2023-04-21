<?php
require "database.php";
require "handleJobs.php";

require "../objects/Crew.php";
require "../objects/Task.php";

session_start();

if(isset($_POST["timeHours"]) && isset($_POST["timeMinutes"]) && isset($_POST["costs"]) && isset($_POST["typeWeightList"]) && isset($_POST["miningStation"])){
    $timeHours = $_POST["timeHours"];
    $timeMinutes = $_POST["timeMinutes"];
    $costs = $_POST["costs"];
    $typeWeightList = $_POST["typeWeightList"];
    $miningStation = $_POST["miningStation"];

    if($timeHours > 999){
        echo("ERROR - Die Stundenanzahl ist höher als 999 und das ist etwas viel ^^");
    }
    else if($timeHours < 0){
        echo ("ERROR - Weniger als 0 Stunden, dein Ernst?!");
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $timeHours)){
        echo ("ERROR - Also Sonderzeichen als Zeit sind nicht geil");
    }
    else if($timeMinutes > 59){
        echo ("ERROR - Die Minutenanzahl ist höher als 59, etwas sus oder nicht?");
    }
    else if($timeMinutes < 0){
        echo ("ERROR - Weniger als 0 Minuten, dein Ernst?!");
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $timeMinutes)){
        echo ("ERROR - Also Sonderzeichen als Zeit sind nicht geil");
    }
    else if($costs < 0){
        echo ("ERROR - Ich glaub dein Betrieb läuft gut, wenn du negative Kosten hast. Lass ich aber nicht gelten");
    }
    else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $costs)){
        echo ("ERROR - Also Sonderzeichen als Kosten sind nicht geil");
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $miningStation)){
        echo ("ERROR - Was machst du hier mit den Stationen?! Da sollen keine Sonderzeichen stehen");
    }
    else{
        $checkSpecialChars = true;

        for($i = 0; $i < count($typeWeightList); $i++){
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$typeWeightList[$i][0])){
                $checkSpecialChars = false;
            }
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$typeWeightList[$i][1])){
                $checkSpecialChars = false;
            }
        }

        if(!$checkSpecialChars){
            echo ("ERROR - Was machst du hier mit den Gewichten und Typen?! Da sollen keine Sonderzeichen stehen");
        }
        else{
            $conn = connect();
            $duration = $timeHours * 60 + $timeMinutes;
            $refinery_station_id = $miningStation;

            $crews = unserialize($_SESSION["crews"]);
            $crewID = $crews[$_SESSION["selectedCrew"]]->getID();
            
            createTask($conn, $duration, $costs, $crewID, $refinery_station_id);
        }
    }
}




?>
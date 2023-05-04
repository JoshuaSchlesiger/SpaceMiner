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

    $timeHours = $values->timeHours;
    $timeMinutes = $values->timeMinutes;
    $costs = $values->costs;
    $typeWeightList = $values->typeWeightList;
    $miningStation = $values->miningStation;

    $data["Error"] = null;
    $data["Task"] = null;

    if($timeHours > 999){
        $data["Error"] = "ERROR - Die Stundenanzahl ist mehr als 999 und das ist etwas viel ^^";
    }
    else if($timeHours < 0){
        $data["Error"] ="ERROR - Weniger als 0 Stunden, dein Ernst?!";
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $timeHours)){
        $data["Error"] ="ERROR - Also Sonderzeichen als Zeit sind nicht geil";
    }
    else if($timeMinutes > 59){
        $data["Error"] ="ERROR - Die Minutenanzahl ist mehr als 59, etwas sus oder nicht?";
    }
    else if($timeMinutes < 0){
        $data["Error"] ="ERROR - Weniger als 0 Minuten, dein Ernst?!";
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $timeMinutes)){
        $data["Error"] ="ERROR - Also Sonderzeichen als Zeit sind nicht geil";
    }
    else if($costs < 0){
        $data["Error"] ="ERROR - Ich glaub dein Betrieb geht gut, wenn du negative Kosten hast. Lass ich aber nicht gelten";
    }
    else if($costs > 9999999){
        $data["Error"] ="ERROR - Ich glaub du gehts Bankrott";
    }
    else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $costs)){
        $data["Error"] ="ERROR - Also Sonderzeichen als Kosten sind nicht geil";
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $miningStation)){
        $data["Error"] ="ERROR - Was machst du hier mit den Stationen?! Da sollen keine Sonderzeichen stehen";
    }
    else{
        $checkSpecialChars = true;
        $checkWeight = true;

        for($i = 0; $i < count($typeWeightList); $i++){
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$typeWeightList[$i][0])){
                $checkSpecialChars = false;
            }
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$typeWeightList[$i][1])){
                $checkSpecialChars = false;
            }
            if($typeWeightList[$i][1] > 99999){
                $checkWeight = false;
            }
        }

        if(!$checkSpecialChars){
            $data["Error"] = "ERROR - Was machst du hier mit den Gewichten und Typen?! Da sollen keine Sonderzeichen stehen";
        }
        if(!$checkWeight){
            $data["Error"] = "ERROR - Das Gewicht ist ja mal etwas zu hoch oder nicht?!";
        }
        else{
            $conn = connect();
            $duration = $timeHours * 60 + $timeMinutes;
            $refinery_station_id = $miningStation;

            $crews = unserialize($_SESSION["crews"]);
            $crewID = $crews[$_SESSION["selectedCrew"]]->getID();

            
            $taskid = createTask($conn, $duration, $costs, $crewID, $refinery_station_id);

            $editTypeWeightList = $typeWeightList;
            for($i = 0; $i < count($typeWeightList); $i++){
                createTypeTask($conn, $typeWeightList[$i][0], $taskid, $typeWeightList[$i][1]);
                $editTypeWeightList[$i][0] =  $_SESSION['oreTypes'][$editTypeWeightList[$i][0]-1]["name"];
            }
            setSingleTask_Session($crewID);


            $data["Task"] = ["taskid" => $taskid , "editTypeWeightList" => $editTypeWeightList];

            $data["jobWeight"] = getJobWeight($_SESSION["JobPosInArray"]);

        }
    }

    echo json_encode($data);

}



?>
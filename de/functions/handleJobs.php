<?php



function setJobs_Session()
{

    $conn = connect();

    $jobs = [];
    $crews = [];
    $players = [];

    $output = getJobs($conn);

    for ($i = 0; $i < count($output); $i++) {

        $scan = true;
        for ($y = 0; $y < count($jobs); $y++) {
            if ($output[$i]["jid"] == $jobs[$y]->getJid()) {
                $scan = false;
            }
        }
        if ($scan) {
            $job = new Job($output[$i]["jid"], $output[$i]["number"]);
            array_push($jobs, $job);
        }

        $scan2 = true;
        for ($y = 0; $y < count($crews); $y++) {
            if ($output[$i]["cid"] == $crews[$y]->getCid()) {
                $scan2 = false;
            }
        }
        if ($scan2) {
            $crew = new Crew($output[$i]["jid"], $output[$i]["cname"], $output[$i]["cid"]);
            array_push($crews, $crew);
        }


        $player = new Player($output[$i]["pname"], $output[$i]["pid"], $output[$i]["cid"], $output[$i]["type"]);
        array_push($players, $player);
    }

    $_SESSION["jobs"] = array();
    $_SESSION["crews"] = array();
    $_SESSION["players"] = array();

    $_SESSION["jobs"] = serialize($jobs);
    $_SESSION["crews"] = serialize($crews);
    $_SESSION["players"] = serialize($players);
}

function setSingleJobs_Session()
{


    $jobs = unserialize($_SESSION["jobs"]);
    $crews = unserialize($_SESSION["crews"]);
    $players = unserialize($_SESSION["players"]);

    $conn = connect();

    $output = getLatestJobs($conn);

    $numJobs = count($jobs);

        if ($output[0]["jid"] != $jobs[$numJobs-1]->getJid()) {
            for ($i = 0; $i < count($output); $i++) {

                $job = new Job($output[$i]["jid"], $output[$i]["number"]);
                array_push($jobs, $job);
                $crew = new Crew($output[$i]["jid"], $output[$i]["cname"], $output[$i]["cid"]);
                array_push($crews, $crew);
                $player = new Player($output[$i]["pname"], $output[$i]["pid"], $output[$i]["cid"], $output[$i]["type"]);
                array_push($players, $player);
            }

            
            $_SESSION["jobs"] = serialize($jobs);
            $_SESSION["crews"] = serialize($crews);
            $_SESSION["players"] = serialize($players);

        }


}

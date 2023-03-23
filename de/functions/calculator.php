<?php
session_start();

    $massStone = $_POST["massStone"];
    $proportion1 = $_POST["proportion1"];
    $proportion2 = $_POST["proportion2"];
    $proportion3 = $_POST["proportion3"];

    if($massStone == ""){
        $massStone = 0;
    }
    if($proportion1 == ""){
        $proportion1 = 0;
    }
    if($proportion2 == ""){
        $proportion2 = 0;
    }
    if($proportion3 == ""){
        $proportion3 = 0;
    }

    $mass1 = round($massStone / 50 * ($proportion1 / 100));
    $mass2 = round($massStone / 50 * ($proportion2 / 100));
    $mass3 = round($massStone / 50 * ($proportion3 / 100));


    $data = [
        'priceRaw1' => $_SESSION['oreTypes'][$_POST["index1"]][2],
        'priceRefined1' => $_SESSION['oreTypes'][$_POST["index1"]][3],
        'priceRaw2' => $_SESSION['oreTypes'][$_POST["index2"]][2],
        'priceRefined2' => $_SESSION['oreTypes'][$_POST["index2"]][3],
        'priceRaw3' => $_SESSION['oreTypes'][$_POST["index3"]][2],
        'priceRefined3' => $_SESSION['oreTypes'][$_POST["index3"]][3],
        'mass1' => $mass1,
        'mass2' => $mass2,
        'mass3' => $mass3,
    ];

    echo json_encode($data);


?>
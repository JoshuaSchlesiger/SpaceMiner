<?php
session_start();

    $massStone = $_POST["massStone"];
    $proportion1 = $_POST["proportion1"];
    $proportion2 = $_POST["proportion2"];
    $proportion3 = $_POST["proportion3"];


    $mass1 = round($massStone / 50 * ($proportion1 / 100), 2);
    $mass2 = round($massStone / 50 * ($proportion2 / 100), 2);
    $mass3 = round($massStone / 50 * ($proportion3 / 100), 2);


    $data = [
        'priceRaw1' => $_SESSION['oreTypes'][$_POST["index1"]][3],
        'priceRefined1' => $_SESSION['oreTypes'][$_POST["index1"]][2],
        'priceRaw2' => $_SESSION['oreTypes'][$_POST["index2"]][3],
        'priceRefined2' => $_SESSION['oreTypes'][$_POST["index2"]][2],
        'priceRaw3' => $_SESSION['oreTypes'][$_POST["index3"]][3],
        'priceRefined3' => $_SESSION['oreTypes'][$_POST["index3"]][2],
        'mass1' => $mass1,
        'mass2' => $mass2,
        'mass3' => $mass3,
    ];

    echo json_encode($data);


?>
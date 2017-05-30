<?php

    error_reporting(E_ALL);
    header("Content-Type: application/json");

    require "../production.php"; // Refer to production.template for information on setting this file up.
    require "../php/backend.php";
    require "../php/URL.php";

    global $dbc;
    global $app;

    $backend = new Backend($app, $dbc);
    $URL = new URL($backend);

    // determine mode
    if(isset($_GET["create"])) {
        $create = $_GET["create"];

        echo "[";
        echo json_encode($URL->create($create));
        echo "]";
    } elseif(isset($_GET["find"])) {
        $find = $_GET["find"];

        echo "[";
        echo json_encode($URL->find($find));
        echo "]";
    }

    

?>
<?php

    error_reporting(E_ALL);

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

        echo "<pre>";
        var_dump($URL->create($create));
        echo "</pre>";
    } elseif(isset($_GET["find"])) {
        $find = $_GET["find"];

        echo "<pre>";
        var_dump($URL->find($find));
        echo "</pre>";
    }

    

?>
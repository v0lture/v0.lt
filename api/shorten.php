<?php

    require "../production.php"; // Refer to production.template for information on setting this file up.
    require "../php/backend.php";
    require "../php/URL.php";

    global $dbc;

    $backend = new Backend($dbc);
    $URL = new URL($backend, $dbc);

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
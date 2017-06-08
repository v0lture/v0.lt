<?php

    require "production.php"; // Refer to production.template for information on setting this file up.
    require "php/backend.php";
    require "php/URL.php";

    global $dbc;
    global $app;

    $backend = new Backend($app, $dbc);
    $URL = new URL($backend);

?>

<!DOCTYPE html>

<html>

    <head>
        <title>v0.lt</title>

        <!-- Materialize resources -->
        <link rel="stylesheet" href="css/materialize.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- app resources -->
        <link rel="stylesheet" href="css/v0.lt.css">
        <script src="js/v0.lt.js"></script>
    </head>

    <body class="container">

        <h3><i class="material-icons left" style="font-size: 48px;">flash_on</i> v0.lt</h3>

        
        <div class="inputbox z-depth-2">
            <h5><i class="material-icons left" style="font-size: 24px;">pageview</i> SNAPSHOT</h5>

            <p>Snapshots are currently unavailable. Try again later.</p>
        </div>

        <br />
        <div class="center-align">
            <a href="https://github.com/v0lture/v0.lt" class="btn-flat waves-effect waves-light">Source</a>
            <a href="https://v0lture.com/contact.php" class="btn-flat waves-effect waves-light">Contact</a>
        </div>

    </body>

</html>
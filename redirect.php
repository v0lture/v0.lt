<?php

    require "production.php"; // Refer to production.template for information on setting this file up.
    require "php/backend.php";
    require "php/URL.php";

    global $dbc;
    global $config;

    $backend = new Backend($config, $dbc);
    $URL = new URL($backend);

    // Handle error
    if(!isset($_GET["id"])){
        header("Location: index.php");
        return;
    }

    $resp = $URL->find($_GET["id"]);

    if($resp["data"]["has-snap"] == 0){
        header("Location: ".$resp["data"]["long"]);
    }

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
            <h5><i class="material-icons left" style="font-size: 24px;">exit_to_app</i> REDIRECT</h5>

            <?php if($resp["error"] == null): ?>
                <p>You are being sent to <code><?= $resp["data"]["long"]; ?></code>. Choose what you want to do below.</p><br />

                <a href="<?= $resp["data"]["long"]; ?>" class="btn-flat waves-effect waves-light white-text" style="width: 100%;"><i class="material-icons left">arrow_forward</i> Continue</a><br />
                <p>Continues to the original link used when creating this short link.</p><br />
                <a href="snapshot.php?id=<?= $_GET["id"]; ?>" class="btn-flat waves-effect waves-light white-text" style="width: 100%;"><i class="material-icons left">pageview</i> View snapshot</a>
                <p>Views the snapshot we created when this short link was created, preserving the state of the page from time changes.</p>
            <?php else: ?>
                <p>An error occurred while handling this short link redirection.<br />Code &mdash; <code><?= $resp["error"]["code"]; ?></code><br />Message &mdash; <code><?= $resp["error"]["message"]; ?></code></p><br />

                <a href="index.php" class="btn-flat waves-effect waves-light white-text" style="width: 100%;"><i class="material-icons left">home</i> Go back to home</a>
            <?php endif; ?>
        </div>

    </body>

</html>
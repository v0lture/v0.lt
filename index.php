<?php

    require "production.php"; // Refer to production.template for information on setting this file up.
    require "php/backend.php";
    require "php/URL.php";

    global $dbc;
    global $app;

    $backend = new Backend($app, $dbc);
    $URL = new URL($backend);

    // Handle error
    foreach($_GET as $key => $val){
        $resp = $URL->find($key);

        if($resp["error"] != null){
            // error :(
            echo "<p>Sadface. An error occurred.<br /><b>Error Code</b> &mdash; <code>".$resp["error"]["code"]."</code><br /><b>Error Message</b> &mdash; <code>".$resp["error"]["message"]."</code></p>";
            break;
        }

        // no errors, yay!
        echo "<p>You will go to <code>".$resp["data"]["long"]."</code>...</p>";
        header("Location: ".$resp["data"]["long"]);
        break;
    }

?>
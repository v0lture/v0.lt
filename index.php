<?php

    require "production.php"; // Refer to production.template for information on setting this file up.
    require "php/backend.php";
    require "php/URL.php";

    global $dbc;
    global $config;

    $backend = new Backend($config, $dbc);
    $URL = new URL($backend);

    // Handle error
    foreach($_GET as $key => $val){
        $resp = $URL->find($key);
        
        header("Location: redirect.php?id=".$key);
        break;
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
        <script src="js/clipboard.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- app resources -->
        <link rel="stylesheet" href="css/v0.lt.css">
    </head>

    <body class="container">

        <h3><i class="material-icons left" style="font-size: 48px;">flash_on</i> v0.lt</h3>

        
        <div class="inputbox z-depth-2">
            <h5><i class="material-icons left" style="font-size: 24px;">content_cut</i> SHORTEN</h5>

            <div style="display: none;" id="shorten-loader" class="center-align">

                <div class="preloader-wrapper active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                        <div class="circle"></div>
                        </div><div class="gap-patch">
                        <div class="circle"></div>
                        </div><div class="circle-clipper right">
                        <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                        <div class="circle"></div>
                        </div><div class="gap-patch">
                        <div class="circle"></div>
                        </div><div class="circle-clipper right">
                        <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                        <div class="circle"></div>
                        </div><div class="gap-patch">
                        <div class="circle"></div>
                        </div><div class="circle-clipper right">
                        <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                        <div class="circle"></div>
                        </div><div class="gap-patch">
                        <div class="circle"></div>
                        </div><div class="circle-clipper right">
                        <div class="circle"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="input-field" id="shorten-prompt">
                <input type="text" id="shortenlink"></input>
                <label for="shortenlink">Link to shorten</label>
            
                <a href="#" onclick="shorten();" class="btn-flat waves-effect waves-light white-text">Shorten!</a>
            </div>

            <div style="display: none;" id="shorten-finished">

                <p>Your shortened link is ready at <code>https://$app["url"]/$data["id"]</code>.</p>
                <input type="text" id="shorten-url" value="" readonly style="color: white;"></input>
                <a href="#" onclick="resetShorten();" class="btn-flat waves-effect waves-light white-text">Shorten another</a>
                <a href="#" class="btn-flat waves-effect waves-light white-text" id="clipboardcopy" data-clipboard-target="#shorten-url">Copy link</a>
            </div>
        </div>

        <script src="js/v0.lt.js"></script>

    </body>

</html>
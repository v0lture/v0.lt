<?php

    $TEST = true;
    require "php/backend.php";
    require "php/URL.php";

    use PHPUnit\Framework\TestCase;

    class v0ltTest extends TestCase {

        public function testURLs() {

            echo "\r\n--- 1/2 ---\r\nCreating a shortened link for https://v0lture.com...\r\n";
            $dbc = mysqli_connect("localhost", "travis", "", "v0lt");

            $app = Array(
                "url" => "travis://v0.lt/"
            );

            $backend = new Backend($app, $dbc);
            $URL = new URL($backend);

            $shortened = $URL->create("https://v0lture.com");

            var_dump($shortened);

            // check for errors
            if($shortened["error"] != null){
                trigger_error($shortened["error"]["code"].": ".$shortened["error"]["message"], E_USER_ERROR);
                exit();
            }

            echo "\r\n--- 2/2 ---\r\nFinding link for ".$shortened["data"]["id"]."...\r\n";

            $longified = $URL->find($shortened["data"]["id"]);

            var_dump($longified);

            // check for errors
            if($longified["error"] != null){
                trigger_error($longified["error"]["code"].": ".$longified["error"]["message"], E_USER_ERROR);
                exit();
            }

        }

    }
            
?>
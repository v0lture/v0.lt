<?php

    $TEST = true;
    require "php/backend.php";
    require "php/URL.php";

    class tests {

        public function testA() {

            echo "Creating a shortened link for https://v0lture.com...";
            $dbc = mysqli_connect("localhost", "travis", "", "v0lt");

            $backend = new Backend();
            $URL = new URL($backend, $dbc);

            var_dump($URL->create("https://v0lture.com"));

        }

    }
            
?>
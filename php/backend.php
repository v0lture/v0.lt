<?php

    class Backend {

        public function cleanText($dbc, $text) {
            return mysqli_escape_string($dbc, $text);
        }

    }

?>
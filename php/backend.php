<?php

    class Backend {

        public $dbc;

        public function __construct($dbc){
            $this->dbc = $dbc;
        }

        public function cleanText($text) {
            return mysqli_real_escape_string($this->dbc, $text);
        }

    }

?>
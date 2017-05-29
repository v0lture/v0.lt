<?php

    class Backend {

        public $dbc;
        public $app;

        public function __construct($config, $dbc){
            $this->dbc = $dbc;
            $this->app = $config;
        }

        public function cleanText($text) {
            return mysqli_real_escape_string($this->dbc, $text);
        }

    }

?>
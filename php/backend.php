<?php

    class Backend {

        public $dbc;
        public $app;
        public $security;

        public function __construct($config, $dbc){
            $this->dbc = $dbc;
            $this->app = $config["app"];
            $this->security = $config["security"];
        }

        public function cleanText($text) {
            return mysqli_real_escape_string($this->dbc, $text);
        }

        public function linkBlacklisted($link) {
            foreach($this->app["blacklist-urls"] as $item) {
                if (stripos($link, $item) !== false) return true;
            }
            return false;
        }

        public function extensionBlacklisted($link) {
            foreach($this->security["blacklist-extensions"] as $item) {
                if (stripos($link, ".".$item) !== false) return true;
            }
            return false;
        }

    }

?>
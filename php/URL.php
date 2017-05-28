<?php

    class URL {

        private $dbc;
        private $backend;

        public function __construct($backend, $dbc){
            $this->dbc = $dbc;
            $this->backend = $backend;
        }

        // create short link based on 
        public function create($link){
            // DB check
            if(!$this->dbc){
                return Array("data" => null, "error" => Array("code" => "absoluteblue", "message" => "A database connection error has occurred"));
            } else {

                // create ids and submit
                $id = substr(base64_encode(microtime()), 0, 10);

                // check if string
                if(filter_var($link, FILTER_VALIDATE_URL)) {

                    if($this->dbc->query("INSERT INTO `links` (`id`, `short`, `long`) VALUES (NULL, '', '')")){
                        // success on insert
                        return Array("data" => Array("short" => "https://v0.lt/l.php?id=".$id, "long" => $link), "error" => null);
                    } else {
                        // errored on insert
                        return Array("data" => null, "error" => Array("code" => "aero", "message" => $this->dbc->error));
                    }

                } else {
                    return Array("data" => null, "error" => Array("code" => "acajou", "message" => "Invalid passed URL"));
                }

            }
        }

    }

?>
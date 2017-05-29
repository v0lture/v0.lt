<?php

    require "../production.php";
    global $app;

    class URL {

        private $dbc;
        private $backend;

        public function __construct($backend){
            $this->dbc = $backend->dbc;
            $this->backend = $backend;
        }

        // create short link based on 
        public function create($link){
            // DB check
            if(!$this->dbc){
                return Array("data" => null, "error" => Array("code" => "absoluteblue", "message" => "A database connection error has occurred"));
            } else {

                // create ids and submit
                $id = substr(base64_encode(microtime(true)), 0, 10);

                // check if string
                if(filter_var($link, FILTER_VALIDATE_URL)) {

                    if($this->dbc->query("INSERT INTO `links` (`id`, `short`, `long`, `added`) VALUES (NULL, '".$this->backend->cleanText($id)."', '".$this->backend->cleanText($link)."', '".$this->backend->cleanText(microtime(true))."')")){
                        // success on insert
                        return Array("data" => Array("short" => $this->backend->app["url"].$id, "long" => $link, "id" => $id), "error" => null);
                    } else {
                        // errored on insert
                        return Array("data" => null, "error" => Array("code" => "aero", "message" => $this->dbc->error));
                    }

                } else {
                    return Array("data" => null, "error" => Array("code" => "acajou", "message" => "Invalid passed URL"));
                }

            }
        }

        // find long link based on short link
        public function find($short) {
            // db conn check
            if(!$this->dbc){
                return Array("data" => null, "error" => Array("code" => "absoluteblue", "message" => "A database connection error has occurred"));
            } else {
                
                // find
                if($raw = $this->dbc->query("SELECT * FROM `links` WHERE `short` = '".$this->backend->cleanText($short)."' LIMIT 1")){
                    if($raw->num_rows == 0){
                        return Array("data" => null, "error" => Array("code" => "africanviolet", "message" => "This short link does not match any long links"));
                    } else {
                        while($data = $raw->fetch_assoc()){
                            return Array("data" => Array("long" => $data["long"]), "error" => null);
                        }
                    }        
                } else {
                    // error :(
                    return Array("data" => null, "error" => Array("code" => "aeroblue", "message" => $this->dbc->error));
                }

            }
        }

    }

?>
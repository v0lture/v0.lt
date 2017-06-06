<?php

    class URL {

        private $dbc;
        private $backend;

        public function __construct($backend){
            $this->dbc = $backend->dbc;
            $this->backend = $backend;
        }

        // create short link based on 
        public function create($link, $snapshot = false){
            // DB check
            if(!$this->dbc){
                return Array("data" => null, "error" => Array("code" => "absoluteblue", "message" => "A database connection error has occurred"));
            } 

            // create ids and submit
            $lid = str_replace("=", "", substr(base64_encode(substr(hash("sha256", microtime(true)), 0, 10)), 0, 7));

            // check if url beings with https:// or http://
            if($this->backend->app["inject-prefix"] == true){
                if(strpos($link, "http://") === false && strpos($link, "https://") === false){
                    $link = "https://".$link;
                }
            }

            // check if URL has http prefix
            if($this->backend->security["enforce-https"] == true){
                if(strpos($link, "http://") !== false){
                    return Array("data" => null, "error" => Array("code" => "alabamacrimson", "message" => "Passed URL does not match security rule 'enforce-https'"));
                }
            }

            // check if URL contains blacklisted URLs/keywords
            if($this->backend->linkBlacklisted($link) == true) {
                return Array("data" => null, "error" => Array("code" => "aliceblue", "message" => "Passed URL does not match security rule 'blacklist-urls'"));
            }

            // check if URL contains blacklisted extensions
            if($this->backend->extensionBlacklisted($link) == true) {
                return Array("data" => null, "error" => Array("code" => "alienarmpit", "message" => "Passed URL does not match security rule 'blacklist-extensions'"));
            }

            // check if string
            if(!filter_var($link, FILTER_VALIDATE_URL)) {
                return Array("data" => null, "error" => Array("code" => "acajou", "message" => "Invalid passed URL"));
            } 

            $snap = 0;
            // check if snapshot
            if($snapshot == true){
                $snap = 1;
            }

            if($this->dbc->query("INSERT INTO `links` (`id`, `short`, `long`, `added`, `has-snap`) VALUES (NULL, '".$this->backend->cleanText($lid)."', '".$this->backend->cleanText($link)."', '".$this->backend->cleanText(microtime(true))."', ".$snap.")")){
                // success on insert
                return Array("data" => Array("short" => $this->backend->app["url"]."?".$lid, "long" => $link, "id" => $lid), "error" => null);
            }

            return Array("data" => null, "error" => Array("code" => "aero", "message" => $this->dbc->error));

        }

        // find long link based on short link
        public function find($short) {
            // db conn check
            if(!$this->dbc){
                return Array("data" => null, "error" => Array("code" => "absoluteblue", "message" => "A database connection error has occurred"));
            }
                
            // find
            if(!$raw = $this->dbc->query("SELECT * FROM `links` WHERE `short` = '".$this->backend->cleanText($short)."' LIMIT 1")){
                // error :(
                return Array("data" => null, "error" => Array("code" => "aeroblue", "message" => $this->dbc->error));
            }

            // check if we found a result
            if($raw->num_rows == 0){
                return Array("data" => null, "error" => Array("code" => "africanviolet", "message" => "This short link does not match any long links"));
            }

            // return results
            while($data = $raw->fetch_assoc()){
                return Array("data" => Array("long" => $data["long"], "has-snap" => $data["has-snap"]), "error" => null);
            }

        }

    }

?>
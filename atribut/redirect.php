<?php
    include_once('./config/config.php');
    class Redirect {

        private $host, $conf;

        function __construct(){
            $this->conf = new config();
            $this->host = 'http://'.$this->conf->curExpPageURL()[2].'/'.$this->conf->curExpPageURL()[3];
        }

        function to($destination){
            header('location: '.$this->host.'/'.$destination.'/');
        }
    }
?>
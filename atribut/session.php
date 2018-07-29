<?php
    class Session {

        static function exists($name){
            return (!empty($_SESSION[$name]) ? true : false);
        }

        static function set($name, $value){
            $_SESSION[$name] = $value;
        }

        static function get($name){
            return $_SESSION[$name];
        }

    }
?>
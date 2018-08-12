<?php
    class input {

        static function get($name){
        	return $_GET[$name];
        }

        static function post($name){
        	return $_POST[$name];
        }

    }
?>
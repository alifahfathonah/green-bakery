<?php
/**
 * Class Config
 */
class Config
{

  function __construct()
  {
    // code...
  }

  function curPageURL() {
   $pageURL = 'http';
   $pageURL .= "://";
   if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
   }
   return $pageURL;
  }

  function curExpPageURL(){
    return explode("/",$this->curPageURL());
  }
}

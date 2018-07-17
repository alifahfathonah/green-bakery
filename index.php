<?php

include 'config/config.php';
$conf = new config();
$main_url = $conf->curExpPageURL()[4];
// $sub_url = $conf->curExpPageURL()[5];
// print_r($conf->curExpPageURL());die;

if($main_url==false){
  //INDEX PHP
  include('controller/front.php');
  $class_load = new front();
  $class_load->index();
}else{
  $sub_url_1 = $conf->curExpPageURL()[4];
  //check file first
  if(file_exists('controller/'.$sub_url_1.'.php')){
    include('controller/'.$sub_url_1.'.php');
    $class_load = new $sub_url_1;

    if(count($conf->curExpPageURL()) < 6 || $conf->curExpPageURL()[5] == null){
      //TANPA URL METHOD
      $class_load->index();
    }else{
      $sub_url_2 = $conf->curExpPageURL()[5];
      if(method_exists($class_load,$sub_url_2)){
        $class_load->$sub_url_2 ();
      }else{
        echo 'METHOD NOT FOUND';
      }
    }
    
    // $class_load = new $sub_url_1.'()';
    // echo 'CONTROLLER FOUND';

    //check method
    // if(){
    //
    // }

  }else{
    echo 'CONTROLLER NOT FOUND';
  }

  // if($sub_url){
  //
  // }else{
  //
  // }
}
// print_r(explode("/",curPageURL()));

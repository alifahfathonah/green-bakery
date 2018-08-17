<?php
session_start();
include 'config/config.php';
$conf = new config();
$main_url = $conf->curExpPageURL()[4];
// print_r($conf->curExpPageURL());die;

if($main_url==false){
    // halaman utama
    include('controller/front.php');
    $load_class = new front();
    $load_class->index();
} else {
    $controller_class = $conf->curExpPageURL()[4];
    if(file_exists('controller/'.$controller_class.'.php')){
        include('controller/'.$controller_class.'.php');
        $load_class = new $controller_class;
        if(count($conf->curExpPageURL()) < 6 || $conf->curExpPageURL()[5] == null){
            $load_class->index();
        } else {
            $controller_method = $conf->curExpPageURL()[5];
            if(method_exists($load_class,$controller_method)){ 
                $load_class->$controller_method ();
            }else{
                echo 'METHOD NOT FOUND';
            }
        }

    } else {
        echo 'CONTROLLER NOT FOUND';
    }
}

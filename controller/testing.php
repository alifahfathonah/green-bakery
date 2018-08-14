<?php

include_once ('config/config.php');
include_once ('config/database.php');

class Testing {

    public $db, $host, $redirect;

    function __construct() {
        // code...
        session_start();
        $this->db = new database();
        $this->host = new config();
        $this->redirect = new redirect();
        $this->host = 'http://'.$this->host->curExpPageURL()[2].'/'.$this->host->curExpPageURL()[3];
    }

    function contoh(){
        $data = $this->db->query("SELECT harga FROM tbl_barang WHERE id = 8")->fetch_array();
        print_r($data[0]);
    }

}

?>
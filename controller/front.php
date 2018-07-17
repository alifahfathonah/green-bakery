<?php
include_once ('config/config.php');
include_once ('config/database.php');

/**
 * Class Panel
 */
class Front
{

  public $db,$host;

  function __construct()
  {
    // code...
    $this->db = new database();
    $this->host = new config();
    $this->host = 'http://'.$this->host->curExpPageURL()[2].'/'.$this->host->curExpPageURL()[3];
  }

  function index(){
    $query_get_all_barang = "SELECT * FROM tbl_barang";
    $execute_get_all_barang = $this->db->query($query_get_all_barang);

    include './view/front/main.php';
    //echo 'HALO';
  }

}

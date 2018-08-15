<?php

include_once('config/config.php');
include_once('config/database.php');

class Keranjang {

    protected $db, $host, $redirect; 

    function __construct(){

        $this->db = new database();
        $this->host = new config();
        $this->redirect = new Redirect();
        $this->host = 'http://'.$this->host->curExpPageURL()[2].'/'.$this->host->curExpPageURL()[3];
        
    }

    function index(){

        if(Session::exists('id_pelanggan')){
            $id_pelanggan = Session::get('id_pelanggan');

            $query = "SELECT tbl_barang.nama_barang, tbl_barang.harga, tbl_barang.foto, tbl_keranjang.qty, tbl_keranjang.subtotal 
                    FROM tbl_keranjang INNER JOIN tbl_barang ON tbl_barang.id = tbl_keranjang.id_barang WHERE tbl_keranjang.id_pelanggan = $id_pelanggan";

            $data_pembelian = $this->db->query($query);

            include './view/front/keranjang.php';
        } else {
            header('location:  /green-bakery/');
        }

    }

}

?>
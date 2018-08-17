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
            $total = 0;

            $id_pelanggan = Session::get('id_pelanggan');

            $query = "SELECT tbl_keranjang.id_pelanggan, tbl_barang.id AS id_barang , tbl_barang.nama_barang, tbl_barang.harga, tbl_barang.foto, tbl_keranjang.qty, tbl_keranjang.subtotal 
                    FROM tbl_keranjang INNER JOIN tbl_barang ON tbl_barang.id = tbl_keranjang.id_barang WHERE tbl_keranjang.id_pelanggan = $id_pelanggan";

            $data_pembelian = $this->db->query($query);
            $all_kategori = $this->db->query("SELECT nama, id FROM tbl_kategori");

            $query = "SELECT COUNT(id_pelanggan) AS pesanan FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan');
            $keranjang = $this->db->query($query)->fetch_assoc();

            include './view/front/keranjang.php';
        } else {
            header('location:  /green-bakery/');
        }

    }

    function update_qty(){
        
        $data_barang = $this->db->query('SELECT qty, harga FROM tbl_barang WHERE id = '.Input::get('id_produk'))->fetch_array();
        
        $qty_keranjang_awal = Input::get('qty_awal');
        $qty_keranjang_baru = Input::get('qty_baru');

        $hitung_stok_baru = ($data_barang[0] + $qty_keranjang_awal) - $qty_keranjang_baru;

        $update_harga = $data_barang[1] * $qty_keranjang_baru;

        $this->db->query("UPDATE tbl_barang SET qty = $hitung_stok_baru WHERE id = ".Input::get('id_produk'));
        $this->db->query("UPDATE tbl_keranjang SET qty = $qty_keranjang_baru, subtotal = $update_harga WHERE id_barang = ".Input::get('id_produk')." AND id_pelanggan = ".Session::get('id_pelanggan'));

        $this->redirect->to('keranjang');
    }

    function hapus_item(){

        $id_barang = Input::get('id_barang');

        $qty_barang_awal = $this->db->query("SELECT qty FROM tbl_barang WHERE id = $id_barang")->fetch_array()[0];

        $update_qty = $qty_barang_awal + Input::get('qty_barang');

        $update_qty = $this->db->query("UPDATE tbl_barang SET qty = $update_qty WHERE id = $id_barang");
        
        if($update_qty){
            $this->db->query("DELETE FROM tbl_keranjang WHERE id_barang = $id_barang AND id_pelanggan = ".Session::get('id_pelanggan'));
        }
        

        $this->redirect->to('keranjang');

    }

}

?>
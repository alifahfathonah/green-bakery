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

            $query = "SELECT tbl_keranjang.id_pelanggan, tbl_barang.qty AS stok, tbl_barang.id_barang AS id_barang , tbl_barang.nama_barang, tbl_barang.harga, tbl_barang.foto, tbl_keranjang.qty, tbl_keranjang.subtotal 
                    FROM tbl_keranjang INNER JOIN tbl_barang ON tbl_barang.id_barang = tbl_keranjang.id_barang WHERE tbl_keranjang.id_pelanggan = $id_pelanggan";

            $data_pembelian = $this->db->query($query);
            $all_kategori = $this->db->query("SELECT nama, id_kategori FROM tbl_kategori");

            $query = "SELECT COUNT(id_pelanggan) AS pesanan FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan');
            $keranjang = $this->db->query($query)->fetch_assoc();
            
            include './view/front/keranjang/keranjang.php';
        } else {
            header('location:  /green-bakery/');
        }

    }

    function update_qty(){
        
        $data_barang = $this->db->query('SELECT qty, harga FROM tbl_barang WHERE id_barang = '.Input::get('id_produk'))->fetch_array();
        
        $qty_keranjang_awal = Input::get('qty_awal');
        $qty_keranjang_baru = Input::get('qty_baru');

        $hitung_stok_baru = ($data_barang[0] + $qty_keranjang_awal) - $qty_keranjang_baru;

        $update_harga = $data_barang[1] * $qty_keranjang_baru;

        $this->db->query("UPDATE tbl_barang SET qty = $hitung_stok_baru WHERE id_barang = ".Input::get('id_produk'));
        $this->db->query("UPDATE tbl_keranjang SET qty = $qty_keranjang_baru, subtotal = $update_harga WHERE id_barang = ".Input::get('id_produk')." AND id_pelanggan = ".Session::get('id_pelanggan'));

        $this->redirect->to('keranjang');
    }

    function hapus_item(){

        $id_barang = Input::get('id_barang');

        $qty_barang_awal = $this->db->query("SELECT qty FROM tbl_barang WHERE id_barang = $id_barang")->fetch_array()[0];

        $update_qty = $qty_barang_awal + Input::get('qty_barang');

        $update_qty = $this->db->query("UPDATE tbl_barang SET qty = $update_qty WHERE id_barang = $id_barang");
        
        if($update_qty){
            $this->db->query("DELETE FROM tbl_keranjang WHERE id_barang = $id_barang AND id_pelanggan = ".Session::get('id_pelanggan'));
        }
        

        $this->redirect->to('keranjang');

    }

    function detail_checkout(){

        (empty(Session::get('id_pelanggan')) ? $this->redirect->to('front') : true);

        $subtotal = 0;
        $ongkir = 15000;

        $query_data_keranjang = "SELECT keranjang.*, barang.nama_barang FROM `tbl_keranjang` AS keranjang JOIN tbl_barang AS barang
                                ON barang.id_barang = keranjang.id_barang WHERE keranjang.id_pelanggan = ".Session::get('id_pelanggan');
        $data_keranjang = $this->db->query($query_data_keranjang);

        $all_kategori = $this->db->query("SELECT nama, id_kategori FROM tbl_kategori");

        $query = "SELECT COUNT(id_pelanggan) AS pesanan FROM tbl_keranjang WHERE id_pelanggan = ".Session::get('id_pelanggan');
        $keranjang = $this->db->query($query)->fetch_assoc();

        include "./view/front/keranjang/detail_checkout.php";
    }

    function checkout(){

        $id_pelanggan = Session::get('id_pelanggan');
        
        $date = new DateTime();

        $get_id = $this->db->query('SELECT MAX(id_transaksi) FROM tbl_transaksi ORDER BY id_transaksi')->fetch_array();

        if(!empty($get_id[0])){

            $urut_id_transaksi = explode("-", $get_id[0])[2] + 1;

            $id_transaksi = "TRX-".$date->format('ymd-').$urut_id_transaksi;

        } else {

            $id_transaksi = 'TRX-'.$date->format('ymd-1');

        }

        $total = 15000;

        $subtotal = $this->db->query("SELECT subtotal FROM tbl_keranjang WHERE id_pelanggan = $id_pelanggan");

        while($value = $subtotal->fetch_array()){ $total += $value[0]; }

        $query_trans = "INSERT INTO tbl_transaksi(id_transaksi, id_pelanggan, total, status) VALUES('$id_transaksi', $id_pelanggan, $total, 0)";
        
        $this->db->query($query_trans);

        $keranjang = $this->db->query("SELECT tbl_keranjang.*, tbl_barang.nama_barang FROM tbl_keranjang JOIN tbl_barang 
                                      ON tbl_barang.id_barang = tbl_keranjang.id_barang WHERE tbl_keranjang.id_pelanggan = $id_pelanggan");

        while($value = $keranjang->fetch_assoc()){

            $query_detail_trans = "INSERT INTO tbl_detail_transaksi(id_transaksi, nama_barang, qty, subtotal) VALUES ('$id_transaksi', '".$value['nama_barang']."', ".$value['qty'].", ".$value['subtotal'].")";
            $this->db->query($query_detail_trans);
        }

        $get_id_pengiriman = $this->db->query('SELECT MAX(id_pengiriman) FROM tbl_pengiriman ORDER BY id_pengiriman')->fetch_array();

        if(!empty($get_id_pengiriman[0])){

            $urut_id_pengiriman = explode("-", $get_id_pengiriman[0])[2] + 1;

            $id_pengiriman = "KPN-".$date->format('ymd-').$urut_id_pengiriman;

        } else {

            $id_pengiriman = 'KPN-'.$date->format('ymd-1');

        }

        $nama_penerima = Input::post('nama_penerima');
        $alamat = Input::post('alamat');
        $no_telp = Input::post('no_telp');
        $email = Input::post('email');
        $catatan = Input::post('catatan');

        $query_insert_pengiriman = "INSERT INTO `tbl_pengiriman`(`id_pengiriman`, `id_transaksi`, `nama_penerima`, `alamat`, `no_telp`, `email`, `catatan`) 
                                    VALUES ('$id_pengiriman','$id_transaksi','$nama_penerima','$alamat','$no_telp','$email', '$catatan')";
                                    
        $this->db->query($query_insert_pengiriman);

        $this->db->query("DELETE FROM tbl_keranjang WHERE id_pelanggan = '$id_pelanggan'");

        print " <script>
                    window.location='".$this->redirect->get_url('front')."';
                    alert('Berhasil Menyimpan Pesanan.');
                </script>";
    }

}

?>
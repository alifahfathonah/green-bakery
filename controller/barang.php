<?php
include_once ('config/config.php');
include_once ('config/database.php');

/**
 * Class Panel
 */
class Barang {

public $db, $host;

function __construct() {
    // code...
    $this->db = new database();
    $this->host = new config();
    $this->host = 'http://'.$this->host->curExpPageURL()[2].'/'.$this->host->curExpPageURL()[3];
}

function index() {
    $query = "SELECT * FROM tbl_kategori";
    $execute = $this->db->query($query);

    $query_get_all_barang = "SELECT barang.* , kategori.nama FROM tbl_barang AS barang JOIN tbl_kategori AS kategori ON kategori.id = barang.id_kategori";
    $execute_get_all_barang = $this->db->query($query_get_all_barang);

    include './view/back/barang.php';
}

function tambah_barang() {

    $kategori     = $_POST['kategori'];
    $nama_barang  = $_POST['nama_barang'];
    $qty          = $_POST['qty'];
    $harga_satuan = $_POST['harga_satuan'];

    $upload_dir   = "./uploads";

    if(!$_FILES["file"]["error"]){
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = basename($_FILES["file"]["name"]);
    move_uploaded_file($tmp_name, "$upload_dir/$name");

    $query = "INSERT INTO tbl_barang (id_kategori, nama_barang, qty, harga, foto, status) VALUES ('$kategori','$nama_barang','$qty','$harga_satuan','$name','1')";
    $execute = $this->db->query($query);

    header("Location: panel/$this->host/barang");
    }else{
    //gagal upload
    }

    echo $harga_satuan;
}

function hapus_barang(){
    $id    = $_POST['id_barang'];
    $query = "DELETE FROM tbl_barang WHERE id=$id";
    $this->db->query($query);
}

}

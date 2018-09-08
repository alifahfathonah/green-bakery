<?php

include_once ('config/config.php');
include_once ('config/database.php');

/**
 * Class Panel
 */
class Panel {

    public $db,$host, $redirect;

    function __construct() {
        $this->db = new database();
        $this->host = new config();
        $this->redirect = new Redirect();

        $isLoginURL=FALSE;

        if(isset($this->host->curExpPageURL()[5])){
			if($this->host->curExpPageURL()[5]=='login'){$isLoginURL=TRUE;}
			}

			$this->host = 'http://'.$this->host->curExpPageURL()[2].'/'.$this->host->curExpPageURL()[3];

			if(!isset($_SESSION["isLogin"])){
				if($isLoginURL==FALSE){
					header("Location: $this->host/panel/login");
			}
        }
    }

    function index() {

        (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

        $data_transaksi = $this->db->query("SELECT COUNT(id_transaksi) FROM tbl_transaksi")->fetch_array();
        $data_kategori  = $this->db->query("SELECT COUNT(id_kategori) FROM tbl_kategori")->fetch_array();
        $data_pelanggan = $this->db->query("SELECT COUNT(id_pelanggan) FROM tbl_pelanggan")->fetch_array();
        $data_barang    = $this->db->query("SELECT COUNT(id_barang) FROM tbl_barang")->fetch_array(); 

        include './view/back/navigasi_utama/main.php';
    }


    /*
    MODUL BARANG
                */

    function barang() {

        (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

        $query = "SELECT * FROM tbl_kategori";
        $execute = $this->db->query($query);

        $query_get_all_barang = "SELECT barang.*, kategori.nama FROM tbl_barang AS barang JOIN tbl_kategori AS kategori ON kategori.id_kategori=barang.id_kategori";
        $execute_get_all_barang = $this->db->query($query_get_all_barang);

        include './view/back//navigasi_utama/barang.php';
    }

    function tambah_barang(){

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
            header("Location: $this->host/panel/barang");
        }else{
            //gagal upload

            if($_FILES["file"]["error"]==4) {
                $query = "INSERT INTO tbl_barang (id_kategori, nama_barang, qty, harga, status) VALUES ('$kategori','$nama_barang','$qty','$harga_satuan','1')";
                $execute = $this->db->query($query);
                header("Location: $this->host/panel/barang");
            }
        }
    }

    function ubah_barang() {

        $id_barang    = $_POST['id_barang'];
        $kategori     = $_POST['kategori'];
        $nama_barang  = $_POST['nama_barang'];
        $qty          = $_POST['qty'];
        $harga_satuan = $_POST['harga_satuan'];

        $upload_dir   = "./uploads";

        if(!$_FILES["file"]["error"]){
            $tmp_name = $_FILES["file"]["tmp_name"];
            $name = basename($_FILES["file"]["name"]);

            $query = "UPDATE tbl_barang SET id_kategori='$kategori', nama_barang='$nama_barang', qty='$qty', harga='$harga_satuan', foto='$name', status=2 WHERE id=$id_barang";

            move_uploaded_file($tmp_name, "$upload_dir/$name");
            $execute = $this->db->query($query);
            header("Location: $this->host/panel/barang");
        }else{

            if($_FILES["file"]["error"] == 4){
                $query = "UPDATE tbl_barang SET id_kategori='$kategori', nama_barang='$nama_barang', qty='$qty', harga='$harga_satuan', status=2 WHERE id=$id_barang";

                $execute = $this->db->query($query);
                header("Location: $this->host/panel/barang");
            }
        }

    }

    function hapus_barang(){
        $id    = $_POST['id_barang'];
        $query = "DELETE FROM tbl_barang WHERE id_barang=$id";
        $this->db->query($query);
    }

    function ambil_data_barang(){
        $id    = $_POST['id_barang'];
        $query = "SELECT * FROM tbl_barang WHERE id_barang=$id";
        echo json_encode(mysqli_fetch_row($this->db->query($query)));
    }

    /*
        MODUL PENGGUNA
                    */

        function pengguna(){

            (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

			$query = "SELECT * FROM tbl_kategori";
			$execute = $this->db->query($query);

			$query_get_all_pengguna = "SELECT * FROM tbl_pengguna";
			$execute_get_all_pengguna = $this->db->query($query_get_all_pengguna);

			include './view/back//setting/pengguna.php';
        }

        function tambah_pengguna(){

			$nama_lengkap = $_POST['nama_lengkap'];
			$username     = $_POST['username'];
			$password     = md5($_POST['password']);

			$query = "INSERT INTO tbl_pengguna (nama_lengkap, username, password) VALUES ('$nama_lengkap','$username','$password')";
			$execute = $this->db->query($query);
			header("Location: $this->host/panel/pengguna");

        }

        function ubah_pengguna(){

			$id_pengguna  = $_POST['id_pengguna'];
			$nama_lengkap = $_POST['nama_lengkap'];
			$username     = $_POST['username'];

			if($_POST['password']==null || $_POST['password']==''){
				$query = "UPDATE tbl_pengguna SET nama_lengkap='$nama_lengkap', username='$username'WHERE id_pengguna = $id_pengguna";
				$execute = $this->db->query($query);
			}else{
				$password = md5($_POST['password']);
				$query = "UPDATE tbl_pengguna SET nama_lengkap='$nama_lengkap', username='$username', password='$password' WHERE id_pengguna = $id_pengguna";
				$execute = $this->db->query($query);
			}

			header("Location: $this->host/panel/pengguna");

        }

        function hapus_pengguna(){
			$id    = $_POST['id_pengguna'];
			$query = "DELETE FROM tbl_pengguna WHERE id_pengguna = $id";
			$this->db->query($query);
        }

        function ambil_data_pengguna(){
			$id    = $_POST['id_pengguna'];
			$query = "SELECT * FROM tbl_pengguna WHERE id_pengguna = $id";
			echo json_encode(mysqli_fetch_row($this->db->query($query)));
        }
	
	/*
    MODUL PELANGGAN
                */
		function pelanggan(){

            (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

			$query_kategori = "SELECT * FROM tbl_kategori";
			$execute = $this->db->query($query_kategori);

			$query_pelanggan = "SELECT * FROM tbl_pelanggan";
			$execute_pelanggan = $this->db->query($query_pelanggan);

			include './view/back//setting/pelanggan.php';
        }


        function hapus_pelanggan(){
			$id    = $_POST['id_pelanggan'];
			$query = "DELETE FROM tbl_pelanggan WHERE id_pelanggan = $id";
			$this->db->query($query);
        }

        function ambil_data_pelanggan(){
			$id    = $_POST['id_pengguna'];
			$query = "SELECT * FROM table_pelanggan WHERE id=$id";
			echo json_encode(mysqli_fetch_row($this->db->query($query)));
        }

    /*
    MODUL KATEGORI
                */

        function kategori(){

            (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

            $query = "SELECT * FROM tbl_kategori";
            $execute = $this->db->query($query);

            $query_get_all_kategori = "SELECT * FROM tbl_kategori";
            $execute_get_all_kategori = $this->db->query($query_get_all_kategori);

            include './view/back//setting/kategori.php';
        }

        function tambah_kategori(){

            $nama_barang  = $_POST['nama_barang'];
            $deskripsi    = $_POST['deskripsi'];

            $query = "INSERT INTO tbl_kategori (nama, deskripsi) VALUES ('$nama_barang','$deskripsi')";
            $execute = $this->db->query($query);
            header("Location: $this->host/panel/kategori");

        }

        function ubah_kategori(){

            $id_kategori  = $_POST['id_kategori'];
            $nama_barang  = $_POST['nama_barang'];
            $deskripsi    = $_POST['deskripsi'];

            $query = "UPDATE tbl_kategori SET nama='$nama_barang', deskripsi='$deskripsi' WHERE id_kategori=$id_kategori";
            $execute = $this->db->query($query);
            header("Location: $this->host/panel/kategori");

        }

        function hapus_kategori(){
            $id    = $_POST['id_kategori'];
            $query = "DELETE FROM tbl_kategori WHERE id_kategori=$id";
            $this->db->query($query);
        }

        function ambil_data_kategori(){
            $id    = $_POST['id_kategori'];
            $query = "SELECT * FROM tbl_kategori WHERE id_kategori=$id";
            echo json_encode(mysqli_fetch_row($this->db->query($query)));
        }

    /*
    MODUL TRANSAKSI
                */

    function transaksi(){

        (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

        $query = "SELECT * FROM tbl_transaksi";
        $execute = $this->db->query($query);

        $query_get_all_transaksi = "SELECT a.* FROM tbl_transaksi a";
        $execute_get_all_transaksi  = $this->db->query($query_get_all_transaksi);

        include './view/back/navigasi_utama/transaksi.php';
    }


    function ubah_transaksi(){

        (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

        $id_transaksi = Input::post('id_transaksi');
        $status = Input::post('status');

        $query = "UPDATE tbl_transaksi SET status = $status WHERE id_transaksi = '$id_transaksi'";

        $this->db->query($query);

        $this->redirect->to('panel/transaksi');

    }

    function hapus_transaksi(){
        $id    = input::post('id_transaksi');
        $query = "DELETE FROM tbl_transaksi WHERE id_transaksi = '$id'";
        $this->db->query($query);
    }


    function ambil_data_transaksi(){
        $id    = input::post('id_transaksi');
        $query = "SELECT id_transaksi FROM tbl_transaksi WHERE id_transaksi= '$id'";
        echo json_encode(mysqli_fetch_row($this->db->query($query)));
    }

    /*
    MODUL PEMBAYARAN
                */
    function pembayaran(){

        (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));
        
        $data_pembayaran = $this->db->query("SELECT * FROM tbl_pembayaran");

        include './view/back/navigasi_utama/pembayaran.php';

    }

    function rubah_status_pembayaran(){

        $id_transaksi = Input::post('id_transaksi');
        $status_pembayaran = Input::post('status_pembayaran');

        if($status_pembayaran == 0){
            $query = "UPDATE tbl_transaksi, tbl_pembayaran SET tbl_transaksi.status_pembayaran = $status_pembayaran, tbl_transaksi.status = $status_pembayaran, tbl_pembayaran.disetujui = $status_pembayaran
                              WHERE tbl_transaksi.id_transaksi = '$id_transaksi' AND tbl_pembayaran.id_transaksi = '$id_transaksi'";
        } else {
            $query = "UPDATE tbl_transaksi, tbl_pembayaran SET tbl_transaksi.status_pembayaran = $status_pembayaran, tbl_pembayaran.disetujui = $status_pembayaran 
                              WHERE tbl_transaksi.id_transaksi = '$id_transaksi' AND tbl_pembayaran.id_transaksi = '$id_transaksi'";
        }

        $this->db->query($query);

    }

    function ambil_foto_bukti(){

        $id    = Input::post('id_transaksi');
        $query = "SELECT foto_bukti FROM tbl_pembayaran WHERE id_transaksi = '$id'";
        echo json_encode($this->db->query($query)->fetch_array());
        
    }
    
    /**
     * MODUL DETAIL TRANSAKSI
                        */
                       
    function detail_transaksi(){

        (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

        $id_trans = Input::get('id_transaksi');

        $ambil_transaksi = $this->db->query("SELECT tbl_transaksi.*, tbl_pengiriman.* FROM tbl_transaksi JOIN tbl_pengiriman ON tbl_transaksi.id_transaksi = tbl_pengiriman.id_transaksi WHERE tbl_transaksi.id_transaksi = '$id_trans'");

        $ambil_detail_transaksi = $this->db->query("SELECT tbl_transaksi.*, tbl_detail_transaksi.* FROM tbl_transaksi JOIN tbl_detail_transaksi ON tbl_transaksi.id_transaksi = tbl_detail_transaksi.id_transaksi WHERE tbl_transaksi.id_transaksi = '$id_trans'");

        include './view/back/navigasi_utama/detail_transaksi.php';
    }

    /*
    MODUL PENGIRIMAN
                */
    function pengiriman(){

        (Session::exists('isLogin') ? True : $this->redirect->to('panel/login'));

        $query_pengiriman = "SELECT tbl_pengiriman.*, tbl_transaksi.status FROM tbl_pengiriman JOIN tbl_transaksi 
                            ON tbl_pengiriman.id_transaksi = tbl_transaksi.id_transaksi ORDER BY tbl_pengiriman.id_transaksi";
        $data_pengiriman = $this->db->query($query_pengiriman);

        include './view/back/navigasi_utama/pengiriman.php';
        
    }

    function rubah_status_pengiriman(){

        $id_transaksi = Input::post('id_transaksi');
        $status = Input::post('status');

        if($status == 1){
            $this->db->query("UPDATE tbl_transaksi, tbl_pengiriman SET tbl_transaksi.status = $status, tbl_pengiriman.tanggal_dikirim = NULL
                              WHERE tbl_transaksi.id_transaksi = '$id_transaksi'");
        } else {
            $this->db->query("UPDATE tbl_transaksi, tbl_pengiriman SET tbl_transaksi.status = $status, tbl_pengiriman.tanggal_dikirim = CURRENT_TIMESTAMP 
                              WHERE tbl_transaksi.id_transaksi = '$id_transaksi'");
        }
        
    }

    /*
    MODUL LAPORAN
                */
    function laporan() {
        
        include './view/back/laporan/laporan.php';

    }
    
    function lihat_laporan(){
        $master = Input::post('master');
        $tanggal = explode(" - ", Input::post('tanggal'));

        switch($master){
            case 'transaksi':
                $title = 'Laporan Transaksi';
                $query = "SELECT tbl_transaksi.id_transaksi, tbl_pengiriman.nama_penerima, tbl_transaksi.tgl_transaksi, tbl_transaksi.total FROM tbl_transaksi JOIN tbl_pengiriman ON tbl_pengiriman.id_transaksi = tbl_transaksi.id_transaksi 
                 WHERE tgl_transaksi BETWEEN '".trim($tanggal[0])." 01:00:00' AND '".trim($tanggal[1]." 23:59:59' ORDER BY tbl_transaksi.id_transaksi");
                $data_laporan = $this->db->query($query);
                $data_detail_transaksi = $this->db->query("SELECT * FROM tbl_detail_transaksi")->fetch_all();
                // print_r($data_detail_transaksi->fetch_all()); die;
                include './view/back/laporan/print_laporan_transaksi.php';
                break;
            case 'barang':
                $title = 'Laporan Barang';
                $query = "SELECT `nama_barang`, `qty`, `harga` FROM tbl_barang";
                $data_laporan = $this->db->query($query);
                include './view/back/laporan/print_laporan_barang.php';
                break;
        }
    }

    /*
    MODUL LOGIN
                */
    function login(){
        if(Session::exists('isLogin')){
            $this->redirect->to('panel/');
        }
        include './view/back/autentikasi/login.php';
    }

    function do_login(){
        
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = "SELECT * FROM tbl_pengguna WHERE username='$username' AND password='$password'";
        $execute = $this->db->query($query);
        if(mysqli_fetch_row($execute)){
            $_SESSION["isLogin"]=TRUE;
            // header("Location: $this->host/panel");
        }else{
            echo 'TIDAK ADA';
        }
        header("Location: $this->host/panel");
    }

    function do_logout(){
        session_destroy();
        header("Location: $this->host/panel");
    }

}

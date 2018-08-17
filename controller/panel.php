<?php

include_once ('config/config.php');
include_once ('config/database.php');

/**
 * Class Panel
 */
class Panel {

    public $db,$host;

    function __construct() {
        $this->db = new database();
        $this->host = new config();

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
        include './view/back/main.php';
    }


    /*
    MODUL BARANG
                */

    function barang() {
        $query = "SELECT * FROM tbl_kategori";
        $execute = $this->db->query($query);

        $query_get_all_barang = "SELECT a.*,b.nama FROM tbl_barang a JOIN tbl_kategori b ON b.id=a.id_kategori";
        $execute_get_all_barang = $this->db->query($query_get_all_barang);

        include './view/back/barang.php';
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
            header("Location: $this->host/barang");
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
            header("Location: $this->host/barang");
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
        $query = "DELETE FROM tbl_barang WHERE id=$id";
        $this->db->query($query);
    }

    function ambil_data_barang(){
        $id    = $_POST['id_barang'];
        $query = "SELECT * FROM tbl_barang WHERE id=$id";
        echo json_encode(mysqli_fetch_row($this->db->query($query)));
    }

    /*
        MODUL PENGGUNA
                    */

        function pengguna(){
			$query = "SELECT * FROM tbl_kategori";
			$execute = $this->db->query($query);

			$query_get_all_pengguna = "SELECT a.* FROM tbl_pengguna a";
			$execute_get_all_pengguna = $this->db->query($query_get_all_pengguna);

			include './view/back/pengguna.php';
        }

        function tambah_pengguna(){

			$kategori     = $_POST['kategori'];
			$nama_lengkap = $_POST['nama_lengkap'];
			$username     = $_POST['username'];
			$password     = md5($_POST['password']);

			$query = "INSERT INTO tbl_pengguna (level, nama_lengkap, username, password, status) VALUES ('$kategori','$nama_lengkap','$username','$password','1')";
			$execute = $this->db->query($query);
			header("Location: $this->host/panel/pengguna");

        }

        function ubah_pengguna(){

			$id_pengguna  = $_POST['id_pengguna'];
			$kategori     = $_POST['kategori'];
			$nama_lengkap = $_POST['nama_lengkap'];
			$username     = $_POST['username'];

			if($_POST['password']==null || $_POST['password']==''){
				$query = "UPDATE tbl_pengguna SET level='$kategori', nama_lengkap='$nama_lengkap', username='$username', status=1 WHERE id=$id_pengguna";
				$execute = $this->db->query($query);
			}else{
				$password = md5($_POST['password']);
				$query = "UPDATE tbl_pengguna SET level='$kategori', nama_lengkap='$nama_lengkap', username='$username', password='$password', status=1 WHERE id=$id_pengguna";
				$execute = $this->db->query($query);
			}

			header("Location: $this->host/panel/pengguna");

        }

        function hapus_pengguna(){
			$id    = $_POST['id_pengguna'];
			$query = "DELETE FROM tbl_pengguna WHERE id=$id";
			$this->db->query($query);
        }

        function ambil_data_pengguna(){
			$id    = $_POST['id_pengguna'];
			$query = "SELECT * FROM tbl_pengguna WHERE id=$id";
			echo json_encode(mysqli_fetch_row($this->db->query($query)));
        }
	
	/*
    MODUL PELANGGAN
                */
		function pelanggan(){
			$query_kategori = "SELECT * FROM tbl_kategori";
			$execute = $this->db->query($query_kategori);

			$query_pelanggan = "SELECT * FROM tbl_pelanggan";
			$execute_pelanggan = $this->db->query($query_pelanggan);

			include './view/back/pelanggan.php';
        }


        function hapus_pelanggan(){
			$id    = $_POST['id_pelanggan'];
			$query = "DELETE FROM tbl_pelanggan WHERE id = $id";
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
            $query = "SELECT * FROM tbl_kategori";
            $execute = $this->db->query($query);

            $query_get_all_kategori = "SELECT a.* FROM tbl_kategori a";
            $execute_get_all_kategori = $this->db->query($query_get_all_kategori);

            include './view/back/kategori.php';
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

            $query = "UPDATE tbl_kategori SET nama='$nama_barang', deskripsi='$deskripsi' WHERE id=$id_kategori";
            $execute = $this->db->query($query);
            header("Location: $this->host/panel/kategori");

        }

        function hapus_kategori(){
            $id    = $_POST['id_kategori'];
            $query = "DELETE FROM tbl_kategori WHERE id=$id";
            $this->db->query($query);
        }

        function ambil_data_kategori(){
            $id    = $_POST['id_kategori'];
            $query = "SELECT * FROM tbl_kategori WHERE id=$id";
            echo json_encode(mysqli_fetch_row($this->db->query($query)));
        }

    /*
    MODUL TRANSAKSI
                */

    function transaksi(){
        $query = "SELECT * FROM tbl_transaksi";
        $execute = $this->db->query($query);

        $query_get_all_transaksi = "SELECT a.* FROM tbl_transaksi a";
        $execute_get_all_transaksi  = $this->db->query($query_get_all_transaksi);

        include './view/back/transaksi.php';
    }

    function tambah_transaksi(){

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
        header("Location: $this->host/barang");
        }else{
            //gagal upload

            if($_FILES["file"]["error"]==4){
            $query = "INSERT INTO tbl_barang (id_kategori, nama_barang, qty, harga, status) VALUES ('$kategori','$nama_barang','$qty','$harga_satuan','1')";
            $execute = $this->db->query($query);
            header("Location: $this->host/barang");
            }
        }

        }

    function ubah_transaksi(){

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
        header("Location: $this->host/barang");
        }else{

            if($_FILES["file"]["error"]==4){
            $query = "UPDATE tbl_barang SET id_kategori='$kategori', nama_barang='$nama_barang', qty='$qty', harga='$harga_satuan', status=2 WHERE id=$id_barang";

            $execute = $this->db->query($query);
            header("Location: $this->host/panel/barang");
            }
        }

        }

    function hapus_transaksi(){
        $id    = $_POST['id_barang'];
        $query = "DELETE FROM tbl_barang WHERE id=$id";
        $this->db->query($query);
    }

    function ambil_data_transaksi(){
        $id    = $_POST['id_barang'];
        $query = "SELECT * FROM tbl_barang WHERE id=$id";
        echo json_encode(mysqli_fetch_row($this->db->query($query)));
    }

    /*
    MODUL LOGIN
                */
    function login(){
        // $query = "SELECT * FROM tbl_transaksi";
        // $execute = $this->db->query($query);
        //
        // $query_get_all_transaksi = "SELECT a.* FROM tbl_transaksi a";
        // $execute_get_all_transaksi  = $this->db->query($query_get_all_transaksi);

        include './view/back/login.php';
    }

    function do_login(){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = "SELECT * FROM tbl_pengguna WHERE username='$username' AND password='$password' AND level='admin'";
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

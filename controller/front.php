<?php

include_once ('config/config.php');
include_once ('config/database.php');

/**
 * Class Panel
 */
class Front {

    public $db, $host, $redirect;

    function __construct() {
        // code...
        session_start();
        $this->db = new database();
        $this->host = new config();
        $this->redirect = new redirect();
        $this->host = 'http://'.$this->host->curExpPageURL()[2].'/'.$this->host->curExpPageURL()[3];
    }

    function index() {

        $execute_get_all_barang = $this->db->query("SELECT * FROM tbl_barang");
        $all_kategori = $this->db->query("SELECT nama, id FROM tbl_kategori");

        include './view/front/main.php';
        //echo 'HALO';
    }

    function register(){
        if(!Session::exists('email')){

            $kategori = $this->db->query("SELECT nama FROM tbl_kategori");

            include './view/front/register.php';

        } else {
            $this->redirect->to('front');
        }
    }

    function process_register(){

        $data_ok = true;

        $nama_lengkap = Input::post('nama_lengkap');
        $email = Input::post('email');
        $no_telepon = Input::post('no_telepon');
        $password = md5(Input::post('password'));

        $check_data = [$nama_lengkap, $email, $no_telepon, $password];

        for($i = 0; $i < count($check_data); $i++){
            if(empty($check_data[$i])){
                $data_ok = false;
            }
        }

        if ($data_ok){

            $query = "INSERT INTO `tbl_pelanggan`(`nama_lengkap`, `email`, `no_telp`, `password`) VALUES ('$nama_lengkap','$email','$no_telepon','$password')";

            if(Input::post('password') == Input::post('re_password')){
                $result = $this->db->query($query);
            
                if($result){
                    print " <script>
                                window.location='".$this->redirect->get_url('login')."';
                                alert('Registrasi Berhasil!');
                            </script>";
                } else {
                    print " <script>
                                window.location='".$this->redirect->get_url('index')."';
                                alert('Registrasi Gagal!');
                            </script>";
                }
            } else {
                print " <script>
                            window.location='".$this->redirect->get_url('register')."';
                            alert('Password Konfirmasi tidak sesuai');
                        </script>";
            }
        } else {
            print " <script>
                        window.location='".$this->redirect->get_url('register')."';
                        alert('Data Registrasi Belum Lengkap');
                    </script>";
        }
    }

    function login(){
        if(!Session::exists('email')){

            $kategori = $this->db->query("SELECT nama FROM tbl_kategori");

            include './view/front/login.php';
        } else {
            $this->redirect->to('front');
        }
    }

    function process_login(){
        if(Input::post('submit')){

            $email = Input::post('email');
            $password = md5(Input::post('password'));

            $query = "SELECT * FROM tbl_pelanggan WHERE email = '$email' AND password = '$password'";
            $login = $this->db->query($query);

            if($login->num_rows > 0){
                while($column = mysqli_fetch_assoc($login)){
                    Session::set('id_pelanggan', $column['id']);
                    Session::set('email', $column['email']);
                    Session::set('nama_pelanggan', $column['nama_lengkap']);
                }
                print " <script>
                            window.location='".$this->redirect->get_url('index')."';
                            alert('Login Berhasil!');
                        </script>";
            } else {
                print " <script>
                            window.location='".$this->redirect->get_url('login')."';
                            alert('email atau Password Salah!');
                        </script>";
            }
            
        } else {
            $this->redirect->to('login');
        }
    }

    function logout(){
        session_destroy();
        $this->redirect->to('index');
    }
	
    function kategori(){
        $id_kategori = Input::get('id_kategori');

        $data_kue = $this->db->query("SELECT * FROM tbl_barang WHERE id_kategori = '$id_kategori'");
        $all_kategori = $this->db->query("SELECT nama, id FROM tbl_kategori");

        include './view/front/kategori/daftar_kue.php';
    }

    function detail_kue(){
        $all_kategori = $this->db->query("SELECT nama, id FROM tbl_kategori");
        $detail = $this->db->query("SELECT * FROM tbl_barang WHERE id =".Input::get("id_kue"))->fetch_assoc();

        include "./view/front/kategori/detail_kue.php";
    }

    function tambah_keranjang(){
        if(Session::exists('email')){
            
            $id_pelanggan = Session::get('id_pelanggan');
            $id_barang = Input::get('id_kue');
            $qty = Input::post('qty');

            $data = $this->db->query("SELECT harga FROM tbl_barang WHERE id = $id_barang")->fetch_array();

           
            $subtotal = $data[0] * $qty;

            $query = "INSERT INTO tbl_keranjang(id_pelanggan, id_barang, qty, subtotal) VALUES (".Session::get('id_pelanggan').", ".Input::get('id_kue').", $qty, $subtotal)";

        } else {
            print " <script>
                        window.location='".$this->redirect->get_url('login')."';
                        alert('Anda Harus Login Terlebih Dahulu.');
                    </script>";
        }
    }
}

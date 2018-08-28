<?php
$conf = new config();
$host = 'http://'.$conf->curExpPageURL()[2].'/'.$conf->curExpPageURL()[3];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Green Bakery | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/dist/css/skins/_all-skins.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Green</b>Bakery</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=$host;?>/assets/back/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Administrator</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=$host;?>/assets/back/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Administrator
                  <small>-</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=$host;?>/panel/do_logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=$host;?>/assets/back/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="<?=$host;?>/panel">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?=$host;?>/panel/barang">
            <i class="fa fa-folder-open"></i> <span>Barang</span>
          </a>
        </li>
        <li>
          <a href="<?=$host;?>/panel/transaksi">
            <i class="fa fa-folder-open"></i>
            <span>Transaksi</span>
          </a>
        </li>
        <li>
          <a href="<?=$host;?>/panel/pembayaran">
            <i class="fa fa-folder-open"></i>
            <span>Pembayaran</span>
          </a>
        </li>
        <li class="header">SETTINGS</li>
        <li><a href="<?=$host;?>/panel/pengguna"><i class="fa fa-folder-open"></i> <span>Pengguna</span></a></li>
		<li><a href="<?=$host;?>/panel/pelanggan"><i class="fa fa-folder-open"></i> <span>Pelanggan</span></a></li>
        <li><a href="<?=$host;?>/panel/kategori"><i class="fa fa-folder-open"></i> <span>Kategori</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Transaksi
        <small>Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pembeli</h3>
            </div>
            <!-- /.box-header -->

      <?php
      $row = $ambil_transaksi->fetch_assoc();
      ?>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ID TRANSAKSI</th>
            <td><?=$row['id_transaksi'];?></td>
            <th>NO TELPON</th>
            <td><?=$row['no_telp'];?></td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <th>NAMA PENERIMA</th>
            <td><?=$row['nama_penerima'];?></td>
            <th>EMAIL PENERIMA</th>
            <td><?=$row['email'];?></td>
          </tr>
          </tbody>
          <thead>
          <tr>
            <th>ALAMAT PENERIMA</th>
            <td><?=$row['alamat'];?></td>
            <th>CATATAN PENERIMA</th>
            <td><?=$row['catatan'];?></td>
          </tr>
          </thead>
        </table>
      </div>

          <!-- /.box-body -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Barang Yang Dibeli</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
               <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>NAMA BARANG</th>
              <th>QTY</th>
              <th>SUBTOTAL</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($detail = $ambil_detail_transaksi->fetch_assoc()){
                ?>
            <tr>
              <td><?=$detail['nama_barang'];?></td>
              <td><?=$detail['qty'];?></td>
              <td><?=$detail['subtotal'];?></td>
            </tr>
          <?php } ?>
            </tbody>
          </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->

        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

        </section>
        <!-- /.Left col -->

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="txtTitleModalTransaksi">Edit Transaksi</h4>
        </div>
        <div class="modal-body">

          <form role="form" id="idFormModalTransaksi" method="POST" action="<?=$host;?>/panel/ubah_transaksi">
            <div class="box-body">
              <div class="form-group">
                <input type="hidden" name="id_transaksi" id="idTxtIDTransaksi">
                  <label>Pilih Status</label>
                  <select class="form-control" name="status" id="idSelectStatus">
                      <option value="0">Belum Di Proses</option>
                      <option value="1">Sedang Di Proses</option>
                      <option value="2">Selesai Di Proses</option>
                  </select>
              </div>
            </div>
            <!-- /.box-body -->


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="#">Green Bakery</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=$host;?>/assets/back/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=$host;?>/assets/back/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=$host;?>/assets/back/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?=$host;?>/assets/back/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$host;?>/assets/back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="<?=$host;?>/assets/back/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=$host;?>/assets/back/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$host;?>/assets/back/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?=$host;?>/assets/back/dist/js/demo.js"></script>

<script>
  $(function () {
    $('#transaksi').DataTable()
  })

  $(".hapus").click(function(){
    var id = this.id;
    var x = confirm("Apakah anda yakin?");
    if(x){
      $.post('<?=$host;?>/panel/hapus_transaksi',{id_transaksi:id}).done(function(){
        alert('Berhasil');
        location.reload();
      })
    }

  })

  $('.edit').click(function(){
    var id = this.id;
    $('#modal-default').modal();
    $("#txtTitleModalTransaksi").html("Ubah Barang");
    $("#idFormModalTransaksi").attr("action", "<?=$host;?>/panel/ubah_transaksi");
    $("#idTxtIDTransaksi").val(id);
  })
</script>

</body>
</html>

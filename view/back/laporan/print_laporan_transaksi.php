<?php
    $conf = new config();
    $host = 'http://'.$conf->curExpPageURL()[2].'/'.$conf->curExpPageURL()[3];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Green Bakery</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=$host."/assets/back/"?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$host."/assets/back/"?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=$host."/assets/back/"?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$host."/assets/back/"?>dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Green Bakery
          <small class="pull-right">Tanggal : <?=(new DateTime)->format('y-m-d')?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row">
      <div class="col-sm-12" style="text-align: center;">
        <h1><?=$title?></h1><hr>
      </div>
      <!-- /.col -->
      <div class="col-sm-12">
      <h4>Periode : <?=$tanggal[0]?> s/d <?=$tanggal[1]?></h4>
      </div>
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr style="background-color: #c1c1c1;">
                <th>ID Transaksi</th>
                <th>Nama Penerima</th>
                <th>Tanggal Transaksi</th>
                <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0; ?>
              <?php while($column = $data_laporan->fetch_object()) : ?>
              <?php $id = $column->id_transaksi?>
                <tr style="background-color: #e4e4e4a6;">
                    <td><b><?php echo $column->id_transaksi?></b></td>
                    <td><b><?php echo $column->nama_penerima?></b></td>
                    <td><b><?php echo $column->tgl_transaksi?></b></td>
                    <td><b>IDR <?php echo $column->total?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <th>Nama Barang</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach($data_detail_transaksi as $key => $value): ?>
                  <?php if ($value[0] == $id):?>
                  <tr>
                      <td></td>
                      <td><i><?=$value[1].' x'.$value[2]?></i></td>
                      <td><i>IDR <?=$value[3]?></i></td>
                  </tr>
                  <?php endif ?>
                <?php endforeach?>
              <?php $total += $column->total ?>
              <?php endwhile ?>
          </tbody>
          <tfoot>
              <tr style="background-color: #c1c1c1;">
                  <td></td>
                  <td></td>
                  <td><b>Total Keseluruhan</b></td>
                  <td><b>IDR <?=$total?></b></td>
              </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>

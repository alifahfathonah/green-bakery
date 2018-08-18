<?php 
    $conf = new config();
    $host = 'http://'.$conf->curExpPageURL()[2].'/'.$conf->curExpPageURL()[3];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Green Bakery</title>

        <!-- Icon css link -->
        <link href="<?=$host."/assets/front/";?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?=$host."/assets/front/";?>vendors/line-icon/css/simple-line-icons.css" rel="stylesheet">
        <link href="<?=$host."/assets/front/";?>vendors/elegant-icon/style.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="<?=$host."/assets/front/";?>css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="<?=$host."/assets/front/";?>vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="<?=$host."/assets/front/";?>vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="<?=$host."/assets/front/";?>vendors/revolution/css/navigation.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="<?=$host."/assets/front/";?>vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="<?=$host."/assets/front/";?>vendors/bootstrap-selector/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?=$host."/assets/front/";?>vendors/jquery-ui/jquery-ui.css" rel="stylesheet">
        
        <link href="<?=$host."/assets/front/";?>css/style.css" rel="stylesheet">
        <link href="<?=$host."/assets/front/";?>css/responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style> .top_right li.cart a::before { content: "<?=$keranjang['pesanan'];?>"; } </style>
    </head>
    <body>

        <!--================Top Header Area =================-->
        <div class="header_top_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="top_header_left">


                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                                <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button"><i class="icon-magnifier"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="top_header_middle">
                            <a href="#"><i class="fa fa-phone"></i> Call Us: <span>+84 987 654 321</span></a>
                            <a href="#"><i class="fa fa-envelope"></i> Email: <span>support@greenbakery.com</span></a>
                            <img src="<?=$host;?>/assets/front/img/logo2.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="top_right_header">
                            <ul class="header_social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                            </ul>
                            <ul class="top_right">
                                <?php if (Session::exists('email')): ?>
                                    <li class="user"><a href="#"><i class="icon-user icons"></i></a></li>
                                    <li class="cart"><a href="<?=$host."/keranjang";?>"><i class="icon-handbag icons"></i></a></li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Top Header Area =================-->

        <!--================Menu Area =================-->
        <header class="shop_header_area">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#"><img src="img/logo2.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item active"><a class="nav-link" href="<?=$host."/front";?>">Beranda</a></li>
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Kategori Kue <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                <?php while($column = mysqli_fetch_array($all_kategori)) { ?>
                                    <li class="nav-item"><a class="nav-link" href="<?=$host."/front/kategori/?id_kategori=".$column["id"]."&jenis_kategori=".$column['nama'];?>"><?php echo $column['nama']; ?></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Hubungi Kami</a></li>
                        </ul>
                        <?php if (!Session::exists('id_pelanggan')) { ?>
                            <ul class="navbar-nav navbar-right ml-auto mr-2">
                                <li class="nav-item"><a href="<?=$host?>/front/login" class="nav-link"> Masuk</a></li>
                            </ul>
                        <?php } else { ?>
                            <ul class="navbar-nav navbar-right ml-auto mr-2">
                                <li class="nav-item mr-2"><a href="#" class="nav-link"><?php echo Session::get('nama_pelanggan');?></a></li>
                                <li class="nav-item"><a href="<?=$host?>/front/logout" class="nav-link">[ Keluar ]</a></li>
                            </ul>
                        <?php } ?>
                    </div>
                </nav>
            </div>
        </header>
        <!--================End Menu Area =================-->
        
         <!--================Shopping Cart Area =================-->
         <?php if($keranjang['pesanan'] != 0){ ?>
         <section class="shopping_cart_area p_100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart_items">
                            <h3>Keranjang Belanja Anda</h3>
                            <div class="table-responsive-md">
                                <table class="table">
                                    <tbody>
                                        <?php while($column = $data_pembelian->fetch_assoc()): ?>
                                        <tr>
                                            <th scope="row">
                                                <a href="<?=$host."/keranjang/hapus_item/?id_barang=".$column['id_barang']."&qty_barang=".$column['qty'];?>">
                                                    <img src="<?=$host."/assets/front/";?>img/icon/close-icon.png" alt="">
                                                </a>
                                            </th>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img width="99px" height="131px" src="<?=$host."/uploads/".$column['foto'];?>" alt="<?=$column['nama_barang'];?>">
                                                    </div>
                                                    <div class="media-body">
                                                        <h4><?=$column['nama_barang'];?></h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><p class="red">IDR <?=$column['harga'];?></p></td>
                                            <!-- <form action="" method="GET"> -->
                                                <td>
                                                    <div class="quantity">
                                                        <h6>Quantity</h6>
                                                        <div class="custom">
                                                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0) result.value--; return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                                            <input type="text" name="qty" id="sst" maxlength="12" value="<?=$column['qty'];?>" title="Quantity:" class="input-text qty">
                                                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++; return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><p>IDR <?=$column['subtotal'];?></p></td>
                                                <td>
                                                    <div class="quantity" style="padding: 0.5em;">
                                                        <div class="custom">
                                                            <button onclick="window.location = '<?=$host.'/keranjang/update_qty/?id_produk='.$column['id_barang'].'&qty_awal='.$column['qty'].'&qty_baru=';?>'+document.getElementById('sst').value;" style="background-color: transparent; border: none;" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            <!-- </form> -->
                                            <?php $total += $column['subtotal']; ?>
                                        </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart_totals_area">
                            <h4>Cart Totals</h4>
                            <div class="cart_t_list">
                                <div class="media">
                                    <div class="d-flex">
                                        <h5>Subtotal</h5>
                                    </div>
                                    <div class="media-body">
                                        <h6>$14</h6>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <h5>Shipping</h5>
                                    </div>
                                    <div class="media-body">
                                        <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model tex</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        
                                    </div>
                                    <div class="media-body">
                                        <select class="selectpicker">
                                            <option>Calculate Shipping</option>
                                            <option>Calculate Shipping</option>
                                            <option>Calculate Shipping</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="total_amount row m0 row_disable">
                                <div class="float-left">
                                    Total
                                </div>
                                <div class="float-right">
                                    IDR <?php echo $total; ?>
                                </div>
                            </div>
                        </div>
                        <a href="<?=$host."/keranjang/checkout"?>" class="btn subs_btn form-control">Proses Pesanan</a>
                        <!-- <button type="submit" value="submit" class="btn subs_btn form-control">Proceed to checkout</button> -->
                    </div>
                </div>
            </div>
        </section>
        <?php } else { ?>
        <section class="emty_cart_area p_100">
            <div class="container">
                <div class="emty_cart_inner">
                    <i class="icon-handbag icons"></i>
                    <h3>Keranjang Anda Masih Kosong</h3>
                    <h4>Silahkan <a href="<?=$host;?>">Kembali</a></h4>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--================End Shopping Cart Area =================-->
        
        <!--================Footer Area =================-->
        <footer class="footer_area">
            <div class="container">
                <div class="footer_widgets">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-6">
                            <aside class="f_widget f_about_widget">
                                <img src="img/logo.png" alt="">
                                <p>Persuit is a Premium PSD Template. Best choice for your online store. Let purchase it to enjoy now</p>
                                <h6>Social:</h6>
                                <ul>
                                    <li><a href="#"><i class="social_facebook"></i></a></li>
                                    <li><a href="#"><i class="social_twitter"></i></a></li>
                                    <li><a href="#"><i class="social_pinterest"></i></a></li>
                                    <li><a href="#"><i class="social_instagram"></i></a></li>
                                    <li><a href="#"><i class="social_youtube"></i></a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_info_widget">
                                <div class="f_w_title">
                                    <h3>Information</h3>
                                </div>
                                <ul>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Delivery information</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Help Center</a></li>
                                    <li><a href="#">Returns & Refunds</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_service_widget">
                                <div class="f_w_title">
                                    <h3>Customer Service</h3>
                                </div>
                                <ul>
                                    <li><a href="#">My account</a></li>
                                    <li><a href="#">Ordr History</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Newsletter</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_extra_widget">
                                <div class="f_w_title">
                                    <h3>Extras</h3>
                                </div>
                                <ul>
                                    <li><a href="#">Brands</a></li>
                                    <li><a href="#">Gift Vouchers</a></li>
                                    <li><a href="#">Affiliates</a></li>
                                    <li><a href="#">Specials</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_account_widget">
                                <div class="f_w_title">
                                    <h3>My Account</h3>
                                </div>
                                <ul>
                                    <li><a href="#">My account</a></li>
                                    <li><a href="#">Ordr History</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Newsletter</a></li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="footer_copyright">
                    <h5>© <script>document.write(new Date().getFullYear());</script> <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</h5>
                </div>
            </div>
        </footer>
        <!--================End Footer Area =================-->
        
        
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?=$host."/assets/front/";?>js/jquery-3.2.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?=$host."/assets/front/";?>js/popper.min.js"></script>
        <script src="<?=$host."/assets/front/";?>js/bootstrap.min.js"></script>
        <!-- Rev slider js -->
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <!-- Extra plugin css -->
        <script src="<?=$host."/assets/front/";?>vendors/counterup/jquery.waypoints.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/counterup/jquery.counterup.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/bootstrap-selector/js/bootstrap-select.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/image-dropdown/jquery.dd.min.js"></script>
        <script src="<?=$host."/assets/front/";?>js/smoothscroll.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/magnify-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/vertical-slider/js/jQuery.verticalCarousel.js"></script>
        <script src="<?=$host."/assets/front/";?>vendors/jquery-ui/jquery-ui.js"></script>
        
        <script src="<?=$host."/assets/front/";?>js/theme.js"></script>
    </body>
</html>
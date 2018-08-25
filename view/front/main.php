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

        <link rel="icon" href="<?=$host;?>/assets/front/img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Green Bakery</title>

        <!-- Icon css link -->
        <link href="<?=$host;?>/assets/front/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?=$host;?>/assets/front/vendors/line-icon/css/simple-line-icons.css" rel="stylesheet">
        <link href="<?=$host;?>/assets/front/vendors/elegant-icon/style.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="<?=$host;?>/assets/front/css/bootstrap.min.css" rel="stylesheet">

        <!-- Rev slider css -->
        <link href="<?=$host;?>/assets/front/vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="<?=$host;?>/assets/front/vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="<?=$host;?>/assets/front/vendors/revolution/css/navigation.css" rel="stylesheet">

        <!-- Extra plugin css -->
        <link href="<?=$host;?>/assets/front/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="<?=$host;?>/assets/front/vendors/bootstrap-selector/css/bootstrap-select.min.css" rel="stylesheet">

        <link href="<?=$host;?>/assets/front/css/style.css" rel="stylesheet">
        <link href="<?=$host;?>/assets/front/css/responsive.css" rel="stylesheet">

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
                            <?php if(Session::exists('id_pelanggan')) : ?>
                                <li class="nav-item"><a class="nav-link" href="<?=$host.'/front/pesanan';?>">Pesanan</a></li>
                            <?php endif ?>
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

        <!--================Slider Area =================-->
        <section class="main_slider_area">
            <div class="container">
                <div id="main_slider" class="rev_slider" data-version="5.3.1.6">
                    <ul>
                        <li data-index="rs-1587" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="img/home-slider/slider-11.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="<?=$host;?>/assets/front/img/home-slider/slider-11.jpg"  alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

                            <!-- LAYER NR. 1 -->
                            <div class="slider_text_box">
                                <div class="tp-caption tp-resizeme first_text"
                                data-x="['right','right','right','center','center']"
                                data-hoffset="['0','0','0','0']"
                                data-y="['top','top','top','top']"
                                data-voffset="['60','60','60','80','95']"
                                data-fontsize="['54','54','54','40','40']"
                                data-lineheight="['64','64','64','50','35']"
                                data-width="['470','470','470','300','250']"
                                data-height="none"
                                data-whitespace="['nowrap','nowrap','nowrap','nowrap','nowrap']"
                                data-type="text"
                                data-responsive_offset="on"
                                data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                data-textAlign="['left','left','left','left','left','center']"
                                style="z-index: 8;font-family: Montserrat,sans-serif;font-weight:700;color:#FFF !important;"><img src="img/home-slider/2017-text.png" alt=""></div>

                                <div class="tp-caption tp-resizeme secand_text"
                                    data-x="['right','right','right','center','center',]"
                                    data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['255','255','255','230','220']"
                                    data-fontsize="['48','48','48','48','36']"
                                    data-lineheight="['52','52','52','46']"
                                    data-width="['450','450','450','450','450']"
                                    data-height="none"
                                    data-whitespace="normal"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-transform_idle="o:1;"
                                    data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                    data-textAlign="['left','left','left','left','left','center']"
                                    style="color: #FFF !important;"
                                    >Bakkery <br />Collection
                                </div>

                                <div class="tp-caption tp-resizeme third_btn"
                                    data-x="['right','right','right','center','center','center']"
                                    data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['385','385','385','385','350']"
                                    data-width="['450','450','450','auto','auto']"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                    data-textAlign="['left','left','left','left','left','center']">
                                    <a class="checkout_btn" href="#">Selengkapnya</a>
                                </div>
                            </div>
                        </li>
                        <li data-index="rs-1588" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="img/home-slider/slider-2.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="<?=$host;?>/assets/front/img/home-slider/slider-11.jpg"  alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="slider_text_box">
                                <div class="tp-caption tp-resizeme first_text"
                                data-x="['right','right','right','center','center']"
                                data-hoffset="['0','0','0','0']"
                                data-y="['top','top','top','top']"
                                data-voffset="['60','60','60','80','95']"
                                data-fontsize="['54','54','54','40','40']"
                                data-lineheight="['64','64','64','50','35']"
                                data-width="['470','470','470','300','250']"
                                data-height="none"
                                data-whitespace="['nowrap','nowrap','nowrap','nowrap','nowrap']"
                                data-type="text"
                                data-responsive_offset="on"
                                data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                data-textAlign="['left','left','left','left','left','center']"
                                style="z-index: 8;font-family: Montserrat,sans-serif;font-weight:700;color:#FFF !important;"><img src="img/home-slider/2017-text.png" alt=""></div>

                                <div class="tp-caption tp-resizeme secand_text"
                                    data-x="['right','right','right','center','center',]"
                                    data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['255','255','255','230','220']"
                                    data-fontsize="['48','48','48','48','36']"
                                    data-lineheight="['52','52','52','46']"
                                    data-width="['450','450','450','450','450']"
                                    data-height="none"
                                    data-whitespace="normal"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-transform_idle="o:1;"
                                    data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                    data-textAlign="['left','left','left','left','left','center']"
                                    style="color:#FFF !important;"
                                    >Quality <br />&amp; Services
                                </div>

                                <div class="tp-caption tp-resizeme third_btn"
                                    data-x="['right','right','right','center','center','center']"
                                    data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['385','385','385','385','350']"
                                    data-width="['450','450','450','auto','auto']"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                    data-textAlign="['left','left','left','left','left','center']">
                                    <a class="checkout_btn" href="#">Selengkapnya</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!--================End Slider Area =================-->


        <!--================Our Latest Product Area =================-->
        <section class="our_latest_product">
            <div class="container">
                <div class="s_m_title">
                    <h2>Kue Terbaru Green Bakery</h2>
                </div>
                <div class="l_product_slider owl-carousel">
                    <?php while($column = mysqli_fetch_array($execute_get_all_barang)): ?>
                    <div class="item">
                        <div class="l_product_item">
                            <div class="l_p_img">
                                <a href="<?=$host."/front/detail_kue/?id_kue=".$column[0]."&id_kategori=".$column[1];?>">
                                <img src="<?=$host;?>/uploads/<?=$column[5];?>">
                                </a>
                            </div>
                            <div class="l_p_text">
                                <ul>
                                    <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                    <li><a class="add_cart_btn" href="<?=$host."/front/detail_kue/?id_kue=".$column[0]."&id_kategori=".$column[1];?>">Lihat Detail</a></li>
                                    <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                                </ul>
                                <h4><?=$column[2];?></h4>
                                <h5>IDR <?=$column[4];?></h5>
                            </div>
                        </div>
                    </div>
                    <?php endwhile ?>
                </div>
            </div>
        </section>
        <!--================End Our Latest Product Area =================-->

        <!--================Feature Big Add Area =================-->
        <section class="feature_big_add_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="f_add_item white_add">
                            <div class="f_add_img"><img class="img-fluid" src="<?=$host;?>/assets/front/img/feature-add/kue-kering.jpg" alt=""></div>
                            <div class="f_add_hover">
                                <h4>Kue Kering <br/>Indonesia</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="f_add_item white_add">
                            <div class="f_add_img"><img class="img-fluid" src="<?=$host;?>/assets/front/img/feature-add/kue-basah.jpg" alt=""></div>
                            <div class="f_add_hover">
                                <h4>Kue Basah <br />Indonesia</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Feature Big Add Area =================-->

        <!--================Product_listing Area =================-->
        <section class="product_listing_area">
            <div class="container">
                <div class="row p_listing_inner">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6 col-sm-8">
                                <div class="p_list_text">
                                    <h3>Kue Basah</h3>
                                    <ul>
                                        <li><a href="#">Bolu Gulung</a></li>
                                        <li><a href="#">Kue Lapis</a></li>
                                        <li><a href="#">Prol Tape</a></li>
                                        <li><a href="#">Caramel Cake</a></li>
                                        <li><a href="#">Tiramisu</a></li>
                                        <li><a href="#">Apple Pie</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-4">
                                <div class="p_list_img">
                                    <img src="<?=$host;?>/assets/front/img/product/p-categories-list/bolu-gulung.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6 col-sm-8">
                                <div class="p_list_text">
                                    <h3>Kue Kering</h3>
                                    <ul>
                                        <li><a href="#">Kue Bawang</a></li>
                                        <li><a href="#">Cookies Coklat</a></li>
                                        <li><a href="#">Kue Kacang</a></li>
                                        <li><a href="#">Nastar</a></li>
                                        <li><a href="#">Kastengel</a></li>
                                        <li><a href="#">Lidah Kucing</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-4">
                                <div class="p_list_img">
                                    <img src="<?=$host;?>/assets/front/img/product/p-categories-list/kastengel.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6 col-sm-8">
                                <div class="p_list_text">
                                    <h3>Tradisional</h3>
                                    <ul>
                                        <li><a href="#">Lapis Legit</a></li>
                                        <li><a href="#">Sus Buah</a></li>
                                        <li><a href="#">Lumpur Pisang</a></li>
                                        <li><a href="#">Sus Coklat</a></li>
                                        <li><a href="#">Lapis Beras</a></li>
                                        <li><a href="#">Putu Tegal</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-4">
                                <div class="p_list_img">
                                    <img src="<?=$host;?>/assets/front/img/product/p-categories-list/sus-buah.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Product_listing Area =================-->

        <!--================Footer Area =================-->
        <footer class="footer_area">
            <div class="container">
                <div class="footer_widgets">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-6">
                            <aside class="f_widget f_about_widget">
                                <img src="<?=$host;?>/assets/front/img/logo2.png" alt="">
                                <p>Green Bakery is a bakery shop online, which you can order anywhere, anytime</p>
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
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_service_widget">
                                <div class="f_w_title">
                                    <h3>Customer Service</h3>
                                </div>
                                <ul>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order History</a></li>
                                </ul>
                            </aside>
                        </div>

                        <div class="col-lg-4 col-md-4 col-6">
                            <aside class="f_widget link_widget f_account_widget">
                                <div class="f_w_title">
                                    <h3>Contact</h3>
                                </div>
                                <ul>
                                    <li>Address: Jln. Margonda Depok 2 No.20 15123 - Kota Depok </li>
                                    <li>Phone: 021-8722123</li>
                                    <li>E-Mail: info@greenbakery.com</li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="footer_copyright">
                    <h5>
                        &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                    </h5>
                </div>
            </div>
        </footer>
        <!--================End Footer Area =================-->




        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?=$host;?>/assets/front/js/jquery-3.2.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?=$host;?>/assets/front/js/popper.min.js"></script>
        <script src="<?=$host;?>/assets/front/js/bootstrap.min.js"></script>
        <!-- Rev slider js -->
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <!-- Extra plugin css -->
        <script src="<?=$host;?>/assets/front/vendors/counterup/jquery.waypoints.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/counterup/jquery.counterup.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/bootstrap-selector/js/bootstrap-select.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/image-dropdown/jquery.dd.min.js"></script>
        <script src="<?=$host;?>/assets/front/js/smoothscroll.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/magnify-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/vertical-slider/js/jQuery.verticalCarousel.js"></script>
        <script src="<?=$host;?>/assets/front/vendors/jquery-ui/jquery-ui.js"></script>

        <script src="<?=$host;?>/assets/front/js/theme.js"></script>
    </body>
</html>

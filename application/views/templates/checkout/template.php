<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    if (isset($_SESSION['id'])) {
        header("Location:" . BASE_URL() . "products");
    }
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <!-- Flaticon CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font/flaticon.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css">
    <!-- Main Menu CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/meanmenu.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">
    <!-- Nouislider Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nouislider.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toastr.min.css">

    <?php if(isset($additional_css)) : ?>
        <?php foreach($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo base_url() . $css ;?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Modernizr Js -->
    <script src="<?php echo base_url(); ?>assets/js/modernizr-2.8.3.min.js"></script>

    
</head>

<body>
    <div class="wrapper-area">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <!-- Header Area Start Here -->
        <header>
            <div class="header-area-style3" id="sticker">
                <div class="header-top">
                    <div class="header-top-inner-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="logo-area">
                                        <!-- <a href="index.html"><img class="img-responsive" src="img/logo.png" alt="logo"></a> -->
                                        <a href="<?php echo BASE_URL();?>shop" style="color:black;"><h3><strong>CASA</strong>MODA</h1></a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <ul class="header-cart-area">
                                        <li>
                                            <div class="cart-area">
                                                <a href="#" id="cartTotal"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>2</span></a>
                                                <ul id="cartContents">
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                        <div class="additional-menu-area" id="additional-menu-area">
                                                <div id="mySidenav" class="sidenav">
                                                    <a href="#" class="closebtn">×</a>
                                                    <h3 class="ctg-name-title">Category Name List</h3>
                                                    <ul class="sidenav-nav">
                                                        <?php foreach($categories as $category): ?>
                                                            <li>
                                                                <a href="<?php echo BASE_URL() . 'shop/cat/' . $category->id ;?>">
                                                                    <?php echo $category->name; ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                    <!-- times-->
                                                </div>
                                                <span class="side-menu-open side-menu-trigger"><i class="fa fa-bars" aria-hidden="true"></i></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                <div class="logo-area">
                                    <a href="<?php echo BASE_URL();?>shop" style="color:black;"><h3><strong>CASA</strong>MODA</h1></a>
                                </div>
                                <div class="category-menu-area" id="category-menu-area-top">
                                    <h2 class="category-menu-title"><a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>Categories</h2>
                                    <ul class="category-menu-area-inner">
                                        <?php foreach($categories as $category): ?>
                                            <li>
                                                <a href="<?php echo BASE_URL() . 'shop/cat/' . $category->id ;?>">
                                                    <?php echo $category->name; ?>
                                                </a>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="main-menu-area">
                                    <nav>
                                        <ul>
                                        <li><a href="<?php echo BASE_URL();?>shop">Home</a></li>
                                            <li><a href="<?php echo BASE_URL();?>shop/ordersearch">Order Search</a></li>
                                            <li><a href="<?php echo BASE_URL();?>shop/packages">Packages</a></li>
                                            <!-- <li><a href="<?php echo BASE_URL();?>shop/about">About</a></li>
                                            <li><a href="<?php echo BASE_URL();?>shop/contact">Contact</a></li> -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu Area Start Here -->
                    <div class="mobile-menu-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mobile-menu">
                                        <nav id="dropdown">
                                            <ul>
                                            <li><a href="<?php echo BASE_URL();?>shop">Home</a></li>
                                            <li><a href="<?php echo BASE_URL();?>shop/ordersearch">Order Search</a></li>
                                            <li><a href="<?php echo BASE_URL();?>shop/packages">Packages</a></li>
                                            <!-- <li><a href="<?php echo BASE_URL();?>shop/about">About</a></li>
                                            <li><a href="<?php echo BASE_URL();?>shop/contact">Contact</a></li> -->
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu Area End Here -->
                </div>
            </div>
        </header>
        <!-- Header Area End Here -->
        <!-- Inner Page Banner Area End Here -->
        <!-- Shop Page Area Start Here -->
        <div class="checkout-page-area">
            <?php echo $content ;?>
        </div>
        <!-- Shop Page Area End Here -->
        <!-- Footer Area Start Here -->
        <footer>
            <div class="footer-area" style="padding: 0 !important">
                <div class="footer-area-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <p>© 2018 Casa Moda Gown Reservation System</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    <!-- Preloader Start Here -->
    <!-- <div id="preloader"></div> -->
    <!-- Preloader End Here -->
    <!-- jquery-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Owl Cauosel JS -->
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
    <!-- Meanmenu Js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.meanmenu.min.js" type="text/javascript"></script>
    <!-- WOW JS -->
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js" type="text/javascript"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url(); ?>assets/js/plugins.js" type="text/javascript"></script>
    <!-- Countdown js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.countdown.min.js" type="text/javascript"></script>
    <!-- Srollup js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.min.js" type="text/javascript"></script>
    <!-- Actual Js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.actual.min.js" type="text/javascript"></script>
    <!-- Nouislider Js -->
    <script src="<?php echo base_url(); ?>assets/js/nouislider.min.js" type="text/javascript"></script>
    <!-- wNumb Js -->
    <script src="<?php echo base_url(); ?>assets/js/wNumb.js" type="text/javascript"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/js/main.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>

    <!-- Additional Scripts -->
    <?php if(isset($add_js)) : ?>
		<?php foreach($add_js as $js): ?>
            <script src="<?php echo base_url() . $js; ?>"></script>
        <?php endforeach; ?>
	<?php endif; ?>

    <?php if(isset($extra_js)) : ?>
        <script><?php echo $extra_js; ?></script>
    <?php endif; ?>
</body>

</html>

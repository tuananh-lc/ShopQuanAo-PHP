<?php
session_start();
require_once './db.php';


$sql1 ="SELECT * FROM `users`";
$kq1 = $conn->query($sql1);
$sql = "SELECT * FROM `products`";
$kq = $conn->query($sql);
$cart = (isset($_SESSION['cart']))? $_SESSION['cart'] : [];
$tongtien = 0;
     foreach($cart as $key){ 
        $tongtien += $key['price'] * $key['quantity'];
     }
       
     if(isset($_POST['sale'])){
        $sale = $_POST['coupon'];
         $sql_sale = "SELECT * FROM `ma_sale` where `name` LIKE '$sale'";
         $kq_sale = $conn->query($sql_sale);
         foreach($kq_sale as $key2){ 
             $tongtien1 = $tongtien - $key2['sale_price'];
         }
        }else{
            $tongtien1 = $tongtien;
         }
         
if(isset($_POST['dathang'])){
    $idtk = $_SESSION['auth']['id'];
    $address = $_POST['billing_streetAddress'];
    $note = $_POST['orderNotes'];
    $tongtien1 = $_POST['tongtien'];

    $stta = "đang xử lý";

    $err=[];
        if(empty($address)){
            $err['billing_streetAddress'] = 'Bạn chưa nhập địa chỉ giao hàng!!';
        }
    if(empty($err)){
    $order  = $conn->query("INSERT INTO `order` (`order_id`, `user_id`, `order_price`, `addres`, `order_note`, `order_stt`, `time`) VALUES (NULL, '$idtk', '$tongtien1', '$address', '$note', '$stta', current_timestamp());");
    $idor = $conn->insert_id;
    
    foreach($cart as $key3){
        $idpro = $key3['id'];
        $qtt = $key3['quantity'];
        $price = $key3['price'];
        $order  = $conn->query("INSERT INTO `order_detail` (`orderdt_id`, `order_id`, `pro_id`, `orderdt_qty`, `orderdt_price`) VALUES (NULL, '$idor', '$idpro', '$qtt', '$price');");
        
    }
    unset($_SESSION['cart']);
    
    header('location:thongbao.php');die;
    
}

    
}

                                  
                            


?>
<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from template.hasthemes.com/airi/airi/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 31 Jul 2021 15:15:13 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.png">

    <!-- Title -->
    <title>Airi - Clean, Minimal eCommerce Bootstrap 5 Template</title>

    <!-- ************************* CSS Files ************************* -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- dl Icon CSS -->
    <link rel="stylesheet" href="assets/css/dl-icon.css">

    <!-- All Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">

    <!-- Revoulation Slider CSS  -->
    <link rel="stylesheet" href="assets/css/revoulation.css">

    <!-- style CSS -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- modernizr JS
    ============================================ -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


    <div class="ai-preloader active">
        <div class="ai-preloader-inner h-100 d-flex align-items-center justify-content-center">
            <div class="ai-child ai-bounce1"></div>
            <div class="ai-child ai-bounce2"></div>
            <div class="ai-child ai-bounce3"></div>
        </div>
    </div>

    <!-- Main Wrapper Start -->
    <div class="wrapper">
        <!-- Header Area Start -->
        <header class="header header-fullwidth header-style-1">
            <div class="header-outer">
                <div class="header-inner fixed-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-xl-5 col-lg-6">
                                <!-- Main Navigation Start Here -->
                                <nav class="main-navigation">
                                    <ul class="mainmenu">
                                        <li class="mainmenu__item menu-item-has-children megamenu-holder">
                                            <a href="index-07.php" class="mainmenu__link">
                                                <span class="mm-text">Home</span>
                                            </a>
                                        </li>
                                        <li class="mainmenu__item menu-item-has-children">
                                            <a href="shop-sidebar.php" class="mainmenu__link">
                                                <span class="mm-text">Shop</span>
                                                <span class="tip">Hot</span>
                                            </a>
                                        </li>
                                        <li class="mainmenu__item">
                                            <a href="#" class="mainmenu__link">
                                                <span class="mm-text">Collections</span>
                                            </a>
                                        </li>
                                        <li class="mainmenu__item menu-item-has-children has-children">
                                            <a href="#" class="mainmenu__link">
                                                <span class="mm-text">Pages</span>
                                            </a>
                                        </li>
                                        <li class="mainmenu__item menu-item-has-children has-children">
                                            <a href="#" class="mainmenu__link">
                                                <span class="mm-text">Blog</span>
                                            </a>
                                        </li>
                                        <li class="mainmenu__item">
                                            <a href="#" class="mainmenu__link">
                                                <span class="mm-text">New Look</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- Main Navigation End Here -->
                            </div>
                            <div class="col-lg-2 col-md-3 col-4 text-lg-center">
                                <!-- Logo Start Here -->
                                <a href="index-2.html" class="logo-box">
                                    <figure class="logo--normal">
                                        <img src="assets/img/logo/logo.svg" alt="Logo" />
                                    </figure>
                                    <figure class="logo--transparency">
                                        <img src="assets/img/logo/logo-white.png" alt="Logo" />
                                    </figure>
                                </a>
                                <!-- Logo End Here -->
                            </div>
                            <div class="col-xl-5 col-lg-4 col-md-9 col-8">
                                <ul class="header-toolbar text-end">
                                    <li class="header-toolbar__item d-none d-lg-block">
                                        <a href="#sideNav" class="toolbar-btn">
                                            <i class="dl-icon-menu2"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item user-info-menu-btn">
                                        <a href="#">
                                            <i class="fa fa-user-circle-o"></i>
                                        </a>
                                        <ul class="user-info-menu">
                                            <li>
                                                <a href="my-account.php">My Account</a>
                                            </li>
                                            <li>
                                                <a href="cart.php">Shopping Cart</a>
                                            </li>
                                            <li>
                                                <a href="checkout.php">Check Out</a>
                                            </li>
                                            <li>
                                                <a href="#">Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="#">Order tracking</a>
                                            </li>
                                            <li>
                                                <a href="#">compare</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="cart.php" class="">
                                            <i class="dl-icon-cart4"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#" class="search-btn toolbar-btn">
                                            <i class="dl-icon-search1"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item d-lg-none">
                                        <a href="#" class="menu-btn"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-sticky-header-height"></div>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- Mobile Header area Start -->
        <header class="header-mobile">
            <div class="header-mobile__outer">
                <div class="header-mobile__inner fixed-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <a href="index-2.html" class="logo-box">
                                    <figure class="logo--normal">
                                        <img src="assets/img/logo/logo.svg" alt="Logo">
                                    </figure>
                                </a>
                            </div>
                            <div class="col-8">
                                <ul class="header-toolbar text-end">
                                    <li class="header-toolbar__item user-info-menu-btn">
                                        <a href="#">
                                            <i class="fa fa-user-circle-o"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#miniCart" class="mini-cart-btn toolbar-btn">
                                            <i class="dl-icon-cart4"></i>
                                            <sup class="mini-cart-count">2</sup>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#searchForm" class="search-btn toolbar-btn">
                                            <i class="dl-icon-search1"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item d-lg-none">
                                        <a href="#" class="menu-btn"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Mobile Navigation Start Here -->
                                <div class="mobile-navigation dl-menuwrapper" id="dl-menu">
                                    <button class="dl-trigger">Open Menu</button>
                                    <ul class="dl-menu">
                                        <li>
                                            <a href="index-07.php">
                                                Home
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-sidebar.php">
                                                Shop
                                                <span class="tip">Hot</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Collections
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Pages
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                Blog
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                New Look
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Mobile Navigation End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-sticky-header-height"></div>
            </div>
        </header>
        <!-- Mobile Header area End -->

        <!-- Breadcrumb area Start -->
        <div class="breadcrumb-area pt--70 pt-md--25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ul class="breadcrumb">
                            <li><a href="index-07.php">Home</a></li>
                            <li><a href="shop-sidebar.php">Shop Pages</a></li>
                            <li class="current"><span>Product Details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb area End -->

        <!-- Main Content Wrapper Start -->
        <div id="content" class="main-content-wrapper">
            <div class="page-content-inner">
                <div class="container">
                    <div class="row pt--80 pt-md--60 pt-sm--40">
                        <div class="col-12">
                            <!-- User Action Start -->
                            <div class="user-actions user-actions__coupon">
                                
                                
                            </div>
                            <!-- User Action End -->
                        </div>
                    </div>
                    <div class="row pb--80 pb-md--60 pb-sm--40">
                        <!-- Checkout Area Start -->
                        <div class="col-lg-6">
                            <div class="checkout-title mt--10">
                                <h2>Billing Details</h2>
                            </div>
                            <div class="checkout-form">
                                <form  class="form form--checkout" method="POST">
                                    <div class="row mb--30">
                                        <div class="form__group col-md-6">
                                            <label for="billing_lname" class="form__label form__label--2">Name
                                                <span class="required">*</span></label>
                                            <h3><?php echo $_SESSION['auth']['fullname']?></h3>
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="billing_streetAddress" class="form__label form__label--2">Street
                                                Address <span class="required">*</span></label>

                                            <input type="text" name="billing_streetAddress" id="billing_streetAddress"
                                                class="form__input form__input--2 mb--30"
                                                placeholder="House number and street name">
                                                <span><?php echo (isset($err['billing_streetAddress'])) ? $err['billing_streetAddress'] : ''?></span>
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="billing_phone" class="form__label form__label--2">Phone <span
                                                    class="required">*</span></label>
                                                    <h3><?php echo $_SESSION['auth']['phonenumber']?></h3>
                                        </div>
                                    </div>
                                    <div class="row mb--30">
                                        <div class="form__group col-12">
                                            <label for="billing_email" class="form__label form__label--2">Email Address
                                                <span class="required">*</span></label>
                                                <h3><?php echo $_SESSION['auth']['email']?></h3>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form__group col-12">
                                            <label for="orderNotes" class="form__label form__label--2">Order
                                                Notes</label>
                                            <textarea class="form__input form__input--2 form__input--textarea"
                                                id="orderNotes" name="orderNotes"
                                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-top pt--20 mt--20">
                                    <div class="col-sm-6">
                                    <input type="text" id="coupon" name="coupon" class="cart-form__input"
                                                placeholder="Coupon Code">
                                    <button type="submit" name="sale" value="sale" class="cart-form__btn">sale</button> 
                                    </div>
                                    
                                </div>
                                    <input type="hidden" name="tongtien" value="<?= $tongtien1??''?>">

                                    <button type="submit" class="btn btn-primary" style="" name="dathang">Đặt hàng</button>

                                </form>
                            </div>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 mt-md--40">
                            <div class="order-details">
                                <div class="checkout-title mt--10">
                                    <h2>Your Order</h2>
                                </div>
                                <div class="table-content table-responsive mb--30">
                                    <table class="table order-table order-table-2">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        
                                                    <?php foreach($cart as $key1){ ?>
                                                    <tr>
                                        <tbody>
                                            <tr>
                                                <th><?php echo $key1['name'] ?>
                                                    <strong><span>&#10005;</span><?php echo $key1['quantity'] ?></strong>
                                                </th>
                                                <td class="text-end"><?php echo $key1['price'] * $key1['quantity'] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td class="text-end"><?php echo $tongtien1 ?></td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Shipping</th>
                                                <td class="text-end">
                                                    <span>Flat Rate; 35.000đ</span>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td class="text-end"><span class="order-total-ammount"><?php echo $tongtien1 + 35000?></span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- Checkout Area End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Wrapper Start -->


        <!-- Footer Start -->
        <footer class="footer footer-3 bg--white border-top">
            <div class="container">
                <div class="row pt--40 pt-md--30 mb--40 mb-sm--30">
                    <div class="col-12 text-md-center">
                        <div class="footer-widget">
                            <div class="textwidget">
                                <a href="index-2.html" class="footer-logo">
                                    <img src="assets/img/logo/logo.svg" alt="Logo">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb--15 mb-sm--20">
                    <div class="col-xl-2 col-md-4 mb-lg--30">
                        <div class="footer-widget">
                            <h3 class="widget-title widget-title--2">Company</h3>
                            <ul class="widget-menu widget-menu--2">
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="#">Our Services</a></li>
                                <li><a href="#">Affiliate Program</a></li>
                                <li><a href="#">Work for Airi</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 mb-lg--30">
                        <div class="footer-widget">
                            <h3 class="widget-title widget-title--2">USEFUL LINKS</h3>
                            <ul class="widget-menu widget-menu--2">
                                <li><a href="shop-collections.html">The Collections</a></li>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="#">Return Policiy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 mb-lg--30">
                        <div class="footer-widget">
                            <h3 class="widget-title widget-title--2">SHOPPING</h3>
                            <ul class="widget-menu widget-menu--2">
                                <li><a href="shop-instagram.html">Look Book</a></li>
                                <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                                <li><a href="shop-fullwidth.html">Shop Fullwidth</a></li>
                                <li><a href="shop-no-gutter.html">Man & Woman</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5 offset-xl-1 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <div class="footer-widget">
                            <h3 class="widget-title widget-title--2 widget-title--icon">Subscribe now and get 10% off
                                new collection</h3>
                            <form
                                action="https://company.us19.list-manage.com/subscribe/post?u=2f2631cacbe4767192d339ef2&amp;id=24db23e68a"
                                class="newsletter-form newsletter-form--3 mc-form" method="post" target="_blank">
                                <input type="email" name="newsletter-email" id="newsletter-email"
                                    class="newsletter-form__input" placeholder="Enter Your Email Address..">
                                <button type="submit" class="newsletter-form__submit">
                                    <i class="dl-icon-right"></i>
                                </button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div>
                <div class="row align-items-center pt--10 pb--30">
                    <div class="col-md-4">
                        <!-- Social Icons Start Here -->
                        <ul class="social social-small">
                            <li class="social__item">
                                <a href="https://twitter.com/" class="social__link">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a href="https://plus.google.com/" class="social__link">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a href="https://facebook.com/" class="social__link">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a href="https://youtube.com/" class="social__link">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                            <li class="social__item">
                                <a href="https://instagram.com/" class="social__link">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- Social Icons End Here -->
                    </div>
                    <div class="col-md-4 text-md-center">
                        <p class="copyright-text">&copy; AIRI 2021 MADE WITH <i class="fa fa-heart"></i> BY HASTHEMES</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <img src="assets/img/others/payments-2.png" alt="Payment">
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->


        <!-- Search from Start -->
        <div class="searchform__popup" id="searchForm">
            <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
            <div class="searchform__body">
                <p>Start typing and press Enter to search</p>
                <form class="searchform">
                    <input type="text" name="search" id="search" class="searchform__input"
                        placeholder="Search Entire Store...">
                    <button type="submit" class="searchform__submit"><i class="dl-icon-search10"></i></button>
                </form>
            </div>
        </div>
        <!-- Search from End -->

        <!-- Side Navigation Start -->
        <aside class="side-navigation" id="sideNav">
            <div class="side-navigation-wrapper">
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                <div class="side-navigation-inner">
                    <div class="widget">
                        <ul class="sidenav-menu">
                            <li><a href="about-us.html">About Airi Shop</a></li>
                            <li><a href="about-us.html">Help Center</a></li>
                            <li><a href="shop-collections.html">Portfolio</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="shop-instagram.html">New Look</a></li>
                        </ul>
                    </div>
                    <div class="widget pt--30 pr--20">
                        <div class="text-widget">
                            <p>
                                <img src="assets/img/others/payments.png" alt="payment">
                            </p>
                            <p>Pellentesque mollis nec orci id tincidunt. Sed mollis risus eu nisi aliquet, sit amet
                                fermentum justo dapibus.</p>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="text-widget">
                            <p>
                                <a href="#">(+612) 2531 5600</a>
                                <a href="mailto:demo@example.com">demo@example.com</a>
                                PO Box 1622 Colins Street West
                            </p>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="text-widget google-map-link">
                            <p>
                                <a href="https://www.google.com/maps" target="_blank">Google Maps</a>
                            </p>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="text-widget">
                            <!-- Social Icons Start Here -->
                            <ul class="social social-small">
                                <li class="social__item">
                                    <a href="https://twitter.com/" class="social__link">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="https://plus.google.com/" class="social__link">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="https://facebook.com/" class="social__link">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="https://youtube.com/" class="social__link">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="https://instagram.com/" class="social__link">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- Social Icons End Here -->
                        </div>
                    </div>
                    <div class="widget">
                        <div class="text-widget">
                            <p class="copyright-text">&copy; AIRI 2021 MADE WITH <i class="fa fa-heart"></i> BY HASTHEMES</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Side Navigation End -->

        <!-- Mini Cart Start -->
        <!-- <aside class="mini-cart" id="miniCart">
            <div class="mini-cart-wrapper">
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                <div class="mini-cart-inner">
                    <h5 class="mini-cart__heading mb--40 mb-lg--30">Shopping Cart</h5>
                    <div class="mini-cart__content">
                        <ul class="mini-cart__list">
                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove">
                                    <i class="dl-icon-close"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="assets/img/products/prod-17-1-70x91.jpg" alt="products">
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title" href="product-details.html">Chain print bermuda
                                        shorts </a>
                                    <span class="mini-cart__product__quantity">1 x $49.00</span>
                                </div>
                            </li>
                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove">
                                    <i class="dl-icon-close"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="assets/img/products/prod-18-1-70x91.jpg" alt="products">
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title" href="product-details.html">Waxed-effect
                                        pleated skirt</a>
                                    <span class="mini-cart__product__quantity">1 x $49.00</span>
                                </div>
                            </li>
                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove">
                                    <i class="dl-icon-close"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="assets/img/products/prod-19-1-70x91.jpg" alt="products">
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title" href="product-details.html">Waxed-effect
                                        pleated skirt</a>
                                    <span class="mini-cart__product__quantity">1 x $49.00</span>
                                </div>
                            </li>
                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove">
                                    <i class="dl-icon-close"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="assets/img/products/prod-2-1-70x91.jpg" alt="products">
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title" href="product-details.html">Waxed-effect
                                        pleated skirt</a>
                                    <span class="mini-cart__product__quantity">1 x $49.00</span>
                                </div>
                            </li>
                        </ul>
                        <div class="mini-cart__total">
                            <span>Subtotal</span>
                            <span class="ammount">$98.00</span>
                        </div>
                        <div class="mini-cart__buttons">
                            <a href="cart.html" class="btn btn-fullwidth btn-style-1">View Cart</a>
                            <a href="checkout.html" class="btn btn-fullwidth btn-style-1">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside> -->
        <!-- Mini Cart End -->

        <!-- Global Overlay Start -->
        <div class="ai-global-overlay"></div>
        <!-- Global Overlay End -->

        <!-- Modal Start -->
        <div class="modal fade product-modal" id="productModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="dl-icon-close"></i></span>
                        </button>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="airi-element-carousel product-image-carousel nav-vertical-center nav-style-1"
                                    data-slick-options='{
                                    "slidesToShow": 1,
                                    "slidesToScroll": 1,
                                    "arrows": true,
                                    "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "dl-icon-left" },
                                    "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "dl-icon-right" }
                                }'>
                                    <div class="product-image">
                                        <div class="product-image--holder">
                                            <a href="product-details.html">
                                                <img src="assets/img/products/prod-9-1.jpg" alt="Product Image"
                                                    class="primary-image">
                                            </a>
                                        </div>
                                        <span class="product-badge sale">sale</span>
                                    </div>
                                    <div class="product-image">
                                        <div class="product-image--holder">
                                            <a href="product-details.html">
                                                <img src="assets/img/products/prod-10-1.jpg" alt="Product Image"
                                                    class="primary-image">
                                            </a>
                                        </div>
                                        <span class="product-badge new">new</span>
                                    </div>
                                    <div class="product-image">
                                        <div class="product-image--holder">
                                            <a href="product-details.html">
                                                <img src="assets/img/products/prod-11-1.jpg" alt="Product Image"
                                                    class="primary-image">
                                            </a>
                                        </div>
                                        <span class="product-badge hot">hot</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-box product-summary">
                                    <div class="product-navigation mb--10">
                                        <a href="#" class="prev"><i class="dl-icon-left"></i></a>
                                        <a href="#" class="next"><i class="dl-icon-right"></i></a>
                                    </div>
                                    <h3 class="product-title mb--15">Waxed-effect pleated skirt</h3>
                                    <span class="product-price-wrapper mb--20">
                                        <span class="money">$49.00</span>
                                        <span class="product-price-old">
                                            <span class="money">$60.00</span>
                                        </span>
                                    </span>
                                    <p class="product-short-description mb--25 mb-md--20">Donec accumsan auctor iaculis.
                                        Sed suscipit arcu ligula, at egestas magna molestie a. Proin ac ex maximus,
                                        ultrices justo eget, sodales orci. Aliquam egestas libero ac turpis pharetra, in
                                        vehicula lacus scelerisque. Vestibulum ut sem laoreet, feugiat tellus at,
                                        hendrerit arcu.</p>
                                    <div class="product-action d-flex flex-row align-items-center mb--30 mb-md--20">
                                        <div class="quantity">
                                            <input type="number" class="quantity-input" name="qty" id="quick-qty"
                                                value="1" min="1">
                                        </div>
                                        <button type="button" class="btn btn-style-1 btn-semi-large add-to-cart"
                                            onclick="window.location.href='cart.html'">
                                            Add To Cart
                                        </button>
                                        <a href="wishlist.html"><i class="dl-icon-heart2"></i></a>
                                        <a href="compare.html"><i class="dl-icon-compare2"></i></a>
                                    </div>
                                    <div class="product-extra mb--30 mb-md--20">
                                        <a href="#" class="font-size-12"><i class="fa fa-map-marker"></i>Find store near
                                            you</a>
                                        <a href="#" class="font-size-12"><i class="fa fa-exchange"></i>Delivery and
                                            return</a>
                                    </div>
                                    <div
                                        class="product-summary-footer d-flex justify-content-between flex-sm-row flex-column flex-sm-row flex-column">
                                        <div class="product-meta">
                                            <span class="sku_wrapper font-size-12">SKU: <span class="sku">REF.
                                                    LA-887</span></span>
                                            <span class="posted_in font-size-12">Categories: <a href="shop-sidebar.html"
                                                    rel="tag">Fashions</a></span>
                                        </div>
                                        <div class="product-share-box">
                                            <span class="font-size-12">Share With</span>
                                            <!-- Social Icons Start Here -->
                                            <ul class="social social-small">
                                                <li class="social__item">
                                                    <a href="https://facebook.com/" class="social__link">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="social__item">
                                                    <a href="https://twitter.com/" class="social__link">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="social__item">
                                                    <a href="https://plus.google.com/" class="social__link">
                                                        <i class="fa fa-google-plus"></i>
                                                    </a>
                                                </li>
                                                <li class="social__item">
                                                    <a href="https://plus.google.com/" class="social__link">
                                                        <i class="fa fa-pinterest-p"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Social Icons End Here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->



    </div>
    <!-- Main Wrapper End -->


    <!-- ************************* JS Files ************************* -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery.min.js"></script>

    <!-- Bootstrap and Popper Bundle JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- All Plugins Js -->
    <script src="assets/js/plugins.js"></script>

    <!-- Ajax Mail Js -->
    <script src="assets/js/ajax-mail.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- REVOLUTION JS FILES -->
    <script src="assets/js/revoulation/jquery.themepunch.tools.min.js"></script>
    <script src="assets/js/revoulation/jquery.themepunch.revolution.min.js"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="assets/js/revoulation/extensions/revolution.extension.actions.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.carousel.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.migration.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.navigation.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.parallax.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="assets/js/revoulation/extensions/revolution.extension.video.min.js"></script>

    <!-- REVOLUTION ACTIVE JS FILES -->
    <script src="assets/js/revoulation.js"></script>

</body>


<!-- Mirrored from template.hasthemes.com/airi/airi/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 31 Jul 2021 15:15:13 GMT -->
</html>
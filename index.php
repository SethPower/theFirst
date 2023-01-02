<?php 
    ob_start();
    session_start();
    define('SECURITY', True);
    include_once('admin/config/connect.php');
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/category.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/success.css">
    <link rel="stylesheet" href="css/cart.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src='ckeditor/ckeditor.js'></script>
</head>

<body>
    <?php
        if(isset($_GET['page_layout']) && ($_GET['page_layout'] == "login" || $_GET['page_layout'] == "logout")){
            if($_GET['page_layout'] == "logout") $_SESSION['mail'] = null;
            include_once('login.php');
        } else if(isset($_GET['page_layout']) && $_GET['page_layout'] == "regist") {
            include_once('regist.php');
        } else if(isset($_GET['page_layout']) && $_GET['page_layout'] == "byform") {
            include_once('byform.php');
        }
        else {
    ?>
    <!--	Header	-->
    <div id="header">
        <div class="container">
            <div class="row ">
                <!-- logo -->
                <!-- search -->
                <!-- cart -->
                <?php 
                include_once('modules/logo/logo.php');
                include_once('modules/search/search_box.php');
                include_once('modules/cart/cart_no-tify.php'); 
                ?>
            </div>
        </div>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <!--	End Header	-->

    <!--	Body	-->
    <div id="body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav>
                        <!-- menu -->
                        <?php include_once('modules/menu/menu.php'); ?>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div id="main" class="col-lg-8 col-md-12 col-sm-12">
                
                    <!--	Slider	-->
                    <?php include_once('modules/slide/slide.php'); ?>
                    <!--	End Slider	-->
                    <?php 
                        if(isset($_GET['page_layout'])){
                            switch($_GET['page_layout']){
                                case "cart": include_once('modules/cart/cart.php'); break;
                                case "product": include_once('modules/product/product.php'); break;
                                case "category": include_once('modules/menu/category.php'); break;
                                case "sale": include_once('modules/menu/sale.php'); break;
                                case "top": include_once('modules/menu/top.php'); break;
                                case "success": include_once('modules/cart/success.php'); break;
                                case "search": include_once('modules/search/search.php'); break;
                                case "new": include_once('modules/product/latest.php'); break;
                            }
                        }else{
                            include_once('modules/product/featured.php');
                            include_once('modules/product/topby.php');
                            include_once('modules/product/latest.php');
                        }
                    ?>
                    <!--	Feature Product	-->

                    <!--	End Feature Product	-->

                    <!--	Latest Product	-->
                    
                    <!--	End Latest Product	-->
                </div>

                <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
                    <!-- banner -->
                    <?php include_once('modules/banner/banner.php'); ?>
                </div>
            </div>
        </div>
    </div>
    <!--	End Body	-->
                         <!--	Footer	-->
    <div id="footer-top">
        <div class="container">
            <div class="row">
                <!-- logo footer -->
                <?php include_once('modules/logo/logo_footer.php'); ?>
                <!-- address -->
                <?php include_once('modules/address/address.php'); ?>
                <!-- services -->
                <?php include_once('modules/services/services.php'); ?>
                <!-- hotline -->
                <?php include_once('modules/hotline/hotline.php'); ?>
            </div>
        </div>
    </div>

    <!--	End Footer	-->
    <?php } ?>
</body>

</html>

<div id="cart" class="col-lg-5 col-md-5 col-sm-12 self-align-end">
    <a class=" mr-2 position-relative" href="index.php?page_layout=cart" style="float:left;">
        <i class="fa-solid fa-cart-shopping"></i>

        <!--  -->
						
        <!--  -->
        <span class="position-absolute">
        <?php 
            if(isset($_SESSION['cart'])){
                if(isset($_POST['qtt'])){
                    $cart = $_POST['qtt'];
                }else{
                    $cart = $_SESSION['cart'];
                }
                $total = 0;
                foreach($cart as $prd_id => $qtt){
                    $total += $qtt;
                }
                echo $total;
            }else{
                echo 0;
            }
        ?>
        </span>
    </a>
        <ul id="ul-login" style="float: left;">
            <?php if(isset($_SESSION['user_name'])) { ?>
                <li style="float: left;color: #fff">
                        <svg style="height: 30px; width: 30px;" class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
                        <?php 
                            echo $_SESSION['user_name'];
                        ?>
                </li>
                <li style="float: left;"><a href="index.php?page_layout=logout"><svg style="height: 30px; width: 30px;" class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>
            <?php } else { ?>
            <li style="float: left;"><a href="index.php?page_layout=login"><svg style="height: 30px; width: 30px;" class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Đăng nhập</a></li>
            <?php } ?>
            <div class="clear" style="clear: both;"></div>
        </ul>
    
    <div class="clear" style="clear: both;"></div>
</div>
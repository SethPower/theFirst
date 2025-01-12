

<?php 
    if(isset($_GET['prd_id'])){
        $prd_id = $_GET['prd_id'];
        $sql = "SELECT * FROM product LEFT JOIN sale on sale.product_id = product.prd_id and sale.start_date <= now() and sale.end_date >= now() WHERE product.prd_id = $prd_id";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($query);
    }
?>

<!--	List Product	-->
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/products/<?php echo $row['prd_image']; ?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $row['prd_name']; ?></h1>
            <ul>
                <li><span>Bảo hành:</span><?php echo $row['prd_warranty']; ?></li>
                <li><span>Đi kèm:</span><?php echo $row['prd_accessories']; ?></li>
                <!-- <li><span>Tình trạng:</span><?php echo $row['prd_new']; ?></li> -->
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <?php if(isset($row['sale_price'])) { ?>
                <li id="price-number" class="decoration"><?php echo number_format($row['prd_price']); ?>₫</li>
                <li id="price">Khuyến Mại:</li>
                <li id="price-number"><?php echo number_format($row['sale_price']); ?>₫</li>
                <?php } else { ?>
                    <li id="price-number"><?php echo number_format($row['prd_price']); ?>₫</li>
                <?php } ?>
                <li class="<?php if($row['prd_status']==1){echo "text-success";}else{echo "text-danger";}?>"><?php if($row['prd_status']==1){echo "Còn hàng";}else{echo "Hết hàng";}?></li>
            </ul>
            <?php if($row['prd_status']==1) { ?>
            <div id="add-cart">
                <a href="modules/cart/cart_add.php?prd_id=<?php echo $row['prd_id']; ?>">Mua ngay</a>
            </div>
            <?php } ?>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $row['prd_name']; ?></h3>
            
            <!-- <p>
                Màn hình OLED có hỗ trợ HDR là một sự nâng cấp mới của Apple thay vì màn hình LCD với IPS được tìm thấy trên iPhone 8 và iPhone 8 Plus đem đến tỉ lệ tương phản cao hơn đáng kể là 1.000.000: 1, so với 1.300: 1 ( iPhone 8 Plus ) và 1.400: 1 ( iPhone 8 ).
            </p>
            <p>
                Màn hình OLED mà Apple đang gọi màn hình Super Retina HD có thể hiển thị tông màu đen sâu hơn. Điều này được thực hiện bằng cách tắt các điểm ảnh được hiển thị màu đen còn màn hình LCD thông thường, những điểm ảnh đó được giữ lại. Không những thế, màn hình OLED có thể tiết kiệm pin đáng kể.
            </p>
            <p>
                Cả ba mẫu iPhone mới đều có camera sau 12MP và 7MP cho camera trước, nhưng chỉ iPhone X và iPhone 8 Plus có thêm một cảm biến cho camera sau. Camera kép trên máy như thường lệ: một góc rộng và một tele. Vậy Apple đã tích hợp những gì vào camera của iPhone X?
            </p>
            <p>
                Chống rung quang học (OIS) là một trong những tính năng được nhiều hãng điện thoại trên thế giới áp dụng. Đối với iPhone X, hãng tích hợp chống rung này cho cả hai camera, không như IPhone 8 Plus chỉ có OIS trên camera góc rộng nên camera tele vẫn rung và chất lượng bức hình không đảm bảo.
            </p>
            <p>
                Thứ hai, ống kính tele của iPhone 8 Plus có khẩu độ f / 2.8, trong khi iPhone X có ống kính tele f / 2.2, tạo ra một đường cong nhẹ và có thể chụp thiếu sáng tốt hơn với ống kính tele trên iPhone X.
            </p>
            <p>
                Portrait Mode là tính năng chụp ảnh xóa phông trước đây chỉ có với camera sau của iPhone 7 Plus, hiện được tích hợp trên cả iPhone 8 Plus và iPhone X. Tuy nhiên, nhờ sức mạnh của cảm biến trên mặt trước của iPhone X, Camera TrueDepth cũng có thể chụp với Potrait mode.
            </p> -->
        </div>
    </div>

    <!--	Comment	-->
    <?php 
        if(isset($_POST['sbm'])){
            $prd_id = $prd_id;
            $comm_name = $_POST['comm_name'];
            $comm_mail = $_POST['comm_mail'];
            date_default_timezone_set("Asia/Bangkok");
            $comm_date = date("Y-m-d H:i:s");
            $comm_details = $_POST['comm_details'];
            $sql = "INSERT INTO comment (prd_id, comm_name, comm_mail, comm_date,comm_details) VALUES ($prd_id,'$comm_name','$comm_mail','$comm_date','$comm_details')";
            $query = mysqli_query($conn,$sql);
        }
    ?>
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <!-- <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div> -->
                <?php if(isset($_SESSION['user_name'])) { ?>
                <input name="comm_name" required type="hidden" value="<?php echo $_SESSION['user_name'];?>" class="form-control">
                <input name="comm_mail" required type="hidden" value="<?php echo $_SESSION['user_mail'];?>" class="form-control" id="pwd">
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
                <?php } else { ?>
                    <label>Đăng nhập để bình luận! <a href="index.php?page_layout=login">Đăng nhập</a></label>
                <?php } ?>
            </form>
        </div>
    </div>
    <!--	End Comment	-->

    <!--	Comments List	-->
    
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php 
            $sql_cmt = "SELECT * FROM comment WHERE prd_id = $prd_id";
            $query_cmt = mysqli_query($conn,$sql_cmt);
            while($row_cmt = mysqli_fetch_array($query_cmt)){
            ?>
            <div class="comment-item">
                <ul>
                    <li><b><?php echo $row_cmt['comm_name']; ?></b></li>
                    <li><?php echo $row_cmt['comm_date']; ?></li>
                    <li><p><?php echo $row_cmt['comm_details']; ?></p></li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
    <!--	End Comments List	-->
</div>
<!--	End Product	-->
<!-- <div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul>
</div> -->

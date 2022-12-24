<div class="products">
    <h3>Sản phẩm nổi bật</h3>
    <div class="product-list row">
        <?php 
            $sql = "SELECT * FROM product LEFT JOIN sale on sale.product_id = product.prd_id and sale.start_date <= now() and sale.end_date >= now() WHERE prd_featured = '1' ORDER BY prd_id DESC LIMIT 6";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($query)){
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
            <div class="product-item card text-center">
                
                <a href="index.php?page_layout=product&&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=product&&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                
                <?php if(isset($row['sale_price'])) { ?>
                <p class="decoration">Giá Bán: <span><?php echo $row['prd_price']; ?>đ</span></p>
                <p>Giá khuyến mãi: <span><?php echo number_format($row['sale_price']); ?>₫</span></p>
                <span class="label label-danger"><?php echo (((1 -round((int)$row['sale_price']/(int)$row['prd_price'],2)))*100).'%'; ?></span>
                <?php } else { ?>
                    <p>Giá Bán: <span><?php echo $row['prd_price']; ?>đ</span></p>
                <?php } ?>
            </div>
        </div>
        <?php        
            }
        ?>
    </div>
</div>
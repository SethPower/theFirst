<div class="products">
    <h3>Top sản phẩn bán chạy</h3>
    <div class="product-list row">
        <?php 
            $sql = "SELECT pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price,SUM(om.number_product) as total FROM `product` pd
            LEFT JOIN sale ON sale.product_id = pd.prd_id and sale.start_date <= now() and sale.end_date >= now()
            LEFT JOIN order_mapping om ON om.product_id = pd.prd_id
            LEFT JOIN `order` od ON od.id = om.order_id
            WHERE od.status = 0
            GROUP BY pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price
            ORDER BY total DESC LIMIT 6";
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
                <p>Lượt bán: <span><?php echo $row['total']; ?> lượt</span></p>
            </div>
        </div>
        <?php        
            }
        ?>
    </div>
</div>
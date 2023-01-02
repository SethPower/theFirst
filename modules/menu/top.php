<?php 
    $sql = "SELECT pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price,SUM(om.number_product) as total FROM `product` pd
    LEFT JOIN sale ON sale.product_id = pd.prd_id and sale.start_date <= now() and sale.end_date >= now()
            LEFT JOIN order_mapping om ON om.product_id = pd.prd_id
            LEFT JOIN `order` od ON od.id = om.order_id
            WHERE od.status = 0
            GROUP BY pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price
    ";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $row_per_page = 9; // 1 trang hiển thị ? bản ghi
    $per_row = $page * $row_per_page - $row_per_page; // phần tử đầu trang
    $total_row = mysqli_num_rows(mysqli_query($conn,$sql)); // số bản ghi
    $total_page = ceil($total_row / $row_per_page); // số trang
    
    //PHÂN TRANG
    
    $list_page = '';
    $prev = $page - 1;
    if($page <= 1){
        $prev = 1;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=top&&page='.$prev.'">&laquo;</a></li>';

    for($i=1;$i<=$total_page;$i++){
        if($i == $page){
            $active = 'active';
        }else{
            $active = '';
        }
        $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=top&&page='.$i.'">'.$i.'</a></li>';
    }

    $next = $page + 1;
    if($next >= $total_page){
        $next = $total_page;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=top&&page='.$next.'">&raquo;</a></li>';

?>
<!--	List Product	-->
<div class="products">
    <h3> Sản phẩm bán chạy (hiện có <?php echo $count = mysqli_num_rows(mysqli_query($conn,"SELECT pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price,SUM(om.number_product) as total FROM `product` pd
             LEFT JOIN sale ON sale.product_id = pd.prd_id and sale.start_date <= now() and sale.end_date >= now()
             LEFT JOIN order_mapping om ON om.product_id = pd.prd_id
             LEFT JOIN `order` od ON od.id = om.order_id
            WHERE od.status = 0
            GROUP BY pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price
    "));?> sản phẩm)</h3>
    <div class="product-list row">
        <?php
            $sql_prd = "SELECT pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price,SUM(om.number_product) as total FROM `product` pd
             LEFT JOIN sale ON sale.product_id = pd.prd_id and sale.start_date <= now() and sale.end_date >= now()
             LEFT JOIN order_mapping om ON om.product_id = pd.prd_id
             LEFT JOIN `order` od ON od.id = om.order_id
            WHERE od.status = 0
            GROUP BY pd.prd_image,pd.prd_id,pd.prd_price,pd.prd_name,sale.sale_price
             ORDER BY total DESC LIMIT ".$per_row.' , '.$row_per_page;
            $query_prd = mysqli_query($conn,$sql_prd);
            while($row_prd = mysqli_fetch_array($query_prd)){
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                <a href="index.php?page_layout=product&&prd_id=<?php echo $row_prd['prd_id']; ?>"><img src="admin/img/products/<?php echo $row_prd['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=product&&prd_id=<?php echo $row_prd['prd_id']; ?>"><?php echo $row_prd['prd_name']; ?></a></h4>
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
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <?php 
            if($count <= 9){
                echo "";
            }else{
                echo $list_page; 
            }
        ?>
    </ul>
</div>
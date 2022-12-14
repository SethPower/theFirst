<?php 
    $sql = "SELECT * FROM sale INNER JOIN product on sale.product_id = product.prd_id WHERE `start_date`<= now() and  `end_date` >= now()";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $row_per_page = 3; // 1 trang hiển thị ? bản ghi
    $per_row = $page * $row_per_page - $row_per_page; // phần tử đầu trang
    $total_row = mysqli_num_rows(mysqli_query($conn,$sql)); // số bản ghi
    $total_page = ceil($total_row / $row_per_page); // số trang
    
    
    //PHÂN TRANG
    
    $list_page = '';
    $prev = $page - 1;
    if($page <= 1){
        $prev = 1;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=sale&&page='.$prev.'">&laquo;</a></li>';

    for($i=1;$i<=$total_page;$i++){
        if($i == $page){
            $active = 'active';
        }else{
            $active = '';
        }
        $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=sale&&page='.$i.'">'.$i.'</a></li>';
    }

    $next = $page + 1;
    if($next >= $total_page){
        $next = $total_page;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=sale&&page='.$next.'">&raquo;</a></li>';

?>
<!--	List Product	-->
<div class="products">
    <h3> Sản phẩm khuyến mãi (hiện có <?php echo $count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM sale INNER JOIN product on sale.product_id = product.prd_id WHERE `start_date`<= now() and  `end_date` >= now()"));?> sản phẩm)</h3>
    <div class="product-list row">
        <?php
            $sql_prd = "SELECT * FROM sale INNER JOIN product on sale.product_id = product.prd_id WHERE `start_date`<= now() and  `end_date` >= now() ORDER BY product.prd_id DESC LIMIT 9";
            $query_prd = mysqli_query($conn,$sql_prd);
            while($row_prd = mysqli_fetch_array($query_prd)){
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                <span class="label label-danger"><?php echo (((1 -round((int)$row_prd['sale_price']/(int)$row_prd['prd_price'],2)))*100).'%'; ?></span>
                <a href="index.php?page_layout=product&&prd_id=<?php echo $row_prd['prd_id']; ?>"><img src="admin/img/products/<?php echo $row_prd['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=product&&prd_id=<?php echo $row_prd['prd_id']; ?>"><?php echo $row_prd['prd_name']; ?></a></h4>
                <p class="decoration">Giá Bán: <span><?php echo number_format($row_prd['prd_price']); ?>₫</span></p>
                <p>Giá khuyến mãi: <span><?php echo number_format($row_prd['sale_price']); ?>₫</span></p>
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
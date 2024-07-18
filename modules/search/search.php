<?php 
include_once('index.php');

if(isset($_POST['keyword'])) {
    $keyword = $_POST['keyword']; // aa bb cc 
} else {
    $keyword = $_GET['keyword']; // aa bb cc 
}
$arr_key = explode(" ", $keyword); // => [aa] [bb] [cc]
$new_key = "%".implode("%", $arr_key)."%"; // => %aa%bb%cc%

$sql = "SELECT * FROM product LEFT JOIN sale on sale.product_id = product.prd_id and sale.start_date <= now() and sale.end_date >= now() WHERE prd_name LIKE '$new_key'";
$query = mysqli_query($conn,$sql);

// PHÂN TRANG

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$row_per_page = 9;
$total_row = mysqli_num_rows(mysqli_query($conn,$sql));
$per_row = $page * $row_per_page - $row_per_page;
$total_page = ceil($total_row / $row_per_page);

$list_page = '';
$prev_page = $page - 1;
if($page <= 1){
    $prev_page = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&&page='.$prev_page.'&&keyword='.$keyword.'">Trang trước</a></li>';

for($i=1; $i <= $total_page; $i++){
    if($i == $page){
        $active = 'active';
    }else{
        $active = '';
    }
    $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=search&&page='.$i.'&&keyword='.$keyword.'">'.$i.'</a></li>';
}

$next_page = $page +1;
if($page >= $total_page){
    $next_page = $total_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&&page='.$next_page.'&&keyword='.$keyword.'">Trang sau</a></li>';
?>

<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <div class="product-list row">
        <?php 
            $sql = "SELECT * FROM product LEFT JOIN sale on sale.product_id = product.prd_id and sale.start_date <= now() and sale.end_date >= now() WHERE prd_name LIKE '$new_key' LIMIT ".$per_row.' , '.$row_per_page;
            $query = mysqli_query($conn,$sql);
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
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <?php echo $list_page; ?> 
    </ul>
</div>

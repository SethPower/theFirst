<?php 
    $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `order`"));
    // if(!defined('SECURITY')){
    //     die('Bạn không thể truy cập vào trang này!');
    // }

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $row_per_page = 10;
    $per_row = $page * $row_per_page - $row_per_page;
    echo $total_row = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM `order`'));
    $total_page = ceil($total_row/$row_per_page);

    $list_page = '';

    $page_prev = $page - 1;
    if($page_prev < 1){
        $page_prev = 1;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=order&page='.$page_prev.'">&laquo;</a></li>';

    for($i = 1; $i <= $total_page; $i++){
        if($i == $page){
            $active = 'active';
        }else{
            $active = '';
        }
        $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=order&&page='.$i.'">'.$i.'</a></li>';
    }

    $page_next = $page + 1;
    if($page_next >= $total_page){
        $page_next = $total_page;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=order&page='.$page_next.'">&raquo;</a></li>';
?>
<style>
    .table td {
        vertical-align: middle !important;
    }
</style>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Danh sách đơn hàng</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách đơn hàng</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table"
                        data-toolbar="#toolbar">
                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="name"  data-sortable="true">Họ & Tên</th>
                            <th data-field="price" data-sortable="true">Email</th>
                            <th data-field="address" data-sortable="true">Địa chỉ</th>
                            <th data-field="phone" data-sortable="true">Số điện thoại</th>
                            <th data-field="product" data-sortable="true">Sản phẩm</th>
                            <th data-field="qlt" data-sortable="true">Số lượng</th>
                            <th data-field="qlt" data-sortable="true">Đơn giá</th>
                            <th data-field="qlt" data-sortable="true">Tổng</th>
                            <th data-field="status" data-sortable="true">Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT * FROM `order` ORDER BY `id` DESC LIMIT ".$per_row.','.$row_per_page;
                                $query = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($query)){
                                    $sqlMap = "SELECT * FROM `order_mapping` od left join product pd on od.product_id = pd.prd_id WHERE od.order_id = ".$row['id'];
                                    $result = $conn -> query($sqlMap);
                                    $rowMap = $result->fetch_all(MYSQLI_ASSOC);
                                   
                                    $rowspan = count($rowMap);
                                    //  var_dump($rowspan);
                                    $total_price_all = 0;
                                    $idx = 0;
                                        foreach($rowMap as $itemMap) {
                                            $total_price_all += $itemMap['number_product']*$itemMap['prd_price'];
                                        }
                                        foreach($rowMap as $itemMap) {
                            ?>
                                    <tr>
                                        <?php if($idx == 0) { ?>
                                        <td rowspan="<?php echo $rowspan; ?>" style=""><?php echo $row['id']; ?></td>
                                        <td rowspan=<?php echo $rowspan; ?> style=""><?php echo $row['name']; ?></td>
                                        <td rowspan=<?php echo $rowspan; ?> style=""><?php echo $row['email']; ?></td>
                                        <td rowspan=<?php echo $rowspan; ?> style=""><?php echo $row['address']; ?></td>
                                        <td rowspan=<?php echo $rowspan; ?> style=""><?php echo $row['phone']; ?></td>
                                        <?php } ?>
                                            <td style=""><?php echo $itemMap['prd_name']; ?></td>
                                            <td style=""><?php echo $itemMap['number_product']; ?></td>
                                            <td style=""><?php echo $itemMap['prd_price']; ?></td>
                                        
                                        <?php if($idx == 0) { ?>
                                        <td rowspan=<?php echo $rowspan; ?> style=""><?php echo $total_price_all; ?></td>
                                        <td rowspan=<?php echo $rowspan; ?> style=""><?php echo $row['status'] == 1 ? "Chưa hoàn thành" : ""; ?></td>
                                        
                                        <td rowspan=<?php echo $rowspan; ?> class="form-group">
                                            <a href="index.php?page_layout=edit_user&&user_id=<?php echo $row['user_id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="del_user.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php $idx ++; } ?>
                            <?php        
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php 
                                echo $list_page;
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
</div>	<!--/.main-->

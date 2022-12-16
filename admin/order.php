<?php 

    if(isset($_POST['order_submit'])){
        $idAct = $_POST['idAct'];
        if($_POST['order_submit'] == "cancel") {
            $reason = $_POST['reason'];
            $sql = "UPDATE `order` SET `status`='3',`reason`='$reason' WHERE `id` = '$idAct'";
            var_dump($sql);
            mysqli_query($conn,$sql);
        } else if($_POST['order_submit'] == "change") {
            $sql = "UPDATE `order` SET `status`='2' WHERE `id` = '$idAct'";
            var_dump($sql);
            mysqli_query($conn,$sql);
        } else if($_POST['order_submit'] == "success") {
            $sql = "UPDATE `order` SET `status`='0' WHERE `id` = '$idAct'";
            var_dump($sql);
            mysqli_query($conn,$sql);
        }
        
    }
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
<form id="order_form" role="form" method="post">
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
                                    // $total_price_all = 0;
                                    $idx = 0;
                                    //     foreach($rowMap as $itemMap) {
                                    //         $total_price_all += $itemMap['number_product']*$itemMap['prd_price'];
                                    //     }
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
                                        <td rowspan=<?php echo $rowspan; ?> style=""><?php echo $row['total_price']; ?></td>
                                        <td rowspan=<?php echo $rowspan; ?> style="">
                                            <?php 
                                                switch($row['status']) {
                                                    case 1:
                                                        echo "Đơn mới";
                                                        break;
                                                    case 2:
                                                        echo "Đang giao hàng";
                                                        break;
                                                    case 3:
                                                        echo "Đơn hủy";
                                                        break;
                                                    case 0:
                                                        echo "Hoàn thành";
                                                        break;
                                                }
                                            ?>
                                    
                                        </td>
                                        
                                        <td rowspan=<?php echo $rowspan; ?> class="form-group">
                                        <?php if($row['status'] != 0) { ?>
                                            <?php if($row['status'] == 1 && ($role == '1' || $role == '2')) { ?>
                                                <a title="Giao hàng" onclick="onSubmit('change',<?php echo $row['id']; ?>)" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i></a>
                                            <?php } ?>
                                            <?php if($row['status'] == 2 && ($role == '1' || $role == '3')) { ?>
                                                <a title="Hoàn thành" onclick="onSubmit('success',<?php echo $row['id']; ?>)" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i></a>
                                            <?php } ?>
                                                <a onclick="openModalReason(<?php echo $row['id']; ?>,<?php echo $row['status']; ?>)" title="Hủy đơn" href="del_user.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                                <input type="hidden" name="reason_<?php echo $row['id']; ?>" id="reason_<?php echo $row['id']; ?>" value="<?php echo $row['reason']; ?>" />
                                        <?php } ?>
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
<input type="hidden" name="idAct" id="idAct" />
<input type="hidden" name="order_submit" id="order_submit" />
<!-- Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lý do</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <textarea required name="reason" id="reason" class="form-control" rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button id="btn_cancel" type="button" onclick="onSubmit('cancel')" class="btn btn-primary">Hủy đơn</button>
      </div>
    </div>
  </div>
</div>
</form>
<script>

    function openModalReason(id,status) {
        if(status == 3) {
            $('#reason').val($('#reason_' + id).val());
            $('#reason').attr('readonly', true);
            $('#btn_cancel').hide();
        } else {
            $('#reason').val('');
            $('#reason').attr('readonly', false);
            $('#btn_cancel').show();
        }
        $('#idAct').val(id);
        $('#cancelModal').modal()
    }

    function onSubmit(act,id) {
        if(id) $('#idAct').val(id);
        $('#order_submit').val(act);
        document.getElementById('order_form').submit()
    }
</script>

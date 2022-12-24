<?php 
    // if(!defined('SECURITY')){
    //     die('Bạn không có quyền truy cập vào file này');
    // }

    if(isset($_POST['submit_form'])){
		
        $product_id = $_POST['product_id'];
        $product_sale = $_POST['product_sale'];
        $startDateArr = explode("/", $_POST['start_date']);
        $start_date = date($startDateArr[2].'-'.$startDateArr[1].'-'.$startDateArr[0].' 00:00:00');
        $endDateArr = explode("/", $_POST['end_date']);
        $end_date = date($endDateArr[2].'-'.$endDateArr[1].'-'.$endDateArr[0].' 00:00:00');

        $sql = "SELECT * from sale where product_id = '$product_id'";
        $result = $conn -> query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        if(count($row) == 0){
            $sql = "INSERT INTO `sale`(`product_id`, `sale_price`, `start_date`, `end_date`) VALUES ('$product_id','$product_sale','$start_date','$end_date')";
            $query = mysqli_query($conn,$sql);
        } else {
            $sql = "UPDATE `sale` SET `sale_price`='$product_sale',`start_date`='$start_date',`end_date`='$end_date' WHERE  `product_id`='$product_id'";
            $query = mysqli_query($conn,$sql);
        }
        
        // if($_SESSION['mail'] = $mail && $_SESSION['pass'] = $pass){
        // 	header("location: index.php");
        // }
        // else{
        // 	$erorr = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
        // }
    }

    if(isset($_POST['sale_cancel'])){
        $product_id = $_POST['product_id_sale_cancel'];

        $sql = "DELETE FROM `sale` WHERE  product_id = '$product_id'";
        $query = mysqli_query($conn,$sql);
    }


    // gán giá trị cho page
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $row_per_page = 5; //so ban ghi hien thị
    $per_row = $page * $row_per_page - $row_per_page; //tìm bị trí bắt đầu bản ghi
    echo $total_row = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM product")); //lấy ra tổng bản ghi
    $total_page = ceil($total_row/$row_per_page); //Tính số page hiển thị

//PHÂN TRANG    

    $list_page = '';
    //nút pre page
    $page_prev = $page - 1;
    if($page_prev <=0 ){
        $page_prev = 1;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product_top&page='.$page_prev.'">&laquo;</a></li>';
    //đánh dấu trang 
    for($i = 1; $i <= $total_page; $i++){
        if($i == $page){
            $active = 'active';
        }else{
            $active = '';
        }
        $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=product_top&&page='.$i.'">'.$i.'</a></li>';
    }
    //nút next page
    $page_next = $page + 1;
    if($page_next > $total_page){
        $page_next = $total_page;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product_top&page='.$page_next.'">&raquo;</a></li>';

?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách sản phẩm ít được mua nhất</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách sản phẩm ít được mua nhất</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <table 
                            data-toolbar="#toolbar"
                            data-toggle="table">

						    <thead>
						    <tr>
						        <th>ID</th>
						        <th>Tên sản phẩm</th>
						        <th>Lượt mua</th>
                                <th>Giá</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Danh mục</th>
                                <th>Khuyến mãi</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT *,sale.sale_price,c.cat_name, SUM(d.number_product) as total FROM (SELECT pd.prd_id,pd.prd_name, pd.prd_price,pd.prd_image, om.number_product, pd.prd_status,pd.cat_id FROM `product` pd LEFT JOIN order_mapping om ON om.product_id = pd.prd_id LEFT JOIN `order` od ON od.id = om.order_id AND od.status = 0 WHERE 1) d
                                    LEFT JOIN sale ON sale.product_id = d.prd_id and sale.start_date <= now() and sale.end_date >= now()
                                    LEFT JOIN category c ON c.cat_id = d.cat_id 
                                    GROUP BY d.prd_image,d.prd_id,d.prd_price,d.prd_name,sale.sale_price,c.cat_name ORDER BY total ASC LIMIT ".$per_row.' , '.$row_per_page;

                                    $query = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_array($query)){
                                ?>  
                                    <tr>
                                        <td style=""><?php echo $row['prd_id'];?></td>
                                        <td style=""><?php echo $row['prd_name'];?></td>
                                        <td style=""><?php echo isset($row['total'] ) ? $row['total'] : 0 ;?></td>
                                        <td style=""><?php echo $row['prd_price'];?> vnd</td>
                                        <td style="text-align: center"><img width="130" height="180" src="img/products/<?php echo $row['prd_image'];?>" /></td>
                                        <td>
                                            <?php 
                                                if($row['prd_status']==1){
                                                    echo '<span class="label label-success">Còn hàng</span>';
                                                }else{
                                                    echo '<span class="label label-danger">Hết hàng</span>';
                                                }
                                            
                                            ?>
                                        </td>
                                        <td><?php echo $row['cat_name'];?></td>
                                        <td>
                                            <?php echo $row['sale_price'];?>
                                            <?php if(isset($row['sale_price'])) { ?>
                                                vnd 
                                            <span class="label label-danger"><?php echo (((1 -round((int)$row['sale_price']/(int)$row['prd_price'],2)))*100).'%'; ?></span>
                                            <?php } ?>
                                        </td>
                                        <td class="form-group">
                                            <a href="index.php?page_layout=edit_product&&prd_id=<?php echo $row['prd_id'];?>" id="<?php echo $row['prd_id'];?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a type="button" class="btn btn-success" data-toggle="modal" onclick="sale_click(<?php echo $row['prd_id'];?>, '<?php echo $row['prd_name'];?>','<?php echo $row['prd_price'];?>','<?php echo $row['sale_price'];?>','<?php echo $row['start_date'];?>','<?php echo $row['end_date'];?>' )" data-href-id="del_product.php?prd_id=<?php echo $row['prd_id'];?> "data-name-id="Sản phẩm: <?php echo $row['prd_name'];?> "data-target="#saleDialod" style="border:none; outline:none;">
                                                <i class="glyphicon glyphicon-cog border-0"></i>
                                            </a>
                                            <?php if(isset($row['sale_price'])) { ?>
                                            <a type="button" class="btn btn-warning" data-toggle="modal"  onclick="sale_cancel_click(<?php echo $row['prd_id'];?>)" data-href-id="del_product.php?prd_id=<?php echo $row['prd_id'];?> " data-name-id="Sản phẩm: <?php echo $row['prd_name'];?> " data-target="#confirmCancelSale" style="border:none; outline:none;">
                                            <i class="glyphicon glyphicon-ban-circle border-0"></i>
                                            </a>
                                            <?php } ?>
                                            <a type="button" class="btn btn-danger" data-toggle="modal" data-href-id="del_product.php?prd_id=<?php echo $row['prd_id'];?> " data-name-id="Sản phẩm: <?php echo $row['prd_name'];?> " data-target="#confirmDialod" style="border:none; outline:none;">
                                        <i class="glyphicon glyphicon-remove border-0"></i>
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmDialod" tabindex="-1" role="dialog"
                                        aria-labelledby="confirmDialodTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document"
                                            style="background-color: #fff;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDialodTitle"></h5>
                                            </div>
                                            <div class="modal-body">
                                                Bạn chắc chắn muốn xóa sản phẩm này không?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" type="button" class="btn btn-primary" id="deletes">Có</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                <script>
                                                    $('#confirmDialod').on('show.bs.modal', function (e) {
                                                        var nameProduct = $(e.relatedTarget).data('name-id'); //lấy dữ liệu truyền vào từ data-name-id của thẻ html
                                                        document.getElementById('confirmDialodTitle')
                                                            .innerHTML = nameProduct; //gán giá trị vào thẻ html có id tương ứng
                                                        var hrefDelete = $(e.relatedTarget).data('href-id');//lấy dữ liệu truyền vào từ data-href-id của thẻ html
                                                        $('#deletes').attr('href', hrefDelete); // truyền dữ liệu vào thuộc tính href của thẻ có id là deletes
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Cancel Sale -->
                                    <div class="modal fade" id="confirmCancelSale" tabindex="-1" role="dialog"
                                        aria-labelledby="confirmDialodTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document"
                                            style="background-color: #fff;">
                                            <form method="post">	
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDialodTitle"></h5>
                                            </div>
                                            <div class="modal-body">
                                               
                                                Bạn chắc chắn muốn dừng khuyến mãi sản phẩm này không?
                                                <input id= "product_id_sale_cancel" name="product_id_sale_cancel" type="hidden" >
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <a href="#" type="button" class="btn btn-primary" id="cancelSale">Có</a> -->
                                                <input type="submit" class="btn btn-primary" name="sale_cancel" value="Hủy Khuyến Mãi"/>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                <!-- <script>
                                                    $('#confirmCancelSale').on('show.bs.modal', function (e) {
                                                        var nameProduct = $(e.relatedTarget).data('name-id'); //lấy dữ liệu truyền vào từ data-name-id của thẻ html
                                                        document.getElementById('confirmDialodTitle')
                                                            .innerHTML = nameProduct; //gán giá trị vào thẻ html có id tương ứng
                                                        var hrefDelete = $(e.relatedTarget).data('href-id');//lấy dữ liệu truyền vào từ data-href-id của thẻ html
                                                        $('#cancelSale').attr('href', hrefDelete); // truyền dữ liệu vào thuộc tính href của thẻ có id là deletes
                                                    });
                                                </script> -->
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
						</table>
                    </div>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                               <?php echo $list_page; ?> 
                               
                                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                                
                            </ul>
                        </nav>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->


     <!-- Modal Khuyến mãi -->
     <div class="modal fade" id="saleDialod" tabindex="-1" role="dialog"
        aria-labelledby="confirmDialodTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document"
            style="background-color: #fff;">
            <form onsubmit="return checkRegistration()" method="post">	
            <div class="modal-header">
                <h4 class="modal-title" id="confirmDialodTitle">Khuyến mãi</h4>
            </div>
            <div class="modal-body">
            
                <fieldset>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input id= "product_name" class="form-control" placeholder="Tên sản phẩm" name="product_name" type="text" readonly>
                        <input id= "product_id" name="product_id" type="hidden" >
                    </div>
                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input id= "product_price" class="form-control" placeholder="Giá sản phẩm" name="product_price" type="text" readonly>
                    </div>
                    <div class="form-group">
                        <label>Giá khuyến mãi</label>
                        <input id= "product_sale" class="form-control" placeholder="Giá khuyến mãi" name="product_sale" type="text" autofocus required>
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                        <label for="id_end_time">Ngày bắt đầu</label>
                            <div class="input-group date" id="start_date_form">
                                <input id= "start_date" type="text" name="start_date" class="form-control" required/>
                                <div class="input-group-addon input-group-append">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_end_time">Ngày kết thúc</label>
                            <div class="input-group date" id="end_date_form">
                                <input id= "end_date" type="text" name="end_date" class="form-control" required/>
                                <div class="input-group-addon input-group-append">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <!-- <button type="submit" class="btn btn-primary">Lưu</button> -->
                <input type="submit" class="btn btn-primary" name="submit_form" value="Lưu"/>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <script>
                   
                </script>
            </div>
            </form>
        </div>
    </div>
    

<script>
    function checkRegistration(){
        let product_price = document.getElementById('product_price').value;
        let product_sale = document.getElementById('product_sale').value;
        if(+product_sale >= +product_price){
            alert('Giá khuyến mãi phải nhỏ hơn giá sản phẩm!');
            return false;
        }

        let currentDate = new Date();
        let new_date = (new Date((currentDate.getMonth() + 1) + "/" + currentDate.getDate() + "/" + currentDate.getFullYear())).getTime();
        let start_date = getDateTime(document.getElementById('start_date').value);
        let end_date = getDateTime(document.getElementById('end_date').value);
       
        if(start_date < new_date) {
            alert('Ngày bắt đầu phải lớn hơn hoặc bằng ngày hiện tại!');
            return false;
        }
        if(end_date < start_date) {
            alert('Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu!');
            return false;
        }
        return true;
    }

    function getDateTime(date) {
        if(date) {
            const arrDate = date.split('/');
            return (new Date(arrDate[1] + "/" + arrDate[0] + "/" + arrDate[2])).getTime()
        }

        return 0;
    }
</script>
<script type="text/javascript">
        function sale_click(product_id,product_name, product_price,sale_price, start_date, end_date) {
            $("#product_id").val(product_id)
            $("#product_name").val(product_name)
            $("#product_price").val(product_price)
            $("#product_sale").val(sale_price)
            $("#start_date").val(getTimeDate(start_date))
            $("#end_date").val(getTimeDate(end_date))
        }

        function sale_cancel_click(product_id) {
            $("#product_id_sale_cancel").val(product_id)
        }

        function getTimeDate(date) {
            if(date) {
                const arrDate = date.split(' ')[0].split("-");
                return arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]
            }

            return "";
        }

        (function($){
            $(function(){
                $('#start_date_form').datetimepicker({
                    "allowInputToggle": true,
                    "showClose": true,
                    "showClear": true,
                    "showTodayButton": true,
                    "format": "DD/MM/YYYY",
                });
                $('#end_date_form').datetimepicker({
                    "allowInputToggle": true,
                    "showClose": true,
                    "showClear": true,
                    "showTodayButton": true,
                    "format": "DD/MM/YYYY",
                });
            });
        })(jQuery);
      </script>
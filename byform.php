<?php 
	// if(!defined('SECURITY')){
	// 	die('Bạn không có quyền truy cập vào file này!');
	// }
	$sql = "SELECT * FROM customer WHERE customer_mail = '".$_SESSION['mail']."'";
	$result = $conn -> query($sql);
	$rows = $result->fetch_all(MYSQLI_ASSOC);

    if(isset($_POST['byform'])){
        $name_order = $_POST['name'];
        $email_order = $_POST['email'];
        $address_order = $_POST['address'];
        $phone_order = $_POST['phone'];

		$sql = "INSERT INTO `order`(`name`, `email`, `address`, `phone`) VALUES ('$name_order','$email_order','$address_order','$phone_order')";
		$query = mysqli_query($conn,$sql);
		
		$sql = "SELECT * FROM order WHERE id = (SELECT max(id) FROM order WHERE deleted_at is null)";
		$resultOrder = $conn -> query($sql);
		$dataOrder = $resultOrder->fetch_all(MYSQLI_ASSOC);
		var_dump($dataOrder);
		// header("location: index.php?page_layout=login&isRegist=true");
    }


	if(isset($_SESSION["cart"])){
        // if(isset($_POST['sbm'])){
        //     $qtt = array();
        //     foreach($_POST['qtt'] as $prd_id => $qtt){
        //         $_SESSION['cart'][$prd_id] = $qtt;
        //     }
        // }
        $arr_id = array();
        foreach($_SESSION["cart"] as $prd_id => $qtt){
            $arr_id[] = $prd_id;
        }
        $str_id = implode(", ", $arr_id);
        $sql = "SELECT * FROM product WHERE prd_id IN ($str_id)";
        $query = mysqli_query($conn,$sql);
	}
?>
<style>
	/* body {
		overflow: hidden;
	} */
</style>
		
	<div class="">			
		
		<div class="row">
			
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
					<div class="main-login">
						<div class="byform-panel panel panel-default">
							<div class="panel-body">
								<div class="panel-heading"><h1 style="text-align: center;"><a href="index.php"><img class="img-fluid" src="images/logo.png"></a></h1></div>
								<div class="col-lg-12">
									<h1 class="page-header">Thông tin đặt hàng</h1>
								</div>
								<div class="col-md-12">
									<form role="form" method="post">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Họ & Tên</label>
													<input name="name" required class="form-control" placeholder="" value="<?php echo $rows[0]['customer_full'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email</label>
													<input name="email" required type="email" class="form-control" value="<?php echo $rows[0]['customer_mail'] ?>">
												</div>   
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Địa chỉ</label>
													<input name="address" required type="text"  class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Số điện thoại</label>
													<input name="phone" required type="text" class="form-control">
												</div>   
											</div>
										</div>

										<table class="table-byform">
											<thead>
												<tr>
													<th>Thông tin sản phẩm</th>
													<th>Đơn Giá(đ)</th>
													<th>Số lượng</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$total_price_all = 0;
													while($row = mysqli_fetch_array($query)){
														$total_price = $_SESSION['cart'][$row['prd_id']] * $row['prd_price'];
														$total_price_all += $total_price;
													?>
														<tr class="cart-item">
															<td class="cart-thumb ">
																<img src="admin/images/<?php echo $row['prd_image']; ?>">
																<h4><?php echo $row['prd_name']; ?></h4>
															</td>
															<td class="cart-price"><b><?php echo number_format($total_price) ; ?>đ</b></td>
															<td class="cart-quantity">
																<?php echo $_SESSION['cart'][$row['prd_id']]; ?>
															</td>
														</div>
												<?php        
													}
												?>
												<tr>
													<td>Tổng</td>
													<td colspan="2" class="cart-price"><b><?php echo number_format($total_price_all) ; ?>đ</b></td>
												</tr>
											</tbody>		
										</table>
									
									<button name="byform" type="submit" class="btn btn-success">Đặt hàng</button>
								</div>
							</form>
							</div>
						</div>
					</div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
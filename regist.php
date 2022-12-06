<?php 
	// if(!defined('SECURITY')){
	// 	die('Bạn không có quyền truy cập vào file này!');
	// }
	$isExit = false;
    if(isset($_POST['sbm'])){
        $user_full = $_POST['name'];
        $user_mail = $_POST['email'];
        $user_pass = md5($_POST['password']);
        $user_re_pass = md5($_POST['re_password']);

		$sql = "SELECT * FROM customer WHERE customer_mail = '".$user_mail."'";
		$result = $conn -> query($sql);
		$rows = $result->fetch_all(MYSQLI_ASSOC);
	
		if(count($rows) == 0) {
			if($user_pass===$user_re_pass){
				$sql = "INSERT INTO customer (customer_full, customer_mail, customer_pass) VALUES ('$user_full','$user_mail','$user_pass')";
				$query = mysqli_query($conn,$sql);
				header("location: index.php?page_layout=login&isRegist=true");
			}else{
				echo '<script language="javascript">';
				echo 'alert("Mật khẩu không khớp! Hãy nhập lại")';
				echo '</script>';
			}
			$isExit = false;
		} else {
			$isExit = true;
		}

        
    } else $isExit = false;
?>
<style>
	body {
		overflow: hidden;
	}
</style>
		
	<div class="">			
		
		<div class="row">
			
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
					<div class="main-login">
						<div class="login-panel panel panel-default">
							<div class="panel-body">
								<div class="panel-heading"><h1 style="text-align: center;"><a href="index.php"><img class="img-fluid" src="images/logo.png"></a></h1></div>
								<div class="col-lg-12">
									<h1 class="page-header">Tạo tài khoản</h1>
								</div>
								<div class="col-md-12">
									<?php if($isExit) { ?>
										<div class="alert alert-danger">Email đã tồn tại !</div>
									<?php } ?>
									<form role="form" method="post">
									<div class="form-group">
										<label>Họ & Tên</label>
										<input name="name" required class="form-control" placeholder="">
									</div>
									<div class="form-group">
										<label>Email</label>
										<input name="email" required type="email" class="form-control">
									</div>                       
									<div class="form-group">
										<label>Mật khẩu</label>
										<input name="password" required type="password"  class="form-control">
									</div>
									<div class="form-group">
										<label>Nhập lại mật khẩu</label>
										<input name="re_password" required type="password"  class="form-control">
									</div>
									
									<button name="sbm" type="submit" class="btn btn-success">Đăng ký</button>
									<button type="reset" class="btn btn-default">Làm mới</button>
								</div>
							</form>
							</div>
						</div>
					</div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
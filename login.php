<?php 

// session_start();
		
		// $sql = "SELECT * FROM customer";
		// $result = $conn -> query($sql);
		
		// $rows = $result->fetch_all(MYSQLI_ASSOC);
		// if(isset($_POST['sbm'])){
		// 	$mail = $_POST['mail'];
		// 	$pass = $_POST['pass'];
		// 	foreach ($rows as $row) {
		// 	if($row['customer_mail']== $mail && $row['customer_pass'] == $pass){
		// 		$_SESSION['mail'] = $mail;
		// 		$_SESSION['pass'] = $pass;
		// 		header("location: index.php");	
		// 	}
		// 	else{
		// 		$erorr = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
		// 	}
		// 	}
			
		// }	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Authentic Shoes - Customer</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php 
		

		if(isset($_POST['sbm'])){
		

			$mail = $_POST['mail'];
			$pass = md5($_POST['pass']);
			$sql = "SELECT * from customer where customer_mail = '$mail' AND customer_pass = '$pass'";
			$result = $conn -> query($sql);
            $row = $result->fetch_all(MYSQLI_ASSOC);
	
			if(count($row) > 0){
				$_SESSION['user_name'] = $row[0]['customer_full'];
				$_SESSION['user_mail'] = $row[0]['customer_mail'];
				$_SESSION['pass'] = $pass;
				header("location: index.php");
			}
			else{
				$erorr = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
			}

			
			// if($_SESSION['mail'] = $mail && $_SESSION['pass'] = $pass){
			// 	header("location: index.php");
			// }
			// else{
			// 	$erorr = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
			// }
		}

	?>
	<?php if(isset($_GET['isRegist'])) { ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		Tạo tài khoản thành công
	</div>
	<?php } ?>
	<div>
		<div>
			<div class="main-login">
				<div class="login-panel panel panel-default">
					<div class="panel-heading"><h1 style="text-align: center;"><a href="index.php"><img class="img-fluid" src="images/logo.png"></a></h1></div>
					<div class="panel-body">
						<?php 
							if(isset($erorr)){
								echo $erorr;
							}
						?>
						<form role="form" method="post">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
									</label>
								</div>
								<div>
									Bạn chưa có tài khoản? <a href="index.php?page_layout=regist">Đăng ký</a>
								</div>
								<button type="submit" name="sbm" class="btn btn-primary">Đăng nhập</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			
		</div><!-- /.col-->
	</div><!-- /.row -->	

	<script>
		<?php 
			if(!isset($_GET['isRegist'])) {
		?>
			$('.alert').alert()
		<?php } ?>
	</script>
</body>

</html>

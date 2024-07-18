<?php 
	// if(!defined('SECURITY')){
	// 	die('Bạn không có quyền truy cập vào file này!');
	// }
	$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Authentic Shoes - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!-- CK Editor -->
<script src='ckeditor/ckeditor.js' ></script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>	
<script src="js/bootstrap-table.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
<script type="text/javascript" src="./js/bootstrap-datetimepicker.min.js"></script>
<!-- <script type="text/javascript" src="./js/demo.js"></script> -->

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src='img/logo.png' alt="logo" style="height:50px" /></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Admin
						<?php 
							echo $_SESSION['mail'];
						?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Hồ sơ</a></li>
							<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
			</div>			
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<!-- <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
			
		<li class="<?php if(!isset($_GET['page_layout'])){echo "active";} ?>"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Trang chủ</a></li>
			
			<?php if($role == '1') { ?>
				<li class="<?php if(isset($_GET['page_layout']) && ($_GET['page_layout'] == 'user' || $_GET['page_layout'] == 'add_user' ||
				 $_GET['page_layout'] == 'edit_user')){echo "active";} ?>"><a href="index.php?page_layout=user">
					<svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>Quản lý thành viên</a></li>
			<?php } ?>
			<?php if($role == '1' || $role == '2') { ?>
				<li class="<?php if(isset($_GET['page_layout']) && ($_GET['page_layout'] == 'category' || $_GET['page_layout'] == 'add_category' || 
				$_GET['page_layout'] == 'edit_category')){echo "active";} ?>"><a href="index.php?page_layout=category"><svg class="glyph stroked open folder"><use xlink:href="#stroked-open-folder"/></svg>Quản lý danh mục</a></li>
			<?php } ?>
			<?php if($role == '1' || $role == '2') { ?>
				<li class="<?php if(isset($_GET['page_layout']) && ($_GET['page_layout'] == 'product' || 
				$_GET['page_layout'] == 'add_product' ||$_GET['page_layout'] == 'edit_product')){echo "active";} ?>"><a href="index.php?page_layout=product"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>Quản lý sản phẩm</a></li>		
			<?php } ?>
			<li class="<?php if(isset($_GET['page_layout']) && ($_GET['page_layout'] == 'order')){echo "active";} ?>"><a href="index.php?page_layout=order"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>Quản lý đơn hàng</a></li>		
			<li class="<?php if(isset($_GET['page_layout']) && ($_GET['page_layout'] == 'customer' || 
			$_GET['page_layout'] == 'add_customer' ||
			$_GET['page_layout'] == 'edit_customer' )){echo "active";} ?>"><a href="index.php?page_layout=customer"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>Quản lý khách hàng</a></li>
		</ul>

	</div><!--/.sidebar-->
		

	<!-- Master Layout -->
	<?php 
		if(isset($_GET['page_layout'])){
			switch($_GET['page_layout']){
				case "product": include_once('product.php'); break;
				case "add_product": include_once('add_product.php');break;
				case "edit_product": include_once('edit_product.php');break;
				case "user": include_once('user.php'); break;
				case "add_user": include_once('add_user.php');break;
				case "edit_user": include_once('edit_user.php');break;
				case "category": include_once('category.php'); break;
				case "add_category": include_once('add_category.php');break;
				case "edit_category": include_once('edit_category.php');break;
				case "customer": include_once('customer.php'); break;
				case "add_customer": include_once('add_customer.php');break;
				case "edit_customer": include_once('edit_customer.php');break;
				case "order": include_once('order.php');break;
				case "product_top": include_once('product_top.php');break;
			}
		}else{
			include_once('dashboard.php');
		}
	?>


	
	
</body>

</html>

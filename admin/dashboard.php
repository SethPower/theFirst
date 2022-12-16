<?php 
	$sql = 'SELECT * FROM ';
?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Trang chủ quản trị</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Trang chủ quản trị</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo mysqli_num_rows(mysqli_query($conn, $sql.'product')); ?></div>
							<div class="text-muted">Sản Phẩm</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">52</div>
							<div class="text-muted">Danh mục</div>
						</div>
					</div>
				</div>
			</div> -->
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo mysqli_num_rows(mysqli_query($conn, $sql.'user')); ?></div>
							<div class="text-muted">Thành Viên</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo mysqli_num_rows(mysqli_query($conn, $sql.'category')); ?></div>
							<div class="text-muted">Danh mục</div>
						</div>
					</div>
				</div>
			</div>

			<?php
				$start_date = date("Y-m-d",time() - 60*86400).' 00:00:00';  
				$end_date = date("Y-m-d",time()).' 23:59:59'; 
			
				$sql = "SELECT * from `order` where created_at >= '$start_date' and created_at <= '$end_date'";
				
				$query = mysqli_query($conn,$sql);
				$moneyDay = 0;
				$moneyDayOld = 0;
				$moneyW = 0;
				$moneyWOld = 0;
				$moneyM = 0;
				$moneyMOld = 0;
				while($row = mysqli_fetch_array($query)){
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()).' 23:59:59'))
						$moneyDay += (int) $row['total_price'];
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()-86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()-86400).' 23:59:59'))
						$moneyDayOld += (int) $row['total_price'];
					
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time() - 7*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()).' 23:59:59'))
						$moneyW += (int) $row['total_price'];
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()-14*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()-7*86400).' 23:59:59'))
						$moneyWOld += (int) $row['total_price'];

					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time() - 30*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()).' 23:59:59'))
						$moneyM += (int) $row['total_price'];
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()-60*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()-30*86400).' 23:59:59'))
						$moneyMOld += (int) $row['total_price'];
				}
				// var_dump(round($moneyW/$moneyWOld,2));
			?>
			<div class="col-xs-12" id="info-box">
				<div class="info-box-content">
					<div class="info-box-item">
						<div class="title color-blue">Doanh thu theo ngày</div>
						<div class="money"><?php echo number_format($moneyDay) ?> VND</div>
						<?php if(round($moneyDay/$moneyDayOld,2) >= 1) { ?>
							<div class="percen color-green"><?php echo $moneyDayOld != 0 ? (round($moneyDay/$moneyDayOld,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-up"></i></div>
						<?php } else { ?>
							<div class="percen color-red"><?php echo $moneyDayOld != 0 ? (1 - round($moneyDay/$moneyDayOld,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-down"></i></div>
						<?php } ?>
					</div>

					<div class="info-box-item">
						<div class="title color-red">Doanh thu theo tuần</div>
						<div class="money"><?php echo number_format($moneyW) ?> VND</div>
						<?php if($moneyWOld == 0 || round($moneyW/$moneyWOld,2) >= 1) { ?>
							<div class="percen color-green"><?php echo $moneyWOld != 0 ? (round($moneyW/$moneyWOld,2) - 1)*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-up"></i></div>
						<?php } else { ?>
							<div class="percen color-red"><?php echo $moneyWOld != 0 ? (1 - round($moneyW/$moneyWOld,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-down"></i></div>
						<?php } ?>
					</div>

					<div class="info-box-item">
						<div class="title color-yellow">Doanh thu theo tháng</div>
						<div class="money"><?php echo number_format($moneyM) ?> VND</div>
						<?php if($moneyMOld == 0 || round($moneyM/$moneyMOld,2) >= 1) { ?>
							<div class="percen color-green"><?php echo $moneyMOld != 0 ? (round($moneyM/$moneyMOld,2) - 1)*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-up"></i></div>
						<?php } else { ?>
							<div class="percen color-red"><?php echo $moneyMOld != 0 ? (1 - round($moneyM/$moneyMOld,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-down"></i></div>
						<?php } ?>
					</div>
				<div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->

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
				$start_date = date("Y").'-01-01 00:00:00';  
				$end_date = date("Y").'-12-31 23:59:59';  
				// $end_date = date("Y-m-d",time()).' 23:59:59'; 
			
				$sql = "SELECT * from `order` od LEFT JOIN order_mapping om ON om.order_id = od.id LEFT JOIN product pd ON pd.prd_id = om.product_id where created_at >= '$start_date' and created_at <= '$end_date' and status != 3";
				var_dump($sql);
				$query = mysqli_query($conn,$sql);
				$moneyDay = 0;
				$moneyDayOld = 0;
				$moneyW = 0;
				$moneyWOld = 0;
				$moneyM = 0;
				$moneyMOld = 0;

				$moneyDay1 = 0;
				$moneyDayOld1 = 0;
				$moneyW1 = 0;
				$moneyWOld1 = 0;
				$moneyM1 = 0;
				$moneyMOld1 = 0;
				$listMonth = [0,0,0,0,0,0,0,0,0,0,0,0];
				while($row = mysqli_fetch_array($query)){
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()).' 23:59:59')) {
						$moneyDay += (int) $row['total_price_map'];
						$moneyDay1 += ((int) $row['total_price_map'] - (((int) $row['number_product'])*((int) $row['prd_original_price']) ));
					}
						
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()-86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()-86400).' 23:59:59')) {
						$moneyDayOld += (int) $row['total_price_map'];
						$moneyDayOld1 += ((int) $row['total_price_map'] - (((int) $row['number_product'])*((int) $row['prd_original_price']) ));
					}
						
					
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time() - 7*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()).' 23:59:59')) {
						$moneyW += (int) $row['total_price_map'];
						$moneyW1 += ((int) $row['total_price_map'] - (((int) $row['number_product'])*((int) $row['prd_original_price']) ));
					}
						
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()-14*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()-7*86400).' 23:59:59')) {
						$moneyWOld += (int) $row['total_price_map'];
						$moneyWOld1 += ((int) $row['total_price_map'] - (((int) $row['number_product'])*((int) $row['prd_original_price']) ));
					}
						

					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time() - 30*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()).' 23:59:59')) {
						$moneyM += (int) $row['total_price_map'];
						$moneyM1 += ((int) $row['total_price_map'] - (((int) $row['number_product'])*((int) $row['prd_original_price']) ));
					}
						
					if(strtotime($row['created_at']) >= strtotime(date("Y-m-d",time()-60*86400).' 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y-m-d",time()-30*86400).' 23:59:59')) {
						$moneyMOld += (int) $row['total_price_map'];
						$moneyMOld1 += ((int) $row['total_price_map'] - (((int) $row['number_product'])*((int) $row['prd_original_price']) ));
					}
						

					//Tháng 1
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-01-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-01-31 23:59:59'))
						$listMonth[0] += (int) $row['total_price_map'];
					//Tháng 2
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-02-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-02-31 23:59:59'))
						$listMonth[1] += (int) $row['total_price_map'];	
					//Tháng 3
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-03-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-03-31 23:59:59'))
						$listMonth[2] += (int) $row['total_price_map'];	
					//Tháng 4
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-04-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-04-31 23:59:59'))
						$listMonth[3] += (int) $row['total_price_map'];	
					//Tháng 5
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-05-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-05-31 23:59:59'))
						$listMonth[4] += (int) $row['total_price_map'];	
					//Tháng 6
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-06-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-06-31 23:59:59'))
						$listMonth[5] += (int) $row['total_price_map'];	
					//Tháng 7
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-07-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-07-31 23:59:59'))
						$listMonth[6] += (int) $row['total_price_map'];	
					//Tháng 8
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-08-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-08-31 23:59:59'))
						$listMonth[7] += (int) $row['total_price_map'];	
					//Tháng 9
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-09-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-09-31 23:59:59'))
						$listMonth[8] += (int) $row['total_price_map'];	
					//Tháng 10
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-10-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-10-31 23:59:59'))
						$listMonth[9] += (int) $row['total_price_map'];	
					//Tháng 11
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-11-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-11-31 23:59:59'))
						$listMonth[10] += (int) $row['total_price_map'];
					//Tháng 12
					if(strtotime($row['created_at']) >= strtotime(date("Y").'-12-01 00:00:00') && strtotime($row['created_at']) <= strtotime(date("Y").'-12-31 23:59:59'))
						$listMonth[11] += (int) $row['total_price_map'];	

				}

			?>
			<div class="col-xs-12" id="info-box" style="margin-bottom: 15px">
				<div class="info-box-content">
					<div class="info-box-item">
						<div class="title color-blue">Doanh thu theo ngày</div>
						<div class="money"><?php echo number_format($moneyDay) ?> VND</div>
						<?php if($moneyDayOld == 0 || round($moneyDay/$moneyDayOld,2) >= 1) { ?>
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
			</div>
			</div>

			<div class="col-xs-12" id="info-box">
				<div class="info-box-content">
					<div class="info-box-item">
						<div class="title color-blue">Lãi theo ngày</div>
						<div class="money"><?php echo number_format($moneyDay1) ?> VND</div>
						<?php if($moneyDayOld1 == 0 || round($moneyDay1/$moneyDayOld1,2) >= 1) { ?>
							<div class="percen color-green"><?php echo $moneyDayOld1 != 0 ? (round($moneyDay/$moneyDayOld1,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-up"></i></div>
						<?php } else { ?>
							<div class="percen color-red"><?php echo $moneyDayOld1 != 0 ? (1 - round($moneyDay1/$moneyDayOld1,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-down"></i></div>
						<?php } ?>
					</div>

					<div class="info-box-item">
						<div class="title color-red">Lãi theo tuần</div>
						<div class="money"><?php echo number_format($moneyW1) ?> VND</div>
						<?php if($moneyWOld1 == 0 || round($moneyW1/$moneyWOld1,2) >= 1) { ?>
							<div class="percen color-green"><?php echo $moneyWOld1 != 0 ? (round($moneyW1/$moneyWOld1,2) - 1)*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-up"></i></div>
						<?php } else { ?>
							<div class="percen color-red"><?php echo $moneyWOld1 != 0 ? (1 - round($moneyW1/$moneyWOld1,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-down"></i></div>
						<?php } ?>
					</div>

					<div class="info-box-item">
						<div class="title color-yellow">Lãi theo tháng</div>
						<div class="money"><?php echo number_format($moneyM1) ?> VND</div>
						<?php if($moneyMOld1 == 0 || round($moneyM1/$moneyMOld1,2) >= 1) { ?>
							<div class="percen color-green"><?php echo $moneyMOld1 != 0 ? (round($moneyM1/$moneyMOld1,2) - 1)*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-up"></i></div>
						<?php } else { ?>
							<div class="percen color-red"><?php echo $moneyMOld1 != 0 ? (1 - round($moneyM1/$moneyMOld1,2))*100 : 100; ?>% <i class="glyphicon glyphicon-arrow-down"></i></div>
						<?php } ?>
					</div>
				<div>
			</div>
			
		</div><!--/.row-->
		<div class="col-xs-12" id="info-box" style="margin-top: 50px">
			<figure class="highcharts-figure">
				<div id="container"></div>
			</figure>
		</div>

		<?php
			$sql = "SELECT * from `order` od LEFT JOIN order_mapping om ON om.order_id = od.id LEFT JOIN product pd on pd.prd_id = om.product_id LEFT JOIN category c on c.cat_id = pd.cat_id where od.created_at >= '$start_date' and od.created_at <= '$end_date' and od.status != 3";
			$query = mysqli_query($conn,$sql);
			$listCat = [];
			while($row = mysqli_fetch_array($query)){
				if(isset($row['cat_name'])) {
					if(isset($listCat[$row['cat_name']])) {
						$listCat[$row['cat_name']] += $row['total_price_map'];
					} else {
						$listCat[$row['cat_name']] = $row['total_price_map'];
					}
				}
				
			}
		?>
		<div class="col-xs-12" id="info-box" style="margin-top: 50px">
			<figure class="highcharts-figure">
				<div id="container1"></div>
			</figure>
		</div>
	</div>	<!--/.main-->
	<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<script src="js/export-data.js"></script>
<script src="js/accessibility.js"></script>


<script>
// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Thống kê doanh thu hàng tháng( <?php echo date('Y') ?> )'
    },
    xAxis: {
        categories: [
			<?php for($i = 0; $i < (int)date("m");$i++) { echo '\'Tháng'.($i+1).'\','; } ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'VND'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} VND</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Doanh thu',
        data: [<?php for($i = 0; $i < (int)date("m");$i++) { echo $listMonth[$i].','; } ?>]

    }],
	colors: ['#30a5ff']
});


Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Thống kê doanh thu theo danh mục( <?php echo date('Y') ?> )'
    },
    xAxis: {
        categories: [
			<?php 
				foreach($listCat as $key => $value) {
					echo '\''.$key.'\',';
				}
			?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'VND'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} VND</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Doanh thu',
        data: [<?php 
				foreach($listCat as $key => $value) {
					echo $value.',';
				}
			?>]

    }],
	colors: ['#1ebfae']
});
</script>
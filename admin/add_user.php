<?php 
	// if(!defined('SECURITY')){
	// 	die('Bạn không có quyền truy cập vào file này!');
	// }
    $isExit = false;
    $isFormatEmail = false;
    if(isset($_POST['sbm'])){
        $user_full = $_POST['user_full'];
        $user_mail = $_POST['user_mail'];
        $user_pass = md5($_POST['user_pass']);
        $user_re_pass = md5($_POST['user_re_pass']);
        $user_level = $_POST['user_level'];

        $sql = "SELECT * FROM user WHERE user_mail = '".$user_mail."'";
		$result = $conn -> query($sql);
		$rows = $result->fetch_all(MYSQLI_ASSOC);
        if(count($rows) == 0) {
            if(strlen($user_mail) < 11 || substr($user_mail,strlen($user_mail)-10,strlen($user_mail)) != '@gmail.com') {
                $isFormatEmail = true;
            } else if($user_pass===$user_re_pass){
                $sql = "INSERT INTO user (user_full, user_mail, user_pass, user_level) VALUES ('$user_full','$user_mail','$user_pass', $user_level)";
                $query = mysqli_query($conn,$sql);
                header("location: index.php?page_layout=user");
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
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="">Quản lý thành viên</a></li>
				<li class="active">Thêm thành viên</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm thành viên</h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                                <?php if($isExit) { ?>
                            	    <div class="alert alert-danger">Email đã tồn tại !</div>
                                <?php } ?>
                                <?php if($isFormatEmail) { ?>
                            	    <div class="alert alert-danger">Định dạng email không đúng !</div>
                                <?php } ?>
                                <form role="form" method="post" onsubmit="return validate()">
                                <div class="form-group">
                                    <label>Họ & Tên</label>
                                    <input name="user_full" required class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="user_mail" required type="text" class="form-control">
                                </div>                       
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input name="user_pass" required type="password"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input name="user_re_pass" required type="password"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="user_level" class="form-control">
                                        <option value=1>Quản lý hệ thống</option>
                                        <option value=2>Quản trị viên</option>
                                        <option value=3>Kế toán</option>
                                    </select>
                                </div>
                                <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
    <script>
		function validate() {
			if(document.getElementsByName('user_pass')[0].value.length < 8) {
				alert('Mật khẩu phải lớn hơn 8 ký tự!');
				return false
			}
			return true;
		}
	</script>
<?php 
$error = array();
$target_dir  = "public/uploads/products/";
$target_file = $target_dir . basename($_FILES['file']['name']);
// check type file img valid
$type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
if (!in_array(strtolower($type_file), $type_fileAllow)) {
    $error['file'] = "Hệ thống không hỗ trợ file này, vui lòng chọn một file ảnh hợp lệ";
} else {
    $file_size = $_FILES['file']['size'];
    if ($file_size > 5242880) {
        $error['file'] = "File bạn chọn không được vược quá 5MB";
    } else {
        if (file_exists($target_file)) {
            $get_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
            $name_new = $get_name . " - Copy.";
            $path_file_new = $target_dir . $name_new . $type_file;
            $k = 1;
            while (file_exists($path_file_new)) {
                $get_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $name_new = $get_name . " - Copy({$k}).";
                $path_file_new = $target_dir . $name_new . $type_file;
                $k++;
            }
            $target_file = $path_file_new;
        }
    }
}
?>
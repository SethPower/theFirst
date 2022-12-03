<?php 
    // if(!defined('SECURITY')){
    //     die('Bạn không có quyền truy cập file này !');
    // }
    $conn = mysqli_connect('localhost','root','','SHOP_AUTHENTIC_SHOES');
    if($conn){
        mysqli_query($conn, "SET NAMEs 'UTF8'");
    }else{
        echo "Kết nối Database thất bại";
    }
?>
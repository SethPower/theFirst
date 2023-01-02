<?php 
    session_start();
    define('SECURITY', True);
    include_once('config/connect.php');
    $user_id = $_GET['customer_id'];
    if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
        $sql = "DELETE FROM customer WHERE customer_id = $user_id";
        mysqli_query($conn,$sql);
        header("location: index.php?page_layout=customer");
    }
?>
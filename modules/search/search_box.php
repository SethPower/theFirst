<!-- <?php 
$keyword = '';
if(isset($_POST['keyword'])) {
    $keyword = $_POST['keyword']; // aa bb cc 
} else if($_GET['keyword']) {
    $keyword = $_GET['keyword']; // aa bb cc 
}
    // if(isset($_POST['sbm'])){
        // $keyword = $_POST['keyword'];
    // }
?> -->
<div id="search" class="col-lg-4 col-md-4 col-sm-12">
    <form class="form-inline" method="post" action="index.php?page_layout=search">
        <input class="form-control mt-3" type="search" name="keyword" placeholder="Tìm kiếm" aria-label="Search" value="<?php echo $keyword ?>">
        <button class="btn btn-danger mt-3" type="submit" name="sbm">Tìm kiếm</button>
    </form>
</div>
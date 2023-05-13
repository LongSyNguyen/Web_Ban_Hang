<?php
include('../connDB.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn,"DELETE FROM category WHERE id=$id");
    // kiểm tra điều kiện nếu $query đúng chuyển sang trang category.php
    if($query){
        header('location:category.php');
    }
}
?>
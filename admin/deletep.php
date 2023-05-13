<?php
    include('../connDB.php');
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        // Xoá phần tử từ hai bảng Gallery và bảng Product có product.id=gallery.product_id 
        $sql = "DELETE g , p FROM gallery g JOIN product p ON g.product_id = p.id WHERE g.product_id = $id";
        $result = mysqli_query($conn,$sql);
        header('location:showp.php');
    }
?>
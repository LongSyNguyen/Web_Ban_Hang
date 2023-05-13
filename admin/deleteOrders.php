<?php
    include('../connDB.php');
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        // Xoá phần tử từ hai bảng Gallery và bảng Product có product.id=gallery.product_id 
        $sql = "DELETE o , od FROM orders o JOIN orderdetails od ON o.id = od.order_id WHERE o.id = $id;";
        $result = mysqli_query($conn,$sql);
        header('location:orderErorr.php');
    }
?>
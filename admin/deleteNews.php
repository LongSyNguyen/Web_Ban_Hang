<?php
    include('../connDB.php');
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql = "DELETE gNews , n FROM newsgallery gNews JOIN News n ON gNews.news_id = n.id WHERE gNews.news_id = $id";
        $result = mysqli_query($conn,$sql);
        header('location:showNews.php');
    }
?>
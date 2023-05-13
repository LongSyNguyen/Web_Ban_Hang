<?php
    session_start();
    include('../connDB.php');
    $category = mysqli_query($conn,"SELECT * FROM category WHERE name NOT IN ('News') ");
    $news = mysqli_query($conn,"SELECT * FROM category WHERE name='News'");
?>
<!-- Kiểm tra điều kiện tài khoản đã login chưa -->
<!-- Nếu chưa login thì cho chạy sang trang khác -->
<?php
if(!isset($_SESSION['admin'])){
    header('location:../login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Phone</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
        <div class="wrapper">
            <div class="header">
                <nav class="container">
                    <a href="home-admin.php" class="logo">
                        <img src="../img/Capture.PNG" alt="logo-mb-phone">
                    </a> 
                    <ul class="main-menu">
                        <li>
                            <a href="">Quản Lý Sản Phẩm</a>
                            <ul class="sub-menu">
                                <li><a href="addp.php">Thêm Sản Phẩm</a></li>
                                <li><a href="showp.php">Chỉnh Sửa Sản Phẩm</a></li>
                            </ul>
                        </li>
                        </li>
                        <li><a href="category.php">Quản Lý Danh Mục</a>
                        </li>
                        <li>
                            <a href="orders.php">Quản Lý Giỏ Hàng</a>
                            <ul class="sub-menu">
                                <li><a href="orderErorr.php">Đơn hàng bị huỷ hoặc bị hoàn</a></li>
                                <li><a href="orderBrowse.php">Đơn hàng được duyệt</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="shown.php">Quản Lý Tin Tức</a>
                            <ul class="sub-menu">
                                <li><a href="addNews.php">Thêm Tin Tức</a></li>
                            </ul>
                        </li>
                        <?php
                            if(isset($_SESSION['admin'])){
                                echo "<li><a href='../unset.php'>Đăng Xuất</a></li>" ;
                            }
                            else{
                                echo "<li><a href='../login.php'>Đăng Nhập</a></li>";
                                echo "<li><a href='../register/register.php'>Đăng Ký</a></li>";
                                    }?>
                    </ul>
                </nav>
            </div>
        </div>
</body>
</html>
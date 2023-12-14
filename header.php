<?php 
    include('connDB.php');
    $category = mysqli_query($conn,"SELECT * FROM category");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Phone</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
        <div class="wrapper">
            <div class="header">
                <nav class="container">
                    <a href="home.php" class="logo">
                        <img src="img/Capture.PNG" alt="logo-mb-phone">
                    </a> 
                    <ul class="main-menu">
                        <li>
                            <a href="">Điện Thoại</a>
                            <ul class="sub-menu">
                                <?php foreach($category as $key => $value){ ?>
                                    <?php if($value['status']==1){?>
                                    <li><a href="?cateID=<?php echo $value['id']; ?>"><?php echo $value['name'] ?></a></li>
                                    <?php }else{}?>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="view-cart.php">Giỏ Hàng</a>
                            <ul class="sub-menu">
                                <li><a href="view-status.php">Trạng thái đơn hàng</a></li>
                            </ul>
                        </li>
                        <?php
                        session_start();
                            if(isset($_SESSION['user'])){
                                echo "<li><a href='userInfor.php'>Thông tin người dùng</a></li>" ;
                                echo "<li><a href='unset.php'>Đăng Xuất</a></li>";
                            }
                            else{
                                echo "<li><a href='login.php'>Đăng Nhập</a></li>";
                                echo "<li><a href='signup.php'>Đăng Ký</a></li>";
                                    }?>
                    </ul>
                </nav>
            </div>
        </div>
</body>
</html>
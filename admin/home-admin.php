<?php
    // Điếm Số Người Dùng
    include('header.php');
    $sql = "SELECT COUNT(id) AS count FROM User WHERE role_id=2";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){?>
        <link rel="stylesheet" href="css/home.css">
        <div class="content">
            <div class="circle">
                <p>Có <?php echo $row['count']?> Người Dùng</p>
            </div>
    <?php } ?>


    <?php
    // Điếm Số Đơn Hàng
    $sql = "SELECT COUNT(id) AS count FROM Orders WHERE status=4";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){?>
        <link rel="stylesheet" href="css/home.css">
            <div class="circle">
                <p>Có <?php echo $row['count'];?> Đơn Hàng Đã Mua</p>
            </div>
    <?php } ?>

    <?php
    // Điếm Số Đơn Hàng
    $sql = "SELECT COUNT(id) AS count FROM Orders WHERE status=0";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){?>
        <link rel="stylesheet" href="css/home.css">
            <div class="circle">
                <p>Có <?php echo $row['count'];?> Đơn Chưa Duyệt</p>
            </div>
    <?php } ?>

    <?php
    // Điếm Số Sản Phẩm
    $sql = "SELECT SUM(total_money) AS total FROM orders WHERE status=4";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){?>
        <link rel="stylesheet" href="css/home.css">
            <div class="circle">
                <a href="doanhthu.php"><p>Doanh thu: <?php echo $row['total'];?> USD</p></a>
            </div>
        </div>
    <?php } ?>
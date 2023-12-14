<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/view-status.css">
</head>
<body>
    <?php
        include('header.php');
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user_id'];
        $customer = mysqli_query($conn, "SELECT orders.*, user.fullname as 'Name' FROM orders JOIN user ON orders.user_id = user.id WHERE user.id= $id");
        ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <div class="container">
        <div class="row">
            <div class="panel-infor">
                <div class="panel-heading">
                    <h1>Đơn hàng</h1>
                </div>
                <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ nhận hàng</th>
                            <th>Tổng tiền</th>                               
                            <th>Ghi chú</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <?php foreach ($customer as $key => $value) { ?>
                    <tbody>

                        <tr>   
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['fullname'] ?></td>
                            <td><?php echo $value['phone_number'] ?></td>
                            <td><?php echo $value['address'] ?></td>
                            <td><?php echo $value['total_money'] ?></td>
                            <td><?php echo $value['note'] ?></td>
                            <td><?php echo $value['order_date'] ?></td>
                            <td>
                                <?php if ($value['status'] == 0) { ?>
                                <span>Chưa Duyệt</span>
                            <?php } else if ($value['status'] == 1) { ?>
                                <span>Huỷ đơn hàng</span>
                            <?php } else if ($value['status'] == 2) { ?>
                                <span>Đã duyệt </span>
                            <?php } else if ($value['status'] == 3) { ?>
                                <span>Đang giao hàng</span>
                            <?php } else if ($value['status'] == 4) { ?>
                                <span>Đã nhận</span>
                            <?php } else if ($value['status'] == 5) { ?>
                                <span>Hoàn đơn hàng</span>
                            <?php } ?>
                            </td>
                        </tr>
                    </tbody>      
                    <?php }
                    } else {
        unset($_SESSION['user_id']);
    }?>    
                </table>      
                </div>
            </div>
        </div>
    </div>
</body>
</html>
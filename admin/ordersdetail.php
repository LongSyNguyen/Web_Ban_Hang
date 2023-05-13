<?php
    include('header.php');
    if(isset($_GET['id'])){
    $id_order = $_GET['id'];
    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE id=$id_order");
    $order = mysqli_fetch_assoc($order_query);
    $user_id = $order['user_id'];
    $user_query = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
    $customer = mysqli_fetch_assoc($user_query);
    }
?>
<?php
    if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $date = $_POST['order_date'];
    $status = $_POST['status'];
    $sql = "UPDATE Orders SET fullname = '$fullname', phone_number = '$phone', address = '$address', note = '$note', 
    status = '$status', order_date ='$date' WHERE id=$id_order";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo"<script>
        alert('Chỉnh sửa thành công!');
        history.go(-1);
        </script>";
    }}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="css/order.css">
<div class="container">
    <div class="row">
        <div class="panel-infor">
            <div class="panel-heading">
                <h1>Thông tin đơn hàng</h1>
            </div>
            <div class="panel-body">
                <p>Tên người nhận:<?php echo $order['fullname']?></p>
                <p>Số điện thoại:<?php echo $order['phone_number']?></p>
                <p>Địa chỉ nhận hàng:<?php echo $order['address']?></p>
                <p>Ghi chú:<?php echo $order['note'] ?></p>
                <p>Ngày đặt hàng:<?php echo $order['order_date'] ?></p>
            </div>
        </div>
        <form action="" method="POST">
            <div class="panel-form">
                <div class="form-gruop">
                    <div class="form-input">
                        <label for="">Tên người nhận</label>
                        <input type="text" name="fullname" value="<?php echo $order['fullname'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="">Số điện thoại</label>
                        <input type="text" pattern="(\+84|0)\d{9,10}" name="phone" value="<?php echo $order['phone_number'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="">Địa chỉ nhận hàng</label>
                        <input type="text" name="address" value="<?php echo $order['address'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="">Ghi chú</label>
                        <input type="text" name="note" value="<?php echo $order['note'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="">Ngày đặt hàng</label>
                        <input type="date" name="order_date" value="<?php echo $order['order_date'] ?>">
                    </div>
                    <div class="form-input">
                        <label for="">Trạng thái</label>
                        <select name=status>
                            <?php if($order['status']==0){ ?>
                                <option value=0 >Chưa duyệt</option>
                                <option value=1 >Huỷ đơn hàng</option>
                                <option value=2 >Đã duyệt</option>
                            <?php }else if($order['status']==1){?>
                                <option value=2 > Đã duyệt </option>
                            <?php }else if($order['status']==2){?>
                                <option value=2 > Đã duyệt</option>
                                <option value=3 > Đang giao hàng</option>
                            <?php }else if($order['status']==3){?>
                                <option value=3 > Đang giao hàng</option>
                                <option value=4 > Đã nhận hàng</option>
                            <?php }else if($order['status']==4){?>
                                <option value=4 > Đã nhận hàng</option>
                                <option value=5 > Hoàn lại hàng</option>
                            <?php }else if($order['status']==5){?>
                                <option value=2 > Đã duyệt hàng</option>
                            <?php } ?>>
                        </select>
                    </div>
                    <div class="form-button">
                        <input type="submit" name="submit" value="Cập nhật">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

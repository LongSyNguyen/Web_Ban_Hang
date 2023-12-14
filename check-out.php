<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/view-check-out.css">
</head>
<body>
    <?php 
    include 'header.php';
    $cart = (isset($_SESSION['cart']))? $_SESSION['cart'] : [];
    if(isset($_SESSION['user'])){

    ?>

    <form method="POST">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                    <h1>Xác nhận thông tin đơn hàng</h1>
                <form role="form">                
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name :</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $_SESSION['fullname']?>" name="fullname" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email :</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['email']?>" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phone :</label>
                        <input type="text" pattern="(\+84|0)\d{9,10}" value="<?php echo $_SESSION['phone_number']?>" name="phone_number"  >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Address :</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $_SESSION['address']?>" name="address" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Note :</label>
                        <textarea id="input" name="note" rows="3" cols="50"></textarea>
                    </div>


                </form>
            </div>
            <div class="col-lg-5">
                        <h1> Thông tin đơn hàng</h1>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>                               
                                    <th>Thành tiền</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_price = 0; ?>                       
                                <?php foreach ($cart as $key => $value):
                                    $total_price = $total_price + ($value['price'] * $value['quantity'])
                                ?>
                                    <tr>   
                                        <td><img src="img/<?php echo $value['thumbnail']?> "alt="" width="100px" ></td>
                                        <td><?php echo $value['title']?></td>
                                        <td><?php echo $value['quantity'] ?></td>
                                        <td><?php echo number_format($value['price'] * $value['quantity'])?></td>
                                        
                                    </tr>
                                <?php endforeach ?>
                                <?php 
                                if(isset($_POST['fullname'])){
                                    $user_id = $_SESSION['user_id'];
                                    $fullname = $_POST['fullname'];
                                    $phone_number = $_POST['phone_number'];
                                    $email = $_POST['email'];
                                    $address = $_POST['address'];
                                    $note = $_POST['note'];
                                    $order_date = date("Y-m-d H:i:s");
                                    $status = 0;
                                    $total_money = $total_price;
                                    $query = mysqli_query($conn,"INSERT INTO orders(user_id,fullname,phone_number,email,address,note,order_date,status,total_money) VALUES 
                                    ('$user_id','$fullname','$phone_number','$email','$address','$note','$order_date','$status','$total_money')");

                                    if($query){
                                        $order_id = mysqli_insert_id($conn);
                                        $_SESSION['order_id'] = $order_id;

                                        echo "<script> 
                                            alert('Bạn đặt hàng thành công');
                                            history.go(-3);
                                        </script> ";
                                        unset($_SESSION['cart']);
                                        foreach($cart as $value){
                                            $t_money = $value['quantity'] * $value['price'];
                                            mysqli_query($conn,"INSERT INTO orderdetails(order_id,product_id,price,quantity,total_money) VALUES
                                            ('$order_id','$value[id]','$value[price]','$value[quantity]','$t_money')");
                                        }
                                        
                                    }
                                }
                                ?>
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td colspan="6" class="text-center bg-info"> <?php echo number_format($total_price) ?>VNĐ</td>
                                </tr>
                            </tbody>
                        </table>      
                    
                        <h3 class="panel-title"><button href="" class="btn btn-info">Check Out</button></h3>              
            </div>
        </div>
    </div>
        </form>
    <?php }else {?>
        <div class="alert alert-danger">
            <strong>Vui lòng đăng nhập để mua hàng</strong> <a href="login.php?action=check-out" title="">Login</a>
        </div>
    <?php } ?>
</body>
</html>
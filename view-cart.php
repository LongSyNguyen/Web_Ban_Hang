<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/view-cart.css">
</head>
<body>
<?php 
    include 'header.php';
    $cart = (isset($_SESSION['cart']))? $_SESSION['cart'] : [];
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_price = 0; ?>                       
                                <?php foreach ($cart as $key => $value):
                                    $total_price += ($value['price'] * $value['quantity'])
                                ?>
                                    <tr>
                                        <td><?php echo $key ++ ?></td>
                                        <td><img src="img/<?php echo $value['thumbnail']?> "alt="" width="100px" ></td>
                                        <td><?php echo $value['title']?></td>
                                        <td>
                                            <form action="cart.php"> 

                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="id" value="<?php echo $value['id']?>">
                                                <input type="text" name="quantity" value="<?php echo $value['quantity']?>">
                                                    <button type="submit">Cập Nhật</button>

                                            </form>
                                        </td>
                                        <td><?php echo $value['price']?></td>
                                        <td><?php echo number_format($value['price'] * $value['quantity'])?></td>
                                        <td><a href="cart.php?id=<?php echo $value['id']?>&action=delete" title="" class="bth-danger">Xóa</a></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td colspan="6" class="text-center bg-info"> <?php echo number_format($total_price) ?>VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a href="check-out.php" class="btn btn-info">Check Out</a></h3>
                    </div>
                    <div class="panel-body dress">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
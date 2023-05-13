<?php
    include('header.php');
	if(isset($_GET['q'])){
		$q = $_GET['q'];
	}else{
		$q = '';
	}
	if(isset($_GET['p'])){
		$p = (int) $_GET['p'];
	}else{
		$p = 1;
	}
	$ppage = 10;
	$start = $ppage*($p-1);
	$paging = "LIMIT $start, $ppage";
	$where = "WHERE id = '$q' OR fullname LIKE '%$q%'";
	$sqltotal = "SELECT * FROM orders $where";
	$result1 = mysqli_query($conn,$sqltotal);
	$total = mysqli_num_rows($result1);
	$totalpage = ceil($total/$ppage);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="css/order.css">
<link rel="stylesheet" href="css/pagin.css">
<div class="contain">
    <div class="row">
        <div class="form-search">
            <form action = '' method = 'GET'>
                Tìm kiếm <input type = text name='q'> 
                <input type = 'submit' value = 'Tìm'>
            </form>
        </div>
        <div class="table-infor">
            <?php
                $orders = mysqli_query($conn, "SELECT * FROM orders $where $paging");
                if ($orders->num_rows > 0) {?>
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên người nhận</th>
                        <th>Địa chỉ người nhận</th>
                        <th>Ghi chú</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $key => $value) { ?>
                        <?php if ($value['status'] == 2||$value['status'] == 3||$value['status'] == 4) { ?>
                            <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['fullname']; ?></td>
                            <td><?php echo $value['address']; ?></td>
                            <td><?php echo $value['note']; ?></td>
                            <td><?php echo $value['order_date']; ?></td>
                            <td><?php echo $value['total_money']; ?></td>
                            <td>
                                <?php if ($value['status'] == 2) { ?>
                                    <span class="browse">Duyệt đơn hàng</span>
                                <?php }else if ($value['status'] == 3) { ?>
                                    <span class="browse">Đang giao hàng</span>
                                <?php }else if ($value['status'] == 4) { ?>
                                    <span class="browse">Đã nhận hàng</span>
                                <?php }?>
                            </td>
                            <td><a href="ordersdetail.php?id=<?php echo $value['id'] ?>" title="Chi tiết đơn hàng"><i class="fa-solid fa-pen-nib"></i></a></td>
                            </tr>
                        <?php }else { ?>
                        <?php }
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php }
            echo "<div class='Pagin'>";
            echo "<div class='pagination'>";
            for($i=1; $i<=$totalpage; $i++){
                if($i==1 OR $i==$totalpage OR (($i>=$p-2) AND ($i<=$p+2))){
                    if($i!=$p){
                        echo"<div>";
                        echo "<a href = '?q=$q&p=$i'> $i </a>";
                        echo "</div>";
                    }else{
                        echo"<div>";
                        echo "<a class='active'> $i</a>";  
                        echo "</div>";
                    }
                }
            }
            echo "</div>";
            echo "</div>";
            ?>
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
	$ppage = 3;
	$start = $ppage*($p-1);
	$paging = "LIMIT $start, $ppage";
	$where = "WHERE id = '$q' OR title LIKE '%$q%'";
	$sqltotal = "SELECT * FROM Product $where";
	$result1 = mysqli_query($conn,$sqltotal);
	$total = mysqli_num_rows($result1);
	$totalpage = ceil($total/$ppage);?>
<div>
<link rel='stylesheet' href='css/showp.css'>
<div class="form-search">
<form action = '' method = 'GET'>
    Tìm kiếm <input type = text name='q'> 
    <input type = 'submit' value = 'Tìm'>
</form>
</div>
<div class="table-product">
<?php
$sql = "SELECT * FROM Product $where $paging";
$result = $conn->query($sql);
$stt=0;
if ($result->num_rows > 0) {
    echo "<table class='show-product' border='1px'>
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Dung Lượng</th>
                <th>Ảnh Sản Phẩm</th>
                <th>Số lượng</th>
                <th></th>
            </tr>";
    foreach ($result as $key => $value) { ?>
                    <tr>
                        <td><?php $stt++;
                        echo $stt ?></td>
                        <td><?php echo $value['title'] ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td><?php echo $value['size']; ?></td>
                        <td><img src="../img/<?php echo $value['thumbnail']; ?>" class="image"></td>
                        <td><?php echo $value['quantity']; ?></td>
                        <td>
                            <button><a href="editp.php?id=<?php echo $value['id'] ?>">Sửa</a></button>
                            <button><a href="deletep.php?id=<?php echo $value['id'] ?>">Xoá</a></button>
                        </td>
                    </tr>
<?php }
}
echo '</table>
</div>
</div>';
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
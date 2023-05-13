<?php include('header.php') ?>
<form action = '' method = 'GET'>
	Tìm kiếm <input type = text name='q' placeholder='tìm kiếm theo title'> 
	<input type = 'submit' value = 'Tìm'>
</form>
<?php
//Bước 1: Kết nối đến CSDL
	include('../connDB.php');
//Bước 2: Tạo truy vấn, thực hiện truy vấn
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
	//Phân trang
	//Số bản ghi trong 1 trang
	$ppage = 8;
	//Trong SQL có câu lệnh LIMIT Bản ghi đầu tiên, Số bản ghi;
	$start = $ppage*($p-1);
	$paging = "LIMIT $start, $ppage";
	$where = "WHERE title LIKE '%$q%' OR short_infor LIKE '%$q%'";
	$sqltotal = "SELECT * FROM news $where";
	$result1 = mysqli_query($conn,$sqltotal);
	$total = mysqli_num_rows($result1);
	$totalpage = ceil($total/$ppage);
	for($i=1; $i<=$totalpage; $i++){
		if($i==1 OR $i==$totalpage OR (($i>=$p-2) AND ($i<=$p+2))){
		$link = "<a href = '?q=$q&p=$i'> $i </a>";
			if($i!=$p){
			echo $link;
			}else{
				echo "[$i]";
			}
		}
		
	}
	$order = "ORDER BY name ASC";
    $sql = "SELECT * FROM news";
    $result = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM news $where $paging";
        $result = mysqli_query($conn, $sql);
        $stt=0;
        echo "<link rel='stylesheet' href='css/shown.css'>
                <table class='show-product' border='1px'>
                    <tr>
                        <th>STT</th>
                        <th>Tilte</th>
                        <th>Thông tin vắn tắt</th>
                        <th>Thông tin</th>
                        <th>Ảnh của thông tin</th>
                        <th></th>
                    </tr>";
        foreach($result as $key => $value){?>
                    <tr>
                        <td><?php $stt++; echo $stt ?></td>
                        <td><?php echo $value['title'] ?></td>
                        <td><?php echo $value['short_infor']; ?></td>
                        <td><div class=a><?php echo $value['long_infor'];?></div></td>
                        <td><img src="../img/<?php echo $value['image']; ?>" class="image"></td>
                        <td>
                            <button><a href="editn.php?id=<?php echo $value['id'] ?>">Sửa</a></button>
                            <button><a href="deleteNews.php?id=<?php echo $value['id'] ?>">Xoá</a></button>
                        </td>
                    </tr>
<?php }
echo'</table>
</div>'
?>

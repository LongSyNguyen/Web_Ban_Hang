<?php include('header.php'); ?>
<form action="" method="GET">
	Tìm kiếm <input type = text name='q'> 
	<input type = 'submit' value = 'Tìm'>
</form>
<?php
        include('connDB.php');
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
        $ppage = 2;
        //Trong SQL có câu lệnh LIMIT Bản ghi đầu tiên, Số bản ghi;
        $start = $ppage*($p-1);
        $paging = "LIMIT $start, $ppage";
        $where = "WHERE id = '$q' OR title LIKE '%$q%' OR image LIKE '%$q%'";
        $sqltotal = "SELECT id, title, short_infor FROM News $where";
        $result1 = mysqli_query($conn,$sqltotal);
        $total = mysqli_num_rows($result1);
        $totalpage = ceil($total/$ppage);
        for($i=1; $i<=$totalpage; $i++){
            if($i==1 OR $i==$totalpage OR (($i>=$p-2) AND ($i<=$p+2))){
            $link = "<a href = '?&p=$i'> $i </a>";
                if($i!=$p){
                echo $link;
                }else{
                    echo "[$i]";
                }
            }}
?>
    <?php
    $sql = "SELECT image, short_infor, title, id FROM News $where $paging";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){?>
        <link rel="stylesheet" href="../css/news.css">
            <div class="news-wrapper">
                <div class="image">
                    <img src="img/<?php echo $row['image'] ?>">
                </div>
                <div class="news-body">
                    <div class="news-body-infor">
                    <a href='shownews.php?id=<?php echo $row['id'] ?>'><?php echo $row['title']?></a>
                        <p><?php echo $row['short_infor'] ?></p>
                    </div>
                </div>
            </div>
    <?php }} ?>
</body>
</html>

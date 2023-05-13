<?php
include('header.php');
$sql="SELECT (MONTH(order_date)) AS month, SUM(total_money) AS total FROM orders WHERE status=4 GROUP BY month ORDER BY month ASC";
$result = mysqli_query($conn,$sql);
foreach($result as $key => $value){
?>
<body>
    <table>
        <tr>
            <th>Thang</th>
            <th>Tong tien</th>
        </tr>
        <tr>
            <td><?php echo $value['month']?></td>
            <td><?php echo $value['total']  ?></td>
        </tr>
    </table>
</body>
<?php }?>
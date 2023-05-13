<link rel='stylesheet' href='css/product.css'>
<?php
include('connDB.php');
include('header.php');
$quantity = 0;
if (isset($_GET['cateID'])) {
    $cateID = $_GET['cateID'];
    $sql = "SELECT title, price, thumbnail, id FROM product WHERE category_id = '$cateID' ";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        echo "<div class='list-product'>";
        while($row = $result->fetch_assoc()){?>
            <div class=product>
                <a href ='product.php?id=<?php echo $row['id'] ?>'>
                <img src='img/<?php echo $row['thumbnail'] ?>'></a><br>
                <a href='product.php?id=<?php echo $row['id'] ?>'><?php echo $row["title"]?></a><br>
                <div class=price>giá:<?php echo $row["price"] ?>
            </div><br>
            </div>
    <?php    }
    }else{
        echo  "0 results";
    }
    echo "</div>";
}else{
    $sql = "SELECT product.*, category.status FROM product, category WHERE product.category_id=category.id";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        echo "<div class='list-product'>";
                while($row = $result->fetch_assoc()){
                    if($row['status']==1){
?>
                        <div class=product>
                            <a href ='product.php?id=<?php echo $row['id'] ?>'>
                            <img src='img/<?php echo $row['thumbnail'] ?>'></a><br>
                            <a href='product.php?id=<?php echo $row['id'] ?>'><?php echo $row["title"]?></a><br>
                            <div class=price>giá:<?php echo $row["price"] ?></div><br>

                        </div>
    <?php    }}
    }else{
        echo  "0 results";
    }
    echo "</div>";
}?>
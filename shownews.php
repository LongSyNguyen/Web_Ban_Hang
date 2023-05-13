<?php
include('connDB.php');
include('header.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql= "SELECT * FROM news WHERE id =$id";
    $result = $conn->query($sql);
    echo "<link rel='stylesheet' href='css/shownews.css'>";
    //in ra title, long_infor, views
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
            <h1><?php echo $row["title"] ?></h1><br>
            <div class=a><p><?php echo $row["long_infor"] ?></p><br></div>
            <img src=img/<?php echo $row["image"] ?>>
            <?php } 
        }
    }?>
    <!-- in ra ảnh trong gallery news -->
<?php
    $sql = "SELECT * FROM newsgallery WHERE news_id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {?>
            <img src='img/<?php echo $row['image'] ?>'>
            <?php }
        }?>

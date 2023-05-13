<?php
include('connDB.php');
include('header.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql= "SELECT * FROM product WHERE id =$id";
    $result = $conn->query($sql);
    echo "<link rel='stylesheet' href='css/product.css'>";
    if ($result->num_rows > 0) {
      $sql_thongke = mysqli_query($conn, "SELECT SUM(quantity) AS sl FROM orderdetails, orders WHERE orders.id=orderdetails.order_id AND orders.status=4 AND product_id=$id");
      $thongke = mysqli_fetch_assoc($sql_thongke);
        while($row = $result->fetch_assoc()) {?>
            <a href=".">Điện thoại di động</a><a href="."> > <?php echo $row["title"] ?><br></a>
            <div style="display:flex;">
            <div class='show_gallery'style="max-width:500px;padding-left:50px;">
              <a href="."><img src='img/<?php echo $row['thumbnail'] ?>'><br></a>
              <a href="."><h1>▶<?php echo $row["title"] ?><br></a></h1>
              <div class=price>giá:<?php echo $row["price"] ?></div>
              <div>Còn lại:<?php $total = $row['quantity'] - $thongke['sl']; echo $total?></div>
              màu : <?php echo $row['color'] ?><br>
              ➤<?php echo $row["description"] ?><br>
              <a href='cart.php?id=<?php echo $id ?>'><button class=buy type='button' name='button'>Buy it now 🛒</button></a><br>
            </div>
       
                <?php } 
            }
        }?>
        <?php 
        $sql = "SELECT * FROM gallery WHERE product_id=$id";
        $result = $conn->query($sql);?>
        <div class=show_gallery style="padding-left:400px;">
          <div class="slideshow-container">
        <?php if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {?>
                <div class="mySlides fade">
                  <img src=img/<?php echo $row['thumbnail']?> style="width:300px">
                </div> 
              <?php }} ?>              
              </div>
                <br>
                
                <div style="text-align:center">
                  <span class="dot"></span> 
                  <span class="dot"></span> 
                  <span class="dot"></span> 
                </div>
              <br>
                <script>
                let slideIndex = 0;
                showSlides();
                
                function showSlides() {
                  let i;
                  let slides = document.getElementsByClassName("mySlides");
                  let dots = document.getElementsByClassName("dot");
                  for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                  }
                  slideIndex++;
                  if (slideIndex > slides.length) {slideIndex = 1}    
                  for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                  }
                  slides[slideIndex-1].style.display = "block";  
                  dots[slideIndex-1].className += " active";
                  setTimeout(showSlides, 3000); // Change image every 3 seconds
                }
                </script>
            </div>
        </div>  
        <?php
              $sql="SELECT * FROM feedback WHERE product_id=$id";
              $result=$conn->query($sql);
              echo "<h2>Bình luận của khách hàng</h2>";
              if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){?>
                <div style="box-shadow: 1px 1px 1px 5px #AAA;">
                  <p><h3><?php echo $row['subject_name'] ?></h3></p>
                  <p><?php echo $row['note'] ?></p>
              <?php
                }
              }?>  
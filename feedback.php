<?php
    include('header.php');  
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $data = "SELECT orderdetails.product_id, product.title FROM orders, orderdetails, product 
    WHERE orders.id = orderdetails.order_id And orders.id = $id AND product.id = orderdetails.product_id;";
    $query = mysqli_query($conn, $data);
    if(isset($_POST['submit'])){
        $product_id = $_POST['selected_id'];
        $note = $_POST['note'];
        $subject_name = $_POST['s_name'];
        $user_id = $_SESSION['user_id'];
        $feedback= mysqli_query($conn,"INSERT INTO feedback (product_id, subject_name, note, user_id) VALUES ('$product_id','$subject_name','$note', '$user_id')");
        if($feedback){
            echo"<script>
            alert('Bình Luận Thành Công');
            history.go(-3);
            </script>";
        }
    }
?>

<form action="" method="POST" >
    <table class="">
        <thead>
            <td><h1>Feedback</h1></td>
        </thead>
        <tr>
            <td><span>Tiêu đề</span></td>
            <td><input required type="text" name="s_name" style="width:463px;" placeholder="Tiêu đề"></td>
        </tr>
        <tr>
            <td><span>Sản Phẩm</span></td>
            <td><select name="selected_id">
                <?php foreach($query as $key =>$value){?>
                <option value="<?php echo $value['product_id']?>"><?php echo $value['title'] ?></option>
                <?php } ?>
            </select></td>
        </tr>
        <tr>
            <td><span>Nội dung</span></td>
            <td>
                <textarea required name="note" id="" cols="60" rows="20"></textarea>
            <td>
        </tr>
        <tfoot>
            <td><input required type="submit" name="submit" value="Nhập"></td>
        </tfoot>
        

    </table>
</form>
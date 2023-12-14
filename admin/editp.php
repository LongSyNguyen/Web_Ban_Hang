<?php
    include('header.php');
    // Data product dạng object sử dụng hàm mysqli_fetch_assoc() về dạng mảng
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $product = mysqli_query($conn,"SELECT * FROM product WHERE id=$id");
        $data = mysqli_fetch_assoc($product);
        // lấy ra ảnh mô tả từ bảng product
        $gallery = mysqli_query($conn,"SELECT * FROM Gallery WHERE product_id=$id");
        //NẾu không có $id nào sẽ cho chạy về trang showp
        if(mysqli_num_rows($product) < 1 ){
                header('location:showp.php');
        }
    }
?>
<!-- Sửa sản phẩm -->
<?php
    include('../connDB.php');
    if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $price = $_POST['price'];
    $thumbnail = $_FILES['image'];
    $description = $_POST['description'];
    $updated_at = date("Y-m-d H:i:s");
    $category_id = $_POST['idCate'];
    $quantity = $_POST['quantity'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    if(isset($_FILES['image'])){
        $file = $_FILES['image'];
        $file_name = $file['name'];
        // Trường hợp người dùng không chọn ảnh
        if(empty($file_name)){
            // Khi đó biến $file_name = $data['image']
            $file_name =  $data['thumbnail'];
        }
        // Trường hợp người dùng chọn ảnh
        else{
            //insert ảnh
            if($file['type']!='image/png' && $file['type']!='image/jpg' && $file['type']!='image/jpeg'){
                echo "<script>
                alert('Lỗi định dạng file ảnh');
                history.go(-1);
                </script>";
                return false;
            }else{
                // var_dump($file['type']);
                // die();
                move_uploaded_file($file['tmp_name'], '../img/'.$file_name);
            }
        }
    }
    // echo"<pre>";
    // print_r($_FILES);
    // thêm ảnh mô tả của sản phẩm có id = $id
    if(isset($_FILES['images'])){
        $files = $_FILES['images'];
        $file_names = $files['name'];
        // // kiểm tra đuôi file ảnh
        // echo "<pre>";
        // print_r($_FILES['images']);
        // die();
        if(!empty($file_names[0])){
            mysqli_query($conn,"DELETE FROM Gallery WHERE product_id=$id");
            move_uploaded_file($file['tmp_name'], '../img/'.$file_name);
            foreach($file_names as $key => $value){
                mysqli_query($conn, "INSERT INTO Gallery(product_id, thumbnail) VALUES('$id', '$value')");
            }
        }
    } 
    // die();
    // insert cơ sở dữ liệu từ bảng product
    $sql = "UPDATE Product SET title = '$title', price = '$price', size = '$size', color = '$color', 
    quantity = '$quantity', category_id = '$category_id', thumbnail = '$file_name', description = '$description', updated_at = '$updated_at' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if($result){
        header('location: showp.php');
    }}
?>
<link rel="stylesheet" href="css/editp.css">
<div class="product">
<form action="" method="POST" enctype = "multipart/form-data">
    <table class="add-product">
        <thead>
            <td><h1>Sửa sản phẩm</h1></td>
        </thead>
        <tfoot>
            <td><input class="form-submit" type="submit" name="submit" value="Nhập"></td>
        </tfoot>
        <tbody>
            <tr>
                <td>
                    <label for="">Tên sản phẩm</label>
                    <input required class="form-input" type="text" name="title" value="<?php echo $data['title']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Giá </label>
                    <input required class="form-input" type="number" name="price" placeholder="USD" value="<?php echo $data['price']?>">
                </td>
            </tr>
            <tr>
                <td>
                <label for="">Danh mục</label>
                    <select name="idCate">
                    <option selected>Choose...</option>
                        <?php foreach($category as $key => $value) {?>
                            <option value="<?php echo $value['id'] ?>"<?php echo (($value['id']==$data['category_id'])? 'selected':'') ?> >
                                <?php echo $value['name']; ?>
                            </option>
                        <?php }; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Dung lượng</label>
                    <input required class="form-input" type="text" name="size" value="<?php echo $data['size']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Màu</label>
                    <input required class="form-input" type="text" name="color" value="<?php echo $data['color']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Ảnh sản phẩm</label>
                    <input  class="form-input" type="file" name="image"><br>
                    <img src="../img/<?php echo $data['thumbnail']?>" alt="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Ảnh mô tả</label>
                    <input multiple class="form-input" type="file" name="images[]">
                    <div class="images">
                        <?php  foreach($gallery as $key =>$value){?>
                            <img src="../img/<?php echo $value['thumbnail']?>">
                        <?php }?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Số lượng</label>
                    <input required class="form-input" type="number" name="quantity" value="<?php echo $data['quantity']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Mô tả</label>
                    <textarea name="description" rows="10" cols="100%"><?php echo $data['description'];?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
</form>
</div>
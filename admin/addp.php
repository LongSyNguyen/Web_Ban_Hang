<?php
    include('header.php');
    $category = mysqli_query($conn,"SELECT * FROM category WHERE name NOT IN ('News') ");
?>
<!-- Thêm Sản Phẩm -->
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $created_at = date("Y-m-d H:i:s");
    $category_id = $_POST['idCate'];
    $quantity = $_POST['quantity'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    // thêm ảnh của sản phẩm
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        if ($file['type'] == 'image/png' || $file['type'] == 'image/jpg' || $file['type'] == 'image/jpeg'||$file['type'] == 'image/webp') {
            move_uploaded_file($file['tmp_name'], '../img/' . $file_name);
        }else{
            echo "<script>
                    alert('Lối địng dạng file ảnh')
                </script>";
            return false;
        }
    }
    // thêm ảnh mô tả của sản phẩm có id = $id
    if (isset($_FILES['images'])) {
        $files = $_FILES['images'];
        $file_names = $files['name'];
        // kiểm tra đuôi file ảnh
        // var_dump($file_names);
        // die();
        foreach ($file_names as $key => $value) {
            move_uploaded_file($files['tmp_name'][$key], '../img/' . $value);
        }
    }
    if(!empty($color)&&!empty($title)&&!empty($price)&&!empty($quantity)&&!empty($category_id)&&!empty($file_name)&&!empty($file_names)&&!empty($description)){
        $sql = "INSERT INTO Product(title, price, size, color, quantity, category_id, thumbnail, description, created_at) 
        VALUES('$title', '$price','$size','$color','$quantity', '$category_id', '$file_name', '$description', '$created_at')";
        $result = mysqli_query($conn, $sql);
        // Khi mỗi lần  truy vấn thành công thì nó trả về id của bản ghi đó
        $product_id = mysqli_insert_id($conn);
        // var_dump($id_product);
        // die();
        foreach ($file_names as $key => $value) {
            mysqli_query($conn, "INSERT INTO Gallery(product_id, thumbnail) VALUES('$product_id', '$value')");
        }
        if($result){
            header('location: showp.php');
        }
    }
    // echo"<pre>";
    // print_r($_FILES);
    // die();
    // die();
    // insert cơ sở dữ liệu từ bảng product
}
?>
<link rel="stylesheet" href="css/adproduct.css">
<div class="product">
<form action="" method="POST" enctype = "multipart/form-data">
    <table class="add-product">
        <thead>
            <td><h1>Thêm Sản Phẩm</h1></td>
        </thead>
        <tfoot>
            <td><input type="submit" required name="submit" value="Nhập"></td>
        </tfoot>
        <tbody>
            <tr>
                <td>Tên Sản Phẩm</td>
                <td><input type="text" required name="title"></td>
            </tr>
            <tr>
                <td>Giá</td>
                <td><input type="number" required name="price" placeholder="USD"></td>
            </tr>
            <tr>
                <td>Hãng</td>
                <td>
                    <select name="idCate">
                    <option selected>Choose...</option>
                        <?php foreach($category as $key => $value) {?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                        <?php }; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Dung Lượng</td>
                <td><input type="text" required name="size"></td>
            </tr>
            <tr>
                <td>Màu</td>
                <td><input type="text" required name="color"></td>
            </tr>
            <tr>
                <td>Ảnh</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td>Ảnh Mô Tả</td>
                <td><input type="file" name="images[]" multiple="multiple"></td>
            </tr>
            <tr>
                <td>Số Lượng</td>
                <td><input type="text" required name="quantity"></td>
            </tr>
            <tr>
                <td>Mô Tả Sản Phẩm</td>
                <td><input type="text" required name="description"></td>
            </tr>
        </tbody>
    </table>
</form>
</div>
 

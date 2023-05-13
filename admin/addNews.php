<?php
    include('header.php');
    include('../connDB.php');
    $category = mysqli_query($conn,'SELECT id, name FROM category LIMIT 6');
?>
<link rel="stylesheet" href="css/adproduct.css">
<div class="product">
<form action="" method="POST" enctype = "multipart/form-data">
    <table class="add-product">
        <thead>
            <td><h1>Thêm Tin Tức</h1></td>
        </thead>
        <tfoot>
            <td><input type="submit" name="submit" value="Nhập"></td>
        </tfoot>
        <tbody>
            <tr>
                <td>Title</td>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td>Thông tin vắn tắt</td>
                <td><input type="text" name="short_infor"></td>
            </tr>
            <tr>
                <td>Thông tin </td>
                <td><input type="text" name="long_infor"></td>
            </tr>
            <tr>
                <td>Ngày tạo</td>
                <td><input type="date" name="created_at"></td>
            </tr>
            <tr>
                <td>Ảnh</td>
                <td><input type="file" name="image"></td>
            </tr>
        </tbody>
    </table>
</form>
</div>
<!-- Thêm Sản Phẩm -->
<?php
    include('../connDB.php');
    if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $short_infor = $_POST['short_infor'];
    $long_infor = $_POST['long_infor'];
    $image = $_FILES['image'];
    $created_at = date("Y-m-d H:i:s");
    if(isset($_FILES['image'])){
        $file = $_FILES['image'];
        $file_name = $file['name'];
        move_uploaded_file($file['tmp_name'], '../img/'.$file_name);
    }
    if ($title=="" || $short_infor=="" || $long_infor=="" || $created_at==""){
        $message = "vui lòng nhập đủ thông tin";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
    $sql = "INSERT INTO news (title, image, short_infor, long_infor, created_at)
    VALUES ('$title', '$file_name', '$short_infor', '$long_infor', '$created_at')";
    $result = mysqli_query($conn, $sql);	
    }}
?>
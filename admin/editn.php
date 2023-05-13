<?php
    include('header.php');
    // Data news dạng object sử dụng hàm mysqli_fetch_assoc() về dạng mảng
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $news = mysqli_query($conn,"SELECT * FROM news WHERE id=$id");
        $data = mysqli_fetch_assoc($news);
        // lấy ra ảnh mô tả từ bảng 
        $gallery = mysqli_query($conn,"SELECT * FROM newsgallery WHERE news_id=$id");
        //NẾu không có $id nào sẽ cho chạy về trang shown
        if(mysqli_num_rows($news) < 1 ){
                header('location:shown.php');
        }
    }
?>
<!-- Sửa tin tức -->
<?php
    include('../connDB.php');
    if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $short_infor = $_POST['short_infor'];
    $long_infor = $_POST['long_infor'];
    $image = $_FILES['image'];
    $updated_at = date("Y-m-d H:i:s");
    if(isset($_FILES['image'])){
        $file = $_FILES['image'];
        $file_name = $file['name'];
        // Trường hợp người dùng không chọn ảnh
        if(empty($file_name)){
            // Khi đó biến $file_name = $data['image']
            $file_name =  $data['image'];
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
            mysqli_query($conn,"DELETE FROM newsgallery WHERE news_id=$id");
            move_uploaded_file($file['tmp_name'], '../img/'.$file_name);
            foreach($file_names as $key => $value){
                mysqli_query($conn, "INSERT INTO newsgallery(news_id, image) VALUES('$id', '$value')");
            }
        }
    } 
    // die();
    // insert cơ sở dữ liệu từ bảng product
    $sql = "UPDATE news SET title = '$title', short_infor = '$short_infor', long_infor = '$long_infor',
             image = '$file_name', updated_at = '$updated_at' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    // Khi mỗi lần  truy vấn thành công thì nó trả về id của bản ghi đó
    // $product_id = mysqli_insert_id($conn);
    // var_dump($id_product);
    // die();
    if($result){
        header('location: shown.php');
    }}
?>
<link rel="stylesheet" href="css/editp.css">
<div class="product">
<form action="" method="POST" enctype = "multipart/form-data">
    <table class="add-product">
        <thead>
            <td><h1>Sửa Tin Tức</h1></td>
        </thead>
        <tfoot>
            <td><input class="form-submit" type="submit" name="submit" value="Nhập"></td>
        </tfoot>
        <tbody>
            <tr>
                <td>
                    <label for="">Title</label>
                    <input required class="form-input" type="text" name="title" value="<?php echo $data['title']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Ảnh Chính</label>
                    <input  class="form-input" type="file" name="image"><br>
                    <img src="../img/<?php echo $data['image']?>" alt="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Ảnh Gallery</label>
                    <input multiple class="form-input" type="file" name="images[]">
                    <div class="images">
                        <?php  foreach($gallery as $key =>$value){?>
                            <img src="../img/<?php echo $value['image']?>">
                        <?php }?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Thông Tin</label>
                    <input required class="form-input" type="text" name="long_infor" value="<?php echo $data['long_infor']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Thông Tin Vắn Tắt</label>
                    <input required class="form-input" type="text" name="short_infor" value="<?php echo $data['short_infor']?>">
                </td>
            </tr>
        </tbody>
    </table>
</form>
</div>
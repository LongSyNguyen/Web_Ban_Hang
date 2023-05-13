<?php
include('header.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $data = mysqli_query($conn,"SELECT * FROM category WHERE id=$id");
    // var_dump($data);
    $cate = mysqli_fetch_assoc($data);
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $status = $_POST['status'];
    $query = mysqli_query($conn,"UPDATE category SET name='$name', status='$status' WHERE id=$id");
    if($query){
        header('location:category.php');
    }else{
        
    }
}
?>
<div class="insert-cate">
    <div class="title-cate">
        <h1>Sửa Danh Mục</h1>
    </div>
    <form action="" method="POST">
        <div class="form-group">
            <div class="form-input">
                <label for="">Tên Danh Mục</label>
                <input type="text" name="name" value="<?php echo $cate['name']?>" required>
            </div>
            <div class="form-input">
                <label for="">Trạng Thái</label>
                <input type="radio" name="status" value="1" <?php echo(($cate['status']==1)?'checked':'') ?>>
                <label for="javascript">Hiện</label>
                <input type="radio" name="status" value="0" <?php echo(($cate['status']==0)?'checked':'') ?>>
                <label for="javascript">Ẩn</label>
            </div>
            <div class="form-button">
                <input type="submit" name="submit">
            </div>
        </div>
    </form>
</div>
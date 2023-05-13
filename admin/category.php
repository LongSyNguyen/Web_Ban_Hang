<?php 
include('../connDB.php');
include('header.php');

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $status = $_POST["status"];
    $query = mysqli_query($conn, "INSERT INTO category(name, status) VALUES('$name', '$status')");
    if($query){
        echo" <script>
        alert('Bạn đã thêm thành công')
        </script>";
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="css/category.css">
<body>
    <div class="category">
        <div class="body_cate">
        <form action="" method="POST">
            <div class="insert-cate">
                <div class="title-cate">
                    <h1>Thêm Danh Mục</h1>
                </div>
                <div class="form-group">
                    <div class="form-input">
                        <label for="">Tên Danh Mục</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-input">
                    <label for="">Trạng Thái</label>
                    <input type="radio" name="status" value="1">
                    <label for="javascript">Hiện</label>
                    <input type="radio" name="status" value="0">
                    <label for="javascript">Ẩn</label>
                    </div>
                    <div class="form-button">
                        <input type="submit" name="submit">
                    </div>
                </div>
            </div>
        </form>
        <div class="show-cate">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Danh Mục</th>
                        <th>Trạng Thái</th>
                        <th>Chỉnh Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt=0; foreach($category as $key => $value):?>
                        <tr>
                            <td><?php $stt++; echo $stt ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <?php if($value['status'] == 1) {?>
                                <td>Hiện</td>
                            <?php }else{?>
                                <td>Ẩn</td>
                            <?php } ?>
                            <td><a href="editCate.php?id=<?php echo $value['id']?>" title="Sửa"><i class="fa-solid fa-pen-nib"></i></a></td>
                            <td><a href="deleteCate.php?id=<?php echo $value['id'] ?>" title="Xoá"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</body>

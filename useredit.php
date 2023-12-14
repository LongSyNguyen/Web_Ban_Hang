<!-- Sửa thông tin người dùng -->
<?php
include('header.php');
include('connDB.php');
if(!isset($_SESSION['pwd'])){
    header('location:userInfor.php');
}else{
    $id = $_SESSION['user_id'];
    // Data product dạng object sử dụng hàm mysqli_fetch_assoc() về dạng mảng
    $datap = mysqli_query($conn, "SELECT * FROM user WHERE id= $id");
    $user = mysqli_fetch_array($datap);
?>
<link rel="stylesheet" href="css/adproduct.css">
<div class="product">
<form action="" name="formReg" method="POST">
    <table class="add-product">
        <thead>
            <td><h1>Sửa Thông Tin</h1></td>
        </thead>
        <tfoot>
            <td><input type="submit" name="submit" value="Nhập" onclick="return check()"></td>
        </tfoot>
        <tbody>
            <tr>
                <td>Full name</td>
                <td><input type="text" name="fullname" value="<?php echo $user['fullname']?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $user['email']?>"></td>
            </tr>
            <tr>
                <td>Phone Number </td>
                <td><input type="text" name="phone_number" value="<?php echo $user['phone_number']?>"></td>
            </tr>
            <tr>
                <td>address </td>
                <td><input type="text" name="address" value="<?php echo $user['address']?>"></td>
            </tr>
            <tr>
                <td>Mật Khẩu Mới</td>
                <td><input type="password" name="newpwd"></td>
            </tr>
        </tbody>
    </table>
</form>
</div>
<script>
    function check() {
        var email = document.formReg.email.value.trim();
        var fullname = document.formReg.fullname.value.trim();
        var newpwd = document.formReg.newpwd.value.trim();
        var pNumber = document.formReg.phone_number.value.trim();
        var address = document.formReg.address.value.trim();

        if (email === "" || fullname === "" || pNumber === "" || address === "" || newpwd === "") {
            alert("Không được bỏ trống");
            return false;
        } 

        return true;
    }
</script>

<?php
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $password = substr(md5(md5($_POST['newpwd'])), 5, 10);
    $updated_at = date("Y-m-d H:i:s");
    $sql = "UPDATE User SET fullname='$fullname', email='$email',phone_number='$phone_number',
                        address='$address',password='$password',updated_at='$updated_at' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
                echo "<script>
            alret('Thành công')
            </script>";
    } else {
        echo "<script>
            alret('Không Thành công')
            </script>";
    }
}
}
?>
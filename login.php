<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Đăng Nhập</title>
</head>
<body>
    <div class="wrapper">
        <form action="" id="form-login" method="POST">
            <h1 class="form-header">Đăng nhập</h1>
            <div class="form-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="text" class="form-input" placeholder="Tên email đăng nhập" name="email" required>
            </div>
            <div class="form-group">
                <i class="fa-solid fa-key"></i>
                <input type="password" class="form-input" placeholder="Mật khẩu" name="pwd" required>
                <div id="eye">
                    <i class="fa-solid fa-eye"></i>
                </div>
            </div>
            <input type="submit" name="submit" class="form-submit" value="Đăng nhập">
            <div class="signup">
                <a  href="signup.php">Đăng ký</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
<?php
    session_start();
	include('connDB.php');
    if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$pwd = substr(md5(md5($_POST['pwd'])),5,10);
		$sql = "SELECT  user.*, role.name FROM User, Role WHERE email = '$email' AND password = '$pwd' AND User.Role_id = Role.id";
		$result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            if($row['name']=='User'){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user'] = $row['name'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone_number'] = $row['phone_number'];
                $_SESSION['address'] = $row['address'];
                header('location:home.php');
            }else if($row['name']=='Admin'){
                $_SESSION['admin'] = $row['name'];
                header('location: admin/home-admin.php');
            }
		}}
?>

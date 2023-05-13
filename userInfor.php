 <?php 
include("header.php"); 
include("connDB.php");
if(isset($_SESSION['user'])){
    $email = $_SESSION['email'];
    $sql="SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
            <?php 
                $_SESSION['fullname']=$row['fullname'];
                $_SESSION['phone_number']=$row['phone_number'];
                $_SESSION['address']=$row['address']
            ?>
            Full name: <?php echo $row['fullname'] ?><br>
            Email: <?php echo $row['email'] ?><br>
            PhoneNumber : <?php echo $row['phone_number'] ?><br>
            Địa Chỉ: <?php echo $row['address'] ?>
            <p>Vui lòng điền đúng mật khẩu để đổi thông tin</p>
            <?php 
            if(isset($_POST['button'])){
                $pwd = substr(md5(md5($_POST['pwd'])), 5, 10);
                if($pwd==$row['password']){
                    $_SESSION['pwd'] = $pwd;
                    header('location:useredit.php');
                }
            }
            ?>
            <form action="" method="POST">
                Password:<input type="password" name="pwd">
                <button name="button">Gửi</button>
            </form>
        <?php }
        }
    }
?>
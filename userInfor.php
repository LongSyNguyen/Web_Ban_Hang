<?php 
include("header.php"); 
include("connDB.php");

if(isset($_SESSION['user'])){
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['address'] = $row['address'];

            echo "Full name: " . $row['fullname'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
            echo "PhoneNumber: " . $row['phone_number'] . "<br>";
            echo "Địa Chỉ: " . $row['address'] . "<br>";

            if(isset($_POST['button'])) {
                $pwd = $_POST['pwd'];
                if( $pwd == $row['password']) {
                    $_SESSION['pwd'] = $pwd;
                    header('location:useredit.php');
                } else {
                    echo "<p style='color: red;'>Mật khẩu không đúng. Vui lòng thử lại.</p>";
                }
            }
?>
            <form action="" method="POST">
                Password: <input type="password" name="pwd">
                <button name="button">Gửi</button>
            </form>
<?php 
        }
    }
}
?>

<?php 
session_start(); 
include "connDB.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['email']) && isset($_POST['re_password']) &&isset($_POST['phone']) && isset($_POST['address']) ) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	$email = validate($_POST['email']);
	$re_pass = validate($_POST['re_password']);
	$phone = validate($_POST['phone']);
	$address = validate($_POST['address']);
	$created_at = date("Y-m-d H:i:s");

	$user_data = 'email='. $email. '&uname='. $uname;

	if(empty($email)){
        header("Location: signup.php?error=Email is required&$user_data");
	    exit();
	}else if (empty($uname)) {
		header("Location: signup.php?error=FullName is required&$user_data");
	    exit();
	}else if(empty($phone)){
        header("Location: signup.php?error=Phone is required&$user_data");
	    exit();
	}else if(empty($address)){
        header("Location: signup.php?error=Address is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}else if(empty($re_pass)){
        header("Location: signup.php?error=Re Password is required&$user_data");
	    exit();
	}else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = substr(md5(md5($pass)),5,10);
	    $sql = "SELECT * FROM user WHERE email='$email' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The email is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO user(fullname, password, email, address, phone_number, role_id, created_at) VALUES('$uname', '$pass', '$email', '$address', '$phone', '2', '$created_at')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: signup.php?success=Your account has been created successfully <a style='text-decoration: none; color:black;' href='login.php'>Login</a>");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}?>
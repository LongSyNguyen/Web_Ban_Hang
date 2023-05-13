<?php
//Bước 1: Kết nối đến CSDL
	$server = "localhost";//127.0.0.1; IP
	$username = "root";
	$password = "";
	$db = "mysql";
	$conn = mysqli_connect($server, $username, $password, $db); //,$dbname
	if(!$conn){
		die("Kết nối không thành công: ".mysqli_connect_error());
	}else{
    }
?>
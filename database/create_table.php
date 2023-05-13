<?php
	$server = "localhost";//127.0.0.1; IP
	$username = "root";
	$password = "";
	$db = "QuanLyBanHang";
	$conn = mysqli_connect($server, $username, $password, $db);
	if(!$conn){
		die("Kết nối không thành công: ".mysqli_connect_error());
	}
	echo "Kết nối thành công";

	//BẢNG PHÂN QUYỀN

	$sql = "CREATE TABLE IF NOT EXISTS Role(id int PRIMARY KEY auto_increment,name varchar(20) NOT NULL)";
	if(mysqli_query($conn,$sql)){
		echo "<br> kết nối thành công";
	}else{
		echo "có lỗi xảy ra".mysqli_error($conn);
	}
	
	//BẢNG NGƯỜI DÙNG
	
	$sql = "CREATE TABLE IF NOT EXISTS User(id int PRIMARY KEY auto_increment,fullname varchar(100) NOT NULL,email varchar(100) NOT NULL,
												phone_number varchar(20) NOT NULL,address varchar(500) NOT NULL,
												password varchar(20) NOT NULL,role_id int NOT NULL,created_at DATE NOT NULL,
												updated_at DATE NOT NULL)";
	if(mysqli_query($conn, $sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG DANH MỤC
	
	$sql = "CREATE TABLE IF NOT EXISTS Category(id int PRIMARY KEY auto_increment,  name varchar(20) NOT NULL, status int NOT NULL)";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG SẢN PHẨM

	$sql = "CREATE TABLE IF NOT EXISTS  Product(id int PRIMARY KEY auto_increment, title varchar(20) NOT NULL,
													price int NOT NULL, category_id int NOT NULL, quantity int NOT NULL, thumbnail varchar(500) NOT NULL,
													description longtext NOT NULL, size varchar(20), color varchar(20), created_at DATE NOT NULL,
													updated_at DATE NOT NULL)";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG LƯU ẢNH SẢN PHẨM

	$sql = "CREATE TABLE IF NOT EXISTS Gallery(id int PRIMARY KEY auto_increment, product_id int NOT NULL, thumbnail varchar(500) NOT NULL)";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG FEEDBACK 

	$sql = "CREATE TABLE IF NOT EXISTS Feedback(id int PRIMARY KEY auto_increment, product_id int NOT NULL,
										subject_name varchar(100) NOT NULL, note varchar(500) NOT NULL, user_id int NOT NULL)";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG ORDER

	$sql = "CREATE TABLE IF NOT EXISTS Orders(id int PRIMARY KEY auto_increment, user_id int NOT NULL, fullname varchar(100) NOT NULL,
													phone_number varchar(20) NOT NULL,email varchar(100) NOT NULL, address varchar(500) NOT NULL,
													note varchar(300) NOT NULL,order_date DATE NOT NULL, status int NOT NULL, total_money int NOT NULL)";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG GIỎ HÀNG

	$sql = "CREATE TABLE IF NOT EXISTS  OrderDetails(id int PRIMARY KEY auto_increment,  order_id int NOT NULL, product_id int NOT NULL,
														price int NOT NULL, quantity int NOT NULL, total_money int NOT NULL)";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG TIN TỨC
	$sql = "CREATE TABLE IF NOT EXISTS News(id int PRIMARY KEY auto_increment, title varchar(300) NOT NULL, image varchar(100) NOT NULL, 
											short_infor varchar(1000) NOT NULL, long_infor longtext NOT NULL, 
											created_at DATE NOT NULL, updated_at DATE NOT NULL )";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}

	//BẢNG ẢNH TIN TỨC

	$sql = "CREATE TABLE IF NOT EXISTS newsgallery(id int PRIMARY KEY auto_increment, news_id INT NOT NULL, image varchar(100) NOT NULL)";
	if(mysqli_query($conn,$sql)){
	echo "<br> kết nối thành công";
	}else{
	echo "có lỗi xảy ra".mysqli_error($conn);
	}
?>
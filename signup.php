<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
          <label>Email</label>
          <?php if (isset($_GET['email'])) { ?>
               <input type="email" 
                      name="email" 
                      placeholder="Email"
                      value="<?php echo $_GET['email']; ?>"><br>
          <?php }else{ ?>
               <input type="email" 
                      name="email" 
                      placeholder="Email"><br>
          <?php }?>

          <label>FullName</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="FullName"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="FullName"><br>
          <?php }?>

          <label>Phone Number</label>
          <?php if (isset($_GET['phone'])) { ?>
               <input type="text" 
                      name="phone" 
                      placeholder="Phone"
                      value="<?php echo $_GET['phone']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="phone" 
                      placeholder="Phone"><br>
          <?php }?>

          <label>Address</label>
          <?php if (isset($_GET['address'])) { ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address"
                      value="<?php echo $_GET['address']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address"><br>
          <?php }?>


     	<label>Password</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"><br>

          <label>Re Password</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Re_Password"><br>

     	<button type="submit">Sign Up</button>
     </form>
</body>
</html>
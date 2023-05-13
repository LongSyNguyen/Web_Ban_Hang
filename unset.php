<?php
session_start();
if(isset($_SESSION["user"])){
    unset($_SESSION["user"]);
    header("Location:home.php");
}
else if(isset($_SESSION['admin'])){
    unset($_SESSION["admin"]);
    header("Location:home.php");
}
?>
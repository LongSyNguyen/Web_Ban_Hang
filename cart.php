<?php
session_start();
include('connDB.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';
$quantity= (isset($_GET['quantity'])) ? $_GET['quantity'] : 1;

if($quantity <=0){
    $quantity = 1;
}
$query = mysqli_query($conn, "SELECT * FROM product WHERE id = $id");
if($query){
    $product = mysqli_fetch_assoc($query);
}
$item = [
    'id'=>$product['id'],
    'title'=>$product['title'],
    'thumbnail'=>$product['thumbnail'],
    'price'=>$product['price'],
    'quantity'=> 1
];

if($action == 'update'){
    $_SESSION['cart'][$id]['quantity'] = $quantity;
}
if($action == 'add'){
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity'] +=1 ;
    }
    else{
    $_SESSION['cart'][$id]=$item ;
    }
}

if($action == 'delete'){
    unset($_SESSION['cart'][$id]);
}
header('location: view-cart.php');
?>
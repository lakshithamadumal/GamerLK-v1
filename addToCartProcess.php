<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
if(isset($_GET["id"])){

    $pid = $_GET["id"];
    $umail = $_SESSION["u"]["email"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `users_email`='".$umail."'");
    $cart_num = $cart_rs->num_rows;

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    

    if($cart_num == 1){
        $cart_data = $cart_rs->fetch_assoc();

        
    }else if(true){

        Database::iud("INSERT INTO `cart`(`product_id`,`users_email`) VALUES ('".$pid."','".$umail."')");
        echo ("New Game added to the Cart");

    }else{
        echo ("Already added");
    }

    
    

    
    

}else{
    echo ("Something Went Wrong");
}
}else{
    echo ("Please Log In or Sign Up");
}

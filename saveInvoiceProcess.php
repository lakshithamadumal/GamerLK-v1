<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

   
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`status`,`product_id`,`users_email`) VALUES 
    ('".$order_id."','".$date."','".$amount."','0','".$pid."','".$mail."')");

    echo ("1");

}

?>
<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $pid = $_GET["id"];
    $umail = $_SESSION["u"]["email"];

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $item = $product_data["title"];
    $amount = (int)$product_data["price"];

    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];
    $merchant_id = "1224279"; // Replace with your actual merchant ID
    $merchant_secret = "NDA5MjU3ODMzMjM1MTMzNjc1MDEyNTY2MzY4MjY5MTcwMzQzNzI1MQ=="; // Replace with your actual merchant secret
    $currency = "LKR";

    $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );

    $array = [
        "id" => $order_id,
        "item" => $item,
        "amount" => $amount,
        "fname" => $fname,
        "lname" => $lname,
        "mobile" => $mobile,
        "umail" => $umail,
        "address" => "", // Empty as no physical delivery
        "city" => "", // Empty as no physical delivery
        "hash" => $hash,
        "currency" => $currency
    ];

    echo json_encode($array);

} else {
    echo json_encode(["error" => "User not logged in"]);
}
?>

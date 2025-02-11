<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];

$stockList = array();

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {
    //From Cart
    $rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='".$user["id"]."'");
    $num = $rs->num_rows;

    for ($i=0; $i < $num; $i++) { 
        $d = $rs->fetch_assoc();
        $stockList[] = $d["product_id"];
    }
} else {
    //From Buy Now
    $stockList[] = $_POST["stockId"];
}

$merchantId = "1224279";
$merchantSecret = "NDA5MjU3ODMzMjM1MTMzNjc1MDEyNTY2MzY4MjY5MTcwMzQzNzI1MQ==";
$items = "";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($i=0; $i < sizeof($stockList); $i++) { 
    $rs2 = Database::search("SELECT * FROM `product` WHERE `id`='" . $stockList[$i] . "'");
    $d2 = $rs2->fetch_assoc();
    
    $items .= $d2["name"];
    $netTotal += intval($d2["price"]);
}

// Delivery Fee
$netTotal += 500;

$hash = strtoupper(
    md5(
        $merchantId . 
        $orderId . 
        number_format($netTotal, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchantSecret)) 
    ) 
);

$payment = array();
$payment["sandbox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["fname"];
$payment["last_name"] = $user["lname"];
$payment["email"] = $user["email"];
$payment["phone"] = $user["mobile"];
$payment["address"] = $user["no"].",".$user["line_1"];
$payment["city"] = $user["line_2"];
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);

?>

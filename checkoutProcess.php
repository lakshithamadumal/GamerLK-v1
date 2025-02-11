<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];

if (isset($_POST["payment"])) {

    $payment = json_decode($_POST["payment"], true);

    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Colombo"));
    $time = $date->format("Y-m-d H-i-s");

    Database::iud("INSERT INTO `order_history`(`order_id`,`order_date`,`amount`,`user_id`) 
    VALUES('" . $payment["order_id"] . "','" . $time . "','" . $payment["amount"] . "','" . $user["id"] . "')");

    $orderHistoryId = Database::$connection->insert_id;

    // Log order history ID
    error_log("Order History ID (checkout): " . $orderHistoryId);

    $rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='" . $user["id"] . "'");
    $num = $rs->num_rows;


    Database::iud("DELETE FROM `cart` WHERE `user_id`='" . $user["id"] . "'");
   
    $order = array();
    $order["resp"] = "Success";
    $order["order_id"] = $orderHistoryId;

    echo json_encode($order);
}
?>

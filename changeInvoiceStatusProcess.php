<?php
require "connection.php";

if(isset($_GET["id"])){
    $invoice_id = $_GET["id"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='".$invoice_id."'");
    $invoice_data = $invoice_rs->fetch_assoc();

    $status_id = $invoice_data["status"];
    $new_status = 0;

    if($status_id == 0){
        Database::iud("UPDATE `invoice` SET `status`='1' WHERE `id`='".$invoice_id."'");
        $new_status = 1;
    }else if($status_id == 1){
        Database::iud("UPDATE `invoice` SET `status`='2' WHERE `id`='".$invoice_id."'");
        $new_status = 2;
    }else if($status_id == 2){
        Database::iud("UPDATE `invoice` SET `status`='3' WHERE `id`='".$invoice_id."'");
        $new_status = 3;
    }else if($status_id == 3){
        Database::iud("UPDATE `invoice` SET `status`='4' WHERE `id`='".$invoice_id."'");
        $new_status = 4;
    }

    echo $new_status;
}

?>
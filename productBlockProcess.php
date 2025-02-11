<?php

require "connection.php";

if(isset($_GET["id"])){

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_num = $product_rs->num_rows;

    if($product_num == 1){

        $product_data = $product_rs->fetch_assoc();

        if($product_data["status_status_id"] == 1){
            Database::iud("UPDATE `product` SET `status_status_id`= '2' WHERE `id`='".$pid."'");
            echo ("blocked");
        }else if($product_data["status_status_id"] == 2){
            Database::iud("UPDATE `product` SET `status_status_id`= '1' WHERE `id`='".$pid."'");
            echo ("unblocked");
        }

    }else{
        echo ("Cannot find the product. Please try again later.");
    }

}else{
    echo ("Something went wrong.");
}

?>
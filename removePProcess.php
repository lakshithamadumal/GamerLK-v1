<?php

require "connection.php";

if(isset($_GET["id"])){

    $product = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$product."'");

    if($product_rs->num_rows != 0){
        Database::iud("DELETE FROM `product_img` WHERE `product_id`='".$product."'");
        Database::iud("DELETE FROM `product` WHERE `id`='".$product."'");
        
        echo ("Deleted");

    }else{
        echo ("Something went wrong");
    }

}

?>
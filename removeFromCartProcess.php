<?php
require "connection.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_id`='".$cid."'");

    if($cart_rs->num_rows == 1){
        Database::iud("DELETE FROM `cart` WHERE `cart_id`='".$cid."'");
        echo ("deleted");
    }else{
        echo ("Please Try Again Later.");
    }

}

?>
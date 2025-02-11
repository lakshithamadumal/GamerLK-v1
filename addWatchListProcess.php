<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    if(isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$pid."' 
        AND `users_email`='".$email."'");

        $watchlist_num = $watchlist_rs->num_rows;

        if($watchlist_num == 1){
            $watchlist_data = $watchlist_rs->fetch_assoc();
            $list_id = $watchlist_data["id"];

            Database::iud("DELETE FROM `watchlist` WHERE `id`='".$list_id."'");
            echo ("Removed");

        }else{
            Database::iud("INSERT INTO `watchlist`(`product_id`,`users_email`) VALUES 
            ('".$pid."','".$email."')");
            echo ("Added");

        }

    }
}
else{
    echo ("Please Log In or Sign Up");
}


?>
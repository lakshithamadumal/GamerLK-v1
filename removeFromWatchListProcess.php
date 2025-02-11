<?php

require "connection.php";

if(isset($_GET["id"])){

    $watch_id = $_GET["id"];

    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$watch_id."'");

    if($watchlist_rs->num_rows != 0){

        Database::iud("DELETE FROM `watchlist` WHERE `id`='".$watch_id."'");
        echo ("Deleted");

    }else{
        echo ("Something went wrong");
    }

}

?>
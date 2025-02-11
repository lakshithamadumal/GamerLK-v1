<?php

require "connection.php";

if(isset($_GET["id"])){

    $type = $_GET["id"];

    $type_rs = Database::search("SELECT * FROM `game_type` WHERE `id`='".$type."'");

    if($type_rs->num_rows != 0){

        Database::iud("DELETE FROM `game_type` WHERE `id`='".$type."'");
        echo ("Deleted");

    }else{
        echo ("Something went wrong");
    }

}

?>
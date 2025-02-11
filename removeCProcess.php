<?php

require "connection.php";

if(isset($_GET["id"])){

    $category = $_GET["id"];

    $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='".$category."'");

    if($category_rs->num_rows != 0){

        Database::iud("DELETE FROM `category` WHERE `cat_id`='".$category."'");
        echo ("Deleted");

    }else{
        echo ("Something went wrong");
    }

}

?>
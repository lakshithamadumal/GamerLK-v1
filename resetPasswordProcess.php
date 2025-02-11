<?php

require "connection.php";


$email = $_POST["e"];
$new_pw = $_POST["np"];
$retyped_pw = $_POST["rnp"];
$v_code = $_POST["vc"];



if(empty($email)){
    echo ("Please enter your Email Address.");
}else if(empty($new_pw)){
    echo ("Please enter your Password.");
}else if(strlen($new_pw) < 5 || strlen($new_pw) > 20){
    echo ("Incorrect password.");
}else if(empty($retyped_pw)){
    echo ("Please enter your Password.");
}else if($new_pw != $retyped_pw){
    echo("Password does not match");
}else if(empty($v_code)){
    echo ("Please enter your verification code.");
}else{
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND 
    `verification_code`='".$v_code."'");

    $n = $rs->num_rows;

    if($n == 1){

        Database::iud("UPDATE `users` SET `password`='".$new_pw."' WHERE `email`='".$email."'
        AND 
    `verification_code`='".$v_code."'");
    echo ("Your Password has been Updated.");



         

    }else{
        echo ("Invalid user details");
    }
}

?>
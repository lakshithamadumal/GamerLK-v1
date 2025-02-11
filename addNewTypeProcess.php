<?php

session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["email"]) && isset($_POST["name"])){
    if($_SESSION["au"]["email"] == $_POST["email"]){

        $tname = $_POST["name"];
        $umail = $_POST["email"];

        $type_rs = Database::search("SELECT * FROM `game_type` WHERE `type_name` LIKE '%".$tname."%'");
        $type_num = $type_rs->num_rows;

        if($type_num == 0){

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$umail."'");

            // EMAIL CODE
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gamerlk888@gmail.com
';
            $mail->Password = 'zhphhchbozohbivn';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('gamerlk888@gmail.com
', 'Admin Verification');
            $mail->addReplyTo('gamerlk888@gmail.com
', 'Admin Verification');
            $mail->addAddress($umail);
            $mail->isHTML(true);
            $mail->Subject = 'gamerLk Admin Verification Code for Add New Game Type';
            $bodyContent = '<h1 style="color:blck;">Your verification code is <br> <span style="color:green;"> '.$code.' </span></h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
            // EMAIL CODE

        }else{
            echo ("This Game Type Already Exists");
        }
    }else{
        echo ("Invalid User");
    }
}else{
    echo ("Something Missing");
}

?>
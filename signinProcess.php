<?php

session_start();
require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if (empty($email)) {
    echo ("Please enter your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Incorrect Email Address.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Not a valid Email Address.");
} else if (empty($password)) {
    echo ("Please enter your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Incorrect password.");
} else {

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        $d = $rs->fetch_assoc();
        if ($d['status'] == 1) {
            echo ("success");
            $_SESSION["u"] = $d;

            if ($rememberme == "true") {
                setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                setcookie("password", $password, time() + (60 * 60 * 24 * 365));
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }
        } else {
            echo ("Your account has been blocked. 
Contact gamerLK admin --> gamerlk888@gmail.com");
        }
    } else {
        echo ("Invalid Email Address or Password");
    }
}

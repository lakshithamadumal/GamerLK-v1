<?php

session_start();
require "connection.php";

$sender = $_SESSION["u"]["email"];
$recever = $_POST["rm"];
$msg = $_POST["mt"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES 
('".$msg."','".$date."','0','".$sender."','".$recever."')");

echo ("success");

?>
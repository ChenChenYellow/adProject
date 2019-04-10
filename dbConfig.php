<?php

$host = "127.0.0.1";
$user = "root";
$pswd = "";
$dbName = "dbad";
//$connectionId = mysqli_connect($host, $user, $pswd, $dbName);

//$myCon = new mysqli($host, $user, $pswd, $dbName);

$con = new PDO("mysql:host = $host; dbname=$dbName;", $user, $pswd);
//get rand row and rand 10-50
//SELECT mod(round(rand()*COUNT(*), 0), COUNT(*)), round(mod(rand()*40,40),0)+10 from web_user
?>


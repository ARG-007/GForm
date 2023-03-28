<?php
$email=$_POST["email"];
$password=$_POST["password"];

$host="127.0.0.1";
$port=3306;
$user="root";
$pass="root";
$dbname="testdb";
$table="register";

$connection = new mysqli($host,$user,$pass,$dbname,$port)
              or die("Something Went Wrong : {$connection->connect_error}");

$getUserPassword = $connection->prepare("SELECT password FROM {$table} WHERE email=?");
$getUserPassword->bind_param("s",$email);

$getUserPassword->execute();

$getUserPassword->bind_result($userPass);

if($password == $userPass){
    echo "USER_ENTERED_CP";
} else{
    echo "USER_ENTERED_NCP";
}



?>
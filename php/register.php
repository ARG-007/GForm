<?php
$email=$_POST["email"];
$pass=$_POST["password"];

$host="127.0.0.1";
$port=3306;
$user="root";
$password="root";
$dbname="testdb";
$table="register";

$sql = new mysqli($host,$user,$password,$dbname,$port)
       or die("Connection Failed : ".$sql->connect_error);

$query = $sql->prepare("INSERT INTO ".$table." VALUES (?,?)");
$query->bind_param("ss",$email,$pass);

$query->execute();

$sql->close();

echo "SUCCESS!!!";
?>
<?php
require '../assets/vendor/autoload.php';
//-----------------------------------------------------------------------------------------------//
//                                       SERVER VARIABLES                                        //
//===============================             MySQL             =================================//
$host="127.0.0.1";
$port=3306;
$user="root";
$password="root";
$dbname="gform_regdb";
$table="register";

$sql = new mysqli($host,$user,$password,$dbname,$port) or die("Connection Failed : ".$sql->connect_error);
//===============================            MongoDB             ================================//
$mongoIP="localhost";
$mongoPort = "27017";

$userProfile = (new MongoDB\Client("mongodb://{$mongoIP}:{$mongoPort}"))->GFormDB->userProfiles;
//================================            REDIS               ===============================//
$redisIP = "127.0.0.1";
$redisPort = 6379;
$redisKeyExpire = 600;

$redis = new Redis();
$redis->connect($redisIP,$redisPort);
//-----------------------------------------------------------------------------------------------//
?>
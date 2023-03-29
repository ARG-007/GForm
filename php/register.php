<?php
require '../assets/vendor/autoload.php'; 

// //Resolves Every Code Error into Server Error
// function ServerError(){
//        header("Internal Server Error",true,500);
//        exit("SERVER_ERROR");
// }
// set_exception_handler("ServerError");
// error_reporting(E_ERROR | E_PARSE); //Supresses Warnings

//Block Out ALL GET Requests Because: I Don't Why I Did This but I Had a Internal Urge to do it anyway
if($_SERVER["REQUEST_METHOD"]==="GET"){
       header("Method Not Allowed",true,405);
       exit();
}

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

function userExists($emailId) : bool{
       $q = $GLOBALS['sql']->prepare("SELECT * FROM {$GLOBALS['table']} WHERE mail=?");
       $q->bind_param("s",$emailId);
       $q->execute();
       $q->store_result();

       if($q->num_rows){
              return true;
       } else  {
              return false;
       }
}



$email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL); //Sanatizing Only Email
$pass=$_POST["password"];

if(userExists($email)){
       exit("USER_EXISTS");
}

$query = $sql->prepare("INSERT INTO {$table} (mail,password) VALUES (?,?)");
$query->bind_param("ss",$email,$pass);
$query->execute();

$sql->close();

$res = $userProfile->insertOne(["email"=>$email])->getInsertedId()->__toString();

$redis->setEx($res,$redisKeyExpire,$email);


echo $res;

?>
<?php

require '../assets/vendor/autoload.php'; 
function ServerError(){
    header("Internal Server Error",true,500);
    exit("SERVER_ERROR");
}

set_exception_handler("ServerError");
error_reporting(E_ERROR | E_PARSE);

if($_SERVER["REQUEST_METHOD"]==="GET"){
    header("Method Not Allowed",true,405);
    exit();
}

$redis = new Redis();
$redis->connect("127.0.0.1",6379);
//echo $redis->ping();
try{
    if($_POST["REQUEST"]==="ValidateSession"){
        if($redis->get($_POST["SessionToken"])){
            exit("Session_Valid");
        } else {
            exit("Session_Invalid");
        }
    }
} catch(Exception $e){}

$email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
$password=$_POST["password"];

$host="127.0.0.1";
$port=3306;
$user="root";
$pass="root";
$dbname="gform_regdb";
$table="register";

$connection = new mysqli($host,$user,$pass,$dbname,$port)
              or die("Something Went Wrong : {$connection->connect_error}");

function userExists($emailId) : bool{
    $tableName = $GLOBALS['table'];
    $q = $GLOBALS['connection']->prepare("SELECT * FROM {$tableName} WHERE mail=?");
    $q->bind_param("s",$emailId);
    $q->execute();
    $q->store_result();

    if($q->num_rows){
        return true;
    } else  {
        return false;
    }
}

if(!userExists($email)){
    exit("USER_NOT_EXISTS");
}

$getUserPassword = $connection->prepare("SELECT password FROM {$table} WHERE mail=?");
$getUserPassword->bind_param("s",$email);

$getUserPassword->execute();

$getUserPassword->store_result();
$getUserPassword->bind_result($userPass);
$getUserPassword->fetch();


if($password !== $userPass){
    exit("USER_ENTERED_NCP");
}


$up = (new MongoDB\Client("mongodb://localhost:27017"))->GFormDB->userProfiles;

$res = $up->findOne(["email"=>$email])["_id"]->__toString();

$redis->setEx($res,600,$email);
echo $res;
?>


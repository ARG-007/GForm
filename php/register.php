<?php
// function ServerError(){
//        header("Internal Server Error",true,500);
//        exit("SERVER_ERROR");
// }
// set_exception_handler("ServerError");

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

if($_SERVER["REQUEST_METHOD"]==="GET"){
       header("Method Not Allowed",true,405);
       exit();
}

$email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL); //Sanatizing Only Email
$pass=$_POST["password"];

//Init Variables For MySQL Connection
$host="127.0.0.1";
$port=3306;
$user="root";
$password="root";
$dbname="gform_regdb";
$table="register";

$sql = new mysqli($host,$user,$password,$dbname,$port) or die("Connection Failed : ".$sql->connect_error);

if(userExists($email)){
       exit("USER_EXISTS");
}

$query = $sql->prepare("INSERT INTO {$table} (mail,password) VALUES (?,?)");
$query->bind_param("ss",$email,$pass);
$query->execute();

$sql->close();

require '../assets/vendor/autoload.php'; 

$up = (new MongoDB\Client("mongodb://localhost:27017"))->GFormDB->userProfiles;
$res = $up->insertOne(["email"=>$email])->getInsertedId()->__toString();

$redis = new Redis();
$redis->connect("127.0.0.1",6379);
$redis->setEx($res,600,$email);


echo $res;

?>
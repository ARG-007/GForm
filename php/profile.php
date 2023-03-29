<?php
require '../assets/vendor/autoload.php'; 

$redis = new Redis();
$redis->connect("127.0.0.1",6379);
//echo $redis->ping();


$up = (new MongoDB\Client("mongodb://localhost:27017"))->GFormDB->userProfiles;
$sessionId = $_POST['SessionID'];
$redisMail = $redis->get($sessionId);
//echo $redisMail;

if($_SERVER["REQUEST_METHOD"]=="GET"){
    header("Method Not Allowed",true,405);
}


if(!$redisMail) exit("SESSION_INVALID");

if($_POST["REQUEST"]=="FORM_GET"){
    $details = $up->findOne(["email"=>$redisMail]);
    //echo gettype($details);
    echo json_encode($details);
    exit();
}

if($_POST["REQUEST"]=="FORM_PUT"){
    // $details = array({
    //     "userName"=>
    // })
    unset($_POST["email"]);
    unset($_POST["REQUEST"]);
    unset($_POST["SessionID"]);

    $up->findOneAndUpdate(["email"=>$redisMail],['$set'=>$_POST]);
    
}

?>
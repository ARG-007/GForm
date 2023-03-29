<?php
require_once "../assets/serverConfig.php";

//Resolves Every Code Error into Server Error
function ServerError(){
    header("Internal Server Error",true,500);
    exit("SERVER_ERROR");
}
set_exception_handler("ServerError");
error_reporting(E_ERROR | E_PARSE); //Supresses Warnings

if($_SERVER["REQUEST_METHOD"]=="GET"){
    header("Method Not Allowed",true,405);
}




$sessionId = $_POST['SessionID'];
$redisMail = $redis->get($sessionId);




if(!$redisMail) exit("SESSION_INVALID");

if($_POST["REQUEST"]=="FORM_GET"){
    $details = $userProfile->findOne(["email"=>$redisMail]);
    echo json_encode($details);
    exit();
}

if($_POST["REQUEST"]=="FORM_PUT"){
    unset($_POST["email"]);
    unset($_POST["REQUEST"]);
    unset($_POST["SessionID"]);

    $userProfile->findOneAndUpdate(["email"=>$redisMail],['$set'=>$_POST]);
    
}

?>
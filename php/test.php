<?php
// use MongoDB\Client;
require '../assets/vendor/autoload.php'; 

$mongo = new MongoDB\Client("mongodb://localhost:27017");
echo "Successfully Connected";
$gf = $mongo->GFormDB;
echo "Selected GFormDB";
$up = $gf->userProfiles;
echo "Selected UserProfiles";

$doc = array("email"=>"phantomArg@hg.com");
$up->insertOne($doc);

$cursor = $up->find();

foreach ($cursor as $document){
	echo "{$document['_id']}\n";
}
// phpinfo();

// $host="127.0.0.1";
// $port=3306;
// $socket="";
// $user="root";
// $password="root";
// $dbname="testdb";

// $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
// 	or die ('Could not connect to the database server' . mysqli_connect_error());


// $result = $con->prepare($sqlQuery);
// $result->execute();
// $result->store_result();
// $result->bind_result($res[],$res1[]);
// $result->fetch();

// echo $res;
//$con->close();

?>
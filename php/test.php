<?php
phpinfo();

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="root";
$dbname="testdb";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());


// $result = $con->prepare($sqlQuery);
// $result->execute();
// $result->store_result();
// $result->bind_result($res[],$res1[]);
// $result->fetch();

echo $res;
//$con->close();

?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_core";

$conn = mysqli_connect($servername,$username,$password,$dbname);

// Connection is failed then display that error
if($conn->connect_error){
	die('Connection failed... '.$conn->connect_error);
}

?>
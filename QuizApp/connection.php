<?php 

$server = "localhost";
$user = "root";
$password = "";
$database = "quizapp";
$connection = new mysqli($server,$user,$password,$database);
if($connection->connect_error){
    die("Connection error: ".$connection->connect_error);
}
?>
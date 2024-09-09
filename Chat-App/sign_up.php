<?php
require "connection.php";
$uname = $pass = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uname=$_POST["uname"];
    $pass=$_POST["pass"];

    $statement = $connection->prepare("INSERT INTO users (name,pass) VALUES (?,?);");
    $statement->bind_param("ss",$uname,$pass);
    if($statement->execute()){
        header("Location: login.php");
    }else{
        echo "User signup failed";
    }
} else{
    echo "Invalid Request";
}

?>
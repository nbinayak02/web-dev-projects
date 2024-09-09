<?php 
require "connection.php";
$roomid=$createdby=$createdat="";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $roomid = $_GET["room_id"];
    $createdby=$_COOKIE["user"];
    $createdat = '';

    $statement=$connection->prepare("INSERT INTO groups (groupstring,createdby,createddate) VALUES (?,?,?)");
    $statement->bind_param("sss",$roomid,$createdby,$createdat);
    if($statement->execute()){
        setcookie("roomid",$roomid,time()+(86400*7),"/");
        header("Location: messages.php?roomid={$roomid}");
    } else{
        echo "failed to activate room";
    }
    
}
?>
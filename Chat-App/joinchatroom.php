<?php 
require "connection.php";
$roomid = "";
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $roomid = $_GET["roomid"];
   

    $statement = "SELECT * FROM groups WHERE groupstring='$roomid'";
    $result = $connection->query($statement);
    
    if($result->num_rows > 0){
        setcookie("roomid",$roomid,time()+(86400*7),"/");
        header("Location: messages.php?roomid={$roomid}");
    } else{
        echo "<h1>Room ID did not matched</h1>";
        echo "<a href='join.php'>Go Back</a>";
    }

} else{
    echo "Invalid request";
}

?>
<?php 
require "connection.php";
$uname = $pass = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];

    $statement = "SELECT * FROM users WHERE name='$uname' AND pass='$pass'";
    $result = $connection->query($statement);
    
    if($result->num_rows == 1){
        setcookie("user",$uname,time()+(86400*7),"/");
        header("Location: home.php");
    } else{
        echo "<h1>Username or password did not matched</h1>";
        echo "<a href='login.php'>Go Back</a>";
    }

} else{
    echo "Invalid request";
}

?>
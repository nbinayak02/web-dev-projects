<?php
include "connection.php";
$title = $details = $image_data = $author = $date = $category = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $title= $_POST["title"];
    $details=$_POST["post-details"];
    // $image=$_POST["image"];
    $category = $_POST["category"];
    $author = $_POST["author"];
    $date = $_POST["date"];

    $image_data = file_get_contents($_FILES["image"]["tmp_name"]); //uploaded file is stored in $_FILES array

    $statement = $connection->prepare("INSERT INTO blogs (headline,content,category,author,date,image) VALUES (?,?,?,?,?,?);");

    $statement->bind_param("ssssss",$title,$details,$category,$author,$date,$image_data);
    if($statement->execute()){
        echo "Post created successfully";
    } else{
        echo "Unable to create post";
    }
} else{
    echo "Invalid request";
}

?>
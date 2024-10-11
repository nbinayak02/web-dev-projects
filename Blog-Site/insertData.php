<?php
include "connection.php";
$title = $details = $imageFileName = $author = $date = $category = $fileExtension = $tempFileName = $targetPath = "";
$allowedFileTypes = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST["title"];
    $details = $_POST["post-details"];
    $imageFileName = $_FILES["image"]["name"];
    $category = $_POST["category"];
    $author = $_POST["author"];
    $date = $_POST["date"];

    $fileExtension = pathinfo($imageFileName, PATHINFO_EXTENSION); //extension of uploaded file
    $allowedFileTypes = ["jpg", "jpeg", "png", "gif"];
    $tempFileName = $_FILES["image"]["tmp_name"];
    $targetPath = "uploads/" . $imageFileName;

    if (in_array($fileExtension, $allowedFileTypes)) {
        if (move_uploaded_file($tempFileName, $targetPath)) {
            $statement = $connection->prepare("INSERT INTO blogs (headline,content,category,author,date,image) VALUES (?,?,?,?,?,?);");
            $statement->bind_param("ssssss", $title, $details, $category, $author, $date, $imageFileName);
            if ($statement->execute()) {
                echo "Post created successfully";
            } else {
                echo "Unable to create post";
            }
        } else {
            echo "Unable to upload file";
        }
    } else {
        echo "Invalid file type";
    }
} else {
    echo "Invalid request";
}

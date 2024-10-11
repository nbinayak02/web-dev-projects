<?php
require "connection.php";
$title = $_GET["title"];
$statement = "SELECT content,author,date,image FROM blogs WHERE headline='$title';";
$result = $connection->query($statement);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="style-in.css">
        <style>
            
            .image img{
                width: 640px;
                height: 360px;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }
        </style>
    </head>

    <body>
        <!-- navigation bar -->
        <nav class="nav-bar">
            <div class="logo">Blog Site</div>
            <ul>
                <li><a href="">Trending</a></li>
                <li><a href="">Latest</a></li>
                <li><a href="">Blogs</a></li>
                <li><a href="">Topics</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Profile</a></li>
            </ul>
        </nav>

        <div class="content">
            <!-- content title -->
            <div class="header">
                <div class="title"><?php echo $title; ?></div>
            </div>
            <div class="content">
                <div class="image">
                    <img src="uploads/<?php echo $row['image']; ?>">
                </div>
               <span><b><?php echo $row["author"]." | ".$row["date"];?></b>&nbsp;&nbsp;</span> <?php echo $row["content"]; ?>
            </div>
        

        <div class="header">
            <div class="title">Topics</div>
            <div class="view-all"><a href="">View all</a></div>
        </div>

        <div class="topics-container">
            <div class="topics"><a href="">Education</a></div>
            <div class="topics"><a href="">Health</a></div>
            <div class="topics"><a href="">Economy</a></div>
            <div class="topics"><a href="">Politics</a></div>
            <div class="topics"><a href="">Artificial Intelligence</a></div>
            <div class="topics"><a href="">Job</a></div>
            <div class="topics"><a href="">Work from home</a></div>
            <div class="topics"><a href="">Flood</a></div>
            <div class="topics"><a href="">Dashain</a></div>
            <div class="topics"><a href="">Festival</a></div>
        </div>

         <div class="newsletter">
            <div class="header">
                <div class="title">Subscribe to our newsletter</div>
            </div>
            <div class="form">
                <form>
                    <input type="email" name="email" placeholder="Enter your email">
                    <input type="submit" name="submit" value="Subscribe">
                </form>
            </div>
         </div>
       
    </div>
        </div>
    <footer>
        <div class="logo">Blog Site</div>
        <span>&copy;Binayak Niraula 2081 Ashwin 16</span>
    </footer>
    </body>

    </html>
<?php } ?>
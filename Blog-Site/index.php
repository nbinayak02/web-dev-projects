<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog-Site</title>
    <link rel="stylesheet" href="style-in.css">
</head>

<body>
    <!-- php code for accessing data from database -->
     <?php 
     require "connection.php";
     $statement = "SELECT headline,content,author,date,image FROM blogs LIMIT 1;";
     $result = $connection->query($statement);
     ?>

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

    <!-- content body -->
    <div class="content">

        <!-- content title -->
        <div class="header">
            <div class="title">Latest</div>
            <div class="view-all"><a href="">View all</a></div>
        </div>

        <!-- highlighted content -->
        <div class="highlight">
            <?php 
             if($result->num_rows > 0){
                $row=$result->fetch_assoc();
                $filename = $row["image"];
            ?>
            <img src="uploads/<?php echo $filename; ?>">
            <a href="view-post.php?title=<?php echo $row['headline']; ?>">
                <h2><?php echo $row["headline"]; ?></h2>
                <div class="info"><span id="author"><?php echo $row["author"]; ?></span> | <span id="upload-time"><?php echo $row["date"]; ?></span></div>
                <p class="highp"><?php echo $row["content"]; ?></p>
            </a>

            <?php 
            }
            ?>
        </div>

        <!-- other latest content  -->
        <div class="more-latest">
            
            <?php 
                $statement2 = "select headline, content,image from blogs WHERE id NOT IN (SELECT min(id) from blogs) ORDER BY id DESC limit 6;";
                $result2 = $connection->query($statement2);
                if($result2->num_rows>0){
                    while($row2=$result2->fetch_assoc()){ ?>
            <div class="more-card card1">
            <img src="uploads/<?php echo $row2["image"]; ?>">
            <a href="view-post.php?title=<?php echo $row2['headline']; ?>">
                <h3><?php echo $row2["headline"]; ?></h3>
                <p><?php echo $row2["content"];?></p>
            </a>
            </div>
                <?php
                    }
                }
                ?>
        </div>
           


        <!-- trending content  -->
        <div class="header">
            <div class="title">Trending</div>
            <div class="view-all"><a href="">View all</a></div>
        </div>

        <div class="highlight">
            <?php 
            $statement_trend = "SELECT headline,content,author,date,image FROM blogs WHERE id=14;";
            $result_trend = $connection->query($statement_trend);
             if($result_trend->num_rows > 0){
                $row_trend=$result_trend->fetch_assoc();
            ?>
            <img src="uploads/<?php echo $row_trend["image"]; ?>">
            <a href="view-post.php?title=<?php echo $row_trend['headline']; ?>">
                <h2><?php echo $row_trend["headline"]; ?></h2>
                <div class="info"><span id="author"><?php echo $row_trend["author"]; ?></span> | <span id="upload-time"><?php echo $row_trend["date"]; ?></span></div>
                <p class="highp"><?php echo $row_trend["content"]; ?></p>
            </a>

            <?php 
            }
            ?>
        </div>


        <div class="more-latest">
            
            <?php 
                $statement2 = "select headline, content,image from blogs WHERE id NOT IN (SELECT min(id) from blogs) ORDER BY id DESC limit 6;";
                $result2 = $connection->query($statement2);
                if($result2->num_rows>0){
                    while($row2=$result2->fetch_assoc()){ ?>
            <div class="more-card card1">
            <img src="uploads/<?php echo $row2["image"]; ?>">
            <a href="view-post.php?title=<?php echo $row2['headline']; ?>">
                <h3><?php echo $row2["headline"]; ?></h3>
                <p><?php echo $row2["content"];?></p>
            </a>
            </div>
                <?php
                    }
                }
                ?>
        </div>

        <!-- topics -->
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

    <footer>
        <div class="logo">Blog Site</div>
        <span>&copy;Binayak Niraula 2081 Ashwin 16</span>
    </footer>
</body>

</html>
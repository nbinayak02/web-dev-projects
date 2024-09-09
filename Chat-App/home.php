<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - ChatApp</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="box">
        <div class="container" style="width: 500px;">
            <h1>Create or Join the ChatRoom, <?php if(isset($_COOKIE["user"])) {echo $_COOKIE["user"];} ?>!</h1>
            <div class="buttons">
                <button><a href="create.php">Create Room</a></button>
                <button><a href="join.php">Join Room</a></button>
            </div>
        </div>
    </div>
</body>

</html>
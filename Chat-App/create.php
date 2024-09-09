<?php 
function createRandStr(){
    $n=2;
    $randstr="chat";
    
    for($i=0; $i<$n; $i++){
        $randstr .="-".bin2hex(random_bytes($n));
    }
    return $randstr;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Room - ChatApp</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="box">
        <div class="container" style="width:500px;">
            <h1>Your room has been created!</h1>
            <div class="buttons">
                <h3>Your ChatApp room code is:<br>
                    <?php $room_id=createRandStr(); echo $room_id; ?>
                </h3>
                <form action="joinroom.php" method="GET">
                    <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                    <input type="submit" name="submit" value="Activate Room">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
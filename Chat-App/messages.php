<?php
require "connection.php";
$roomid="";
if(isset($_GET["roomid"])){
    $roomid = $_GET["roomid"];
}else{
    $roomid=$_COOKIE["roomid"];
}

$user=$_COOKIE["user"];
$dateAndTime=$_COOKIE["date"]."&".$_COOKIE["time"];

$msg="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $msg=$_POST["msg"];
    $statement=$connection->prepare("INSERT INTO messages(message,groupstring,sentby,senttime) VALUES (?,?,?,?)");
    $statement->bind_param("ssss",$msg,$roomid,$user,$dateAndTime);
    if($statement->execute()){
        header("Location: messages.php?roomid={$roomid}");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <link rel="stylesheet" href="msgstyle.css">
    <title>ChatApp | ChatRoom
        <?php echo $roomid; ?>
    </title>
</head>

<body>
    <div class="box">
        <div class="side-container">
            <div class="logo">ChatApp -
                <?php echo $user; ?>
            </div>
            <div class="exit"><a href="index.php">Logout</a></div>
            <div class="changemode" onclick="changeMode()"><img src="darkmode.png"></div>
        </div>
        <div class="message-container">
            <div class="msg-header" id="msg-header">
                <div class="group-logo">
                    <div class="online"></div>
                </div>

                <div class="group-name">
                    <?php echo $roomid; ?>
                </div>
            </div>
            
            <?php

                $select="SELECT * FROM messages WHERE groupstring='$roomid'";
                $result=$connection->query($select);

                ?>
            <div class="msg-exchange" id="msg-exchange">
                <ul>
                    <?php 
                       function getSentDT($senttime){
                            $d=[];
                            if($senttime !== NULL){
                                //seperate date and time in array
                                $d = explode("&",$senttime);
                                // print_r($d);
                            } else{
                                //php doesn't prints NULL
                                $d=[NULL,NULL];
                            }
                            return $d;
                       }
             if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    if($row["sentby"] !== $user){
                        $d = getSentDT($row["senttime"]);
                         echo " <li class='sender-profile'>{$row["sentby"]}</li>
                                <li class='received'>{$row['message']}</li>
                                <li class='rdatetime'>{$d[0]} {$d[1]} </li>
                                ";

                    }else if($row["sentby"] == $user){
                        $d = getSentDT($row["senttime"]);
                        echo " <li class='sent'>{$row['message']}</li>
                               <li class='sdatetime'>{$d[0]} {$d[1]} </li>
                        ";
                    }
                }
             } else{
                echo "<li>Start sending message</li>";
                }
                ?>
                </ul>

            </div>

            <div class="sending-area">
                <div class="text-box">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateAndSet()">
                        <input type="text" name="msg" placeholder="Type your message here" id="msg" autocomplete="off">
                </div>
                <div class="send-btn">
                    <input type="submit" name="submit" value="Send">
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>

        //check theme and set accordingly
        function setTheme() {
            const x = getthemeCookie();
            if (x === "dark") {

                document.getElementById("msg-exchange").style.backgroundColor = "#18191A";
                document.getElementById("msg-header").style.backgroundColor = "#242526";
                document.getElementsByClassName("group-name")[0].style.color = "#e4e6eb";
                document.getElementsByClassName("sending-area")[0].style.backgroundColor = "#242526";
                document.getElementById("msg").style.backgroundColor = "#242526";
                document.getElementById("msg").style.color = "#e4e6eb";
                document.getElementById("msg").style.border = "2px solid #e4e6eb";


                var sp = document.getElementsByClassName("sender-profile");
                for (var i in sp) { sp[i].style.color = "#e4e6eb"; }
               
            } else {
                document.getElementById("msg-exchange").style.backgroundColor = "#fff";
            }
        }

        //go to recently exchanged messages
        var msgex = document.getElementById("msg-exchange");
        function scrollToBottom() {
            msgex.scrollTop = msgex.scrollHeight;
        }

        window.addEventListener('load', scrollToBottom);
        window.addEventListener('load', setDateTimeCookie);
        window.addEventListener('load', setTheme);

        function setDateTimeCookie() {
            const timezone = new Intl.DateTimeFormat().resolvedOptions().timeZone;
            var dandt = new Date();
            var month = dandt.getMonth() + 1;
            var date = dandt.getFullYear() + "/" + month + "/" + dandt.getDate();
            var time = dandt.getHours() + ":" + dandt.getMinutes();
            document.cookie = "date=" + date;
            document.cookie = "time=" + time;
            document.cookie = "timezone=" + timezone;
        }

        function validateAndSet() {

            var msg = document.getElementById("msg").value;

            if (msg == "") {

                return false;

            } else {
                setDateTimeCookie();
            }


        }

        function getthemeCookie() {
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();
                const cookieName = cookie.substring(0, cookie.indexOf('='));
                const cookieValue = cookie.substring(cookie.indexOf('=') + 1);
                if (cookieName === "theme") {
                    return cookieValue;
                }
            }
            return null;
        }


        function changeMode() {
            const x = getthemeCookie();
            if (x === "light") {
                //change to dark
                document.cookie = "theme=dark";
                window.location.reload();
            } else if (x === "dark") {
                //change to light
                document.cookie = "theme=light";
                window.location.reload();

            } else {
                document.cookie = "theme=dark";
                window.location.reload();

            }
        }

    </script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Join ChatRoom</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="box">
        <div class="container">
            <h1>Join ChatRoom</h1>
            <div class="form" style="margin-top: 20px;">
                <form action="joinchatroom.php" method="get" onsubmit="return validateForm()">
                    <input type="text" name="roomid" placeholder="Room code" id="uname" style="margin-bottom: 0;">
                    <div class="buttons">
                        <input type="submit" name="submit" value="Join Room">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var user = document.getElementById("uname").value;


            if (user == "") {
                alert("Room code cannot be empty!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
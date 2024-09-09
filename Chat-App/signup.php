<!DOCTYPE html>
<html>

<head>
    <title>Signup to ChatApp</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="box">
        <div class="container">
            <h1>Signup to ChatApp!</h1>
            <div class="form" style="margin-top: 20px;">
                <form action="sign_up.php" method="post" onsubmit="return validateForm()">
                    <input type="text" name="uname" placeholder="Username" id="uname">
                    <input type="password" name="pass" placeholder="Password" id="pass" style="margin-bottom: 0;">
                    <div class="buttons">
                    <input type="submit" name="submit" value="Signup">
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validateForm(){
            var user = document.getElementById("uname").value;
            var pass = document.getElementById("pass").value;

            if(user == "" || pass == ""){
                alert("Username or password cannot be empty!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
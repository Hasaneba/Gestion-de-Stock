<?php
include("connection.php");
include("login.php")
?>

<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>


    <form class="box" action="index.php" onsubmit="return isvalid()" method="POST">
        

            <h1>Login top lait</h1>
            

                <input type="text" id="user" name="user" placeholder="Nom d'utilisateur">
                <input type="password" id="pass" name="pass" placeholder="Mot de passe">
                <input type="submit" id="btn" value="Login" name="submit" />

        </div>
    </form>

    <script>
        function isvalid() {
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if (user.length == "" && pass.length == "") {
                alert(" Username and password field is empty!!!");
                return false;
            } else if (user.length == "") {
                alert(" Username field is empty!!!");
                return false;
            } else if (pass.length == "") {
                alert(" Password field is empty!!!");
                return false;
            }

        }
    </script>
</body>

</html>
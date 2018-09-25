<?php if (isset($_POST['login'])){
        header('location: index.php');
    } 
require "php_codes/db.php"
?>
<html>
<head>
    <title> Login Form  </title>
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
    <body>
        <div class="loginbox">
            <img src="img/icon.png" class="avatar">
            <form action="index.php" method="post">
            <h1>CLSMS</h1>
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="login" value="Login">
            </form>
        </div>   
    </body>
    </head>
</html>
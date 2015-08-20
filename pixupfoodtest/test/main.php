<?php
session_start();
if(!isset($_SESSION["islogin"])){
 echo  '<script>document.location = "login.php";</script>';
 die();

    
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

            You are: <?=$_SESSION["userdata"]["name"]?>  <?=$_SESSION["userdata"]["lname"]?> <br>
            <?=$_SESSION["userdata"]["email"]?> <br>
            <a href="logout.php"><button>logout</button></a>


    </body>
</html>

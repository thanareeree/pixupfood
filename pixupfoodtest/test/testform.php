<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>


        <form action="save.php" method="post" >
            name:  <input type="text" name="name" ><br>
            last name: <input type="text" name="lname" ><br>
            วันเกิด: <input type="date" name="dob" ><br>
            เพศ :<input type="radio" name="gender" value="F" >F <input type="radio" name="gender" value="M" >M <br>
            อีเมล: <input type="email" name="email" ><br>
            รหัสผ่าน: <input type="password" name="password" ><br>
            
            <select name="resid">
            <?php
            include '../dbconn.php';
            $res = $con->query("SELECT * FROM `test_restaurant`");
            
            while ($data = $res->fetch_assoc()) {
                echo "<option value=".$data["res_id"].">". $data["res_name"]."</option>";
            }
            ?> 
            </select>
            <br><br><br>
            <input type="submit">

        </form>
    </body>
</html>

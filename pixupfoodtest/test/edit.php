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

         <?php 
         include '../dbconn.php';
         $id = $_GET["id"];
         
         $res = $con->query("SELECT * FROM `test` where register_id='$id'");
         $data = $res->fetch_assoc();
         
         ?>
        
        
        <form action="saveedit.php" method="post" >
            <input type="hidden" name="registerid" value="<?=$data["register_id"]?>">
            name:  <input type="text" name="name" value="<?=$data["name"]?>"><br>
            last name: <input type="text" name="lname" value="<?=$data["lname"]?>" ><br>
            วันเกิด: <input type="date" name="dob" value="<?=$data["dob"]?>" ><br>
            เพศ :<input type="radio" name="gender" value="F" <?=($data["gender"]=='F')?"checked":"" ?> >F <input type="radio" name="gender" value="M" <?=($data["gender"]=='M')?"checked":"" ?> >M <br>
            อีเมล: <input type="email" name="email" value="<?=$data["email"]?>" ><br>
            รหัสผ่าน: <input type="password" name="password" value="<?=$data["password"]?>"><br>
            
            <select name="resid">
            <?php
            include '../dbconn.php';
            $res = $con->query("SELECT * FROM `test_restaurant`");
            
            while ($data2 = $res->fetch_assoc()) {
                echo "<option value='". $data2["res_id"]."' ".(($data["res_id"]==$data2["res_id"])?"selected":"")  .">". $data2["res_name"]."</option>";
            }
            ?> 
            </select>
            <br><br><br>
            <input type="submit">

        </form>
    </body>
</html>

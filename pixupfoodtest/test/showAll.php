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


        <table border="1">
            <tr>
                <td>id</td>
                <td>ชื่อ</td>
                <td>DOB</td>
                <td>gender</td>
                <td>age</td>
                <td>Regis time</td>
                <td>email</td>
                <td>restaurant</td>
                <td></td>
            </tr>

            <?php
            include '../dbconn.php';
            $res = $con->query("SELECT * FROM `test` t JOIN test_restaurant tr ON t.res_id=tr.res_id");
            while ($data = $res->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $data["register_id"] ?></td>
                    <td><?= $data["name"] . " " . $data["lname"] ?></td>
                    <td><?= $data["dob"] ?></td>
                    <td><?= $data["gender"] ?></td>
                    <td>
                        <?php
                        $now = date("Y");
                        $dob = date("Y", strtotime($data["dob"]));
                        $age = $now - $dob;
                        echo $age;
                        ?>

                    </td>
                    <td><?= $data["regis_time"] ?></td>
                    <td><?= $data["email"] ?></td>
                    <td><?= $data["res_name"] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $data["register_id"] ?>">edit</a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="delete.php?id=<?= $data["register_id"] ?>">delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>

        </table>
    </body>
</html>

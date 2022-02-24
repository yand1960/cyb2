<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        echo '<meta http-equiv="refresh" content="2; URL=login.php"> '; 
        die("Требуется логин");
    }
    $user = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width:30%;
        }

        tr:nth-child(even) {
            background-color: lightgray;
        }

        td {
            text-align: right;
        }

        td:nth-child(3) {
            text-align: center;
        }

        a {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
    <script>
        function toggleTable() {
            if(document.getElementById("lnkToggle").innerText == "Cпрятать") {
                document.getElementById("tblCalcs").style.display = "none";
                document.getElementById("lnkToggle").innerText = "Показать";
            }
            else {
                document.getElementById("tblCalcs").style.display = "";
                document.getElementById("lnkToggle").innerText = "Cпрятать";
            }
        }
    </script>
</head>
<body>
    <a href="index1.html">Индекс</a>

    <?php
     echo "<h1>Твой счет, $user!</h1>";
    ?>
    <a onclick="toggleTable();" id="lnkToggle">Спрятать</a>

    <table border="1" id="tblCalcs">
        <tr>
            <th>Первое число</th>
            <th>Второе число</th>
            <th>Операция</th>
        </tr>
    <?php
        include("../../params/billing.php");
        $conn = mysqli_connect($db_server,$db_user,$db_pwd,"billing");


        // Это довольно нудный код, но использование 
        // параметрического запроса избавляет от уязвимости SQL Injection
        $sql = "SELECT * FROM calcs WHERE User=?";
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement,"s",$user);
        mysqli_stmt_execute($statement);
        $cursor = mysqli_stmt_get_result($statement);
        $result = mysqli_fetch_all($cursor);
        mysqli_close($conn);

        for ($i = 0; $i < count($result); $i++) {
            echo "<tr>";
            echo "<td>".$result[$i][1]."</td><td>".$result[$i][2]."</td><td>".$result[$i][3]."</td>";
            echo "</tr>";
        }
    
    ?>
    </table>
    <?php echo("<h2>С тебя, друг, ".count($result)." долл.</h2>"); ?>
</body>
</html>
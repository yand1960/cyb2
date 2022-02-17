<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check login</title>
</head>
<body>
    <?php
        $user = $_REQUEST['user'];
        $pwd = $_REQUEST['pwd'];
        $hash = hash("sha256", $pwd);

        //$conn = mysqli_connect("localhost:3306","root","","billing");
        include("../../params/billing.php");
        $conn = mysqli_connect($db_server,$db_user,$db_pwd,"billing");

        // Это было уязвимо, но проблема потом решена
        // $sql = "SELECT * FROM users WHERE login='$user' AND Pwdhash='$hash' ";
        // $query = mysqli_query($conn, $sql);
        // $result = mysqli_fetch_all($query);

        // Это довольно нудный код, но использование 
        // параметрического запроса избавляет от уязвимости SQL Injection
        $sql = "SELECT * FROM users WHERE login=? AND Pwdhash=? ";
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement,"ss",$user, $hash);
        mysqli_stmt_execute($statement);
        $cursor = mysqli_stmt_get_result($statement);
        $result = mysqli_fetch_all($cursor);

        mysqli_close($conn);

        //var_dump($result);
        if (count($result) == 0)
            echo("Bad login!");
        else {
            echo "<h1>Welcome, $user!</h1>";
            echo "Сейчас вы будете перенаправлены на калькулятор";
            $_SESSION["user"] = $user;
            echo '<meta http-equiv="refresh" content="2; URL=calc.php"> ';
        }
    ?>
</body>
</html>
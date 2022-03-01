<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        echo '<meta http-equiv="refresh" content="2; URL=login.php"> '; 
        die("Требуется логин");
    }
    $user = $_SESSION["user"];

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

    //Генерируем JSON из данных биллинга (переменной $result)
    echo(json_encode($result));
   
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicks</title>
</head>
<body>
    <a href="index1.html">Индекс</a>
    <h1>Считаем щелчки с помощью PHP</h1>
    <form>
        <button>Щелкни здесь</button>
    </form>
    <?php
        //$i = 0;
        // if (isset($_SESSION["clicks"]))
        //     $i = $_SESSION["clicks"];
        // else
        //     $i = 0;

        if (isset($_COOKIE["clicks"]))
            $i = $_COOKIE["clicks"];
        else
            $i = 0;

        $i += 1;
        echo "Число щелчков: $i";
        setcookie("clicks", $i, time() + 20);
        //$_SESSION["clicks"] = $i;
    ?>
    
</body>
</html>
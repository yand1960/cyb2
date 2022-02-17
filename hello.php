<html>
    <head>
        <title>Hello</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <a href="index1.html">Индекс</a>
        <?php
    
            date_default_timezone_set("Europe/Moscow");
            //date_default_timezone_set("Asia/Tokyo");
            $hour = date("H");
            if ($hour < 5)
                echo "<h1>Доброй ночи!</h1>";

            if ($hour >= 5 and $hour < 12)
                echo "<h1>Доброe утро!</h1>";

            if ($hour >= 12 and $hour < 19)
                echo "<h1>Добрый день!</h1>";

            if ($hour >= 19)
                echo "<h1>Добрый вечер!</h1>";

        ?>
    </body>
</html>
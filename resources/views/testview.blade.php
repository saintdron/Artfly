<html>
    <body>
        <h1>Здравствуйте!</h1>
        <pre><?php
            error_reporting(E_ALL);
            //Вычисляем текущий год в формате
            $dat = date("d.m.Y");
            //ауц
            $tm = date("h:i:s");

            echo "Текущая дата: $dat года<br>\n";
            echo "Текущее время: $tm<br>\n";

            for ($i = 0; $i <= 5; $i++) {
                echo '<li>$i в квадрате = ' . ($i * $i);
                echo ",&#9 $i в кубе = " . ($i * $i * $i) . "\n";
            }
            ?>
        </pre>
    </body>
</html>
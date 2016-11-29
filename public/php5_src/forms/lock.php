<html>
    <body>
        <?php
        //ob_start();
        // if (!isset($_REQUEST['doGo']))
        if (isset($_REQUEST['doGo']) && @$_REQUEST['login'] == "root" && @$_REQUEST['password'] == "Z10N0101") {
            echo "Access is open for user \"" . @$_REQUEST[login] . "\"";
        } else {
            ?>

            <form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
                Login: <input type=text name="login" value="<?=@$_REQUEST[login]?>"><br>
                Pass: <input type=password name="password" value="<?=@$_REQUEST[password]?>"><br>
                <input type=submit name="doGo" value="Go">
            </form>
            <?php

        if (isset($_REQUEST['doGo'])) {
            echo "<br/>Login or password is not correct!";
        }}
        ?>
    </body>
</html>
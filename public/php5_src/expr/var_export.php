<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    </head>
    <body>
<?php ## Использование var_export().
class SomeClass {
  private $x = 100;
}
$a = array(1, array ("Programs hacking programs. Why?", "д'Артаньян"));
$b = 'dsfпар//\\!@##!$&#%&*(*()\'(';
echo "<pre>"; var_export($a); echo "</pre>";
echo $a[1][1];
$obj = new SomeClass();
echo "<pre>"; var_export($obj); echo "</pre>";
echo "<br>\n".htmlspecialchars($b);
echo "<br>\n$b";
echo "<pre>\x#9\x\r093425</br>42\n543</pre>";

echo "<br>\n";
$c=<<<EOD
Какой-то текст с <b>тегами</b> – этот пример не работает!
EOD;
echo strip_tags($c);

echo "<br>\n";
$st=`dir`;
echo "<pre>$st</pre>";
?>
</body>
</html>
<?php ## �������� ������� virtual().
if (!function_exists("virtual")) {
  // ������� ������������ �������
  function virtual($url) { 
    $script_name = $_SERVER['SCRIPT_NAME'];  
    $server = $_SERVER['HTTP_HOST']; // ����:����
    // ����������� ������������� URI � ����������.
    if ($url[0] != '/') {
      // ����� ������������ ���������� �������.
      $dir = str_replace("\\", "/", dirname($script_name));
      $url = substr($dir, -1)=="/"? $dir.$url : "$dir/$url";
    }
    // ��������� ����������.
    $f = @fopen("http://$server$url", "rb");
    if (!$f) { 
      echo "[an error ocurred while processing this directive: $url]";
      return false;
    }
    // ������ ������ ������ ��� � ������� � ������� echo.
    while (!feof($f)) echo fread($f, 10000);
    fclose($f);
    return true;
  }
}
# ������ �������������:
# echo "<hr><hr>";
# virtual("..");
# echo "<hr><hr>";
?>

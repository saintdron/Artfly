<?php ## ���������� ���������� � ������������ �������.
$imgDir = "img";        // ������� ��� �������� �����������
@mkdir($imgDir, 0777);  // �������, ���� ��� ��� ���

// ���������, ������ �� ������ ���������� ����������.
if (@$_REQUEST['doUpload']) {
  $data = $_FILES['file'];
  $tmp = $data['tmp_name'];
  // ���������, ������ �� ����.
  if (@file_exists($tmp)) {
    $info = @getimagesize($_FILES['file']['tmp_name']);
    // ���������, �������� �� ���� ������������.
    if (preg_match('{image/(.*)}is', $info['mime'], $p)) {
      // ��� ����� ������ �������� ������� � ��������, � 
      // ���������� - ��� ����� MIME-���� ����� "image/".
      $name = "$imgDir/".time().".".$p[1];
      // ��������� ���� � ������� � ������������.
      move_uploaded_file($tmp, $name);
    } else {
      echo "<h2>������� �������� ���� ������������� �������!</h2>";
    }
  } else {
    echo "<h2>������ ������� #{$data['error']}!</h2>";
  }
}

// ������ ��������� � ������ ��� ����������.
$photos = array();
foreach (glob("$imgDir/*") as $path) {
  $sz = getimagesize($path); // ������
  $tm = filemtime($path);    // ����� ����������
  // ��������� ����������� � ������ $photos.
  $photos[$tm] = array( 
    'time' => $tm,              // ����� ����������
    'name' => basename($path),  // ��� �����
    'url'  => $path,            // ��� URI   
    'w'    => $sz[0],           // ������ ��������
    'h'    => $sz[1],           // �� ������
    'wh'   => $sz[3]            // "width=xxx height=yyy"
  );
}
// ����� ������� $photos - ����� � ��������, ����� ���� ���������
// �� ��� ���� ����������. ��������� ������: �������� "������" 
// ���������� ����������� ����� � ��� ������.
krsort($photos);
// ������ ��� ������ ������. ���� �� ����� - �������� ��������.
?>

<body>
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
<input type="file" name="file"><br>
<input type="submit" name="doUpload" value="�������� ����� ����������">
<hr>
</form>
<?foreach($photos as $n=>$img) {?>
  <p><img 
   src="<?=$img['url']?>"
   <?=$img['wh']?> 
   alt="��������� <?=date("d.m.Y H:i:s", $img['time'])?>"
  >
<?}?>
</body>
<?php ## PHP ������������� ������� ���������� ����������.
if (@$_REQUEST['doUpload']) 
  echo '<pre>���������� $_FILES: '.print_r($_FILES, true)."</pre><hr>";
?>
�������� �����-������ ���� � ����� ����:
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
<input type="file" name="myFile">
<input type="submit" name="doUpload" value="��������">
</form>
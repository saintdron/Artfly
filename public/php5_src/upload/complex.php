<?php ## PHP ������������ � ������� ����� ����� �������.
if (@$_REQUEST['doUpload']) 
  echo '<pre>���������� $_FILES: '.print_r($_FILES, true)."</pre><hr>";
?>
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
<h3>�������� ��� ������ � ����� �������:</h3>
��������� ����: <input type=file name="input[a][text]"><br>
�������� ����: <input type=file name="input[a][bin]"><br>
<input type=submit name=doUpload value="��������� �����">
</form>

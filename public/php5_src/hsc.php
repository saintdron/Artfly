<?php ##Модель скрипта, принимающего текст от пользователя.
if (@S_REQUEST['text'])
   echo htmlspecialchars(S_REQUEST['text'])."<hr>";
?>
<form action="<?=S_SEVER['SCRIPT_NAME']?>" method="post">
<textarea name="text" cols="60" rows="10">
<?=@htmlspecialchars(S_REQUEST['text'])?>
</textarea><br>
<input type="submit">
</form>

<!-- РђР»СЊС‚РµСЂРЅР°С‚РёРІРЅС‹Р№ СЃРёРЅС‚Р°РєСЃРёСЃ if-else. -->
<?php if(isset($_REQUEST['go'])): ?>
  Привет, <?=$_REQUEST['name']?>!
<?php else: ?>
  <form action="<?=$_SERVER['REQUEST_URI']?>" method=post>
  Ваше имя: <input type=text name=name><br>
  <input type=submit name=go value="Отослать!">
<?php endif ?>

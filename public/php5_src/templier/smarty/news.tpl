{* ������ ��������. *}
<html>
<head><title>��������� �������</title></head>
<body>
<h1>��������� �������</h1>
<ul>
{foreach from="$news" item="n"}
  <li><b>{$n.date}</b> {$n.text}
{/foreach}
</body>
</html>

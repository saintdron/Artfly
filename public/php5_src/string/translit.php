<?php ## �������������� �����.
function transliterate($st) {
  $st = strtr($st, 
    "����������������������������������������������",
    "abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE"
  );
  $st = strtr($st, array(
    '�'=>"yo",    '�'=>"h",  '�'=>"ts",  '�'=>"ch", '�'=>"sh",  
    '�'=>"shch",  '�'=>'',   '�'=>'',    '�'=>"yu", '�'=>"ya",
    '�'=>"Yo",    '�'=>"H",  '�'=>"Ts",  '�'=>"Ch", '�'=>"Sh",
    '�'=>"Shch",  '�'=>'',   '�'=>'',    '�'=>"Yu", '�'=>"Ya",
  ));
  return $st;
}
echo transliterate("� ���� ���� ������, �� �� �����.");
?>
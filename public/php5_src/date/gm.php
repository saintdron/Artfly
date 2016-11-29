<?php ## ������ � �������� �� GMT.
// ��������� timestamp � ��������, ������� �������������
// ���������� timestamp-����������������.
function local2gm($localStamp=false) {
  if ($localStamp === false) $localStamp = time();
  // �������� �������� ������� ���� � ��������.
  $tzOffset = date("Z", $localStamp);
  // �������� ������� - �������� ����� �� GMT.
  return $localStamp - $tzOffset;
}

// ��������� ��������� timestamp � ��������, �������
// ������������� timestamp-��������������� �� GMT. ����� �������
// �������� ��������� ���� ������������ GMT (� �����),
// ����� ����� ����������� ������� � ��� ���� (� �� � ������� ���������).
// (� �� � ������� ���������).
function gm2local($gmStamp=false, $tzOffset=false) {
  if ($gmStamp === false) return time();
  // �������� �������� ������� ���� � ��������.
  if ($tzOffset === false)
    $tzOffset = date("Z", $gmStamp);
  else
    $tzOffset *= 60*60;
  // �������� ������� - �������� ����� �� GMT.
  return $gmStamp + $tzOffset;
}
?>
<?php
// ������� ��� ������� ����� �������, ����� SMTP-������ ����������.
// ���������� getmxrr(), ������� � Windows �� ��������������. 
function mailx_manual($mail, &$reason=false) {
  $reason = array();
  // �������� ��������� To.
  $to = "";
  if (preg_match('/^To:\s*([^\r\n]*)[\r\n]*/m', $mail, $p)) {
    $to = @$p[1]; // ���������
  }
  // ������� �������� ��� �����.
  if (!preg_match('/@([\w.-]*)/', $to, $pockets)) {
    $reason[] = "invalid e-mail address - $to: no host";
    return false;
  }
  $host = $pockets[1];
  // �� ��������� SMTP, ���� ��� �� ����� MX-������, �� � ��������
  // ��������� ������� ��������� ��� ����.
  if (!getmxrr($host, $mxes, &$weights)) {
    $mxes = array($host);
  }
  // ���������� �� ���� MX-�������. ��� �������� ���� �� 
  // ��������� - ������� ���� �� ����� �� �����.
  foreach ($mxes as $mx) {
    $result = socketmail($mx, $mail, $r);
    $reason = array_merge($reason, $r);        
    // ���� ������ ��������, ��� �������.
    if ($result) return true;
  }
  $reason[] = "could not connect to any of (".join(", ", $mxes).")";
  return false;
}

// ������� ��������� ���������� � SMTP-�������� $host
// � �������� ��������� ����� ���� ������, �������� � $mails.
// ��� ������ ������������� � �������������� ���������� $reason
// � ���� ������ �����. � ������, ���� �������� ���� �����
// ������ �������, ������� ���������� true, ����� - false.
// ������ ������ � $mails ������ ���� ������������ � �������:
// "���������\r\n\r\n����". ������� �� ��������� � ����������
// ����������� ����������, �����������, ��� ��� ��� ���� 
// ������� �����.
function socketmail($host, $mails, &$reason=false) { 
  // ��������� ���������� � �������� ��������.
  $reason = array();
  $f = @fsockopen($host, 25, $errno, $errstr, 30);
  if (!$f) {
    $reason[] = "could not open $host:25"; 
    return false;
  }
  $answer = fgets($f, 1024); 

  // ������������� � ������ ������ �������.
  fputs($f, "HELO {$_SERVER['SERVER_NAME']}\r\n"); 
  $answer = fgets($f, 1024); 

  // ���������� ��� ������ ��� ����� ������� � �����.
  // ��� ��� ���������� �� ���� ���������� � ��������.
  if (!is_array($mails)) $mails = array($mails);
  foreach ($mails as $i=>$data) { 
    // �������� ��������� � ���� ���������.
    list ($headers, $body) = preg_split('/\r?\n\r?\n/', $data, 2);
    // �������� ��������� From.
    if (!preg_match('/^From:\s*(.*)/mi', $headers, $pockets)) {
      $reason[] = "could not find required From: header in mail #$i";
      continue;
    }
    $from = getEmail($pockets[1]);    
    if (!$from) {
      $reason[] = "no email in From: header in mail #$i";
      continue;
    }
    // �������� ��������� To.
    if (!preg_match('/^To:\s*(.*)/mi', $headers, $pockets)) {
      $reason[] = "could not find required To: header in mail #$i";
      continue;
    }
    $to = getEmail($pockets[1]);
    if (!$to) {
      $reason[] = "no email in To: header in mail #$i";
      continue;
    }
    // �.�. ����� � ��������� SMTP ��������������� � ����� ������,
    // (��. ����), �� �� ���������.
    $data = preg_replace("/\n\./", "\n..", $data);
    // ���������� ����������� ������� SMTP.
    do {
      if (!smtp_say($f, "MAIL FROM: <$from>", $reason)) break; 
      if (!smtp_say($f, "RCPT TO: <$to>", $reason)) break; 
      if (!smtp_say($f, "DATA", $reason)) break;  
      // �������� ������.
      fputs($f, trim($data)."\r\n");
      if (!smtp_say($f, ".", $reason)) break;  
    } while (false);
    // ����� ������.
    !smtp_say($f, "RSET", $reason);
  } 

  // ������� ������� �� ��������� ������.
  @smtp_say($f, "QUIT", $reason);
  fclose($f); 
  return !count($reason);
}

function smtp_say($f, $cmd, &$reason) {
  fputs($f, "$cmd\r\n"); 
  $answer = fgets($f, 1024); 
#  echo "&gt; $cmd<br>&lt; $answer<br>";
  if (!preg_match('/^(250|354|221)/', $answer)) { $reason[] = "$answer"; return; }
  return true;
}

// ��������� ������ ����� E-mail �� ��������� To ��� From.
// ��������: ���������� ������!
function getEmail($header) {
  if (!preg_match('/([\w.-]+@[\w.-]+)/s', $header, $p)) return;
  return $p[1];
}

?>
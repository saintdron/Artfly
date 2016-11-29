<?php ## ������ ������ ������� ��������� ������
$xml="<root><child11/><child2/></root1>";
$dom=new domDocument();
$old_error_handler=set_error_handler('domerrorhandler');
$ret=$dom->loadXML($xml);
echo $dom->saveXML();

/**
 * ���������� ������� ��������� ������
 *
 * @param int $errno ����� ������
 * @param string $errstr �������� ������
 * @param string $errfile ����, ��� ��������� ������
 * @param int $����� ��������� ������
 */
function domerrorhandler($errno, $errstr, $errfile, $errline)
{
    $mes="\r\n������ �������� ���������.
    ����: $errfile.
    ������: $errline.
    ���:$errno
    ������:\r\n $errstr";
    throw new Exception($mes);
}


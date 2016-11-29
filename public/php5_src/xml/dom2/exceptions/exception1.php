<?php ## �������� ���������� � ������ ������������� ������
$dom=new domDocument();
$root=new domElement('root');
try {   //�������� ��������� � ��������
    appendattrs($root,Array('id'=>1,'name'=>'first'));
} catch(domException $exception) {
    //���� �������� �������������� ��������
    print_r($exception);//���������� ��������� ������
    if ($exception->code==DOM_NO_MODIFICATION_ALLOWED_ERR) {
	//���� ������� �� ����� ���������
	$dom->appendChild($root);//�������� ��� � ���������
	//� ���������� �������� �� ���������
	appendattrs($root,Array('id'=>0,'name'=>'default'));
    } else //������ ������ ���������� ����������
	throw($exception);
}
echo $dom->saveXML();

/**
 * �������� ��������� �������� � ��������.
 *
 * @param domElement $element �������������� �������
 * @param array $attr ������������� ������ �������� ���������
 */
function appendattrs($element,$attrs)
{
    foreach($attrs as $name => $value) {//��� ���� ��������� �������
	//���������� ��������� �������
	$element->setAttribute($name,$value);
    }
}
?>

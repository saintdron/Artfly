<?php ## ��������� showns.php ����������� �������� ������
      ##  �������� ���� � ���������
require_once 'unicode.inc';
$document=new domDocument('1.0',Encoding);
$document->load('multins.xml'); //��������� ��������
$namespaces=Array();    //������ ����������� �������� ����
$prefixes=Array();      //������ ����������� ���������
showns($document->documentElement);//����������������
$document->formatOutput=true;
echo $document->saveXML();//������� ���������� ��������

/**
 * �� ���� ������ ��������� ����� ���������� �����
 * ����������� ��������� � �������� ����.
 * ������� ���������� ����������.
 *
 * @param domNode $node ��������� ����
 */
function showns($node)
{
    //������� ����������� �������� ���� � ���������
    global $namespaces,$prefixes;
    if ($node->nodeType==XML_ELEMENT_NODE){//���� �������� ���������?
	$namespace=$node->namespaceURI;//���������� ��� ������� ����
	if ($namespace) //���� ������� ���� ������� - ��������� ��
	    $namespaces[$namespace]=@$namespaces[$namespace]+1;
	$prefix=$node->prefix;//���������� ������� ��������
	if ($prefix) //���� ������� ������ - ��������� ���
	    $prefixes[$prefix]=@$prefixes[$prefix]+1;
	if ($node->hasChildNodes()){//���� ���� �������� ��������
	    //�������� �� ���
	    for ($child=$node->firstChild;$child;) {
		$nextchild=$child->nextSibling;
		showns($child);
		$child=$nextchild;
	    }
	}
    } elseif ($node->nodeType==XML_TEXT_NODE && //������ ��������� ����
	    $node===$node->parentNode->firstChild) {
	$Prefixes=$prefixes;//����������� ������� ������ ���������
	$data="\r\n";
	foreach($namespaces as $namespace => $count) {
	    //�������� �� ����������� �������� ����
	    if ($node->isDefaultNamespace($namespace))
		{   //������� ���� �� ���������
		$prefix='DEFAULT';  //������� �� DEFAULT
	    } else //������� ���� �� �� ��������� - ��������� �� �������
		$prefix=$node->lookupPrefix($namespace);
	    if ($prefix) //���� ������� ����?
		unset($Prefixes[$prefix]);//������� ��� �� Prefixes
	    else //������� ���� �� ������� � ���������
		$prefix='UNKNOWN';  //������� ���� ��������
	    //�������� � ������ �������� ������� ����
	    $data.="\t\t$prefix == $namespace\r\n";
	}
	//� Prefixes �������� ��������, �� ��������� �� ������������
	//��������� ����
	foreach($Prefixes as $prefix => $count) {
	    //���������� ������� ����, � ������� ������ �������
	    $namespace=$node->lookupNamespaceURI($prefix);
	    if (!$namespace) //������� �������?
		$namespace='UNKNOWN';
	    //�������� � ������ �������� ��������
	    $data.="\t\t$prefix == $namespace\r\n";
	}
	//��������� ����� ���� �������������� �������
	// �������� ���� � ���������
	$node->data=$data;
    } else {
	//��������� ���� (�� �������� � �� ������ ��������� ����) �������
	$node->parentNode->removeChild($node);
    }
}

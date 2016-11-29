<?php ## ������� ������� � ��������� ���� � ���� DocType
/**
 * ����� �������� �������
 *
 * @param domDocument $dom XML-��������
 *
 * @return domNode �������� ������� XML-���������
 */
function getroot($dom)
{
    $children=$dom->childNodes;
    foreach ($children as $child) {
	if ($child->nodeType==XML_ELEMENT_NODE)
	    return $child;
    }
    return NULL;
}

/**
 * ����� ��������� DTD
 *
 * @param domDocument $dom XML-��������
 *
 * @return domNode �������� ������� XML-���������
 */
function getDTD($dom)
{
    $children=$dom->childNodes;
    foreach ($children as $child) {
	if ($child->nodeType==XML_DOCUMENT_TYPE_NODE)
	    return $child;
    }
    return NULL;
}
?>

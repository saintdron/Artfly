<?xml version='1.0' encoding='WINDOWS-1251'?>
<xsl:stylesheet version='1.0'
     xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

    <!-- �������� ��������� n ��-��������� -->
    <xsl:param name='n'>0</xsl:param>
    <xsl:template name='song' match='�����'>
	<h2>����� N<xsl:value-of select='$n'/>:
	    <xsl:value-of select='./@��������'/></h2>
	<table>
	    <xsl:for-each select="������">
		<tr>
		    <th align='right' valign='top'>������</th>
		    <td><xsl:apply-templates select="."/></td>
		 </tr>
		<tr>
		    <th align='right' valign='top'>������</th>
		    <td><xsl:apply-templates select="../������"/></td>
		 </tr>
	    </xsl:for-each>
	    <tr>
		<th align='right' valign='top'>�����</th>
		<td><xsl:call-template name='final'/></td>
	    </tr>
	</table>
    </xsl:template>
</xsl:stylesheet>

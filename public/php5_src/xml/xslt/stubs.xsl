<?xml version='1.0' encoding='WINDOWS-1251'?>
<!-- XSLT-���� �������� ������������ �������� -->
<xsl:stylesheet version='1.0'
     xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

    <!-- ������� 1-�� ������ -->
    <xsl:template name='song' match='�����'>
	<div class='stub'>
	    ���������� ����� "<xsl:value-of select='./@��������'/>"
	</div>
    </xsl:template>

    <!-- ������� 2-�� ������ -->
    <xsl:template match='������'>
	<div class='stub'>���������� �������</div>
    </xsl:template>

    <xsl:template match='������'>
	<div class='stub'>���������� �������</div>
    </xsl:template>

    <xsl:template name='final'>
	<div class='stub'>���������� ���������</div>
    </xsl:template>

    <!-- ������� 3-�� ������ -->
    <xsl:template match='������'>
	<div class='stub'>���������� ������</div>
    </xsl:template>

    <xsl:template match='������'>
	<div class='stub'>���������� �������</div>
    </xsl:template>

</xsl:stylesheet>

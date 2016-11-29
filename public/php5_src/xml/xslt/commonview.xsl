<?xml version='1.0' encoding='...'?>
<xsl:stylesheet version = '1.0'
     xmlns:xsl='http://www.w3.org/1999/XSL/Transform'
     ...
     >
    <!-- ����������� ������� ������ -->
    <xsl:output  method="..." encoding="..." indent="..."/>
    <xsl:strip-space elements="..."/>
    <xsl:preserve-space elements="..."/>
    <xsl:decimal-format name="..."/>

    <!-- �������� ������� ������ -->
    <xsl:include href="..."/>
    <xsl:import href="..."/>

    <!-- ����������� ��������� � ���������� -->
    <xsl:param name='...'>...</xsl:param>
    <xsl:variable name="...">...</xsl:variable>

    <!-- �������� �������� -->
    <xsl:template match='/'>  <!-- 1-� ������-->
	<!-- �������� ��������-->
	<xsl:apply-templates select="..."/>
	<!-- �������� ��������-->
	<xsl:apply-templates select="..."/>
	 ...
    </xsl:template>

    <xsl:template match='...'><!-- 2-� ������-->
	<!-- �������� ��������-->
	 ...
    </xsl:template>

    <xsl:template name="..."> <!-- 3-� ������-->
	<!-- �������� ��������-->
	 ...
    </xsl:template>

    <!-- ... -->  <!-- 4-� ������-->

</xsl:stylesheet>

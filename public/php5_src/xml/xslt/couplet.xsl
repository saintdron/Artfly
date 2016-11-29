<?xml version='1.0' encoding='WINDOWS-1251'?>
<xsl:stylesheet version='1.0'
     xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

    <!-- ��������� ������� � �������� -->
    <xsl:template match='������[../������]'>
      <div class='couplet'>
	<xsl:for-each select ="./������">
	    <xsl:apply-templates select="������" />
	    <xsl:apply-templates select="../../������[1]" />
	<xsl:if test="position()!=last()"><br/></xsl:if>
	</xsl:for-each>
      </div>
    </xsl:template>

    <!-- ��������� �������� ������� -->
    <xsl:template match='������'>
      <div class='couplet'>
	<xsl:apply-templates select="������" />
      </div>
    </xsl:template>

</xsl:stylesheet>

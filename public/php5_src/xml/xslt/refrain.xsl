<?xml version='1.0' encoding='WINDOWS-1251'?>
<xsl:stylesheet version = '1.0'
     xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>

    <!-- ��������� ������� � �������� -->
    <xsl:template match='������[../������]'>
      <div class='refrain'>
	<xsl:apply-templates select="������" />
	<xsl:apply-templates select="������[1]" />
	<xsl:apply-templates select="������[1]" />
      </div>
    </xsl:template>

    <!-- ��������� �������� ������� -->
    <xsl:template match='������'>
      <div class='refrain'>
	<xsl:apply-templates select="������" />
      </div>
    </xsl:template>

</xsl:stylesheet>

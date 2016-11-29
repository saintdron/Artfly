<?xml version='1.0' encoding='WINDOWS-1251'?>
<xsl:stylesheet version='1.0'
    xmlns:set="http://exslt.org/sets"
    extension-element-prefixes="set"
    xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>
    <xsl:output  method="xml" encoding="WINDOWS-1251" indent="yes"/>

    <xsl:variable name="src"
		  select="//*[@src]" />

    <xsl:variable name="width"
		  select="//*[@width]" />

    <xsl:template match="/">
       <out>
	    <div>
����, ������� ������� src:
		<xsl:for-each select="$src">
		   <xsl:call-template name='showlist'/>
		</xsl:for-each>
	    </div>
	    <div>
����, ������� ������� width:
		<xsl:for-each select="$width">
		   <xsl:call-template name='showlist'/>
		</xsl:for-each>
	    </div>
	    <div>
����, ������� �������� src � width:
		<xsl:for-each select="set:intersection($src, $width)">
		   <xsl:call-template name='showlist'/>
		</xsl:for-each>
	    </div>
	    <div>
����, ������� ������� src, �� �� ������� �������� width:
		<xsl:for-each select="set:difference($src, $width)">
		   <xsl:call-template name='showlist'/>
		</xsl:for-each>
	    </div>
	    <div>
����, ������� ������� width, �� �� ������� �������� src:
		<xsl:for-each select="set:difference($width, $src)">
		   <xsl:call-template name='showlist'/>
		</xsl:for-each>
	    </div>
	</out>
    </xsl:template>

    <xsl:template name="showlist">
	 <xsl:value-of select="name()" />
	 <xsl:if test="position()!=last()">,</xsl:if>
    </xsl:template>

</xsl:stylesheet>

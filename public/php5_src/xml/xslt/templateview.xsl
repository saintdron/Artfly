<xsl:template match='�����'>
    <!-- �������� -->
    <�������1 �������="��������" ...> �����
	<�������2 �������="��������" ...> �����
	    ...
	    <xsl:apply-templates select="�����"/>
	    ...
	</�������2>
	<xsl:call-template name="���">
	    <xsl:with-param name="...">...</xsl:with-param>
	    <xsl:with-param name="...">...</xsl:with-param>
	    ...
	</xsl:call-template>
	...
	<xsl:apply-templates select="�����">
	    <xsl:with-param name="...">...</xsl:with-param>
	    <xsl:with-param name="...">...</xsl:with-param>
	...
	</xsl:call-templates>
    </�������1>
    ...

<?xml version="1.0" encoding="ISO-8859-15"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	exclude-result-prefixes="xsl dc">

	<xsl:output method="xml" encoding="ISO-8859-15" cdata-section-elements="script" indent="yes"/> 
  		
	<xsl:template name="affCommentFaireSi">
		<xsl:if test="count(CommentFaireSi) > 0">
			<div class="spPublicationCFS block" id="sp-comment-faire">
				<h3>
					<xsl:call-template name="imageOfAPartie">
						<xsl:with-param name="nom">comment-faire</xsl:with-param>
					</xsl:call-template>
					<xsl:value-of select="$TEXTE_CFS"/>
				</h3>
				<ul class="spPublicationCFS">
					<xsl:apply-templates select="CommentFaireSi"/>
					<xsl:call-template name="lienVersAccueilCommentFaireSi"/>
				</ul>
			</div>
		</xsl:if>
	</xsl:template>

	<xsl:template match="CommentFaireSi">
		<xsl:variable name="title">
			<xsl:value-of select="../dc:title"/>
			<xsl:value-of select="$sepFilDAriane"/>
			<xsl:value-of select="$TEXTE_CFS"/>
			<xsl:value-of select="$sepFilDAriane"/>
			<xsl:value-of select="text()"/>
		</xsl:variable>
		<xsl:variable name="class">
			<xsl:text>spPublicationNoeud spPublicationDFT</xsl:text>
			<xsl:if test="position() = 1">
				<xsl:text> spPublicationDFTFirst</xsl:text>
			</xsl:if>
		</xsl:variable>
		<li class="{$class}">
    			<xsl:call-template name="getPublicationLink">
    				<xsl:with-param name="href"><xsl:value-of select="@ID"/></xsl:with-param>
    				<xsl:with-param name="title"><xsl:value-of select="$title"/></xsl:with-param>
    				<xsl:with-param name="text"><xsl:value-of select="text()"/></xsl:with-param>
				</xsl:call-template>
		</li>
	</xsl:template>
	
	<xsl:template name="lienVersAccueilCommentFaireSi">
		<xsl:variable name="file">
			<xsl:value-of select="$XML_COURANT"/>
			<xsl:value-of select="$ACCUEIL_CFS"/>
		</xsl:variable>
		
		<li class="spPublicationNoeud spPublicationDFT spPublicationDFTLast">
			<a>
    			<xsl:call-template name="getPublicationLink">
    				<xsl:with-param name="href">
    					<xsl:value-of select="$ACCUEIL_CFS"/>
    				</xsl:with-param>
    				<xsl:with-param name="title">Comment Faire si ?</xsl:with-param>
    				<xsl:with-param name="text"> plus </xsl:with-param>
				</xsl:call-template>
			</a>
		</li>
	</xsl:template>

</xsl:stylesheet>

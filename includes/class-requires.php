<?php
/*
comarquage
License : emendo.fr
Date : 25/11/2015
Author : Sebastien BOURSIER / EMENDO
Version : 0.1
*/

class comarquage_requires {
	
	var $upload_dir;

	function __construct() {
		
		// Get the upload dir
		$uploads = wp_upload_dir();
		$this->upload_dir = $uploads['basedir'];
		
	}
	
	// ------------------------------------------- Help for debug
	public function get_phpvalue($value_name) {
		
		// Get current php value
		$current_value = ini_get($value_name);
		
		// Return info
		$test = $value_name . ' : ';
		$test .= $current_value . '<br>';

	    return $test;
    }
    
    public function get_defined($value_name) {
    	
    	if(!defined($value_name)) $current_value = 'NOT DEFINED';
		else $current_value = constant($value_name);
		
		if(empty($current_value)) $current_value = '0';
		
		// Return info
		$test = $value_name . ' : ';
		$test .= $current_value . '<br>';
		return $test;
	}
	
	// Display plugin requires
	public function display(){
		
		if ( !current_user_can( 'manage_options' ) ) return;
		
	    $html = '<div contenteditable="true" style="padding:1%; margin:10px 0; background-color:#FFF; border:1px solid #ddd; width:98%; height:200px; overflow-y:scroll;">';
	    
	    $html .= '<p style="margin-bottom:0px;"><strong><u>1) SERVEUR</u></strong></p>';
		if(function_exists('apache_get_version')) $html .= 'serveur web : ' . apache_get_version() . '<br>';
	    $html .= 'SERVER_NAME : ' . $_SERVER['SERVER_NAME'] . '<br>';
	    $html .= 'SERVER_SOFTWARE : ' . $_SERVER['SERVER_SOFTWARE'] . '<br>';
	    $html .= 'SERVER_PROTOCOL : ' . $_SERVER['SERVER_PROTOCOL'] . '<br>';
	    
	    $html .= '<br><p style="margin-bottom:0px;"><strong><u>2) PHP</u></strong></p>';
	    
		$html .= 'version de PHP : ' . phpversion() . '<br>';
		$html .= $this->get_phpvalue('memory_limit');
	    $html .= $this->get_phpvalue('max_execution_time');
	    $html .= '<br><u>extensions : </u><br>';
		$html .= 'xml : ' . extension_loaded('xml') . '<br>';
		$html .= 'xmlreader : ' . extension_loaded('xmlreader') . '<br>';
		$html .= 'simplexml : ' . extension_loaded('SimpleXML') . '<br>';
		$html .= 'libxml : ' . extension_loaded('libxml') . '<br>';
		$html .= 'xsl : ' . extension_loaded('xsl') . '<br>';
		
		$html .= '<br><p style="margin-bottom:0px;"><strong><u>3) WORDPRESS</u></strong></p>';
		$html .= $this->get_defined('WP_SITEURL');
		$html .= $this->get_defined('WP_HOME');
	    $html .= $this->get_defined('ABSPATH');
	    $html .= $this->get_defined('UPLOADS');
		$html .= $this->get_defined('WP_TEMP_DIR');
		$html .= $this->get_defined('WP_DEBUG');
		$html .= $this->get_defined('WP_DEBUG_DISPLAY');
		$html .= $this->get_defined('SCRIPT_DEBUG');
	    $html .= $this->get_defined('WP_NETWORK_ADMIN');
	    $html .= $this->get_defined('WP_CACHE');
	    $html .= $this->get_defined('WP_MEMORY_LIMIT');
		$html .= $this->get_defined('WP_PLUGIN_DIR');
		$html .= $this->get_defined('ALTERNATE_WP_CRON');
	   
		$html .= '<br><u>plugin comarquage : </u><br>';
		$html .= $this->get_defined('COMARQUAGE_VERSION');
		$html .= $this->get_defined('COMARQUAGE_DIR');
		$html .= $this->get_defined('COMARQUAGE_INCLUDES');
		$html .= $this->get_defined('COMARQUAGE_ADMIN');
		
	    $html .= '<br></div>';
	    
		echo $html;		
	}
	
	// ------------------------------------------- Install check requirement	
	public function br_trigger_error($message, $errno) {
	    if(isset($_GET['action']) && $_GET['action'] == 'error_scrape') {
	        echo '<strong>Co-marquage : </strong> ' . $message;
	        exit;
	    } else {
	        trigger_error($message, $errno);
	    }
	}
	
	// Install check requirement. Stop the plugin activation when there's not the requires 
	public function install_check(){
		
		// Check PHP extensions and functionnality
		if(!ini_get('allow_url_fopen')) $this->br_trigger_error('PHP n\'est pas configurer pour la gestion de fichier. Modifier votre configuration PHP : allow_url_fopen', E_USER_ERROR);
		if(!extension_loaded('xml')) $this->br_trigger_error('L\'extension PHP suivante est manquante : xml', E_USER_ERROR);
		if(!extension_loaded('libxml')) $this->br_trigger_error('L\'extension PHP suivante est manquante : libxml', E_USER_ERROR);
		if(!extension_loaded('simplexml')) $this->br_trigger_error('L\'extension PHP suivante est manquante : simplexml', E_USER_ERROR);
		if(!extension_loaded('xsl')) $this->br_trigger_error('L\'extension PHP suivante est manquante : xsl', E_USER_ERROR);
		
		// FileSystem Check
		if(!is_writable($this->upload_dir)) $this->br_trigger_error('Impossible d\'&eacute;crire dans le repertoire : ' . $this->upload_dir, E_USER_ERROR);
	}
	

	
	
}
<?php
/*
Plugin Name: Comarquage service-public.fr
Plugin URI: http://www.emendo.fr
Description: Affichage des informations de service-public.fr dans votre site Internet. Flux du comarquage : v2.3. Shortcodes : [comarquage category="part/pro/asso"] 
Version: 0.4.0
Author: EMENDO
Author URI: http://www.emendo.fr
Requires at least: 3.9
Tested up to: 4.3.1
License: GPL v3

@package Comarquage
@category Core
@author EMENDO
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* -------------------------------------------------------------------------------------------------------------- 

			MAIN CLASS - PLUGIN COMARQUAGE

----------------------------------------------------------------------------------------------------------------- */
if ( !class_exists( 'emendo_comarquage' ) ) {

	class emendo_comarquage {
		
		// ------------------------------------ Constructor
		function __construct() {
				
			// Start a PHP session, if not yet started
			if ( ! session_id() ) session_start();
	
			add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 ); // Set Constants
			add_action( 'plugins_loaded', array( &$this, 'includes' ), 2); // Load Functions
			
			add_action( 'init', array( &$this, 'init' ), 0 );
			
			add_action( 'comarquage_daily_xml_update', array( &$this, 'comarquage_xml_update'), 10);
			
			register_activation_hook(__FILE__, array('emendo_comarquage', 'activate'));  // Activate the plugin
			register_deactivation_hook(__FILE__, array('emendo_comarquage', 'desactivate'));
			
			// Load Options
			if ( ! class_exists( 'EMENDO_Comarquage_Options' ) ) {
				require_once 'admin/class-options.php';
				new EMENDO_Comarquage_Options;
			}
			
			// Load Class Comarquage
			if ( ! class_exists( 'comarquage' ) ) require_once 'includes/class-comarquage.php';
			
			// Load Class Comarquage
			if ( ! class_exists( 'comarquage_requires' ) ) require_once 'includes/class-requires.php';
			
		}
		
		
		// ------------------------------------ Constants
		function constants() {
			
			define( 'COMARQUAGE_VERSION','0.4.0');
			define( 'COMARQUAGE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) ); // Plugin Directory
			define( 'COMARQUAGE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) ); // Plugin URL
			define( 'COMARQUAGE_INCLUDES', COMARQUAGE_DIR . trailingslashit( 'includes' ) ); // Path to include dir
			define( 'COMARQUAGE_ADMIN', COMARQUAGE_DIR . trailingslashit( 'admin' ) ); // Path to admin dir
			define( 'COMARQUAGE_ASSETS', COMARQUAGE_DIR . trailingslashit( 'assets' ) ); // Path to assets dir
		}

		// ------------------------------------ Include
		function includes() {
			require_once( COMARQUAGE_INCLUDES . 'shortcodes.php' ); // Load shortcodes
		}
		
		// ------------------------------------ Init
		function init() {
			require_once( COMARQUAGE_INCLUDES . 'scripts.php' ); // Load custom scripts in frontend
		}


		// ------------------------------------ Activate / Desactivate the plugin
		public static function activate() {
			
			// Check Requires before activate
			$requires = new comarquage_requires();
			$requires->install_check();
			
			// Setup plugin default options
			EMENDO_Comarquage_Options::setup_default_options(); 
						
			// Scheduled XML Update and Run it now
			wp_schedule_event( time(), 'daily', 'comarquage_daily_xml_update' );		
		}

		public static function desactivate() {
			
			// Delete XML Update Schedule
			wp_clear_scheduled_hook( 'comarquage_daily_xml_update' ); 
		
		}
		
		
		// ------------------------------------ Comarquage XML Update
		
		// Daily update
		public static function comarquage_xml_update() {
			if ( ! class_exists( 'comarquage' ) ) require_once 'includes/class-comarquage.php';
			$comarquage = new comarquage(null);
			$comarquage->update_xml();
		}
		
		// Update on demand (Use for force the update)
		public static function comarquage_xml_update_now() {
			if ( ! class_exists( 'comarquage' ) ) require_once 'includes/class-comarquage.php';
			$comarquage = new comarquage(null);
			$comarquage->update_xml(true);
			$comarquage->the_error();
		}
		
		
		
	}

	// Init the class
	if(class_exists('emendo_comarquage')) new emendo_comarquage();

}
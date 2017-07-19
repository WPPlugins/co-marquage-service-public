<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

function comarquage_delete_plugin() {

	// Delete XML
	// $upload_dir = wp_upload_dir();
	// $upload_dir['basedir'] . '/comarquage/';

	// Delete plugin Options
	delete_option( 'emendo-comarquage' );

}
comarquage_delete_plugin();
?>
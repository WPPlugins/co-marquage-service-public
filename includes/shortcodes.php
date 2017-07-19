<?php
function comarquage( $atts ) {

	 // ------------ Extract shortcode atts
	extract(shortcode_atts(array(
		'category' 	=> 'part'
	), $atts));

  	ob_start();
  	
	$comarquage = new comarquage($category);
  	?>
	
	<div id="comarquage" class="comarquage espace-<?php echo $category; ?>">
		<?php $comarquage->display(); ?>
	</div>
	
	<?php
	return ob_get_clean();
	
}
add_shortcode('comarquage', 'comarquage');
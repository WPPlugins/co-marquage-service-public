<?php if(!current_user_can('manage_options')) wp_die(__('You do not have sufficient permissions to access this page.')); ?>

<div class="wrap" id="emendo-slider-page">
    
    <h2 style="margin-bottom:20px;">Co-marquage avec service-public.fr : R&eacute;glages</h2>

	<?php
	
	// Update XML 
	if( isset($_POST['action']) && $_POST['action'] == 'comarquage-xml-update') {

		emendo_comarquage::comarquage_xml_update_now();
		
		global $comarquage_error;
		if (  1 > count( $comarquage_error->get_error_messages() ) ) { // There's no error
			echo '<div class="updated notice is-dismissible"><p> La derni&egrave;re version des donn&eacute;es de service-public.fr est t&eacute;lecharg&eacute;e.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ne pas tenir compte de ce message.</span></button></div>';
		}
    }
    
    // Setting update
    if(!empty($_GET['settings-updated'])) {
		echo '<div class="updated notice is-dismissible"><p>Vos r&eacute;glages sont sauvegard&eacute;s</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ne pas tenir compte de ce message.</span></button></div>';
	}
	
	
	// Get Plugin options
	$options = EMENDO_Comarquage_Options::get_all_options(); 
	$update_time_part = !empty($options->comarquage_update_time['part']) ? $options->comarquage_update_time['part'] : '';
	$update_time_pro = !empty($options->comarquage_update_time['pro']) ? $options->comarquage_update_time['pro'] : '';
	$update_time_asso = !empty($options->comarquage_update_time['asso']) ? $options->comarquage_update_time['asso'] : '';

	?> 
	
	
    <h2 class="nav-tab-wrapper" style="margin:10px 0 30px;">
    	<a href="#emendo-comarquage-tab-general" class="nav-tab nav-tab-active">Comarquage</a>
    	<a href="#emendo-comarquage-tab-options" class="nav-tab">Options du Plugin</a>
    	<a href="#emendo-comarquage-tab-debug" class="nav-tab">Support</a>
    </h2>
    
    <form method="post" action="options.php">
    
        <?php @settings_fields('emendo-comarquage'); ?>
        
		<input type="hidden" name="comarquage_update_time[part]" value="<?php echo $update_time_part; ?>">
        <input type="hidden" name="comarquage_update_time[pro]" value="<?php echo $update_time_pro; ?>">
        <input type="hidden" name="comarquage_update_time[asso]" value="<?php echo $update_time_asso; ?>">        
        
		<div class="tab-content" id="emendo-comarquage-tab-general">

			<table class="form-table">

				<tr valign="top">
		            <th scope="row">1) Afficher les informations de service-public.fr</th>
		            <td>
			            <p>Le plugin comarquage permet d'afficher sur votre site Internet les informations provenant de <a href="http://www.service-public.fr" target="_blank">service-public.fr</a>.</p>
			            <p>&nbsp;</p>
			        	<p><u>Ajouter l'un des shortcodes suivant dans une page :</u></p>
			            <p>Pour le guide des d&eacute;marches &agrave; destination des particuliers : [comarquage category="part"]   </p>
			            <p>Pour le guide des d&eacute;marches &agrave; destination des entreprises : [comarquage category="pro"]   </p>
			            <p>Pour le guide des d&eacute;marches &agrave; destination des associations : [comarquage category="asso"]   </p>
			        </td>
		        </tr>

	        	<tr valign="top">
		            <th scope="row">2) Etablissements locaux</th>
		            <td>
			            <fieldset>
				            <p>L'activation des informations locales permet d'associer les d&eacute;marches aux &eacute;tablissements locaux (correspondant au code INSEE choisi). </p><p class="description">Mairie, Service des Imp&ocirc;ts, Tribunal de commerce, ... </p>
				            <p>&nbsp;</p>
				            <p>
			            	<label for="comarquage_global_pivot_enable"><input name="comarquage_global_pivot_enable" type="checkbox" id="comarquage_global_pivot_enable" value="1" <?php checked( 1, get_option( 'comarquage_global_pivot_enable' ) ); ?>> Activer les informations locales</label></p>
			            	
			            	<div id="info-locale" style="display:inline-block; float: left; padding:20px; background:#fff; border:1px solid #ddd;" class="pivot-close">
				            	
				            	<p>
					            	<label for="comarquage_global_departement">D&eacute;partement :
					               	<select name="comarquage_global_departement" id="comarquage_global_departement">
								   	<?php
									if (empty($options->comarquage_global_departement)) echo '<option value=""> Choisir un d&eacute;partement</option>';
									include COMARQUAGE_ASSETS . 'insee/code_departements.php';					            
						            foreach($code_departements as $code => $name ) {
							            $selected = ($code == $options->comarquage_global_departement) ? 'selected' : '';
							            echo '<option value="' . $code . '" ' . $selected . '>' . $code . ' - ' . $name . '</option>';
						            } ?>
					               	</select>
				               	</p>
				               	
				            	<p><label for="comarquage_global_code_insee">Code INSEE :
				               	<input name="comarquage_global_code_insee" type="text" id="comarquage_global_code_insee" value="<?php echo $options->comarquage_global_code_insee; ?>" class="regular-text"> (ex: 77491) </label> </p>
							   	<p style="float:right; margin-top:10px;"><a href="http://www.insee.fr/fr/methodes/nomenclatures/cog/" target="_blank"> Liste des codes g&eacute;ographiques INSEE </a></p>

			            	</div>
			            </fieldset>
		            </td>
		        </tr>

				<tr valign="top">
		            <th scope="row"> 3) Vérifier les coordonnées </th>
		            <td>
			        <p> Les coordonnées des &eacute;tablissements sont enregistrées sur l'annuaire des services public. </p>

			        <p> Vérifier et modifier les coordonnées d'une Mairie en allant sur : <a href="http://lannuaire.service-public.fr" target="_blank"> Annuaire de l'administration </a></p><p>Une fois sur la page correspondant &agrave; l'&eacute;tablissement, demandez la modification des coordonnées en cliquant sur "Faire une suggestion sur cette fiche".</p><br>
			        
			        </td>
		        </tr>

		        <tr valign="top">
		            <th scope="row">4) Proposer des démarches en ligne </th>
		            <td>
			        
			        	<p> Si vous souhaitez que votre collectivit&eacute; propose des d&eacute;marches en ligne &agrave; travers le site <a href="https://mon.service-public.fr/" target="_blank">mon.service-public.fr</a></p>
						<p class="description"> ex : Acte de naissance, acte de mariage, carte nationale d'identit&eacute;, ... </p>
						<p>Veuillez-vous rendre sur le site : <a href="http://telechargement.modernisation.gouv.fr/EspaceDocumentaireMSP/" target="_blank">http://telechargement.modernisation.gouv.fr/EspaceDocumentaireMSP/</a> et demander le "Raccordement" de votre collectivit&eacute;.
			        </td>
		        </tr>

		        

			</table>
			
			<?php @submit_button(); ?>

		</div>
		
		<div class="tab-content ui-tabs-hide" id="emendo-comarquage-tab-options">
	        <table class="form-table">
		        <tr valign="top">
		            <th scope="row">Plugin options</th>
		            <td>
			            <fieldset>
			            	<label for="comarquage_global_css_enable"><input name="comarquage_global_css_enable" type="checkbox" id="comarquage_global_css_enable" value="1" <?php checked( 1, get_option( 'comarquage_global_css_enable' ) ); ?>> Utiliser le CSS du plugin</label><br>
			            	<label for="comarquage_global_poweredby"><input name="comarquage_global_poweredby" type="checkbox" id="comarquage_global_poweredby" value="1" <?php checked( 1, get_option( 'comarquage_global_poweredby' ) ); ?>> Afficher le lien "réalisation : emendo.fr" (Ce n'est pas une obligation mais c'est sympa)</label><br>
			            </fieldset>
		            </td>
		        </tr>
	        </table>
			<?php @submit_button(); ?>
		</div>
		
	</form>

		
	<div class="tab-content ui-tabs-hide" id="emendo-comarquage-tab-debug">
	    <table class="form-table">
	        <tr valign="top">
	            <td style="vertical-align:top;">
			        <h3> Donn&eacute;es issues de service-public.fr  </h3>
				    
				    <p> <u> Derni&egrave;re mise à jour des fichiers XML du comarquage : </u><p>
				    <p>particulier : <?php if(!empty($options->comarquage_update_time['part'])) echo date('Y-m-d H:i', $options->comarquage_update_time['part']); ?></p>
				    <p>professionnel : <?php if(!empty($options->comarquage_update_time['pro']))echo date('Y-m-d H:i', $options->comarquage_update_time['pro']); ?></p>
				    <p>association : <?php if(!empty($options->comarquage_update_time['asso']))echo date('Y-m-d H:i', $options->comarquage_update_time['asso']); ?></p>
				    <br>
				    <form method="post">
				    	<input type="hidden" name="action" value="comarquage-xml-update">
				    	<input type="submit" class="button" value="Mettre à jour les donn&eacute;es provenant de service-public.fr">
				    </form>
	            </td>
	            <td>
				    <div style="background:#fff; float:right; border:1px solid #ccc; max-width:350px;">
						<div style="background-color:#3498DB; padding: 20px 30px; text-align:center;">
							<p><img src="<?php echo COMARQUAGE_URI . '/assets/images/emendo-app.png'; ?>"></p>
						</div>
						<div style=" padding: 20px 30px;">
						    <h3 style="margin:0;"> Support Premium </h3>
						    <p> Si vous le souhaitez, emendo vous propose un <strong>support Premium</strong>, pour un accompagnement personnalis&eacute;.</p>
						    <p style="margin-top:20px;"><a target="_blank" href="http://www.emendo.fr/contact/#utm_source=wordpress-comarquage-config&amp;utm_medium=banner&amp;utm_campaign=reglages-page-banners" class="button-primary">
							Contacter emendo</a></p>
						    <!--
<p> Pour votre site Internet, emendo vous propose de souscrire à notre support du plugins comarquage. Plus de rapidité et une assistance personnalisée.</p>
							<p style="margin-top:20px;"><a target="_blank" href="http://app.emendo.fr/app/comarquage-service-public-wordpress/#utm_source=wordpress-comarquage-config&amp;utm_medium=banner&amp;utm_campaign=reglages-page-banners" class="button-primary">
							Souscrire au support</a></p>
-->
						</div>
				    </div>
			    </td>
	            
	        </tr>
	        
	        <tr valign="top">
		        <td colspan="2">
			        <h3> Informations pour le support </h3>
					<p> Dans le cadre d'un support direct (pas sur les forums), copier les informations ci-dessous et nous les envoyer.</p>
					<?php
						// Requires
						if ( ! class_exists( 'comarquage_requires' ) ) require_once COMARQUAGE_INCLUDES . 'class-requires.php'; // Load Class Comarquage-requires
						$requires = new comarquage_requires();
						$requires->display();
					?>
		        </td>
	        </tr>
	    </table>

	</div>

	
	<script type="text/javascript">		
	// Manage Options tabs
    jQuery(document).ready(function() {
	    
	    // Locale info block
	    jQuery('#info-locale').hide();
	    
		if(jQuery('#comarquage_global_pivot_enable').is(":checked")) jQuery('#info-locale').slideDown().removeClass('pivot-close').addClass('pivot-open');
		
	    jQuery('#comarquage_global_pivot_enable').click(function(){
	    	if(jQuery("#info-locale").hasClass('pivot-close')) jQuery("#info-locale").slideDown().removeClass('pivot-close').addClass('pivot-open');
			else jQuery("#info-locale").slideUp().removeClass('pivot-open').addClass('pivot-close');
	    });
	    
	    // 
	    jQuery(".nav-tab").click(function(event){
			event.preventDefault();     
	    	jQuery(".tab-content").addClass('ui-tabs-hide');
	    	var tabname = jQuery(this).attr('href');
	    	jQuery(tabname).removeClass('ui-tabs-hide');
			jQuery(".nav-tab").removeClass('nav-tab-active');
			jQuery(this).addClass('nav-tab-active');
	    });
    });
    </script>
	
</div>
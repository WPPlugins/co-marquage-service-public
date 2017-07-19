/* EMENDO - jQuery for co-marquage */
jQuery(window).load(function(){
	jQuery(document).ready(function () {
		
		// ----------------------------- Adresse slide Down / Up
  		jQuery('.spOrganisme .spOrganisme-title .spOrganisme-content').hide();
  		
	    jQuery('.spOrganisme .spOrganisme-title').click(function(){
	        if(jQuery(this).hasClass('orgaclose')){
	            jQuery(this).parents().first().find('.spOrganisme-content').slideDown();
	            jQuery(this).removeClass('orgaclose').addClass('orgaopen');
	        } else {
	            jQuery(this).parents().first().find('.spOrganisme-content').slideUp();
	            jQuery(this).removeClass('orgaopen').addClass('orgaclose');
	        }
	    }).addClass('orgaclose');
  		
  		// On ouvre par défaut les pivots locaux
  		jQuery('.spOrganisme.local').find('.spOrganisme-content').slideDown();
  		jQuery('.spOrganisme.local .spOrganisme-title').removeClass('orgaclose').addClass('orgaopen');
  		
  		
  		// ----------------------------- MORE for block
  		jQuery( "#cm-sidebar .automore" ).each(function( index ) {
	  		if ( jQuery(this).find('> ul > li').length > 5 ) {
	  			jQuery(this).find('> ul > li').slice(5).hide();
	  			jQuery(this).append("<div class='more'> &or; </div>").addClass("blockclose");
	  		}
  		});
  		
  		jQuery('#cm-sidebar .automore .more').click(function(){
	        if(jQuery(this).parent().hasClass('blockclose')){
	            jQuery(this).parents().first().find('ul > li').slice(5).slideDown();
	            jQuery(this).parents().removeClass('blockclose').addClass('blockopen');
	            jQuery(this).html('&and;');
	        } else {
	            jQuery(this).parents().first().find('ul > li').slice(5).slideUp();
	            jQuery(this).parents().removeClass('blockopen').addClass('blockclose');
	            jQuery(this).html('&or;');
	        }
	    }).addClass('blockclose');
  		

	    // ----------------------------- HIDE Sidebar if empty or not exist
	    if(jQuery('#cm-sidebar').html() == '' || jQuery('#cm-sidebar').length == 0 ) {
		    jQuery('#cm-sidebar').hide();
		    jQuery('#cm-content').addClass('nosidebar');
	    }

	    // ----------------------------- MAP
		var map = new Array();
		var marker = new Array();
		var infowindow = new Array();
		var lat, lng, precision;
		
		jQuery( ".spGoogleMap" ).each(function( index ) {
			
			lat = jQuery(this).attr("data-lat");
			lng = jQuery(this).attr("data-lng");
			precision = jQuery(this).attr("data-precision");
			marker_title = jQuery(this).attr("data-title");
			marker_content = jQuery(this).attr("data-content");
			
			// Création de la carte
			var myOptions = {
			      	center: new google.maps.LatLng(lat, lng),
			      	zoom: parseInt(precision) + 8,
			      	disableDefaultUI: true,
			      	panControl: true,
			      	scaleControl: true,
					zoomControl: true,			      	
			      	streetViewControl: true,
			      	mapTypeId: google.maps.MapTypeId.ROADMAP	// Definition du type de carte ROADMAP, SATELLITE, HYBRID, TERRAIN
			};
			map[index] = new google.maps.Map(jQuery(this).get(0),myOptions);
			
			// Infowindow
			infowindow[index] = new google.maps.InfoWindow ({
				content: marker_content
			});
			
			// Ajout du marker
			marker[index] = new google.maps.Marker({
				animation: google.maps.Animation.DROP,
				position: new google.maps.LatLng(lat, lng),
				title: marker_title,
				map: map[index]
			});
			
			// Affichage de l'infowindow lorsqu'on click sur le marker
			google.maps.event.addListener(marker[index], 'click', function() {
			  infowindow[index].open(map[index],marker[index]);
			});
			
			// On force le redimensionnement pour eviter les problemes d'affichage
			google.maps.event.trigger(map[index], "resize");
			
		});


	});
});
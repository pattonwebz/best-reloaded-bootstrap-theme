/**
 * The Best Reloaded Theme scripts.js file.
 *
 * @package Best_Reloaded
 * @since Best Reloaded 0.9
 */

jQuery( document ).ready(function($){
	// deal with very long titles.
	if ( $( '.name-text .site-title' ).height() > 110 ) {
		$( '.name-text .site-title' ).addClass( 'long-title' );
	}
});

jQuery( window ).load(function(){
	var $ = jQuery;
	if ( $( '#carousel-home' ) && ( typeof best_reloaded_settings != "undefined" && best_reloaded_settings.slider_height_cap ) ) {
		var first_item_height = $( '#carousel-home .carousel-item' ).height();
		console.log( first_item_height );
		$( '#carousel-home .carousel-item' ).each( function(){
			$( this ).height( first_item_height )
		});
	}
});

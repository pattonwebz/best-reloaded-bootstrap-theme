( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['best-reloaded-upsell'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

function add_or_remove_active( el ){
	if ( jQuery( el ).find( 'div.info' ).css( 'display' ) === 'none' ) {
		jQuery( el ).addClass( 'active' );
	} else {
		jQuery( el ).removeClass( 'active' );
	}
}

jQuery( 'document' ).ready( function() {
	jQuery( '#accordion-section-best-reloaded-upsell div.info' ).html( jQuery( '#accordion-section-best-reloaded-upsell div.info' ).text() );
	jQuery( '#accordion-section-best-reloaded-upsell' ).click( function() {
		jQuery( this ).find( 'div.info' ).slideToggle( 450, 'swing', add_or_remove_active( this ) );
	});
})

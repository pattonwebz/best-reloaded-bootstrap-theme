( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['upsell-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

function add_or_remove_active(){
	if ( jQuery( '#accordion-section-upsell-section div.info' ).css( 'display' ) === 'none' ) {
		console.log( 'display none' );
		jQuery( '#accordion-section-upsell-section' ).addClass( 'active' );
	} else {
		console.log( 'NOT display none' );
		jQuery( '#accordion-section-upsell-section' ).removeClass( 'active' );
	}
}

jQuery( 'document' ).ready( function() {
	jQuery( '#accordion-section-upsell-section' ).click( function() {
		jQuery( this ).find( 'div.info' ).slideToggle( 400, 'swing', add_or_remove_active() );
	});
})

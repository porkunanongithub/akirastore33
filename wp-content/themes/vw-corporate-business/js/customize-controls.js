( function( api ) {

	// Extends our custom "vw-corporate-business" section.
	api.sectionConstructor['vw-corporate-business'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
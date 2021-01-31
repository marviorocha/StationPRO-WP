( function( api ) {
	// Extends our custom "night-club-lite" section.
	api.sectionConstructor['night-club-lite'] = api.Section.extend( {
		// No events for this type of section.
		attachEvents: function () {},
		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );
} )( wp.customize );
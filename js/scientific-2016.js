jQuery( document ).ready( function ( $ ) {
	$( '.popover_parent > a' ).on( 'click', function () {
		$( '.popover_parent > a' ).not( this ).parent().removeClass( 'active' );
		$( this ).parent().toggleClass( 'active' );
		/*for some reason, putting focus on the search input, needs setTimeot,
		 * as described here: http://stackoverflow.com/questions/15859113/focus-not-working/15859155#15859155 */
		setTimeout(function() { $('.search-field').focus() }, 500);
	} );

//Hide the menu when click off
	$( 'html' ).on( 'click focus', function () {
		$( '.popover_parent.active' ).removeClass( 'active' );
	} );

//Don't include button or menu in 'html' click function
	$( '.popover, .popover_parent > a, .search-form' ).click( function ( event ) {
		event.stopPropagation();
	} );

	/* in Opinions on front page, move the entry meta before the entry title in higher resolutions */
	var mql = window.matchMedia( "screen and (min-width: 960px)" );
	mql.addListener( moveOpinionsEntryMeta );
	moveOpinionsEntryMeta( mql );
	function moveOpinionsEntryMeta( mql ) {
		if ( mql.matches ) {

			var entryMeta = $( '.block-columns_and_opinions .entry-meta' );
			entryMeta.each( function ( index ) {
				var titleSibling = $( this ).siblings( '.entry-title' );
				$( this ).insertBefore( titleSibling );
			} );
		}
	}
} );
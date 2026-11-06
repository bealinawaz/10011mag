/**
 * Adds a "fixed" body class once the page scrolls past the fixed widget area.
 *
 * Same behaviour as the inline script the theme used to print in <head>,
 * which threw a TypeError on scroll on pages without the widget area.
 */
( function( $ ) {
	var $wrap = $( '.fixed-nav .fixed-nav-wrap' );

	if ( ! $wrap.length ) {
		return;
	}

	$( window ).on( 'scroll.mag10011', function() {
		if ( $( window ).scrollTop() > $wrap.position().top ) {
			$( 'body' ).addClass( 'fixed' );
		} else {
			$( 'body' ).removeClass( 'fixed' );
		}
	} );
} )( jQuery );

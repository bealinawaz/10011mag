/**
 * Adds a "fixed" body class once the page scrolls past the WooCommerce sidebar.
 */
( function( $ ) {
	var $wrap = $( '.fixed-nav .fixed-nav-wrap' );

	if ( ! $wrap.length ) {
		return;
	}

	// Measure once, before the widget area becomes position: fixed.
	var offset = $wrap.offset().top;

	$( window ).on( 'scroll.mag10011', function() {
		$( 'body' ).toggleClass( 'fixed', $( window ).scrollTop() > offset );
	} );
} )( jQuery );

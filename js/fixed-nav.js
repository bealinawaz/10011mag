/**
 * Adds a "fixed" body class once the page scrolls past the WooCommerce sidebar.
 */
( function( $ ) {
	var $wrap = $( '.fixed-nav .fixed-nav-wrap' );

	if ( ! $wrap.length ) {
		return;
	}

	$( window ).on( 'scroll.mag10011', function() {
		$( 'body' ).toggleClass( 'fixed', $( window ).scrollTop() > $wrap.position().top );
	} );
} )( jQuery );

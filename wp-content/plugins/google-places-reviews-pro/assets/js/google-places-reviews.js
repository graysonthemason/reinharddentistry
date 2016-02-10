/**
 *  Google Places Reviews JS
 *
 *  @description: JavaScript/jQuery for the WordPress Google Places Widget
 *  @author: Devin Walker
 */

;
(function ( $ ) {

	$( document ).ready( function () {


		//Reviews concatenation
		$( '.gpr-widget-inner' ).each( function () {

			var review = $( this ).find( '.gpr-review-content' );
			var review_char_limit = $( this ).data( 'review-limit' );

			//safety net to set limit if none is present
			if ( typeof review_char_limit === 'undefined' || !review_char_limit ) {
				review_char_limit = 250;
			}

			//set the limit with max height
			review.readmore( {
				collapsedHeight: parseInt( review_char_limit )
			} );

		} );


	} );

})( jQuery );

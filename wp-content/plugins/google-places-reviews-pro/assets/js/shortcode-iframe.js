/**
 *  Google Places Reviews JS: WP Admin Shortcode Generator
 *
 *  @description: JavaScripts for the shortcode generator iframe
 *  @since: 1.3
 */

(function ( $ ) {
	"use strict";

	var custom_params = '';
	var existing_shortcode = false;

	$( document ).ready( function () {

		//Cancel button (closes iframe modal)
		$( '#gpr_cancel' ).on( 'click', function ( e ) {
			top.tinymce.activeEditor.windowManager.close();
			e.preventDefault();
		} );

		custom_params = top.tinyMCE.activeEditor.windowManager.getParams();

		//Are there custom params?
		if ( custom_params.shortcode_params !== 'undefined' ) {
			existing_shortcode = true;
		}

		//Get things going for various functions
		init();

	} );

	// Init
	// @public
	function init() {
		gpr_initialize_autocomplete();
		gpr_tipsy();
		gpr_generator_submit();

		//iframe sizing
		setTimeout( function () {
			$( 'body.iframe' ).css( {height: 'auto'} );
		}, 200 );

		//Toggle fields
		$( '.gpr-toggle-shortcode-fields' ).on( 'click', function () {
			$( '.gpr-shortcode-hidden-fields-wrap' ).slideToggle();
		} );

		//New or Existing Shortcode?
		if ( existing_shortcode === true ) {
			$( '.gpr-edit-shortcode' ).show(); //show edit options
			$( '.gpr-shortcode-hidden-fields-wrap' ).show(); //show table of options
			$( '#gpr_location_lookup_fields' ).hide(); //hide lookup fields (already set)
			$( '#gpr_submit' ).val( 'Edit Shortcode' ); //Change submit button text
			gpr_set_existing_params( custom_params ); //Set default options
		}

	}


	/**
	 * Set Existing Options
	 *
	 * @description Sets the generator options according to the user's already preset shortcode configuration
	 * @param custom_params obj
	 */
	function gpr_set_existing_params( custom_params ) {

		//Set variables from passed custom_params
		var id = gpr_get_attr( custom_params.shortcode_params, 'id' ),
			title = gpr_get_attr( custom_params.shortcode_params, 'title' ),
			theme = gpr_get_attr( custom_params.shortcode_params, 'widget_style' ),
			alignment = gpr_get_attr( custom_params.shortcode_params, 'align' ),
			max_width = gpr_get_attr( custom_params.shortcode_params, 'max_width' ),
			review_limit = gpr_get_attr( custom_params.shortcode_params, 'review_limit' ),
			cache = gpr_get_attr( custom_params.shortcode_params, 'cache' ),
			rating_filter = gpr_get_attr( custom_params.shortcode_params, 'review_filter' ),
			review_char_limit = gpr_get_attr( custom_params.shortcode_params, 'review_char_limit' ),
			pre_content = gpr_get_attr( custom_params.shortcode_params, 'pre_content' ),
			post_content = gpr_get_attr( custom_params.shortcode_params, 'post_content' ),
			hide_header = gpr_get_attr( custom_params.shortcode_params, 'hide_header' ),
			hide_google_image = gpr_get_attr( custom_params.shortcode_params, 'hide_google_image' ),
			hide_out_of_rating = gpr_get_attr( custom_params.shortcode_params, 'hide_out_of_rating' ),
			target_blank = gpr_get_attr( custom_params.shortcode_params, 'target_blank' ),
			no_follow = gpr_get_attr( custom_params.shortcode_params, 'no_follow' );

		//Set Place ID (very important)
		if ( id ) {
			$( '#gpr_widget_place_id' ).val( id );
		} else {
			alert( 'There was no Place ID found for this shortcode. Please create a new one.' );
			return false;
		}

		//Change default settings to customized ones using the values of the variables set above
		if ( title ) {
			$( '#gpr_widget_title' ).val( title );
		}
		if ( theme ) {
			$( '#gpr_widget_theme' ).val( theme );
		}
		if ( alignment ) {
			$( '#gpr_widget_alignment' ).val( alignment );
		}
		if ( max_width ) {
			$( '#gpr_widget_maxwidth' ).val( max_width );
		}
		if ( rating_filter ) {
			$( '#gpr_widget_review_filter' ).val( rating_filter );
		}
		if ( review_char_limit ) {
			$( '#gpr_widget_review_char_limit' ).val( review_char_limit );
		}
		if ( pre_content ) {
			$( '#gpr_widget_pre_content' ).val( pre_content );
		}
		if ( post_content ) {
			$( '#gpr_widget_post_content' ).val( post_content );
		}
		if ( cache ) {
			$( '#gpr_widget_cache' ).val( cache );
		}
		if ( hide_header == 'true' ) {
			$( '#gpr_widget_hide_header' ).prop( 'checked', true );
		}
		if ( hide_google_image == 'true' ) {
			$( '#gpr_widget_hide_google_image' ).prop( 'checked', true );
		}
		if ( hide_out_of_rating == 'true' ) {
			$( '#gpr_widget_hide_out_of_rating' ).prop( 'checked', true );
		}
		if ( no_follow == 'false' ) {
			$( '#gpr_widget_no_follow' ).prop( 'checked', false );
		}
		if ( target_blank == 'false' ) {
			$( '#gpr_widget_target_blank' ).prop( 'checked', false );
		}

	}


	/**
	 * Initialize Google Places Autocomplete Field
	 */
	function gpr_initialize_autocomplete() {
		var input = $( '.gpr-autocomplete' );
		var types = $( '.gpr-types' );

		input.each( function ( index, value ) {

			var autocomplete = new google.maps.places.Autocomplete( input[index] );

			//Handle type select field
			$( types ).on( 'change', function () {
				//Set type
				var type = $( this ).val();
				autocomplete.setTypes( [type] );
				$( input ).val( '' );
			} );

			add_autocomplete_listener( autocomplete, input[index] );

			//Tame the enter key to not save the widget while using the autocomplete input
			$( input ).keydown( function ( e ) {
				if ( e.which == 13 ) return false;
			} );

			input.on( 'focus', function () {
				$( '.place-id-set' ).slideUp();
				$( this ).val( '' );
			} );

		} );


	}


	/**
	 * Google Maps API Autocomplete Listener
	 *
	 * @param autocomplete
	 * @param input
	 */
	function add_autocomplete_listener( autocomplete, input ) {

		google.maps.event.addListener( autocomplete, 'place_changed', function () {

			var place = autocomplete.getPlace();

			if ( !place.place_id ) {
				alert( 'No place reference found for this location.' );
				return false;
			}

			//set location and Place ID hidden input value
			$( input ).parentsUntil( 'form' ).find( '.location' ).val( place.name );

			//Set place_id field (mucho importante)
			$( input ).parents( 'form' ).find( 'input.gpr-place-id-hidden' ).val( place.place_id );

			//Reveal place id set message
			$( input ).parents( 'form' ).find( '.place-id-set' ).slideDown();
			$( input ).parents( 'form' ).find( '.place-id-not-set' ).hide();

			//Reveal additional fields
			$( input ).parents( 'form' ).find( '.gpr-toggle-shortcode-fields' ).slideDown();

		} );
	}


	/**
	 * Tooltips
	 */
	function gpr_tipsy() {
		//Tooltips for admins
		$( '.tooltip-info' ).tipsy( {
			fade    : true,
			html    : true,
			gravity : 'n',
			delayOut: 1000,
			delayIn : 500
		} );
	}

	/**
	 * Shortcode Generator On Submit
	 *
	 * @description: Outputs the shortcode in TinyMCE and does minor validation
	 */
	function gpr_generator_submit() {

		$( '#gpr_settings' ).on( 'submit', function ( e ) {
			e.preventDefault();

			//Set our variables
			var args = top.tinymce.activeEditor.windowManager.getParams(),
				place_id = $( '[name="gpr_widget_place_id"]' ).val(),
				title = $( '[name="gpr_widget_title"]' ).val(),
				widget_theme = $( '[name="gpr_widget_theme"]' ).val(),
				align = $( '[name="gpr_widget_alignment"]' ).val(),
				max_width = $( '[name="gpr_widget_maxwidth"]' ).val(),
				review_limit = $( '[name="gpr_widget_review_limit"]' ).val(),
				review_char_limit = $( '[name="gpr_widget_review_char_limit"]' ).val(),
				review_filter = $( '[name="gpr_widget_review_filter"]' ).val(),
				pre_content = $( '[name="gpr_widget_pre_content"]' ).val(),
				post_content = $( '[name="gpr_widget_post_content"]' ).val(),
				hide_header = $( '[name="gpr_widget_hide_header"]' ).is( ':checked' ),
				hide_google_image = $( '[name="gpr_widget_hide_google_image"]' ).is( ':checked' ),
				hide_out_of_rating = $( '[name="gpr_widget_hide_out_of_rating"]' ).is( ':checked' ),
				no_follow = $( '[name="gpr_widget_no_follow"]' ).is( ':checked' ),
				target_blank = $( '[name="gpr_widget_target_blank"]' ).is( ':checked' ),
				cache = $( '[name="gpr_widget_cache"]' ).val(),
				shortcode;

			//Let's do some validation to ensure the location's place ID is set
			if ( place_id === '' ) {
				alert( 'Missing Location\'s Place ID. Did you lookup a location?' );
				return false;
			}

			//Form the shortcode
			shortcode = '[' + args.shortcode;

			//Start with the ID
			if ( place_id ) {
				shortcode += ' id="' + place_id + '"';
			}

			//Title
			if ( title ) {
				shortcode += ' title="' + title + '"';
			}

			//Widget Style
			if ( widget_theme !== 'Minimal Light' ) {
				shortcode += ' widget_style="' + widget_theme + '"';
			}

			//align
			if ( align !== 'none' ) {
				shortcode += ' align="' + align + '"';
			}

			//max-width
			if ( max_width !== '' && max_width !== '250px' ) {
				shortcode += ' max_width="' + max_width + '"';
			}

			//pre_content
			if ( pre_content !== '' ) {
				shortcode += ' pre_content="' + pre_content + '"';
			}

			//review_limit
			if ( review_limit !== '5' ) {
				shortcode += ' review_limit="' + review_limit + '"';
			}

			//review_char_limit
			if ( review_char_limit !== '' && review_char_limit !== '250' ) {
				shortcode += ' review_char_limit="' + review_char_limit + '"';
			}

			//review_filter
			if ( review_filter !== 'none' ) {
				shortcode += ' review_filter="' + review_filter + '"';
			}
			//pre_content
			if ( pre_content !== '' ) {
				shortcode += ' pre_content="' + pre_content + '"';
			}

			//post_content
			if ( post_content !== '' ) {
				shortcode += ' post_content="' + post_content + '"';
			}

			//cache
			if ( cache !== '' && cache !== '2 Days' ) {
				shortcode += ' cache="' + cache + '"';
			}

			//hide_header
			if ( hide_header == true ) {
				shortcode += ' hide_header="true"';
			}

			//hide_google_image
			if ( hide_google_image == true ) {
				shortcode += ' hide_google_image="true"';
			}

			//hide_out_of_rating
			if ( hide_out_of_rating == true ) {
				shortcode += ' hide_out_of_rating="true"';
			}

			//no_follow
			if ( no_follow !== true ) {
				shortcode += ' no_follow="false"';
			}

			//target_blank
			if ( target_blank !== true ) {
				shortcode += ' target_blank="false"';
			}

			shortcode += ']';

			top.tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			top.tinymce.activeEditor.windowManager.close();

		} );


	}

	/**
	 * Get Attribute
	 *
	 * @description: Helper function that plucks options from passed string
	 */
	function gpr_get_attr( s, n ) {
		n = new RegExp( n + '=\"([^\"]+)\"', 'g' ).exec( s );
		return n ? window.decodeURIComponent( n[1] ) : '';
	}


})( jQuery );

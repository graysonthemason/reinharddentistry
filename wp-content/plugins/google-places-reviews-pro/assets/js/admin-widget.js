/**
 *  Google Places Reviews JS: WP Admin
 *
 *  @description: JavaScripts for the admin side of the widget
 */
var gpr_avatar_widget;

(function ( $ ) {
	"use strict";

	//var loadAPIPromise;
	//// Load API
	//function loadAPI( callback ) {
	//
	//	if ( !loadAPIPromise ) {
	//		var deferred = $.Deferred();
	//		$.ajax( {
	//			url     : 'http://www.google.com/jsapi/',
	//			dataType: "script",
	//			success : function () {
	//				google.load( 'maps', '3', {
	//					callback    : function () {
	//						deferred.resolve();
	//					},
	//					other_params: 'sensor=false&libraries=places'
	//				} );
	//			}
	//		} );
	//		loadAPIPromise = deferred.promise();
	//	}
	//	loadAPIPromise.done( callback );
	//}
	//
	//
	$( window ).load( function () {
		//loadAPI( init )
		init();
	} );

	// Init
	// @public
	function init() {
		/*
		 * Initialize the API Request Method widget radio input toggles
		 */
		gpr_widget_toogles();
		gpr_initialize_autocomplete();
		gpr_tipsy();


	}


	/**
	 * On DOM load
	 */
	$( document ).on( 'click', '.gpr-clear-cache', function ( e ) {
		e.preventDefault();
		var $this = $( this );
		$this.next( '.cache-clearing-loading' ).fadeIn( 'fast' );
		var data = {
			action        : 'clear_widget_cache',
			transient_id_1: $( this ).data( 'transient-id-1' ),
			transient_id_2: $( this ).data( 'transient-id-2' )
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post( ajaxurl, data, function ( response ) {
			$( '.cache-clearing-loading' ).hide();
			$this.prev( '.cache-message' ).text( response ).fadeIn( 'fast' ).delay( 2000 ).fadeOut();
		} );

	} );


	/**
	 * AJAX Success
	 *
	 * @description: Function to Refresh jQuery toggles for Yelp Widget Pro upon saving specific widget
	 */
	$( document ).ajaxSuccess( function ( e, xhr, settings ) {
		gpr_widget_toogles();
		gpr_initialize_autocomplete();
		gpr_tipsy();
	} );


	/**
	 * Widget Toggles
	 */
	function gpr_widget_toogles() {

		//Advanced Options Toggle (Bottom-gray panels)
		$( '.gpr-widget-toggler:not("clickable")' ).each( function () {

			$( this ).addClass( "clickable" ).unbind( "click" ).click( function () {
				$( this ).toggleClass( 'toggled' );
				$( this ).next().slideToggle();
			} )

		} );


		//Review character limit toggle
		$( '.limit-reviews-option' ).each( function () {

			var review_char_option = $( this ).find( 'input' );
			var review_char_option_value = review_char_option.prop( 'checked' );
			var review_char_set_wrap = $( this ).next( '.review-character-limit' );

			//if clicked now
			review_char_option.on( 'click', function () {
				review_char_set_wrap.slideToggle();
			} );


		} );


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
			$( input ).parentsUntil( 'form' ).find( '.place_id' ).val( place.place_id );
			$( input ).parentsUntil( 'form' ).find( '.set-business' ).slideDown();

		} );
	}


	function gpr_tipsy() {
		//Tooltips for admins
		$( '.tooltip-info' ).tipsy( {
			fade    : true,
			html    : true,
			gravity : 's',
			delayOut: 1000,
			delayIn : 500
		} );
	}


	/**
	 * Avatar Image
	 */
	$( document ).ready( function () {

		gpr_avatar_widget = {

			// Call this from the upload button to initiate the upload frame.
			uploader   : function ( widget_id, widget_id_string ) {

				//@TODO: i18n
				var frame = wp.media( {
					title   : 'Set an Avatar',
					multiple: false,
					library : {type: 'image'},
					button  : {text: 'Set Avatar Image'}
				} );

				// Handle results from media manager.
				frame.on( 'close', function () {
					var attachments = frame.state().get( 'selection' ).toJSON();
					gpr_avatar_widget.render( widget_id, widget_id_string, attachments[0] );
				} );

				frame.open();
				return false;
			},

			// Output Image preview and populate widget form.
			render     : function ( widget_id, widget_id_string, attachment ) {

				if ( $( "#" + widget_id_string + 'preview a' ).length > 0 ) {
					$( "#" + widget_id_string + 'preview' ).prepend( gpr_avatar_widget.imgHTML( attachment ) );
				} else {
					$( "#" + widget_id_string + 'preview' ).html( gpr_avatar_widget.imgHTML( attachment ) );
				}

				$( "#" + widget_id_string + 'attachment_id' ).val( attachment.id );
				$( "#" + widget_id_string + 'imageurl' ).val( attachment.url );
				$( "#" + widget_id_string + 'preview a' ).show();
			},

			// Render html for the image.
			imgHTML    : function ( attachment ) {
				var img_html = '<img src="' + attachment.url + '" ';
				img_html += 'width="' + attachment.width + '" ';
				img_html += 'height="' + attachment.height + '" ';
				if ( attachment.alt != '' ) {
					img_html += 'alt="' + attachment.alt + '" ';
				}
				img_html += '/>';
				return img_html;
			},
			// User wants to remove the avatar
			removeImage: function ( widget_id_string ) {
				$( "#" + widget_id_string + 'attachment_id' ).val( '' );
				$( "#" + widget_id_string + 'imageurl' ).val( '' );
				$( "#" + widget_id_string + 'preview img' ).remove();
				$( "#" + widget_id_string + 'preview a' ).hide();
			}

		};

	} );


})( jQuery );

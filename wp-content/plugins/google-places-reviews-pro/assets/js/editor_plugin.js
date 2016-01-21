/**
 * TinyMCE plugin
 *
 * @see: http://generatewp.com/take-shortcodes-ultimate-level/ (heavily referenced)
 */
(function () {

	tinymce.PluginManager.add( 'gpr_shortcode_button', function ( editor, url ) {

		var ed = tinymce.activeEditor;
		var sh_tag = 'google-places-reviews';


		/**
		 * Open Shortcode Generator Modal
		 *
		 * @param ui
		 * @param v
		 */
		function gpr_open_modal( ui, v ) {

			editor.windowManager.open( {
				title     : ed.getLang( 'gpr.shortcode_generator_title' ),
				id        : 'gpr_shortcode_dialog',
				width     : 600,
				height    : 450,
				resizable : true,
				scrollbars: true,
				url       : ajaxurl + '?action=gpr_shortcode_iframe'
			}, {
				shortcode       : ed.getLang( 'gpr.shortcode_tag' ),
				shortcode_params: window.decodeURIComponent( v )
			} );
		}

		//add popup
		editor.addCommand( 'gpr_shortcode_popup', gpr_open_modal );


		editor.addButton( 'gpr_shortcode_button', {
			title  : ed.getLang( 'gpr.shortcode_generator_title' ),
			icon   : 'gpr dashicons-location',
			onclick: gpr_open_modal
		} );


		//replace from shortcode to an image placeholder
		editor.on( 'BeforeSetcontent', function ( event ) {
			event.content = gpr_replace_shortcode( event.content );
		} );

		//replace from image placeholder to shortcode
		editor.on( 'GetContent', function ( event ) {
			event.content = gpr_restore_shortcode( event.content );
		} );


		//open popup on placeholder double click
		editor.on( 'DblClick', function ( e ) {
			var cls = e.target.className.indexOf( 'wp-google-places-reviews' );
			var attributes = e.target.attributes['data-gpr-attr'].value;

			if ( e.target.nodeName == 'IMG' && cls > -1 ) {
				editor.execCommand( 'gpr_shortcode_popup', false, attributes );
			}
		} );

		/**
		 * Helper functions
		 */
		function getAttr( s, n ) {
			n = new RegExp( n + '=\"([^\"]+)\"', 'g' ).exec( s );
			return n ? window.decodeURIComponent( n[1] ) : '';
		}


		/**
		 * Google Places Replace Shortcode
		 *
		 * @param content
		 * @returns {XML|*|string|void}
		 */
		function gpr_replace_shortcode( content ) {
			return content.replace( /\[google-places-reviews([^\]]*)\]/g, function ( all, attr, con ) {
				return gpr_shortcode_html( 'wp-google-places-reviews', attr, con );
			} );
		}

		/**
		 * Restore Shortcodes
		 */
		function gpr_restore_shortcode( content ) {
			return content.replace( /(?:<p(?: [^>]+)?>)*(<img [^>]+>)(<\/p>)*/g, function ( match, image ) {
				var data = getAttr( image, 'data-gpr-attr' );

				if ( data ) {
					return '<p>[' + sh_tag + data + ']</p>';
				}
				return match;
			} );
		}

		/**
		 * HTML
		 */
		function gpr_shortcode_html( cls, data, con ) {

			var placeholder = url + '/shortcode-placeholder.jpg';
			data = window.encodeURIComponent( data );

			return '<img src="' + placeholder + '" class="mceItem ' + cls + '" ' + 'data-gpr-attr="' + data + '" data-mce-resize="false" data-mce-placeholder="1" />';
		}

	} );


})();

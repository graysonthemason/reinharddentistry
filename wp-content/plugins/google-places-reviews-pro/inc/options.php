<?php
$google_places_reviews_options = array(
	array( 'name' => __( 'About', $google_places_reviews->textdomain ), 'type' => 'opentab' ),
	array( 'type' => 'about' ),
	array(
		'name'  => __( 'Google Places API Key', $google_places_reviews->textdomain ),
		'desc'  => sprintf( __( 'API keys are manage through the <a href="%1$s" class="new-window" target="_blank">Google API Console</a>. For more information please <a href="%2$s" class="new-window" target="_blank">review these steps</a>.', $google_places_reviews->textdomain ), esc_url( 'https://code.google.com/apis/console/?noredirect' ), esc_url( 'https://developers.google.com/places/documentation/#Authentication' ) ),
		'std'   => '',
		'id'    => 'google_places_api_key',
		'type'  => 'text',
		'label' => __( 'Yes', $google_places_reviews->textdomain )
	),
	array( 'type' => 'closetab', 'actions' => true ),
	//Advanced Options
	array(
		'name' => __( 'Advanced Options', $google_places_reviews->textdomain ),
		'type' => 'opentab'
	),
	array(
		'name'  => __( 'Disable Plugin CSS', $google_places_reviews->textdomain ),
		'desc'  => __( 'Useful to style your own widget and for theme integration and optimization.', $google_places_reviews->textdomain ),
		'std'   => '',
		'id'    => 'disable_css',
		'type'  => 'checkbox',
		'label' => __( 'Yes', $google_places_reviews->textdomain )
	),
	array(
		'name'  => __( 'Disable Google Maps API Script in Admin', $google_places_reviews->textdomain ),
		'desc'  => __( 'Some themes and plugins may also include Google Maps API JS in the admin of WordPress which may cause conflicts with this plugin. This setting ensures the plugin does not output it\'s own to prevent the error: "You have included the Google Maps API multiple times on this page. This may cause unexpected errors.".', $google_places_reviews->textdomain ),
		'std'   => '',
		'id'    => 'disable_admin_maps_js',
		'type'  => 'checkbox',
		'label' => __( 'Yes', $google_places_reviews->textdomain )
	),
	array( 'type' => 'closetab' )
);


/**
 * Get Google Maps Builder Themes
 *
 * @return array
 */
function gpr_get_widget_themes() {
	$options = array(
		__( 'Bare Bones', 'gpr' ),
		__( 'Minimal Light', 'gpr' ),
		__( 'Minimal Dark', 'gpr' ),
		__( 'Shadow Light', 'gpr' ),
		__( 'Shadow Dark', 'gpr' ),
		__( 'Inset Light', 'gpr' ),
		__( 'Inset Dark', 'gpr' )
	);

	return apply_filters( 'gpr_widget_themes', $options );
}

/**
 * Get Google Maps Builder Themes
 *
 * @return array
 */
function gpr_get_widget_cache_options() {
	$options = array(
		__( 'None', 'gpr' ),
		__( '1 Hour', 'gpr' ),
		__( '3 Hours', 'gpr' ),
		__( '6 Hours', 'gpr' ),
		__( '12 Hours', 'gpr' ),
		__( '1 Day', 'gpr' ),
		__( '2 Days', 'gpr' ),
		__( '1 Week', 'gpr' )
	);

	return apply_filters( 'gpr_widget_cache_options', $options );
}

/**
 *  Google Places Reviews Admin Tooltips
 *
 * @param $tip_name
 *
 * @return bool|string
 */
function gpr_admin_tooltip( $tip_name ) {

	$tip_text = '';

	//Ensure there's a tip requested
	if ( empty( $tip_name ) ) {
		return false;
	}

	switch ( $tip_name ) {
		case 'title':
			$tip_text = __( 'The title text appears at the very top of the widget above all other elements.', 'gpr' );
			break;
		case 'autocomplete':
			$tip_text = __( 'Enter the name of your Google Place in this field to retrieve it\'s Google Place ID. If no information is returned there you may have a conflict with another plugin or theme using Google Maps API.', 'gpr' );
			break;
		case 'place_type':
			$tip_text = __( 'Specify how you would like to lookup your Google Places. Address instructs the Place Autocomplete service to return only geocoding results with a precise address. Establishment instructs the Place Autocomplete service to return only business results. The Regions type collection instructs the Places service to return any result matching the following types: locality, sublocality, postal_code, country, administrative_area_level_1, administrative_area_level_2.', 'gpr' );
			break;
		case 'location':
			$tip_text = __( 'This is the name of the place returned by Google\'s Places API.', 'gpr' );
			break;
		case 'place_id':
			$tip_text = __( 'The Google Place ID is a textual identifier that uniquely identifies a place and can be used to retrieve information about the place. This option is set using the "Location Lookup" field above.', 'gpr' );
			break;
		case 'review_filter':
			$tip_text = __( 'Filter bad reviews to prevent them from displaying. Please note that the Google Places API only allows for up to 5 total reviews displayed per location. This option may limit the total number further.', 'gpr' );
			break;
		case 'review_limit':
			$tip_text = __( 'Limit the number of reviews displayed for this location to a set number.', 'gpr' );
			break;
		case 'reviewers_link':
			$tip_text = __( 'Toggle on or off the link on the reviews name to their Google+ page.', 'gpr' );
			break;
		case 'review_characters':
			$tip_text = __( 'Some reviews may be very long and cause the widget to have a very large height. This option uses JavaScript to expand and collapse the text.', 'gpr' );
			break;
		case 'review_char_limit':
			$tip_text = __( 'Set the character limit for this review widget. Values are in pixels.', 'gpr' );
			break;
		case 'widget_style':
			$tip_text = __( 'Choose from a set of predefined widget styles. Want to style your own? Set it to \'Bare Bones\' for easy CSS styling.', 'gpr' );
			break;
		case 'hide_header':
			$tip_text = __( 'Disable the main business information profile image, name, overall rating. Useful for displaying only ratings in the widget.', 'gpr' );
			break;
		case 'hide_out_of_rating':
			$tip_text = __( 'Hide the text the appears after the star image displaying \'x out of 5 stars\'. The text will still be output because it is important for SEO but it will be hidden with CSS.', 'gpr' );
			break;
		case 'google_image':
			$tip_text = __( 'Prevent the Google logo from displaying in the reviews widget.', 'gpr' );
			break;
		case 'cache':
			$tip_text = __( 'Caching data will save Google Place data to your database in order to speed up response times and conserve API requests. The suggested settings is 1 Day.', 'gpr' );
			break;
		case 'disable_title_output':
			$tip_text = __( 'The title output is content within the \'Widget Title\' field above. Disabling the title output may be useful for some themes.', 'gpr' );
			break;
		case 'target_blank':
			$tip_text = __( 'This option will add target=\'_blank\' to the widget\'s links. This is useful to keep users on your website.', 'gpr' );
			break;
		case 'no_follow':
			$tip_text = __( 'This option will add rel=\'nofollow\' to the widget\'s outgoing links. This option may be useful for SEO.', 'gpr' );
			break;
		case 'alignment':
			$tip_text = __( 'Choose whether to float the widget to the right or left, or not at all. This is helpful for integrating within post content so text wraps around the widget if wanted. Default value is \'none\'.', 'gpr' );
			break;
		case 'max_width':
			$tip_text = __( 'Define a max-width property for the widget. Dimension value can be in pixel or percentage. Default value is \'250px\'.', 'gpr' );
			break;
		case 'pre_content':
			$tip_text = __( 'Output content before the main widget content. Useful to provide introductory text.', 'gpr' );
			break;
		case 'post_content':
			$tip_text = __( 'Output content after the main widget content. Useful to provide a button or custom text inviting the user to perform an action or read a message.', 'gpr' );
			break;
		case 'custom_avatar':
			$tip_text = __( 'If you are not happy with the image pulled from the Google API then you may upload your own. The recommended size is 60x60',  'gpr' );
			break;
	}

	return '<img src="' . GPR_PLUGIN_URL . '/assets/images/help.png" title="' . $tip_text . '" class="tooltip-info" width="16" height="16" />';

}

<?php

/**
 * Class Google_Places_Reviews_Shortcode
 *
 * @description: Google Places Reviews Shortcode Class
 * @since      : 1.0
 */
class Google_Places_Reviews_Shortcode extends Google_Places_Reviews {

	/**
	 * Init shortcode
	 */
	function __construct() {

		parent::__construct();

		add_shortcode( 'google-places-reviews', array( $this, 'handle_shortcode' ) );

	}

	function handle_shortcode( $atts ) {

		//Defaults shortcode vals
		$defaults = array(
			'title'              => '',
			'id'                 => '',
			'align'              => 'none',
			'max_width'          => '280px',
			'pre_content'        => '',
			'post_content'       => '',
			'cache'              => '1 Day',
			'hide_header'        => '',
			'hide_google_image'  => '',
			'hide_out_of_rating' => '',
			'no_follow'          => '1',
			'target_blank'       => '1',
			'widget_style'       => 'Minimal Light',
			'review_limit'       => '5',
			'reviewers_link'     => '1',
			'review_filter'      => '',
			'review_char_limit'  => '250',
		);

		//extract shortcode arguments
		extract( shortcode_atts( $defaults, $atts ) );

		//declare variables
		$args = $instance = array();

		//loop through options array and save variables for usage within function

		$globals = array(
			'title'                => empty( $atts['title'] ) ? $title : $atts['title'],
			'disable_title_output' => '',
			'place_id'             => empty( $atts['id'] ) ? $id : $atts['id'],
			'reference'            => empty( $atts['id'] ) ? $id : $atts['id'],
			'align'                => empty( $atts['align'] ) ? $align : $atts['align'],
			'max_width'            => empty( $atts['max_width'] ) ? $max_width : $atts['max_width'],
			'pre_content'          => empty( $atts['pre_content'] ) ? $pre_content : $atts['pre_content'],
			'post_content'         => empty( $atts['post_content'] ) ? $post_content : $atts['post_content'],
			'hide_header'          => empty( $atts['hide_header'] ) ? $hide_header : $this->check_shortcode_value( $atts['hide_header'] ),
			'hide_out_of_rating'   => empty( $atts['hide_out_of_rating'] ) ? $hide_out_of_rating : $this->check_shortcode_value( $atts['hide_out_of_rating'] ),
			'hide_google_image'    => empty( $atts['hide_google_image'] ) ? $hide_google_image : $this->check_shortcode_value( $atts['hide_google_image'] ),
			'cache'                => empty( $atts['cache'] ) ? $cache : $atts['cache'],
			'no_follow'            => empty( $atts['no_follow'] ) ? $no_follow : $atts['no_follow'],
			'target_blank'         => empty( $atts['target_blank'] ) ? $no_follow : $atts['target_blank'],
			'widget_style'         => empty( $atts['widget_style'] ) ? $widget_style : $atts['widget_style'],
			'review_limit'         => empty( $atts['review_limit'] ) ? $review_limit : $atts['review_limit'],
			'reviewers_link'       => empty( $atts['reviewers_link'] ) ? $reviewers_link : $atts['reviewers_link'],
			'review_filter'        => empty( $atts['review_filter'] ) ? $review_filter : $atts['review_filter'],
			'review_char_limit'    => empty( $atts['review_char_limit'] ) ? $review_char_limit : $atts['review_char_limit'],
		);

		//Take care of reference ID and Place ID duplicates
		if ( strlen( $globals['reference'] ) < 100 ) {
			$globals['reference'] = ''; //Clear out reference ID so widget reacts properly
		}

		//merge instance with globals
		$instance = array_merge( $instance, $globals );

		// actual shortcode handling here
		//Using ob_start to output shortcode within content appropriately
		ob_start();
		parent::widget( $args, $instance );
		$widget = ob_get_contents();
		ob_end_clean();

		/* Max Width (adds inline style) */
		$max_width = isset( $max_width ) ? ' style="max-width:' . $max_width . ';"' : '';
		$align     = isset( $align ) ? ' class="gpr-widget-align-' . $align . '"' : '';

		//Wrap widget with ID for styling purposes
		$widget = '<div id="gpr_widget" ' . $max_width . $align . '>' . $widget . '</div>';

		//Output our Widget
		return $widget;

	}


	/**
	 *
	 * Check Shortcode Value
	 *
	 * @description: Helper Function
	 *
	 * @param $attr
	 *
	 * @return string
	 */
	function check_shortcode_value( $attr ) {

		if ( $attr === "true" || $attr === "1" || $attr == "yes" ) {
			$attr = "1";
		} else {
			$attr = '0';
		}

		return $attr;

	}

}

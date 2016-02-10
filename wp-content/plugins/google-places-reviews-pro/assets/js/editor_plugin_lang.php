<?php

$strings = 'tinyMCE.addI18n({' . _WP_Editors::$mce_locale . ':{
	gpr:{
		shortcode_generator_title: "' . esc_js( __( 'Google Places Reviews', 'gpr' ) ) . '",
		shortcode_tag: "' . esc_js( apply_filters( 'gpr_shortcode_tag', 'google-places-reviews' ) ) . '"
	}
}})';

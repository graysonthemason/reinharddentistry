<?php

/**
 * GPR_Shortcode_Generator class.
 *
 * @since 2.0
 */
class GPR_Shortcode_Generator {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_head', array( $this, 'add_shortcode_button' ), 20 );
		add_filter( 'tiny_mce_version', array( $this, 'refresh_mce' ), 20 );
		add_filter( 'mce_external_languages', array( $this, 'add_tinymce_lang' ), 20, 1 );

		// Tiny MCE button icon
		add_action( 'admin_head', array( __CLASS__, 'set_tinymce_button_icon' ) );

		add_action( 'wp_ajax_gpr_shortcode_iframe', array( $this, 'gpr_shortcode_iframe' ), 9 );
	}

	/**
	 * Add a button for the GPR shortcode to the WP editor.
	 */
	public function add_shortcode_button() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		// check if WYSIWYG is enabled
		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_external_plugins', array( $this, 'add_shortcode_tinymce_plugin' ), 10 );
			add_filter( 'mce_buttons', array( $this, 'register_shortcode_button' ), 10 );
		}
	}

	/**
	 * Add TinyMCE language function.
	 *
	 * @param array $arr
	 *
	 * @return array
	 */
	public function add_tinymce_lang( $arr ) {
		$arr['gpr_shortcode_button'] = GPR_PLUGIN_PATH . '/assets/js/editor_plugin_lang.php';

		return $arr;
	}

	/**
	 * Register the shortcode button.
	 *
	 * @param array $buttons
	 *
	 * @return array
	 */
	public function register_shortcode_button( $buttons ) {

		array_push( $buttons, '|', 'gpr_shortcode_button' );

		return $buttons;
	}

	/**
	 * Add the shortcode button to TinyMCE
	 *
	 * @param array $plugin_array
	 *
	 * @return array
	 */
	public function add_shortcode_tinymce_plugin( $plugin_array ) {

		$plugin_array['gpr_shortcode_button'] = GPR_PLUGIN_URL . '/assets/js/editor_plugin.js';

		return $plugin_array;
	}

	/**
	 * Force TinyMCE to refresh.
	 *
	 * @param int $ver
	 *
	 * @return int
	 */
	public function refresh_mce( $ver ) {
		$ver += 3;

		return $ver;
	}

	/**
	 * Adds admin styles for setting the tinymce button icon
	 */
	public static function set_tinymce_button_icon() {
		?>
		<style>
			i.mce-i-gpr {
				font: 400 20px/1 dashicons;
				padding: 0;
				vertical-align: top;
				speak: none;
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
				margin-left: -2px;
				padding-right: 2px
			}

			#gpr_shortcode_dialog-body {
				background: #F1F1F1;
			}

			.gpr-shortcode-submit {
				margin: 0 -15px;
				position: fixed;
				bottom: 0;
				background: #FFF;
				width: 100%;
				padding: 15px;
				border-top: 1px solid #DDD;
			}

			div.place-id-set {
				clear: both;
				float: left;
				width: 100%;
			}

		</style>
	<?php
	}

	/**
	 * Display the contents of the iframe used when the GPR Shortcode Generator is clicked
	 * TinyMCE button is clicked.
	 *
	 * @param int $ver
	 *
	 * @return int
	 */
	public static function gpr_shortcode_iframe() {
		global $wp_scripts;
		set_current_screen( 'gpr' );
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		//Enqueue our scripts
		wp_enqueue_script( 'gpr_shortcode_google_places_gmaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places', array( 'jquery' ) );
		//Tipsy tooltips
		wp_enqueue_script( 'gpr_shortcode_admin_tipsy', GPR_PLUGIN_URL . '/assets/js/gpr-tipsy' . $suffix . '.js', array( 'jquery' ) );
		//Shortcode Generator Specific JS
		wp_enqueue_script( 'gpr_shortcode_admin_generator', GPR_PLUGIN_URL . '/assets/js/shortcode-iframe' . $suffix . '.js', array( 'jquery' ) );
		//Styles
		wp_enqueue_style( 'gpr_widget_admin_tipsy', GPR_PLUGIN_URL . '/assets/css/gpr-tipsy' . $suffix . '.css' );

		iframe_header(); ?>

		<style>
			#gpr-wrap {
				margin: 0 1em;
				overflow: hidden;
				padding-bottom: 75px;
			}

			/* iFrame Styles */
			#gpr_settings label {
				margin-bottom: 3px;
				display: block;
			}

			div.gpr-shortcode-hidden-fields-wrap {
				display: none;
			}

			.gpr-place-search-wrap > div.gpr-autocomplete {
				width: 65%;
				margin-right: 2%;
				float: left;
			}

			.gpr-place-search-wrap > div.gpr-place-type {
				width: 33%;
				float: left;
			}

			.gpr-place-search-wrap > div.gpr-place-type > select {
				height: 36px;
				line-height: 36px;
			}

			div.updated {
				width: 100%;
				float: left;
				box-sizing: border-box;
			}

			div.place-id-not-set {
				border-color: orange;
			}
		</style>
		<div class="wrap" id="gpr-wrap">
			<form id="gpr_settings" style="float: left; width: 100%;">
				<?php do_action( 'gpr_shortcode_iframe_before' ); ?>
				<fieldset id="gpr_location_lookup_fields" class="gpr-place-search-wrap clear" style="margin:1em 0;">
					<div class="gpr-autocomplete">
						<label for="gpr_location_lookup"><strong><?php _e( 'Location Lookup:', 'gpr' ); ?></strong> <?php echo gpr_admin_tooltip( 'autocomplete' ); ?>
						</label>
						<input type="text" id="gpr_location_lookup" name="gpr_location_lookup" class="widefat gpr-autocomplete" />
					</div>

					<div class="gpr-place-type">
						<label for="place_type"><?php _e( 'Place Type', 'gpr' ); ?>: <?php echo gpr_admin_tooltip( 'place_type' ); ?></label>

						<select name="place_type" id="place_type" class="widefat gpr-types">
							<option value="all"><?php _e( 'All', 'gpr' ); ?></option>
							<option value="address"><?php _e( 'Addresses', 'gpr' ); ?></option>
							<option value="establishment" selected="selected"><?php _e( 'Establishments', 'gpr' ); ?></option>
							<option value="(regions)"><?php _e( 'Regions', 'gpr' ); ?></option>
						</select>

					</div>

					<input type="hidden" id="gpr_widget_place_id" name="gpr_widget_place_id" class="gpr-place-id-hidden" value="" />

					<div class="updated place-id-not-set">
						<p><?php _e( '<strong>Create a Shortcode</strong>: Start creating a Google Places Review shortcode by looking up your business or location using the lookup field above.', 'gpr' ); ?></p>
					</div>
					<div class="updated place-id-set" style="display: none;">
						<p><?php esc_attr_e( 'The Google Place ID is set for this location.', 'gpr' ); ?></p>
					</div>

				</fieldset>


				<div class="updated gpr-edit-shortcode" style="display: none;">
					<p><?php _e( '<strong>Edit Active Shortcode:</strong> Customize the options for this Google Places Reviews shortcode by adjusting the options below.', 'gpr' ); ?></p>
				</div>

				<a href="#" class="gpr-toggle-shortcode-fields" style="display: none;box-shadow: none;margin: 0 0 20px;">&raquo; <?php _e( '<strong>View Additional Shortcode Options</strong> (all optional)', 'gpr' ); ?>
				</a>

				<div class="gpr-shortcode-hidden-fields-wrap">


					<table class="widefat">
						<thead>
						<tr>
							<th class="row-title"><?php esc_attr_e( 'Name', 'gpr' ); ?></th>
							<th><?php esc_attr_e( 'Option(s)', 'gpr' ); ?></th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_title"><?php _e( 'Title:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'title' ); ?></label>
							</td>
							<td>
								<input type="text" id="gpr_widget_title" name="gpr_widget_title" class="widefat gpr-title" placeholder="<?php esc_attr_e( 'Enter a title...', 'gpr' ); ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td class="row-title">
								<label for="gpr_widget_theme"><?php _e( 'Widget Theme:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'widget_style' ); ?></label>
							</td>
							<td>
								<select id="gpr_widget_theme" name="gpr_widget_theme" class="widefat gpr_widget_theme">
									<option value="default"><?php _e( 'Select a theme...', 'gpr' ); ?></option>
									<?php
									$options      = gpr_get_widget_themes();
									$widget_style = 'Minimal Light';

									//Counter for Option Values
									$counter = 0;

									foreach ( $options as $option ) {
										echo '<option value="' . $option . '" id="' . $option . '"', $widget_style == $option ? ' selected="selected"' : '', '>', $option, '</option>';
										$counter ++;
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_alignment"><?php _e( 'Alignment:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'alignment' ); ?></label>
							</td>
							<td>
								<select name="gpr_widget_alignment" class="widefat" id="gpr_widget_alignment">
									<?php
									$options      = array(
										__( 'none', 'gpr' ),
										__( 'left', 'gpr' ),
										__( 'right', 'gpr' ),
									);
									$widget_style = 'none';

									//Counter for Option Values
									$counter = 0;

									foreach ( $options as $option ) {
										echo '<option value="' . $option . '" id="' . $option . '"', $widget_style == $option ? ' selected="selected"' : '', '>', $option, '</option>';
										$counter ++;
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="alternate">
							<td class="row-title">
								<label for="gpr_widget_maxwidth"><?php esc_attr_e( 'Max-Width:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'max_width' ); ?></label>
							</td>
							<td>
								<input type="text" style="width:90px" name="gpr_widget_maxwidth" id="gpr_widget_maxwidth" placeholder="250px" />
							</td>
						</tr>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_review_char_limit"><?php esc_attr_e( 'Review Character Limit:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'review_char_limit' ); ?></label>
							</td>
							<td>
								<input type="text" style="width:90px" name="gpr_widget_review_char_limit" id="gpr_widget_review_char_limit" placeholder="250" />
							</td>
						</tr>
						<tr class="alternate">
							<td class="row-title">
								<label for="gpr_widget_review_limit"><?php esc_attr_e( 'Limit Number of Reviews:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'review_limit' ); ?></label>
							</td>
							<td>
								<select name="gpr_widget_review_limit" class="widefat" id="gpr_widget_review_limit"><?php
									$options      = array(
										__( '5', 'gpr' ),
										__( '4', 'gpr' ),
										__( '3', 'gpr' ),
										__( '2', 'gpr' ),
										__( '1', 'gpr' ),
									);
									$widget_style = '5';

									//Counter for Option Values
									$counter = 0;

									foreach ( $options as $option ) {
										echo '<option value="' . $option . '" id="' . $option . '"', $widget_style == $option ? ' selected="selected"' : '', '>', $option, '</option>';
										$counter ++;
									}
									?></select>
							</td>
						</tr>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_review_filter"><?php esc_attr_e( 'Minimum Review Rating:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'review_filter' ); ?></label>
							</td>
							<td>
								<select name="gpr_widget_review_filter" class="widefat" id="gpr_widget_review_filter"><?php
									$options = array(
										__( 'none', 'gpr' ),
										__( '5', 'gpr' ),
										__( '4', 'gpr' ),
										__( '3', 'gpr' ),
										__( '2', 'gpr' ),
										__( '1', 'gpr' ),
									);
									$default = 'none';
									//Counter for Option Values
									$counter = 0;

									foreach ( $options as $option ) {
										echo '<option value="' . $option . '" id="' . $option . '"', $default == $option ? ' selected="selected"' : '', '>', $option, '</option>';
										$counter ++;
									}
									?></select>
							</td>

						</tr>
						<tr class="alternate">
							<td class="row-title">
								<label for="gpr_widget_pre_content"><?php _e( 'Pre-Content:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'pre_content' ) ?></label>
							</td>
							<td>
								<textarea id="gpr_widget_pre_content" name="gpr_widget_pre_content" class="widefat gpr-title" style="font-size:12px;" placeholder="<?php esc_attr_e( 'Enter some text to display before the widget...', 'gpr' ); ?>"></textarea>
							</td>
						</tr>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_post_content"><?php _e( 'Post-Content:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'post_content' ) ?></label>
							</td>
							<td>
								<textarea id="gpr_widget_post_content" name="gpr_widget_post_content" class="widefat gpr-title" style="font-size:12px;" placeholder="<?php esc_attr_e( 'Enter some text to display after the widget...', 'gpr' ); ?>"></textarea>
							</td>
						</tr>
						<tr class="alternate">
							<td class="row-title">
								<label for="gpr_widget_cache"><?php esc_attr_e( 'Cache Response:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'cache' ) ?></label>
							</td>
							<td>
								<select name="gpr_widget_cache" id="gpr_widget_cache" class="widefat">
									<?php
									$options = gpr_get_widget_cache_options();
									$cache   = '2 Days';
									/**
									 * Output Cache Options (set 2 Days as default for new widgets)
									 */
									foreach ( $options as $option ) {
										?>
										<option value="<?php echo $option; ?>"
										        id="<?php echo $option; ?>" <?php if ( $cache == $option || empty( $cache ) && $option == '1 Day' ) {
											echo ' selected="selected" ';
										} ?>>
											<?php echo $option; ?>
										</option>
										<?php $counter ++;
									} ?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_hide_header"><?php _e( 'Hide Header:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'hide_header' ) ?></label>
							</td>
							<td>
								<input type="checkbox" id="gpr_widget_hide_header" name="gpr_widget_hide_header" class="gpr-hide-header" />
							</td>
						</tr>
						<tr class="alternate">
							<td class="row-title">
								<label for="gpr_widget_hide_google_image"><?php _e( 'Hide Google Logo:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'google_image' ) ?></label>
							</td>
							<td>
								<input type="checkbox" id="gpr_widget_hide_google_image" name="gpr_widget_hide_google_image" class="gpr-hide-google-image" />
							</td>
						</tr>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_hide_out_of_rating"><?php _e( 'Hide "x out of 5 stars" Text:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'hide_out_of_rating' ) ?></label>
							</td>
							<td>
								<input type="checkbox" id="gpr_widget_hide_out_of_rating" name="gpr_widget_hide_out_of_rating" class="gpr-hide_out_of_rating" />
							</td>
						</tr>
						<tr class="alternate">
							<td class="row-title">
								<label for="gpr_widget_no_follow"><?php _e( 'Add rel="nofollow" to Links:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'no_follow' ) ?></label>
							</td>
							<td>
								<input type="checkbox" id="gpr_widget_no_follow" name="gpr_widget_no_follow" class="gpr-gpr_widget_no_follow" checked />
							</td>
						</tr>
						<tr>
							<td class="row-title">
								<label for="gpr_widget_target_blank"><?php _e( 'Open Links in New Window:', 'gpr' ); ?> <?php echo gpr_admin_tooltip( 'target_blank' ) ?></label>
							</td>
							<td>
								<input type="checkbox" id="gpr_widget_target_blank" name="gpr_widget_target_blank" class="gpr-gpr_widget_target_blank" checked />
							</td>
						</tr>
						</tbody>
					</table>
				</div>

				<?php do_action( 'gpr_shortcode_iframe_after' ); ?>

				<fieldset class="gpr-shortcode-submit">
					<input id="gpr_submit" type="submit" class="button-small button-primary" value="<?php _e( 'Create Shortcode', 'gpr' ); ?>" />
					<input id="gpr_cancel" type="button" class="button-small button-secondary" value="<?php _e( 'Cancel', 'gpr' ); ?>" />
				</fieldset>

			</form>
		</div>


		<?php iframe_footer();
		exit();
	}
}

new GPR_Shortcode_Generator();

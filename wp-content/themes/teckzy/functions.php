<?php
add_action('wp_enqueue_scripts', 'teckzy_Scripts' , 20);
function teckzy_Scripts() {
wp_enqueue_style('teckzy-style-sheet', get_stylesheet_uri());	
wp_enqueue_script('teckzy-animations', get_stylesheet_directory_uri() .'/js/animations.js');
wp_enqueue_style('teckzy-reset', get_stylesheet_directory_uri() .'/css/reset.css');
wp_enqueue_style('teckzy-responsive-leyouts', get_stylesheet_directory_uri() .'/css/responsive-leyouts.css');
wp_enqueue_style('teckzy-animations', get_stylesheet_directory_uri() .'/css/animations.css');
}?>
<?php
function teckzy_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
	load_child_theme_textdomain( 'teckzy', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'teckzy_add_editor_styles' );
?>
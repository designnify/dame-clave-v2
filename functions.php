<?php
/**
 * Dame Clave V2.0.
 *
 * This file adds functions to the Dame Clave Theme.
 *
 * @package Dame Clave
 * @author  Mauricio Alvarez
 * @license GPL-2.0+
 * @link    http://designnify.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'dame-clave', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'dame-clave' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Dame Clave' );
define( 'CHILD_THEME_URL', 'http://designnify.com/' );
define( 'CHILD_THEME_VERSION', '2.0' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'dame_clave_enqueue_scripts_styles' );
function dame_clave_enqueue_scripts_styles() {

	wp_enqueue_style( 'dame-clave-fonts', '//fonts.googleapis.com/css?family=Arimo:400,400i,700,700i|Didact+Gothic', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'dame-clave-responsive-menu', get_stylesheet_directory_uri() . '/js/min/responsive-menu-min.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'dame-clave' ),
		'subMenu'  => __( 'Menu', 'dame-clave' ),
	);
	wp_localize_script( 'dame-clave-responsive-menu', 'genesisSampleL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
// add_theme_support( 'custom-background' );

//* Add support for 1-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

//* Add Image Sizes
add_image_size( 'featured-post-image', 320, 320, TRUE );
add_image_size( 'featured-image', 720, 400, TRUE );

//* Removing emoji code form head
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

//* Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

//* Modify the WordPress read more link for automatic excerpts
/*
add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
function sp_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">Lue lisää</a>';
}
*/

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'dame-clave' ), 'secondary' => __( 'Footer Menu', 'dame-clave' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'dame_clave_secondary_menu_args' );
function dame_clave_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'dame_clave_author_box_gravatar' );
function dame_clave_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'dame_clave_comments_gravatar' );
function dame_clave_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'bg_entry_meta_header' );
function bg_entry_meta_header($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}

//* Customize the credits
add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_text' );
function sp_footer_creds_text() {
	echo '<div class="creds"><p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; Dame Clave';
	echo '</p></div>';
}

//* Register widget areas for home page
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home Top', 'dame-clave' ),
	'description' => __( 'This is the home top section.', 'dame-clave' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home Middle', 'dame-clave' ),
	'description' => __( 'This is the home middle section.', 'dame-clave' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Sponsors', 'dame-clave' ),
	'description' => __( 'This is the first column', 'dame-clave' ),
) );

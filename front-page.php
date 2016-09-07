<?php
/**
 * This file adds the Home Page to the Dame Clave V2.0 Theme.
 *
 * @author Mauricio Alvarez
 * @subpackage Customizations
 */
 
add_action( 'genesis_meta', 'dameclave_home_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function dameclave_home_page_genesis_meta() {
	
	if ( is_active_sidebar( 'slider' ) || is_active_sidebar( 'news' ) || is_active_sidebar( 'sponsors' ) ) {
	
		//* Enqueue scripts - No need to enqueue more the project-min.js
		
		//* Add front-page body class
		add_filter( 'body_class', 'dameclave_body_class' );
		function dameclave_body_class( $classes ) {

   			$classes[] = 'dame-clave-home';
   			return $classes;

		}
		
		//* Force content-sidebar layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		
		//* Add home body class
		add_filter( 'body_class', 'dameclave_body_class' );
		
		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add homepage widgets
		add_action( 'genesis_loop', 'dameclave_home_page_widgets' );

	}
}

function dameclave_home_page_widgets() {
	
	genesis_widget_area( 'slider', array(
	'before'	=> '<section class="slider">',
	'after'		=> '</section>',
	));
	genesis_widget_area( 'news', array(
		'before'	=> '<section class="news">',
		'after'		=> '</section>',
	));
	genesis_widget_area( 'sponsors', array(
		'before'	=> '<section class="sponsors">',
		'after'		=> '</section>',
	));
	
}

genesis();

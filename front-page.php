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
	
	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom' ) ) { 
		
		//* Add front-page body class
		add_filter( 'body_class', 'dameclave_body_class' );
		function dameclave_body_class( $classes ) {

   			$classes[] = 'dame-clave-home';
   			return $classes;

		}
		
		//* Force full width content layout
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
				
		//* Add home body class
		add_filter( 'body_class', 'dameclave_body_class' );
		
		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		
		//* Remove .site-inner
		add_filter( 'genesis_markup_site-inner', '__return_null' );
		add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
		add_filter( 'genesis_markup_content', '__return_null' );

		//* Add homepage widgets
		add_action( 'genesis_loop', 'dameclave_home_page_widgets' );
		
		//* Enqueue scripts for backstretch
		add_action( 'wp_enqueue_scripts', 'digital_front_page_enqueue_scripts' );
		function digital_front_page_enqueue_scripts() {

			$image = get_option( 'genesis-sample-front-image', sprintf( '%s/images/hero-bg.jpg', get_stylesheet_directory_uri() ) );

			//* Load scripts only if custom backstretch image is being used
			if ( ! empty( $image ) && is_active_sidebar( 'home-top' ) ) {

				//* Enqueue Backstretch scripts
				wp_enqueue_script( 'digital-backstretch', get_bloginfo( 'stylesheet_directory' ) . '/js/partials/backstretch.js', array( 'jquery' ), '1.0.0' );
				wp_enqueue_script( 'digital-backstretch-set', get_bloginfo('stylesheet_directory').'/js/partials/backstretch-set.js' , array( 'jquery', 'digital-backstretch' ), '1.0.0' );

				wp_localize_script( 'digital-backstretch-set', 'BackStretchImg', array( 'src' => str_replace( 'http:', '', $image ) ) );

			}
		
		}
	}
}

function dameclave_home_page_widgets() {
	
	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top widget-area">',
		'after'  => '</div>',
	) );
	
	genesis_widget_area( 'home-middle', array(
		'before' => '<div id="home-middle" class="home-middle widget-area"><div class="wrap"><div class="flexible-widgets widget-area widget-thirds">',
		'after'  => '</div></div></div>',
	) );
	
	genesis_widget_area( 'home-bottom', array(
		'before' => '<div id="home-bottom" class="home-bottom widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
}

genesis();
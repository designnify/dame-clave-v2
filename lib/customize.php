<?php
/**
 * Dame Clave.
 *
 * This file adds the Customizer additions to the Dame Clave Theme.
 *
 * @package Dame Clave
 * @author  Mauricio Alvarez
 * @license GPL-2.0+
 * @link    http://designnify.com/
 */

/**
 * Get default link color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for link color.
 */
function genesis_sample_customizer_get_default_link_color() {
	return '#410993';
}

/**
 * Get default accent color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for accent color.
 */
function genesis_sample_customizer_get_default_accent_color() {
	return '#410993';
}

add_action( 'customize_register', 'genesis_sample_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_sample_customizer_register() {

	global $wp_customize;
	
	$wp_customize->add_section( 'genesis-sample-image', array(
		'title'          => __( 'Front Page Hero Image', 'genesis-sample' ),
		'description'    => __( '<p>Use the default image or personalize your site by uploading your own image for the front page 1 widget background.</p><p>The default image is <strong>1600 x 1050 pixels</strong>.</p>', 'genesis-sample' ),
		'priority'       => 75,
	) );

	$wp_customize->add_setting( 'genesis-sample-front-image', array(
		'default'  => sprintf( '%s/images/hero-bg.jpg', get_stylesheet_directory_uri() ),
		'type'     => 'option',
	) );
	 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'front-background-image',
			array(
				'label'       => __( 'Front Image Upload', 'genesis-sample' ),
				'section'     => 'genesis-sample-image',
				'settings'    => 'genesis-sample-front-image',
			)
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_link_color',
		array(
			'default'           => genesis_sample_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_link_color',
			array(
				'description' => __( 'Change the default color for linked titles, menu links, post info links and more.', 'genesis-sample' ),
			    'label'       => __( 'Link Color', 'genesis-sample' ),
			    'section'     => 'colors',
			    'settings'    => 'genesis_sample_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_accent_color',
		array(
			'default'           => genesis_sample_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_accent_color',
			array(
				'description' => __( 'Change the default color for button hovers.', 'genesis-sample' ),
			    'label'       => __( 'Accent Color', 'genesis-sample' ),
			    'section'     => 'colors',
			    'settings'    => 'genesis_sample_accent_color',
			)
		)
	);

}

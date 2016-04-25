<?php
/**
 * Cassions Theme Customizer.
 *
 * @package Cassions
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cassions_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/*------------------------------------------------------------------------*/
		/*  Section: Theme Options
		/*------------------------------------------------------------------------*/

				// Primary color setting
				$wp_customize->add_setting( 'primary_color' , array(
				    'default'     => '#2e6d9d',
					'sanitize_callback' => 'cassions_sanitize_hex_color'
				) );

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
					'label'        => esc_html__( 'Primary Color', 'cassions' ),
					'section'    => 'colors',
					'settings'   => 'primary_color',
				) ) );

				// Second color setting
				$wp_customize->add_setting( 'secondary_color' , array(
				    'default'     => '#444',
					'sanitize_callback' => 'cassions_sanitize_hex_color'
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
					'label'        => esc_html__( 'Secondary Color', 'cassions' ),
					'section'    => 'colors',
					'settings'   => 'secondary_color',
				) ) );
}
add_action( 'customize_register', 'cassions_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cassions_customize_preview_js() {
	wp_enqueue_script( 'cassions_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cassions_customize_preview_js' );


/*------------------------------------------------------------------------*/
/*  cassions Sanitize Functions.
/*------------------------------------------------------------------------*/

function cassions_sanitize_file_url( $file_url ) {
	$output = '';
	$filetype = wp_check_filetype( $file_url );
	if ( $filetype["ext"] ) {
		$output = esc_url( $file_url );
	}
	return $output;
}

function cassions_sanitize_number( $input ) {
    return force_balance_tags( $input );
}

function cassions_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function cassions_sanitize_hex_color( $color ) {
	if ( $color === '' ) {
		return '';
	}
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}
	return null;
}
function cassions_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function cassions_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

function cassions_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

<?php
/**
 * MTHL Theme Customizer
 *
 * @package mthl
 */

function mthl_customize_register( $wp_customize ) {
	// Add Phone Number Setting
	$wp_customize->add_setting( 'mthl_company_phone', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'mthl_company_phone', array(
		'label'    => __( 'Số điện thoại', 'mthl' ),
		'section'  => 'title_tagline',
		'type'     => 'text',
		'priority' => 50,
	) );

	// Add Email Setting
	$wp_customize->add_setting( 'mthl_company_email', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'mthl_company_email', array(
		'label'    => __( 'Email', 'mthl' ),
		'section'  => 'title_tagline',
		'type'     => 'email',
		'priority' => 51,
	) );

	// Add Facebook Setting
	$wp_customize->add_setting( 'mthl_company_facebook', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'mthl_company_facebook', array(
		'label'    => __( 'Facebook (URL)', 'mthl' ),
		'section'  => 'title_tagline',
		'type'     => 'url',
		'priority' => 52,
	) );
}
add_action( 'customize_register', 'mthl_customize_register' );

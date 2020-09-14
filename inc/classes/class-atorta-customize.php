<?php

/* CUSTOMIZER SETTINGS
------------------------------------------------ */

if ( ! class_exists( 'ATorta_Customize' ) ) :
	class ATorta_Customize {

		public static function register( $wp_customize ) {

			// Add our Customizer section
			$wp_customize->add_section( 'atorta_options', array(
				'title' 		=> __( 'Theme Options', 'atorta' ),
				'priority' 		=> 35,
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Customize the theme settings for A Torta.', 'atorta' ),
			) );

			// Dark Mode
			$wp_customize->add_setting( 'atorta_dark_mode', array(
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'atorta_sanitize_checkbox',
				'transport'			=> 'postMessage'
			) );

			$wp_customize->add_control( 'atorta_dark_mode', array(
				'type' 			=> 'checkbox',
				'section' 		=> 'colors', // Default WP section added by background_color
				'label' 		=> __( 'Dark Mode', 'atorta' ),
				'description' 	=> __( 'Displays the site with white text and black background. If Background Color is set, only the text color will change.', 'atorta' ),
			) );

			// Always show preview titles
			$wp_customize->add_setting( 'atorta_alt_nav', array(
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'atorta_sanitize_checkbox',
				'transport'			=> 'postMessage'
			) );

			$wp_customize->add_control( 'atorta_alt_nav', array(
				'type' 			=> 'checkbox',
				'section' 		=> 'atorta_options', // Add a default or your own section
				'label' 		=> __( 'Show Primary Menu in the Header', 'atorta' ),
				'description' 	=> __( 'Replace the navigation toggle in the header with the Primary Menu on desktop.', 'atorta' ),
			) );

			// Maximum number of columns
			$wp_customize->add_setting( 'atorta_max_columns', array(
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'atorta_sanitize_checkbox',
				'transport'			=> 'postMessage'
			) );

			$wp_customize->add_control( 'atorta_max_columns', array(
				'type' 			=> 'checkbox',
				'section' 		=> 'atorta_options',
				'label' 		=> __( 'Three Columns', 'atorta' ),
				'description' 	=> __( 'Check to use three columns in the post grid on desktop.', 'atorta' ),
			) );

			// Always show preview titles
			$wp_customize->add_setting( 'atorta_show_titles', array(
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'atorta_sanitize_checkbox',
				'transport'			=> 'postMessage'
			) );

			$wp_customize->add_control( 'atorta_show_titles', array(
				'type' 			=> 'checkbox',
				'section' 		=> 'atorta_options', // Add a default or your own section
				'label' 		=> __( 'Show Preview Titles', 'atorta' ),
				'description' 	=> __( 'Check to always show the titles in the post previews.', 'atorta' ),
			) );

			// Set the home page title
			$wp_customize->add_setting( 'atorta_home_title', array(
				'capability' 		=> 'edit_theme_options',
				'sanitize_callback' => 'sanitize_textarea_field',
			) );

			$wp_customize->add_control( 'atorta_home_title', array(
				'type' 			=> 'textarea',
				'section' 		=> 'atorta_options', // Add a default or your own section
				'label' 		=> __( 'Front Page Title', 'atorta' ),
				'description' 	=> __( 'The title you want shown on the front page when the "Front page displays" setting is set to "Your latest posts" in Settings > Reading.', 'atorta' ),
			) );

			// Make built-in controls use live JS preview
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

			// SANITATION

			// Sanitize boolean for checkbox
			function atorta_sanitize_checkbox( $checked ) {
				return ( ( isset( $checked ) && true == $checked ) ? true : false );
			}

		}

		// Initiate the live preview JS
		public static function live_preview() {
			wp_enqueue_script( 'atorta-themecustomizer', get_template_directory_uri() . '/assets/js/theme-customizer.js', array(  'jquery', 'customize-preview', 'masonry' ), '', true );
		}

	}

	// Setup the Theme Customizer settings and controls
	add_action( 'customize_register', array( 'ATorta_Customize', 'register' ) );

	// Enqueue live preview javascript in Theme Customizer admin screen
	add_action( 'customize_preview_init', array( 'ATorta_Customize', 'live_preview' ) );

endif;

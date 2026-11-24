<?php
/**
 * Psychwire theme bootstrap.
 *
 * @package Psychwire
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports.
 */
function psychwire_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'psychwire_setup' );

/**
 * Load style.css on the front end (block themes do not do this automatically); the editor gets it via add_editor_style().
 */
function psychwire_enqueue_styles(): void {
	wp_enqueue_style(
		'psychwire-style',
		get_theme_file_uri( 'style.css' ),
		array(),
		(string) wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'psychwire_enqueue_styles' );

require_once get_theme_file_path( 'inc/data.php' );
require_once get_theme_file_path( 'inc/seo.php' );
require_once get_theme_file_path( 'inc/cleanup.php' );
require_once get_theme_file_path( 'inc/a11y.php' );

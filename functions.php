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
}
add_action( 'after_setup_theme', 'psychwire_setup' );

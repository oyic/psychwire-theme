<?php
/**
 * Front-end performance: inline the small theme stylesheet and preload the hero image.
 *
 * @package Psychwire
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print style.css inline. It is tiny, and a separate file would be a render-blocking request.
 */
function psychwire_inline_styles(): void {
	$css = (string) file_get_contents( get_theme_file_path( 'style.css' ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local theme file.
	$css = (string) preg_replace( '#/\*.*?\*/#s', '', $css );
	$css = (string) preg_replace( '/\s+/', ' ', $css );
	$css = trim( (string) preg_replace( '/\s*([{};,>])\s*/', '$1', $css ) );

	wp_register_style( 'psychwire-style', false, array(), (string) wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'psychwire-style' );
	wp_add_inline_style( 'psychwire-style', $css );
}
add_action( 'wp_enqueue_scripts', 'psychwire_inline_styles' );

/**
 * Start fetching the hero image at the top of <head> (front page only), with the same srcset and sizes as the <img>.
 */
function psychwire_preload_hero(): void {
	if ( ! is_front_page() ) {
		return;
	}

	$base   = get_theme_file_uri( 'assets/images/dr-rivera' );
	$srcset = sprintf( '%1$s-400.webp 400w, %1$s-600.webp 600w, %1$s-800.webp 800w', $base );

	printf(
		"<link rel=\"preload\" as=\"image\" type=\"image/webp\" imagesrcset=\"%s\" imagesizes=\"%s\" fetchpriority=\"high\">\n",
		esc_attr( $srcset ),
		esc_attr( '(min-width: 48rem) 40vw, min(100vw, 20rem)' )
	);
}
add_action( 'wp_head', 'psychwire_preload_hero', 1 );

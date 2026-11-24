<?php
/**
 * Remove core front-end JavaScript this theme does not need (spec: zero JS).
 *
 * @package Psychwire
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Drop the emoji detection script and speculation rules from the front end.
 */
function psychwire_remove_core_scripts(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_print_speculation_rules' );
	remove_action( 'wp_footer', 'wp_print_speculation_rules' );
}
add_action( 'init', 'psychwire_remove_core_scripts' );

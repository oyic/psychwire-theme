<?php
/**
 * Accessibility helpers.
 *
 * @package Psychwire
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Name each <section> group after its heading: aria-labelledby="{anchor}-title".
 *
 * Done at render time so the saved block markup stays valid in the editor.
 *
 * @param string              $content Rendered block HTML.
 * @param array<string,mixed> $block   Parsed block.
 */
function psychwire_label_sections( string $content, array $block ): string {
	$attrs = $block['attrs'] ?? array();

	if ( 'section' !== ( $attrs['tagName'] ?? '' ) || empty( $attrs['anchor'] ) ) {
		return $content;
	}

	$processor = new WP_HTML_Tag_Processor( $content );

	if ( $processor->next_tag( 'section' ) ) {
		$processor->set_attribute( 'aria-labelledby', $attrs['anchor'] . '-title' );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block_core/group', 'psychwire_label_sections', 10, 2 );

/**
 * Give the header's <nav> group its accessible name at render time ("Primary"), keeping the saved block markup valid.
 *
 * @param string              $content Rendered block HTML.
 * @param array<string,mixed> $block   Parsed block.
 */
function psychwire_label_nav( string $content, array $block ): string {
	$attrs = $block['attrs'] ?? array();

	if ( 'nav' !== ( $attrs['tagName'] ?? '' ) ) {
		return $content;
	}

	$processor = new WP_HTML_Tag_Processor( $content );

	if ( $processor->next_tag( 'nav' ) && null === $processor->get_attribute( 'aria-label' ) ) {
		$processor->set_attribute( 'aria-label', __( 'Primary', 'psychwire' ) );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block_core/group', 'psychwire_label_nav', 10, 2 );

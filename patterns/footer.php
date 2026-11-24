<?php
/**
 * Title: Site footer
 * Slug: psychwire/footer
 * Inserter: no
 *
 * @package Psychwire
 */

$profile = psychwire_profile();
?>
<!-- wp:group {"tagName":"footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<footer class="wp-block-group has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:paragraph {"fontSize":"small"} -->
	<p class="has-small-font-size">&copy; <?php echo esc_html( sprintf( '%s, %s, %s, Australia.', $profile['name'], $profile['title'], $profile['locality'] ) ); ?></p>
	<!-- /wp:paragraph -->
</footer>
<!-- /wp:group -->

<?php
/**
 * Title: About
 * Slug: psychwire/about
 * Inserter: no
 *
 * @package Psychwire
 */

$profile = psychwire_profile();
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"About"},"anchor":"about","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section id="about" class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:heading -->
	<h2 class="wp-block-heading">About</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p><?php echo esc_html( $profile['bio'] ); ?></p>
	<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->

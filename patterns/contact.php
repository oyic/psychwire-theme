<?php
/**
 * Title: Contact
 * Slug: psychwire/contact
 * Inserter: no
 *
 * @package Psychwire
 */

$profile = psychwire_profile();
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"Contact"},"anchor":"contact","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section id="contact" class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:heading -->
	<h2 class="wp-block-heading">Contact</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Email: <a href="mailto:<?php echo esc_attr( antispambot( $profile['email'] ) ); ?>"><?php echo esc_html( $profile['email'] ); ?></a></p>
	<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->

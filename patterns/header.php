<?php
/**
 * Title: Site header
 * Slug: psychwire/header
 * Inserter: no
 *
 * @package Psychwire
 */

$nav = array(
	'about'   => __( 'About', 'psychwire' ),
	'courses' => __( 'Courses', 'psychwire' ),
	'contact' => __( 'Contact', 'psychwire' ),
);
?>
<!-- wp:group {"tagName":"header","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}}} -->
<header class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:site-title {"level":0,"style":{"typography":{"fontWeight":"700"}}} /-->

	<!-- wp:navigation {"overlayMenu":"never","ariaLabel":"<?php echo esc_attr__( 'Primary', 'psychwire' ); ?>","layout":{"type":"flex","flexWrap":"wrap"}} -->
<?php foreach ( $nav as $slug => $label ) : ?>
		<!-- wp:navigation-link {"label":"<?php echo esc_attr( $label ); ?>","type":"","url":"/#<?php echo esc_attr( $slug ); ?>","kind":"custom"} /-->
<?php endforeach; ?>
	<!-- /wp:navigation -->
</header>
<!-- /wp:group -->

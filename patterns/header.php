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

	<!-- wp:group {"tagName":"nav","className":"site-nav"} -->
	<nav class="wp-block-group site-nav">
		<!-- wp:list {"className":"site-nav__list"} -->
		<ul class="wp-block-list site-nav__list">
<?php foreach ( $nav as $slug => $label ) : ?>
			<!-- wp:list-item -->
			<li><a href="/#<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?></a></li>
			<!-- /wp:list-item -->
<?php endforeach; ?>
		</ul>
		<!-- /wp:list -->
	</nav>
	<!-- /wp:group -->
</header>
<!-- /wp:group -->

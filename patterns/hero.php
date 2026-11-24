<?php
/**
 * Title: Hero
 * Slug: psychwire/hero
 * Inserter: no
 *
 * @package Psychwire
 */

$profile = psychwire_profile();
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"Hero"},"align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"68rem"}} -->
<section class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:columns {"verticalAlignment":"center"} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
			<!-- wp:heading {"level":1} -->
			<h1 class="wp-block-heading"><?php echo esc_html( $profile['name'] ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size"><?php echo esc_html( $profile['title'] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%">
			<!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"0.5rem"}}} -->
			<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/dr-rivera.jpg' ) ); ?>" alt="<?php echo esc_attr( $profile['photo_alt'] ); ?>" width="800" height="1000" style="border-radius:0.5rem" fetchpriority="high"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->

<?php
/**
 * Title: Courses
 * Slug: psychwire/courses
 * Inserter: no
 *
 * @package Psychwire
 */

$courses = psychwire_courses();
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"Courses"},"anchor":"courses","align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"68rem"}} -->
<section id="courses" class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"anchor":"courses-title"} -->
	<h2 class="wp-block-heading" id="courses-title"><?php echo esc_html__( 'Courses', 'psychwire' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
	<div class="wp-block-group">
<?php foreach ( $courses as $course ) : ?>
		<!-- wp:group {"tagName":"article","anchor":"course-<?php echo esc_attr( $course['slug'] ); ?>","className":"course-card"} -->
		<article id="course-<?php echo esc_attr( $course['slug'] ); ?>" class="wp-block-group course-card">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $course['name'] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html( $course['description'] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"course-card__length"} -->
			<p class="course-card__length"><?php echo esc_html( $course['length'] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p><a href="#contact"><?php echo esc_html__( 'Enquire about this course', 'psychwire' ); ?><span class="screen-reader-text">: <?php echo esc_html( $course['name'] ); ?></span></a></p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->
<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->

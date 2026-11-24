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
	<!-- wp:heading -->
	<h2 class="wp-block-heading">Courses</h2>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<div class="courses-grid">
<?php foreach ( $courses as $course ) : ?>
		<article id="course-<?php echo esc_attr( $course['slug'] ); ?>" class="course-card">
			<h3><?php echo esc_html( $course['name'] ); ?></h3>
			<p><?php echo esc_html( $course['description'] ); ?></p>
			<p class="course-card__length"><?php echo esc_html( $course['length'] ); ?></p>
		</article>
<?php endforeach; ?>
	</div>
	<!-- /wp:html -->
</section>
<!-- /wp:group -->

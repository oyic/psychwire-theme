<?php
/**
 * SEO and AEO: document title, meta description and JSON-LD structured data.
 *
 * @package Psychwire
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Document title for the front page.
 *
 * @param string $title Title WordPress would use.
 */
function psychwire_document_title( string $title ): string {
	if ( ! is_front_page() ) {
		return $title;
	}

	$profile = psychwire_profile();

	return sprintf( '%s | %s in %s', $profile['name'], $profile['title'], $profile['locality'] );
}
add_filter( 'pre_get_document_title', 'psychwire_document_title' );

/**
 * Meta description text (70-160 characters).
 */
function psychwire_description(): string {
	$profile = psychwire_profile();

	return sprintf(
		'%s is a %s clinical psychologist who trains psychologists, counsellors and social workers in Acceptance and Commitment Therapy.',
		$profile['name'],
		$profile['locality']
	);
}

/**
 * Print the meta description on the front page.
 */
function psychwire_meta_description(): void {
	if ( ! is_front_page() ) {
		return;
	}

	printf( "<meta name=\"description\" content=\"%s\">\n", esc_attr( psychwire_description() ) );
}
add_action( 'wp_head', 'psychwire_meta_description', 1 );

/**
 * Build the schema.org graph: one Person, one Organization (the Course provider) and one Course per course.
 *
 * @return array<string,mixed>
 */
function psychwire_build_graph(): array {
	$profile   = psychwire_profile();
	$person_id = home_url( '/#person' );
	$org_id    = home_url( '/#organization' );

	$graph = array(
		array(
			'@type'       => 'Person',
			'@id'         => $person_id,
			'name'        => $profile['name'],
			'jobTitle'    => $profile['title'],
			'description' => $profile['bio'],
			'email'       => $profile['email'],
			'url'         => home_url( '/' ),
			'image'       => $profile['photo'],
			'address'     => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => $profile['locality'],
				'addressCountry'  => 'AU',
			),
		),
	);

	$graph[] = array(
		'@type'   => 'Organization',
		'@id'     => $org_id,
		'name'    => $profile['name'],
		'url'     => home_url( '/' ),
		'founder' => array( '@id' => $person_id ),
	);

	foreach ( psychwire_courses() as $course ) {
		$instance = array(
			'@type'          => 'CourseInstance',
			'courseMode'     => 'online',
			'courseWorkload' => $course['workload'],
			'instructor'     => array( '@id' => $person_id ),
		);

		if ( '' !== $course['repeat'] ) {
			$instance['courseSchedule'] = array(
				'@type'           => 'Schedule',
				'repeatFrequency' => $course['repeat'],
				'duration'        => $course['workload'],
			);
		}

		$graph[] = array(
			'@type'             => 'Course',
			'@id'               => $course['url'],
			'name'              => $course['name'],
			'description'       => $course['description'],
			'url'               => $course['url'],
			'provider'          => array( '@id' => $org_id ),
			'hasCourseInstance' => $instance,
		);
	}

	return array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
}

/**
 * Print the JSON-LD script on the front page.
 */
function psychwire_json_ld(): void {
	if ( ! is_front_page() ) {
		return;
	}

	printf(
		"<script type=\"application/ld+json\">%s</script>\n",
		wp_json_encode( psychwire_build_graph(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG )
	);
}
add_action( 'wp_head', 'psychwire_json_ld', 2 );

<?php
/**
 * SEO and AEO: title, meta description, canonical, social tags, favicon and JSON-LD.
 *
 * @package Psychwire
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const PSYCHWIRE_LANG   = 'en-AU';
const PSYCHWIRE_LOCALE = 'en_AU';

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
 * Serve the page as Australian English on the front end (the site is for a Sydney practice).
 *
 * @param string $output The language attributes WordPress built.
 */
function psychwire_language_attributes( string $output ): string {
	if ( is_admin() ) {
		return $output;
	}

	return (string) preg_replace( '/lang="[^"]*"/', 'lang="' . PSYCHWIRE_LANG . '"', $output );
}
add_filter( 'language_attributes', 'psychwire_language_attributes' );

/**
 * Print description, canonical, Open Graph, Twitter and favicon tags on the front page.
 */
function psychwire_head_meta(): void {
	if ( ! has_site_icon() ) {
		printf( "<link rel=\"icon\" href=\"%s\" type=\"image/svg+xml\">\n", esc_url( get_theme_file_uri( 'assets/images/favicon.svg' ) ) );
	}

	if ( ! is_front_page() ) {
		return;
	}

	// Core prints its own canonical for singular pages; we print one for the whole front page.
	remove_action( 'wp_head', 'rel_canonical' );

	$profile     = psychwire_profile();
	$title       = psychwire_document_title( '' );
	$description = psychwire_description();
	$url         = home_url( '/' );

	$tags = array(
		array( 'name', 'description', $description ),
		array( 'property', 'og:type', 'website' ),
		array( 'property', 'og:site_name', $profile['name'] ),
		array( 'property', 'og:locale', PSYCHWIRE_LOCALE ),
		array( 'property', 'og:title', $title ),
		array( 'property', 'og:description', $description ),
		array( 'property', 'og:url', $url ),
		array( 'property', 'og:image', $profile['social'] ),
		array( 'property', 'og:image:width', '1200' ),
		array( 'property', 'og:image:height', '630' ),
		array( 'property', 'og:image:alt', $profile['photo_alt'] ),
		array( 'name', 'twitter:card', 'summary_large_image' ),
		array( 'name', 'twitter:title', $title ),
		array( 'name', 'twitter:description', $description ),
		array( 'name', 'twitter:image', $profile['social'] ),
	);

	printf( "<link rel=\"canonical\" href=\"%s\">\n", esc_url( $url ) );

	foreach ( $tags as list( $attribute, $key, $value ) ) {
		printf( "<meta %s=\"%s\" content=\"%s\">\n", esc_attr( $attribute ), esc_attr( $key ), esc_attr( $value ) );
	}
}
add_action( 'wp_head', 'psychwire_head_meta', 1 );

/**
 * Build the schema.org graph: Person, Organization (course provider), WebSite, WebPage and one Course per course.
 *
 * @return array<string,mixed>
 */
function psychwire_build_graph(): array {
	$profile   = psychwire_profile();
	$home      = home_url( '/' );
	$person_id = home_url( '/#person' );
	$org_id    = home_url( '/#organization' );
	$site_id   = home_url( '/#website' );
	$page_id   = home_url( '/#webpage' );
	$graph     = array(
		array(
			'@type'            => 'Person',
			'@id'              => $person_id,
			'name'             => $profile['name'],
			'jobTitle'         => $profile['title'],
			'description'      => $profile['bio'],
			'email'            => $profile['email'],
			'url'              => $home,
			'image'            => $profile['photo'],
			'knowsAbout'       => 'Acceptance and Commitment Therapy',
			'mainEntityOfPage' => array( '@id' => $page_id ),
			'address'          => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => $profile['locality'],
				'addressCountry'  => 'AU',
			),
		),
		array(
			'@type'   => 'Organization',
			'@id'     => $org_id,
			'name'    => $profile['name'],
			'url'     => $home,
			'founder' => array( '@id' => $person_id ),
		),
		array(
			'@type'      => 'WebSite',
			'@id'        => $site_id,
			'url'        => $home,
			'name'       => $profile['name'],
			'inLanguage' => PSYCHWIRE_LANG,
			'publisher'  => array( '@id' => $org_id ),
		),
		array(
			'@type'              => 'WebPage',
			'@id'                => $page_id,
			'url'                => $home,
			'name'               => psychwire_document_title( '' ),
			'description'        => psychwire_description(),
			'inLanguage'         => PSYCHWIRE_LANG,
			'isPartOf'           => array( '@id' => $site_id ),
			'about'              => array( '@id' => $person_id ),
			'primaryImageOfPage' => array(
				'@type'  => 'ImageObject',
				'url'    => $profile['social'],
				'width'  => 1200,
				'height' => 630,
			),
		),
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
			'inLanguage'        => PSYCHWIRE_LANG,
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

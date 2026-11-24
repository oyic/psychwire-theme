<?php
/**
 * Site content: the single source of truth for markup and structured data.
 *
 * @package Psychwire
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Practitioner profile.
 *
 * @return array{name:string,title:string,bio:string,email:string,photo_alt:string,locality:string}
 */
function psychwire_profile(): array {
	return array(
		'name'      => 'Dr Alex Rivera',
		'title'     => 'Clinical Psychologist and Trainer',
		'bio'       => 'Dr Alex Rivera is a clinical psychologist based in Sydney, Australia. For the past 12 years she has trained psychologists, counsellors and social workers in Acceptance and Commitment Therapy, a practical approach that helps people handle difficult thoughts and feelings and act on what matters to them.',
		'email'     => 'hello@example.com',
		'photo_alt' => 'Dr Alex Rivera smiling, wearing a white shirt',
		'locality'  => 'Sydney',
	);
}

/**
 * Courses offered. `workload` is an ISO 8601 duration; `url` is an in-page anchor.
 *
 * @return list<array{slug:string,name:string,description:string,length:string,workload:string,url:string}>
 */
function psychwire_courses(): array {
	$courses = array(
		array(
			'slug'        => 'intro-act',
			'name'        => 'Introduction to Acceptance and Commitment Therapy',
			'description' => 'The core ideas and skills, for practitioners new to the approach.',
			'length'      => '6 hours, online',
			'workload'    => 'PT6H',
		),
		array(
			'slug'        => 'act-anxiety',
			'name'        => 'Acceptance and Commitment Therapy for Anxiety',
			'description' => 'How to apply the approach with clients experiencing anxiety.',
			'length'      => '4 hours, online',
			'workload'    => 'PT4H',
		),
		array(
			'slug'        => 'act-supervision',
			'name'        => 'Acceptance and Commitment Therapy Supervision',
			'description' => 'Monthly group sessions to discuss cases and build confidence.',
			'length'      => '1.5 hours a month, online',
			'workload'    => 'PT1H30M',
		),
	);

	return array_map(
		static fn ( array $course ): array => $course + array( 'url' => home_url( '/#course-' . $course['slug'] ) ),
		$courses
	);
}

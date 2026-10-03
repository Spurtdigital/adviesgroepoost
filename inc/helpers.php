<?php
/**
 * Theme helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Find the permalink of a page that uses a given page template.
 *
 * @param string $template Template filename, e.g. 'page-oplossingen.php'.
 * @return string
 */
function creators_page_url_by_template( $template ) {
	$pages = get_posts(
		[
			'post_type'      => 'page',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_key'       => '_wp_page_template',
			'meta_value'     => $template,
		]
	);

	return ! empty( $pages ) ? get_permalink( (int) $pages[0] ) : '';
}

/**
 * Normalize an ACF link field and fill in a fallback URL/title when needed.
 *
 * @param mixed  $field          ACF link field value (array) or empty.
 * @param string $fallback_url   URL used when the field has no URL.
 * @param string $fallback_title Title used when the field has no title.
 * @return array{url:string,title:string,target:string}
 */
function creators_link_field( $field, $fallback_url, $fallback_title ) {
	if ( is_array( $field ) ) {
		$url   = ! empty( $field['url'] ) ? $field['url'] : $fallback_url;
		$title = ! empty( $field['title'] ) ? $field['title'] : $fallback_title;
		$target = ! empty( $field['target'] ) ? $field['target'] : '';

		return [
			'url'    => $url,
			'title'  => $title,
			'target' => $target,
		];
	}

	return [
		'url'    => $fallback_url,
		'title'  => $fallback_title,
		'target' => '',
	];
}

/**
 * Render creators_markdown output without an outer <p> wrapper.
 *
 * Handig voor titels die in een h1/h2/h3 of div komen, waar een
 * <p>-wrapper van creators_markdown niet mag.
 *
 * @param string $content Markdown-achtige inhoud.
 * @return string
 */
function creators_markdown_inline( $content ) {
	if ( function_exists( 'creators_markdown' ) ) {
		$html = creators_markdown( $content );
	} else {
		$html = '';
	}

	$html = trim( (string) $html );

	// Enkel een wrapper verwijderen als de volledige output uit één <p>-blok bestaat.
	if (
		1 === substr_count( $html, '<p>' )
		&& 0 === strpos( $html, '<p>' )
		&& '</p>' === substr( $html, -4 )
	) {
		$html = substr( $html, 3, -4 );
	}

	return $html;
}

/**
 * Willekeurige fallback-afbeelding uit de thema-optie "Builder fallback media".
 *
 * @return array|null
 */
function creators_fallback_media() {
	static $fallback_images = null;

	if ( null === $fallback_images ) {
		$fallback_images = [];
		$rows            = get_field( 'fall_back_media', 'options' );

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				$image = $row['afbeelding'] ?? null;

				if ( is_array( $image ) && ! empty( $image['url'] ) ) {
					$fallback_images[] = $image;
				}
			}
		}
	}

	if ( empty( $fallback_images ) ) {
		return null;
	}

	return $fallback_images[ wp_rand( 0, count( $fallback_images ) - 1 ) ];
}

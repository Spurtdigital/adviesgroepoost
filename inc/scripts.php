<?php

add_action( 'wp_enqueue_scripts', function() {
	$creators_css_path = CREATORS_THEME_DIR . '/dist/css/styles.css';
	$creators_js_path  = CREATORS_THEME_DIR . '/dist/js/app.js';

	wp_enqueue_style(
		'creators-css',
		CREATORS_THEME_URI . '/dist/css/styles.css',
		[],
		file_exists( $creators_css_path ) ? filemtime( $creators_css_path ) : null
	);
	wp_enqueue_style( 'font-awesome-pro', CREATORS_THEME_URI . '/assets/fontawesome/css/all.min.css', [], null );
	wp_enqueue_script(
		'creators-app',
		CREATORS_THEME_URI . '/dist/js/app.js',
		[],
		file_exists( $creators_js_path ) ? filemtime( $creators_js_path ) : null,
		true
	);
}, 20 );

// Load script as ES module
add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
	if ( 'creators-app' === $handle ) {
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	}
	return $tag;
}, 10, 3 );

// Load Font Awesome non-blocking: icons zijn niet kritiek voor de eerste paint.
add_filter( 'style_loader_tag', function( $tag, $handle ) {
	if ( 'font-awesome-pro' !== $handle ) {
		return $tag;
	}

	$tag = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $tag );
	$tag .= '<noscript><link rel="stylesheet" href="' . esc_url( CREATORS_THEME_URI . '/assets/fontawesome/css/all.min.css' ) . '"></noscript>';

	return $tag;
}, 10, 2 );

<?php

add_action( 'after_setup_theme', function() {
	load_theme_textdomain( 'creators', CREATORS_THEME_DIR . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
	register_nav_menus([
		'topmenu'     => __( 'Topmenu', 'creators' ),
		'hoofdmenu'   => __( 'Hoofdmenu', 'creators' ),
		'footermenu'  => __( 'Footer menu 1', 'creators' ),
		'footermenu2' => __( 'Footer menu 2', 'creators' ),
		'footermenu3' => __( 'Footer menu 3', 'creators' ),
		'footermenu4' => __( 'Footer menu 4', 'creators' ),
		'footermenu5' => __( 'Footer menu 5', 'creators' ),
		'footermenu6' => __( 'Footer menu 6', 'creators' ),
		'footermenu7' => __( 'Footer menu 7', 'creators' ),
		'footermenu8' => __( 'Footer menu 8', 'creators' ),
		'privacymenu' => __( 'Privacy menu', 'creators' ),
	]);
} );

// Register ACF Options Page
if ( function_exists( 'acf_add_options_page' ) ) {
	add_action( 'init', function() {
		acf_add_options_sub_page([
			'page_title' => 'Thema Settings',
			'menu_title' => 'Thema Settings',
			'menu_slug'  => 'thema-settings',
			'parent_slug' => 'acf-options-thema-velden',
			'capability' => 'manage_options',
			'redirect'   => false,
		]);
	});
}

add_action( 'after_setup_theme', function() {
	$GLOBALS['content_width'] = apply_filters( 'creators_content_width', 640 );
}, 0 );

// Remove default WooCommerce Styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_action( 'wp_enqueue_scripts', function () {
	// Bijvoorbeeld de block styles uitschakelen
	wp_dequeue_style('wc-block-style');
}, 100 );

/**
 * Verhoog max upload size naar 300MB. De echte limiet wordt bepaald door
 * upload_max_filesize/post_max_size op de server (php.ini, .user.ini of hosting panel);
 * deze filter en ini_set() zorgen dat WP dit ook toont/toestaat waar de server het toelaat.
 */
add_filter( 'upload_size_limit', function () {
	return 300 * MB_IN_BYTES;
} );

if ( function_exists( 'ini_set' ) ) {
	ini_set( 'memory_limit', '300M' );
	ini_set( 'max_execution_time', '300' );
	ini_set( 'max_input_time', '300' );
}

/**
 * Verwijder door thema/plugins toegevoegde image sizes (custom sizes).
 * Standaardmaten (thumbnail, medium, large, medium_large, 1536x1536, 2048x2048) blijven bestaan.
 */
add_filter('intermediate_image_sizes', function ($sizes) {
    // lijst met WP-core maten die je WEL wilt houden
    $keep = ['thumbnail'];

    // filter alle maten die niet in $keep zitten (dus: custom thema/plugin maten)
    return array_values(array_intersect($sizes, $keep));
});
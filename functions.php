<?php

if ( ! function_exists( 'creators_setup' ) ) :
	function creators_setup() {
		load_theme_textdomain( 'creators', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'widgets' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption'] );
		add_theme_support( 'customize-selective-refresh-widgets' );

		register_nav_menus( array(
            'topmenu' => esc_html__( 'Top menu', 'creators' ),
			'hoofdmenu' => esc_html__( 'Hoofdmenu', 'creators' ),
            'hoofdmenurechts' => esc_html__( 'Hoofdmenu rechts', 'creators' ),
            'isolatiemenu' => esc_html__( 'Isolatie menu', 'creators' ),
            'dakisolatiemenu' => esc_html__( 'dakisolatiemenu menu', 'creators' ),
            'spouwmuurisolatiemenu' => esc_html__( 'Spouwmuurisolatie menu', 'creators' ),
            'vloerisolatiemenu' => esc_html__( 'Vloerisolatie menu', 'creators' ),
            'hrglasmenu' => esc_html__( 'HR glas menu', 'creators' ),
            'warmtepompenmenu' => esc_html__( 'Warmtepompen menu', 'creators' ),
            // creators_spouwmuurisolatiemenu
            'servicemenu' => esc_html__( 'Diensten menu', 'creators' ),
            'zonnepanelenmenu' => esc_html__( 'Zonnepanelen menu', 'creators' ),
            'aboutmenu' => esc_html__( 'about menu', 'creators' ),
			'footermenu' => esc_html__( 'Footer menu', 'creators' ),
			'privacymenu' => esc_html__( 'Privacy menu', 'creators' ),

		) );
	}
endif;
add_action( 'after_setup_theme', 'creators_setup' );

function creators_topmenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'topmenu',
		'menu_class' => 'nav-bar-top__menu js-top-menu d-lg-flex',
		'theme_location' => 'topmenu',
		'depth' => 1
	));
}

function creators_hoofdmenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'hoofdmenu',
		'menu_class' => 'nav-bar__menu js-nav-bar-menu-left d-lg-flex',
		'theme_location' => 'hoofdmenu',
		'depth' => 3
	));
}
function creators_hoofdmenurechts() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'hoofdmenurechts',
		'menu_class' => 'nav-bar__menu js-nav-bar-menu-right d-lg-flex',
		'theme_location' => 'hoofdmenurechts',
		'depth' => 3
	));
}

function creators_warmtepompenmenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'warmtepompenmenu',
		'menu_class' => 'warmtepompenmenu',
		'theme_location' => 'warmtepompenmenu',
		'depth' => 1
	));
}

function creators_isolatiemenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'isolatiemenu',
		'menu_class' => 'isolatiemenu',
		'theme_location' => 'isolatiemenu',
		'depth' => 1
	));
}
function creators_spouwmuurisolatiemenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'spouwmuurisolatiemenu',
		'menu_class' => 'spouwmuurisolatiemenu',
		'theme_location' => 'spouwmuurisolatiemenu',
		'depth' => 1
	));
}

function creators_dakisolatiemenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'dakisolatiemenu',
		'menu_class' => 'dakisolatiemenu',
		'theme_location' => 'dakisolatiemenu',
		'depth' => 1
	));
}

function creators_vloerisolatiemenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'vloerisolatiemenu',
		'menu_class' => 'vloerisolatiemenu',
		'theme_location' => 'vloerisolatiemenu',
		'depth' => 1
	));
}

function creators_hrglasmenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'hrglasmenu',
		'menu_class' => 'hrglasmenu',
		'theme_location' => 'hrglasmenu',
		'depth' => 1
	));
}

function creators_zonnepanelen() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'zonnepanelen',
		'menu_class' => 'zonnepanelen',
		'theme_location' => 'zonnepanelen',
		'depth' => 1
	));
}

function creators_servicemenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'servicemenu',
		'menu_class' => 'servicemenu',
		'theme_location' => 'servicemenu',
		'depth' => 1
	));
}

function creators_aboutmenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'aboutmenu',
		'menu_class' => 'aboutmenu',
		'theme_location' => 'aboutmenu',
		'depth' => 1
	));
}

function creators_footermenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'footermenu',
		'menu_class' => 'footermenu',
		'theme_location' => 'footermenu',
		'depth' => 1
	));
}

function creators_privacymenu() {
	wp_nav_menu(array(
        'container' => false,
		'menu' => 'privacymenu',
		'menu_class' => 'privacymenu',
		'theme_location' => 'privacymenu',
		'depth' => 1
	));
}

function creators_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'creators_content_width', 640 );
}
add_action( 'after_setup_theme', 'creators_content_width', 0 );

function creators_scripts() {
	wp_enqueue_style( 'creators-css', get_template_directory_uri() .  '/dist/css/app.min.css' );
	wp_enqueue_script( 'creators-manifest', get_template_directory_uri() . '/dist/js/manifest.js', array(), null, false );
	wp_enqueue_script( 'creators-vendor', get_template_directory_uri() . '/dist/js/vendor.js', array(), null, false );
	wp_enqueue_script( 'creators-app', get_template_directory_uri() . '/dist/js/app.js', array(), null, false );
    wp_enqueue_script( 'creators-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), null, false );
}
add_action( 'wp_enqueue_scripts', 'creators_scripts' );

function add_defer_async_attribute($tag, $handle) {
    if (in_array($handle, ['creators-manifest', 'creators-vendor', 'creators-app'])) {
        return str_replace(' src', ' defer="defer" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_defer_async_attribute', 10, 2);

function add_preload_link() {
    $href = get_template_directory_uri() . '/dist/css/app.css'; // Het pad naar je CSS-bestand
    echo '<link rel="preload" href="' . esc_url($href) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
}
add_action('wp_head', 'add_preload_link');

function creators_remove_metabox() {
    if ( ! current_user_can( 'edit_others_posts' ) )
        remove_meta_box( 'wpseo_meta', 'post', 'normal' );
}
add_action( 'add_meta_boxes', 'creators_remove_metabox', 11 );

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
add_filter( 'use_widgets_block_editor', '__return_false' );

add_filter('use_block_editor_for_post', '__return_false', 10);


function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

// Forms include
include_once('includes/global/forms.php');
include_once('includes/reviews/reviews.php');
include_once('includes/global/grafity_forms.php');

remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_select_enum_rules', 20, 2 );
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_checkbox_enum_rules', 20, 2 );

function zoeken_in_custom_post_types( $query ) {
    if ( $query->is_search && !is_admin() ) {
        $query->set( 'post_type', array( 'post', 'page', 'dienst', 'zonnepanelen' ) );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'zoeken_in_custom_post_types' );
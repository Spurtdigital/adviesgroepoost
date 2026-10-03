<?php

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

add_filter( 'emoji_svg_url', '__return_false' );
add_filter( 'embed_oembed_discover', '__return_false' );
add_filter( 'tiny_mce_plugins', function($plugins) {
	return array_diff( $plugins, [ 'wpembed' ] );
});
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

add_filter( 'use_block_editor_for_post', '__return_false' );
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );
add_filter( 'use_widgets_block_editor', '__return_false' );

add_filter( 'style_loader_src', 'creators_remove_ver', 9999 );
add_filter( 'script_loader_src', 'creators_remove_ver', 9999 );
function creators_remove_ver( $src ) {
	return ( strpos( $src, 'ver=' ) ) ? remove_query_arg( 'ver', $src ) : $src;
}

add_action('get_header', function() {
	remove_action('wp_head', '_admin_bar_bump_cb');
});

add_action('wp_enqueue_scripts', function() {
    if (!is_admin() && !is_user_logged_in()) {
        wp_deregister_style('wp-block-library');
        wp_deregister_style('dashicons');
        wp_deregister_style('admin-bar');
        wp_deregister_script('admin-bar');
    }
}, 100);
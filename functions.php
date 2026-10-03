<?php
// Exit als dit bestand direct wordt aangeroepen
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Theme constants
 */
define( 'CREATORS_THEME_DIR', get_template_directory() );
define( 'CREATORS_THEME_URI', get_template_directory_uri() );

/**
 * Includes
 */
require_once CREATORS_THEME_DIR . '/inc/setup.php';
require_once CREATORS_THEME_DIR . '/inc/helpers.php';
require_once CREATORS_THEME_DIR . '/inc/acf.php';
require_once CREATORS_THEME_DIR . '/inc/cleanup.php';
require_once CREATORS_THEME_DIR . '/inc/scripts.php';
require_once CREATORS_THEME_DIR . '/inc/menus.php';
require_once CREATORS_THEME_DIR . '/inc/contactform7.php';
require_once CREATORS_THEME_DIR . '/inc/buttons.php';






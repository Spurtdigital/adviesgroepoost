<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<!-- Preload de meest gebruikte Poppins-weights (self-hosted) -->
		<link rel="preload" href="<?php echo CREATORS_THEME_URI; ?>/dist/fonts/poppins-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<link rel="preload" href="<?php echo CREATORS_THEME_URI; ?>/dist/fonts/poppins-700.woff2" as="font" type="font/woff2" crossorigin="anonymous">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
	  	<?php get_template_part('template-parts/layouts/layout', 'header'); ?>
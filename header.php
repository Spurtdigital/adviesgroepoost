<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


			<!-- Preload belangrijke FA-fonts -->
		<link rel="preload" href="<?php echo CREATORS_THEME_URI; ?>/assets/fontawesome/webfonts/fa-sharp-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<link rel="preload" href="<?php echo CREATORS_THEME_URI; ?>/assets/fontawesome/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
	  	<?php get_template_part('template-parts/layouts/layout', 'header'); ?>
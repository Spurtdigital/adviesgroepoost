<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
		<?php spurt_header() ?>
        <!-- Fonts -->
        <meta name="google-site-verification" content="O8SW87g4m8bhuJvZizm-sR7JqRixDxPY8cw7tXDIIWM" />
        <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/fonts/MazzardH-ExtraBold.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/fonts/MazzardH-Regular.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/fonts/MazzardH-Bold.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/fonts/mazzardh-medium.woff2" as="font" type="font/woff2" crossorigin>

        <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/fonts/MazzardH-ExtraBold.ttf" as="font" type="font/ttf" crossorigin>
        <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/fonts/MazzardH-Regular.ttf" as="font" type="font/ttf" crossorigin>
        <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/fonts/MazzardH-Bold.ttf" as="font" type="font/ttf" crossorigin>
            <!-- Laad FontAwesome All voor kernstijlen -->
            <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/css/all.min.css">

            <!-- Laad specifiek Sharp Regular en Sharp Solid -->
            <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/css/sharp-regular.min.css">
            <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/css/sharp-solid.min.css">

            <!-- Preload webfonts voor Sharp Regular en Sharp Solid -->
            <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/webfonts/fa-sharp-regular-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
            <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/webfonts/fa-sharp-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous">
            <noscript>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/css/all.min.css">
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/css/sharp-regular.min.css">
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/css/sharp-solid.min.css">
            </noscript>

        <!-- Hotjar Tracking Code for adviesgroepoost.nl -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:5174018,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
    </head>
	<body <?php body_class(); ?>>
	<?php get_template_part( 'template-parts/layouts/layout','header' ); ?>
<?php get_header(); ?>

<?php
$header_variant = is_singular( 'dienst' ) ? 'dienst' : 'single';
get_template_part( 'template-parts/headers/header', $header_variant );
?>

<?php get_template_part( 'template-parts/layouts/layout', 'builder' ); ?>


<?php get_footer(); ?>

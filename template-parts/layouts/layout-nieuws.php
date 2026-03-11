<?php $class = $args['class'];?>
<section class="layout-nieuws <?php echo $class; ?>">
    <div class="container">
        <h2 class="display-4 mb-lg-3 mb-2">Het laatste nieuws</h2>
        <div class="js-layout-nieuws slick-margin">
                <?php $loop = new WP_Query( array(
                'post_type' => 'post ',
                'posts_per_page' => -1
            )  ); ?>

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <?php get_template_part( 'template-parts/blocks/block','nieuws' ); ?>
            <?php endwhile; wp_reset_query(); ?>
        </div>
    </div>
</section>
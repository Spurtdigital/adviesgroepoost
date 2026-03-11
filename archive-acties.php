<?php /*Template Name: Archive - Acties */ get_header(); ?>

<section class="header-acties">
    <div class="container">
        <div class="row">
            <div class="offset-lg-2 col-lg-8">
                <div class="header-acties__content">
                    <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs --dark">','</div>' ); }?>
                    <?php if ( get_field('andere_titel_tonen') ) : ?>
                        <?php if ( get_field('alternatieve_h1_kop') ) : ?>
                            <h1 class="header-acties__title"><?php echo get_field('alternatieve_h1_kop'); ?></h1>
                        <?php else: ?>
                            <h1 class="header-acties__title"><?php the_title();?></h1>
                        <?php endif;?>
                        <h3 class="display-1"><?php echo get_field( 'andere_titel_tonen' );?></h3>
                    <?php else: ?>
                        <?php if ( get_field('alternatieve_h1_kop') ) : ?>
                            <h1 class="display-1"><?php echo get_field('alternatieve_h1_kop'); ?></h1>
                        <?php else: ?>
                            <h1 class="display-1"><?php the_title();?></h1>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-5 my-lg-10">
    <div class="container">
        <div class="row gy-lg-3 gy-2 justify-content-center">
            <?php $loop = new WP_Query( array(
                'post_type' => 'acties',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            )  ); ?>

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="col-xl-10">
                <?php get_template_part( 'template-parts/blocks/block','acties' ); ?>
            </div>
            <?php endwhile; wp_reset_query(); ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>


<?php get_footer(); ?>
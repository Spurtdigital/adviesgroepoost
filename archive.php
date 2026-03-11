<?php /*Template Name: Archive - News */ get_header(); $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

<section class="header-single">
    <div class="container">
        <div class="offset-xl-2">
            <div class="header-single__content">
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); }?>

                <?php if ( get_field('andere_titel_tonen') ) : ?>
                    <?php if ( get_field('alternatieve_h1_kop') ) : ?>
                        <h1 class="header-single__title"><?php echo get_field('alternatieve_h1_kop'); ?></h1>
                    <?php else: ?>
                        <h1 class="header-single__title"><?php the_title();?></h1>
                    <?php endif;?>
                    <h3 class="display-1 text-white"><?php echo get_field( 'andere_titel_tonen' );?></h3>
                <?php else: ?>
                    <?php if ( get_field('alternatieve_h1_kop') ) : ?>
                        <h1 class="display-1 text-white"><?php echo get_field('alternatieve_h1_kop'); ?></h1>
                    <?php else: ?>
                        <h1 class="display-1 text-white"><?php the_title();?></h1>
                    <?php endif;?>
                <?php endif;?>
            </div>
        </div>
    </div>
    <img fetchpriority="high"  src="<?php echo $featured_img_url;?>" alt="<?php the_title();?>">
</section>

<section class="my-lg-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-xl-8">
                <?php  
                $terms = get_terms(array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ));?>
                <ul class="reset-list list__links gx-1">
                    <?php  foreach ($terms as $term) {
                        $term_link = get_term_link($term); 
                        
                        ?>
                    <li class="me-1"><a href="<?php echo $term_link;?>"><?php echo $term->name; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="row gy-3">
            <?php $loop = new WP_Query( array(
                'post_type' => 'post',
                'posts_per_page' => -1
            )  );?>

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="col-xl-3 col-lg-4">
                <?php get_template_part( 'template-parts/blocks/block','nieuws' ); ?>
            </div>
            <?php endwhile; wp_reset_query(); ?>
        </div>
        <div class="col-xl-8 offset-xl-2 my-3">
        <?php the_content();?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/layouts/layout','seo', array( 'class' => 'my-3 my-lg-5' ) ); ?>

<?php get_footer(); ?>
<?php get_header(); $term = get_queried_object();?>

<section class="header-single">
    <div class="container">
        <div class="offset-xl-2">
            <div class="header-single__content">
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); }?>
                <h1 class="display-1 text-white"><?php single_cat_title();?></h1>
            </div>
        </div>
    </div>
    <img fetchpriority="high"  src="<?php echo get_field( 'uitgelichte_afbeelding', $term )['url'];?>" alt="<?php the_title();?>">
</section>
 
<section class="archive-news my-3 my-lg-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-xl-8">
                <?php echo term_description();?>
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
    </div>
</section>

<section class="archive-post mb-lg-5 mb-2">
    <div class="container">
        <div class="row g-2">
            <?php if(have_posts()): $count = 0; while( have_posts() ): the_post(); ?>
                <div class="col-lg-3 col-md-6">
                    <?php get_template_part( 'template-parts/blocks/block','nieuws' ); ?>
                </div>
            <?php $count++; endwhile; wp_reset_query(); endif; ?>
        </div>
    </div>
</section>

<?php get_footer();?>
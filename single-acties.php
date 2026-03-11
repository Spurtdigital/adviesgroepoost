<?php get_header(); $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

<section class="header-acties">
    <div class="container text-center">
        <h1 class="header-acties__title mb-1"><?php the_title();?></h1>
        <a href="#" class="btn btn-primary header-acties__btn"><?php echo get_field( 'ondertitel' );?></a>
    </div>
    <img src="<?php echo $featured_img_url;?>" alt="<?php the_title();?>">
</section>

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>


<?php get_footer();?>
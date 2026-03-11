<?php 
/* Template Name: Blog - Kozijn*/
/* Template Post Type: kozijn */ 


get_header();   $current_post_id = get_the_ID();?>

<?php get_template_part( 'template-parts/headers/header','single' ); ?>


<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<?php if(!get_field( 'auteur_verbergen' )):?>
<?php get_template_part( 'template-parts/components/component','author' ); ?>
<?php endif;?>


<?php
 if(!get_field( 'posts_verbergen' )):
if (get_field('handmatige_vulling')) {
    $posts = get_field('related_posts');
    } else {
        $loop = new WP_Query(array(
            'post_type' => 'kozijn',
            'posts_per_page' => -1,
            'post__not_in' => array($current_post_id)
        ));
    }
    ?>
    <section class="related-posts mb-lg-7">
        <div class="container">
            <h2 class="display-3 mb-lg-3 mb-1">Anderen bekeken ook</h2>
            <div class="js-related-posts slick-margin">
            <?php if (get_field('handmatige_vulling')) { ?>
                <?php foreach ($posts as $post) : setup_postdata($post); ?>
                        <?php get_template_part('template-parts/blocks/block', 'post'); ?>
                <?php endforeach;  wp_reset_postdata(); ?>
            <?php } else { ?>
                <?php while ($loop->have_posts()) :$loop->the_post();?>
                    <?php get_template_part('template-parts/blocks/block', 'post'); ?>
                <?php endwhile; wp_reset_query(); ?>
            <?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php get_footer(); ?>

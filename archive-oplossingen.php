<?php /*Template Name: Archive - Oplossingen */ get_header(); ?>

<?php get_template_part( 'template-parts/headers/header','single' ); ?>

<?php get_template_part( 'template-parts/components/component', 'usps', array( 'class' => 'mt-4 mb-0' ) ); ?>


<section class="py-lg-10 py-3">
    <div class="container">
        <div class="row gy-3">
            <?php if ( have_rows('oplossing_blokken') ) : ?>
            
                <?php while( have_rows('oplossing_blokken') ) : the_row(); ?>
            
                <div class="col-lg-4">
                    <div class="block-oplossing --<?php echo get_sub_field( 'kleur' );?>">
                        <h2 class="display-4 mb-2"><?php echo get_sub_field('titel'); ?></h2>
                        <p><?php echo get_sub_field( 'tekst' );?></p>
                        <?php $posts = get_sub_field('diensten'); ?>
                        <?php if ( $posts ): ?>
                            <ul class="mb-2">
                                <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        <?php endif; ?>
                        <a href="<?php echo get_sub_field( 'link' )['url'];?>" class="btn"><?php echo get_sub_field( 'link' )['title'];?></a>
                    </div>
                </div>
            
                <?php endwhile; ?>
            
            <?php endif; ?>
            
  
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<?php get_template_part( 'template-parts/layouts/layout','seo', array( 'class' => 'my-3 my-lg-5' ) ); ?>

<?php get_footer(); ?>
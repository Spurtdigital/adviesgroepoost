<?php /*Template Name: Page - Whatsapp */ get_header();?>

<section class="whatsapp-hero">
    <div class="container">
        <div class="row gx-lg-8">
            <div class="col-lg-7">
                <h1 class="whatsapp-hero__title mb-0"><?php echo get_field( 'hero_titel' );?></h1>
                <p class="lead mt-4 mb-2"><?php echo get_field( 'hero_tekst' );?></p>
                <div class="btns d-flex flex-wrap gap-1">
                <?php $btncount = 0; if ( have_rows('hero_buttons') ) : while( have_rows('hero_buttons') ) : the_row(); $btncount++;?>
                    <a href="<?php echo get_sub_field('button')['url']; ?>" class="btn <?php if($btncount < 2): echo 'btn-secondary'; else: echo 'btn-outline-secondary'; endif;?>"><?php echo get_sub_field('button')['title']; ?></a>
                <?php endwhile;  endif; ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="whatsapp-hero__media">
                    <img loading="lazy"  src="<?php echo get_field( 'hero_afbeelding' )['url'];?>" alt="<?php echo get_field( 'hero_afbeelding' )['alt'];?>">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="whatsapp-usps mt-3 mb-lg-5 mb-3">
    <div class="container">
        <div class="row gy-1">
            <?php if ( have_rows('hero_usps') ) : ?>
                <?php while( have_rows('hero_usps') ) : the_row(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="whatsapp-usps__usp">
                            <?php echo get_sub_field('icoon'); ?> <?php echo get_sub_field('tekst'); ?>
                        </div>
                    </div> 
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="whatsapp-intro my-3 my-md-5 my-xl-10">
    <div class="container d-flex align-items-center justify-content-center text-center">
        <div class="col-lg-7">
            <h2 class="whatsapp-intro__title mb-md-3 mb-1">
                <?php echo get_field( 'intro_titel' );?>
            </h2>
            <p class="lead mb-0"><?php echo get_field( 'intro_ondertekst' );?></p>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<?php get_footer();?>

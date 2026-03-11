<?php /*Template Name: Page - Home */ get_header();?>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

<section class="home-hero">
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 col-xl-8 col-lg-8">
                <h1 class="display-1 text-white mb-lg-2 me-xl-6">Adviesgroep Oost, jouw partner voor <span id="typed"></span></h1>
                <p class="text-white mb-3"><?php echo get_field( 'hero_tekst' );?></p>
                <strong class="text-white d-block">Start direct, onze adviseur komt graag gratis langs!</strong>
                <!-- Setup and start animation! -->
                <script>
                    var typed = new Typed('#typed', {
                    strings: ['dakisolatie.', 'zonnepanelen.', 'glasisolatie.', 'airconditioning.', 'vloerisolatie.', 'zoldervloer isoleren.', 'spouwmuurisolatie.', 'bodemisolatie.','warmtepompen.'],
                    typeSpeed: 200,
                    });
                </script>
            </div>
            <div class="col-lg-10">
                <form action="<?php echo get_field('global_adviesgesprek', 'options')['url']; ?>" class="home-hero-form gap-1 mt-1" method="get">
                    <div class="home-hero-form-flex gap-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="postcode" name="postcode" required placeholder="postcode">
                            <label for="postcode" class="form-label">Postcode</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="huisnummer" name="huisnummer" required placeholder="huisnummer">
                            <label for="huisnummer" class="form-label">Huisnummer</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success text-white">Adviesgesprek aanvragen</button>
                </form>
            </div>
        </div>
    </div>
    <img class="d-none d-md-block" fetchpriority="high" loading="eager" decoding="async" 
     src="<?php echo spurt_image(get_field('hero_afbeelding')['url'], 1440, 9999);?>"
     srcset="<?php echo spurt_image(get_field('hero_afbeelding')['url'], 1440, 9999);?> 1440w,
             <?php echo spurt_image(get_field('hero_afbeelding')['url'], 960, 666);?> 960w,
             <?php echo spurt_image(get_field('hero_afbeelding')['url'], 640, 444);?> 640w,
             <?php echo spurt_image(get_field('hero_afbeelding')['url'], 440, 344);?> 440w",
     sizes="(min-width: 992px) 1440px, (min-width: 576px) 960px, 640px"
     alt="<?php echo get_field('hero_afbeelding')['alt'];?>">

     <img height="400" width="600" class="d-block d-md-none" fetchpriority="high"
     src="<?php echo spurt_image(get_field('hero_afbeelding')['url'], 1440, 9999);?>"
     srcset="<?php echo spurt_image(get_field('hero_afbeelding')['url'], 640, 444);?> 640w,
             <?php echo spurt_image(get_field('hero_afbeelding')['url'], 440, 344);?> 440w",
     sizes="(min-width: 992px) 700px, (min-width: 576px) 960px, 640px, 340px"
     alt="<?php echo get_field('hero_afbeelding')['alt'];?>">
</section>

<?php if ( have_rows('hero_blokken') ) : ?>
<section class="home-intro-blocks">
    <div class="container">
        <div class="home-intro-blocks__inner">
            <div class="row gx-0 ">
                    <?php while( have_rows('hero_blokken') ) : the_row(); ?>
                    <div class="col-xl-3 col-lg-6">
                        <div class="block-intro d-flex align-items-center">
                            <div class="block-intro__icon">
                                <img src="<?php echo get_sub_field( 'icoon' )['url'];?>" alt="<?php echo get_sub_field( 'icoon' )['alt'];?>">
                            </div>
                            <div class="block-intro__content">
                                <strong><?php echo get_sub_field('titel'); ?></strong>
                                <p class="mb-0"><?php echo get_sub_field( 'tekst' );?></p>
                            </div>
                            <a href="<?php echo get_sub_field( 'link' )['url'];?>" class="stretched-link"></a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="home-intro pt-2 pb-lg-5 pb-3 bg-light">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-7 col-lg-10 my-lg-5 mt-3 mb-0 text-lg-center">
                <h2 class="display-2 mb-0"><?php echo get_field( 'intro_titel' );?></h2>
            </div>
        </div>
        <div class="row gx-lg-5">
            <div class="col-lg-6 mb-2 mb-lg-0">
                <div class="content-split__media d-none d-lg-block">
                    <img src="<?php echo spurt_image(get_field( 'intro_afbeelding' )['url'],720,9999)?>" alt="<?php echo get_field( 'intro_afbeelding' )['alt']?>" <?php if(get_sub_field( 'afbeelding_contain' )): echo'style="object-fit:contain"'; endif;?>>
                </div>
            </div>
            <div class="col-lg-6 py-1">
                <?php echo get_field('intro_tekstvlak'); ?>
                <?php $posts = get_field('intro_links'); ?>
                <?php if ( $posts ): ?>
                    <ul class="content-linklist">
                        <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a>
                            </li>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </ul>
                <?php endif; ?>
                <?php if(get_field( 'intro_link' )):?>
                    <a href="<?php echo get_field( 'intro_link' )['url'];?>" class="btn btn-primary mt-1"><?php echo get_field( 'intro_link' )['title'];?></a>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/components/component', 'usps', array( 'class' => 'bg-light pb-lg-4 pb-2' ) ); ?>

<?php get_template_part( 'template-parts/layouts/layout', 'method', array( 'class' => '--dark' ) ); ?>

<?php if ( have_rows('blokken') ) : ?>
<section class="home-content-blocks">
    <div class="container">
        <div class="row gy-3">
            <?php while( have_rows('blokken') ) : the_row(); ?>
            <div class="col-lg-6">
                <div class="home-content-blocks__block">
                    <h4 class="display-2 mb-0"><?php echo get_sub_field('titel'); ?></h4>
                    <p class="mb-md-2 mb-1 mt-1 mt-md-3"><?php echo get_sub_field('tekst'); ?></p>
                    <?php if(get_sub_field( 'link' )):?>
                    <a href="<?php echo get_sub_field( 'link' )['url'];?>" class="btn btn-primary mt-1"><?php echo get_sub_field( 'link' )['title'];?></a>
                    <?php endif;?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/layouts/layout', 'reviews', array( 'class' => '' ) ); ?>

<?php get_template_part( 'template-parts/layouts/layout','nieuws', array( 'class' => 'mt-lg-5 mt-3' ) ); ?>

<?php get_template_part( 'template-parts/layouts/layout','seo', array( 'class' => 'my-3 my-lg-5' ) ); ?>


<?php get_footer();?>

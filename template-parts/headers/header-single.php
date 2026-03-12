<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
<?php $class = $args['class'];?>

<section class="header-single <?php echo $class; ?>">
    <div class="container">
        <div class="row">
            <div class="<?php if($class == '--small' ): echo'col-12'; else: echo'offset-lg-1 col-lg-8'; endif; ?>">
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
    </div>
    <img fetchpriority="high" src="<?php echo spurt_image($featured_img_url, 1440, 9999);?>" alt="<?php the_title();?>">
</section>
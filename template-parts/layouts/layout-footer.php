<?php  $gemeenten = get_field('gemeenten', 'options');if ($gemeenten) {?>
<section class="global-gemeenten">
    <div class="container">
        <h2 class="display-5">Wij zijn actief in onder andere de volgende gemeenten</h2>
        <div class="js-gemeenten">
        <?php
                    // Willekeurige volgorde toepassen op de gemeenten
                    shuffle($gemeenten);

                    // Maximaal 20 items weergeven
                    $aantal_items_weergeven = min(20, count($gemeenten));

                    for ($i = 0; $i < $aantal_items_weergeven; $i++) {
                        $gemeente = $gemeenten[$i];
                ?>
                        <div class="global-gemeenten__block">
                            <img loading="lazy" fetchpriority="low" src="<?php echo spurt_image($gemeente['logo']['url'], 150, 9999); ?>" alt="">
                        </div>
                <?php
                    }
               ?>
        </div>
    </div>
</section>
<?php  } ?>
<?php if(get_field( 'notice_tonen', 'options' )):?>
    <?php $rating = review_stars();?>
    <div class="notice js-notice">
        <a class="js-notice-close notice__close"><i class="fa-sharp fa-solid fa-xmark"></i></a>
        <div class="notice__inner">
            <div class="notice__header align-items-center justify-content-between">
                <div class="notice__reviews d-flex align-items-center">          
                    <ul class="reset-list d-flex">
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                    <strong><?php echo $rating['score']* 2; ?>/10 </strong>
                </div>
                <strong class="notice__title">
                    <?php echo get_field( 'notice_titel', 'options' );?>
                </strong>
            </div>
            <div class="notice__content">
                <p class="mb-0"><?php echo get_field( 'notice_tekst', 'options' );?></p>
                <a href="<?php echo get_field( 'notice_link','options' )['url'];?>" class="btn btn-primary my-1"><?php echo get_field( 'notice_link','options' )['title'];?></a>
                <small class="d-block"><?php echo get_field( 'notice_subtekst', 'options' );?></small>
            </div>
        </div>
    </div>
<?php endif;?>
<?php if(!get_field( 'verberg_sticky_cta', 'options' )):?>
<div class="fixed-cta align-items-end">
    <a href="<?php echo get_field( 'global_adviesgesprek', 'options' )['url'];?>" class="fixed-cta-top d-flex align-items-center">    
        <div class="fixed-cta__image">
            <img loading="lazy" fetchpriority="low" src="<?php echo get_field( 'fixedcta_afbeelding', 'options' )['url'];?>" alt="<?php echo get_field( 'fixedcta_afbeelding', 'options' )['alt'];?>">
        </div>
        <div class="fixed-cta__content">
            <?php echo get_field( 'global_adviesgesprek', 'options' )['title'];?>
        </div>
    </a>
    <a target="_blank" href="<?php echo get_field( 'whatsapp_link', 'options' )?>" class="fixed-cta-bottom">
        <?php echo get_field( 'fixedcta_tekst', 'options' );?>
    </a>
</div>
<?php endif;?>

<footer class="footer js-has-dark">
    <div class="footer-top">
		<div class="container">
			<div class="row gx-3 gx-md-0 gx-lg-2 gx-xl-3">
				<div class="col-lg-6 col-md-4">
					<div class="footer-top-media">
						<img loading="lazy" src="<?php echo spurt_image(get_field( 'footer_top_image','options' )['url'], 620, 9999);?>" alt="<?php echo get_field( 'footer_top_image','options' )['alt'];?>">
					</div>
				</div>
				<div class="col-lg-6 col-md-8">
					<div class="footer-top-block">
						<h4 class="display-3 mb-0"><?php echo get_field( 'footer_top_titel', 'options' );?></h4>
						<p class="my-lg-3 my-2"><?php echo get_field( 'footer_top_tekst', 'options' );?></p>
                        <?php if ( get_field('footer_top_titel','options') ) : ?>
                            <a href="<?php echo get_field( 'footer_top_link', 'options' )['url'];?>" class="btn btn-primary"><?php echo get_field( 'footer_top_link', 'options' )['title'];?></a>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-middle">
		<div class="container">
			<div class="row gy-lg-5 gy-1">
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
					<strong class="footer-middle__title">Contact <span class="js-footer-toggle footer__toggle">+</span></strong>
					<nav class="footer-middle__nav">
						<ul class="active mb-1">
                            <li><a href="tel:<?php echo get_field( 'algemeen_telefoonnummer', 'options' );?>"><?php echo get_field( 'algemeen_telefoonnummer', 'options' );?></a></li>
                            <li><a href="mailto:<?php echo get_field( 'algemeen_mailadres', 'options' );?>"><?php echo get_field( 'algemeen_mailadres', 'options' );?></a></li>
                            <li><a target="_blank" href="<?php echo get_field( 'whatsapp_link', 'options' )?>">Whatsapp</a></li>
						</ul>
					</nav>
                    <strong class="footer-middle__title">Kantoor <span class="js-footer-toggle footer__toggle">+</span></strong>
					<nav class="footer__menu">
                        <ul>
                            <li class="position-relative"><a target="_blank" class="stretched-link" href="https://www.google.com/maps/place/Adviesgroep+Oost+b.v./@52.2855357,6.5680754,17z/data=!4m7!3m6!1s0x80abe90f3bd6686f:0x3e1882dd7ed2636a!8m2!3d52.2855324!4d6.5702694!9m1!1b1"><?php echo get_field( 'algemeen_straatnaam', 'options' );?> <br> <?php echo get_field( 'algemeen_postcode', 'options' );?> <?php echo get_field( 'algemeen_plaats', 'options' );?></a></li>
                        </ul>
                    </nav>
				</div>
                <div class="col-xl-2 col-lg-3 col-md-6 ">
                    <strong class="footer-middle__title">Isolatie <span class="js-footer-toggle footer__toggle">+</span></strong>
                    <nav class="footer__menu">
						<?php echo creators_isolatiemenu();?>
					</nav>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 ">
                    <strong class="footer-middle__title">Spouwmuurisolatie <span class="js-footer-toggle footer__toggle">+</span></strong>
                    <nav class="footer__menu">
						<?php echo creators_spouwmuurisolatiemenu();?>
					</nav>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 ">
                    <strong class="footer-middle__title">Dakisolatie <span class="js-footer-toggle footer__toggle">+</span></strong>
                    <nav class="footer__menu">
						<?php echo creators_dakisolatiemenu();?>
					</nav>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 ">
                    <strong class="footer-middle__title">Vloerisolatie <span class="js-footer-toggle footer__toggle">+</span></strong>
                    <nav class="footer__menu">
						<?php echo creators_vloerisolatiemenu();?>
					</nav>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 ">
                    <strong class="footer-middle__title">Ga direct naar <span class="js-footer-toggle footer__toggle">+</span></strong>
                    <nav class="footer__menu">
						<?php echo creators_servicemenu();?>
					</nav>
                </div>
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <strong class="footer-middle__title">Warmtepompen <span class="js-footer-toggle footer__toggle">+</span></strong>
					<nav class="footer__menu">
                        <?php echo creators_warmtepompenmenu();?>
                    </nav>
				</div>
                <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                    <strong class="footer-middle__title">Zonnepanelen <span class="js-footer-toggle footer__toggle">+</span></strong>
					<nav class="footer__menu has-two">
                        <?php echo creators_zonnepanelen();?>
                    </nav>
				</div> 
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <strong class="footer-middle__title">Over ons <span class="js-footer-toggle footer__toggle">+</span></strong>
					<nav class="footer__menu">
                        <?php echo creators_aboutmenu();?>
                    </nav>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <strong class="footer-middle__title">HR glas <span class="js-footer-toggle footer__toggle">+</span></strong>
					<nav class="footer__menu">
                        <?php echo creators_hrglasmenu();?>
                    </nav>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <strong class="footer-middle__title">Laatste nieuws <span class="js-footer-toggle footer__toggle">+</span></strong>
					<nav class="footer__menu">
                        <ul>
                        <?php $loop = new WP_Query( array(
                            'post_type' => 'post',
                            'posts_per_page' => 3
                        )  );?>

                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
                        <?php endwhile; wp_reset_query(); ?>
                        </ul>
                    </nav>
                </div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container d-flex align-items-center justify-content-between flex-wrap gap-1">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="footer-bottom__social">
                    <?php spurt_social();?>
                </div>
                <nav class="footer-bottom__menu">
                    <?php creators_privacymenu();?>
                </nav>
            </div>
            <div class="spurt-logo">
                <?php spurt_branding();?>
            </div>
		</div>
	</div>
</footer>
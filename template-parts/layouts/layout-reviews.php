
<?php $class = $args['class'];?>




<section class="reviews <?php echo $class; ?>">
    <div class="container">
        <h5 class="display-4 mb-2 mb-lg-4">Waar wacht je op? 400 klanten geven ons een 9/10</h5>
        <div class="row gx-0 d-flex align-items-end">
            <div class="col-lg-9 mb-lg-3 mb-2">
            <?php if( have_rows('ervaringen', 2526) ):  $teller = 0; // Start de teller ?>
                <div class="js-reviews slick-margin --small slick-box-shadow">
                <?php while( have_rows('ervaringen', 2526) && $teller < 5 ): the_row();  $teller++; ?>
                    <div class="block-ervaring block-ervaring--slider">
                        <div class="block-ervaring__content">
                            <h3 class="display-5 mb-0"><?php echo get_sub_field( 'naam' );?> <span class="fw-normal">uit <?php echo get_sub_field( 'plaats' );?></span></h3>
                            <?php if ( get_sub_field( 'ondertitel' ) ) : ?>
                                <span class="text-success block-ervaring__subtitle"><?php echo get_sub_field( 'ondertitel' )?></span>
                            <?php endif; ?>
                            <p class="my-2 dot-this"><?php echo get_sub_field( 'review' );?></p>
                        </div>
                        <div class="block-ervaring__footer d-flex align-items-center justify-content-between w-100">
                            <div class="block-ervaring__stars d-flex align-items-center">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <?php 
                                    $destionation = get_sub_field( 'review_vanuit' );
                                    switch ($destionation) {
                                        case "website":
                                        $destionationIcon = '';
                                        break;
                                        case "google":
                                            $destionationIcon = '<i class="fa-brands fa-google"></i>';
                                        break;
                                        case "facebook":
                                            $destionationIcon = '<i class="fa-brands fa-facebook-f"></i>';
                                        break;
                                    }
                                ?>
                                <?php echo $destionationIcon; ?>
                                <strong class="ms-1"><?php echo get_sub_field( 'review_cijfer' );?></strong>
                            </div>
                        </div>
                </div>
                <?php endwhile; ?>
            </div>
            <a href="<?php echo get_permalink('2526');?>" class="text-decoration-none">Bekijk alle ervaringen<i class="fa-regular fa-arrow-right ms-1 text-secondary"></i></a>
        <?php endif; ?>
            </div>
            <div class="col-lg-3">
                <div class="reviews-container__image d-none d-lg-block">
                    <img src="<?php echo get_field( 'fixedcta_afbeelding', 'options' )['url'];?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

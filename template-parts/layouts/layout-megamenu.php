<nav class="js-mega-menu mega-menu">
    <ul class="reset-list d-lg-flex align-items-center gap-xl-3 gap-2">
        <?php if ( have_rows('hoofdmenu','options') ) : while( have_rows('hoofdmenu','options') ) : the_row(); // start mega menu?>
        <li>
            <?php if(! get_sub_field( 'mega_menu_tonen' )):?>
                <a href="<?php echo get_sub_field('hoofdmenu_link')['url']; ?>"><?php echo get_sub_field('hoofdmenu_link')['title']; ?></a>
            <?php else : ?>
                <a href="<?php echo get_sub_field('hoofdmenu_link')['url']; ?>" class="js-mega-menu-toggle d-flex justify-content-between align-items-center w-100">
                    <?php echo get_sub_field('hoofdmenu_link')['title']; ?>
                    <i class="d-xl-none d-block ms-lg-1 fa-sharp fa-regular fa-arrow-right"></i>
                    <i class="d-xl-block d-none ms-lg-1 fa-sharp fa-regular fa-chevron-down"></i>
                </a>
                <div class="mega-menu-wrapper">
                    <div class="js-mega-menu-return container mega-menu-return d-block d-lg-none mt-1">
                        <a href="#" class="text-decoration-none"><i class="fa-sharp fa-light fa-arrow-left me-2"></i>Terug</a>
                    </div>
                    <div class="mega-menu-wrapper__inner">
                        <div class="container">
                            <div class="row gx-lg-5">
                                <?php
                                $numrows = 0;
                                $uitgelichte_links = get_sub_field('uitgelichte_links');
                                if (is_array($uitgelichte_links) || $uitgelichte_links instanceof Countable) {
                                    $numrows = count($uitgelichte_links);
                                }  ?>
                                <?php if ( have_rows('submenu_items', 'options') ) : while( have_rows('submenu_items', 'options') ) : the_row();?>
                                    <div class="mb-lg-0 mb-sm-2 mb-1 <?php if($numrows = 0): echo 'col-xl-4 col-lg-3'; else: echo 'col-xl-2 col-lg-3'; endif; ?>">
                                        <?php if(get_sub_field( 'sub_hoofd_link', 'options' )):?>
                                          <a href="<?php echo get_sub_field('sub_hoofd_link')['url'];?>" class="js-sub-menu-title d-flex w-100 justify-content-between"><strong><?php echo get_sub_field('sub_hoofd_link')['title']; ?></strong> <i class="d-block d-lg-none fa-sharp fa-regular fa-arrow-down"></i></a> 
                                        <?php endif;?>
                                          <ul class="mega-menu__sub reset-list">
                                            <?php if ( have_rows('links') ) : ?>
                                                <?php while( have_rows('links') ) : the_row(); ?>
                                                    <li><a href="<?php echo get_sub_field('link')['url']; ?>"><?php echo get_sub_field('link')['title']; ?></a></li>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                <?php endwhile;  endif; ?>
                                <?php if ( have_rows('uitgelichte_links') ) : ?>
                                <div class="col-xl-5 col-lg-6">
                                    <ul class="mega-menu__links reset-list columns-2">
                                        <?php while( have_rows('uitgelichte_links') ) : the_row(); ?>
                                            <li class="position-relative">
                                                <strong class="d-block fw-medium"><i class="fa-light fa-comments me-1 text-primary"></i><?php echo get_sub_field( 'titel', 'options' );?></strong>
                                                <small class="d-block"><?php echo get_sub_field( 'korte_omschrijving', 'options' );?></small>
                                                <?php if ( get_sub_field('link') ) : ?>
                                                    <a href="<?php echo get_sub_field( 'link' )['url'];?>" class="stretched-link">Bekijk meer<i class="ms-1 fa-sharp fa-regular fa-angle-right"></i></a>
                                                <?php endif; ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <div class="<?php if($numrows = 0): echo 'col-xl-2'; else: echo 'col-xl-3'; endif; ?> d-xl-block d-none">
                                    <div class="mega-menu-wrapper__media">
                                        <?php if(get_sub_field( 'afbeelding', 'options' )):?>
                                            <img class="img-abs-center" src="<?php echo get_sub_field( 'afbeelding', 'options' )['url'];?>" alt="<?php echo get_sub_field( 'afbeelding', 'options' )['alt'];?>">
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </li>
        <?php endwhile;  endif; // end mega menu?>
    </ul>
</nav>
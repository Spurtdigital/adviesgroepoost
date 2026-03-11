<?php $rating = review_stars();?>
<!-- <header class="nav-bar js-nav-bar">
    <div class="nav-bar-middle">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="<?php echo get_home_url();?>" class="nav-bar__logo"></a>
            <div class="nav-bar__right js-nav-bar-right">
                <div class="nav-bar-top js-nav-bar-top d-flex align-items-center justify-content-between">
                    <div class="nav-bar__reviews d-flex align-items-center position-relative">
                        <ul class="reset-list d-flex">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <?php echo $rating['score']*2; ?> / 10 (<a rel="noopener" href="https://www.google.com/maps/place/Adviesgroep+Oost+b.v./@52.2855357,6.5680754,17z/data=!4m7!3m6!1s0x80abe90f3bd6686f:0x3e1882dd7ed2636a!8m2!3d52.2855324!4d6.5702694!9m1!1b1" target="_blank" title="Bekijk beoordelingen van onze klanten"><?php echo $rating['count']; ?> beoordelingen</a>)
                    </div>
                    <nav class="js-top-mav">
                        <?php creators_topmenu(); ?>  
                    </nav>
                </div>
                <div class="nav-bar__action d-flex align-items-center justify-content-end">
                    <nav class="js-nav-bar-menu">
                        <?php creators_hoofdmenu(); ?>
                    </nav>
                    <a href="<?php echo get_field( 'global_adviesgesprek', 'options' )['url'];?>" class="btn btn-primary ms-2"><?php echo get_field( 'global_adviesgesprek', 'options' )['title'];?></a>
                    <div class="js-nav-toggle nav-toggle"><span class="nav-toggle__icon"><span></span></span></div>
                </div>
            </div>
        </div>
    </div>
</header> -->
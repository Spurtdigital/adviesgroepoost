<?php $class = $args['class'];?>
<section class="layout-seo content content--nomargin <?php echo $class; ?>">
    <div class="container">
        <h2 class="display-5 mb-2 mb-lg-3"><?php echo get_field( 'seo_titel' );?></h2>
        <div class="row gy-lg-3 gy-1">
            <div class="col-lg-6">
                <?php echo get_field( 'seo_tekst_links' );?>
            </div>
            <div class="col-lg-6">
                <?php echo get_field( 'seo_tekst_rechts' );?>
            </div>
        </div>
    </div>
</section>
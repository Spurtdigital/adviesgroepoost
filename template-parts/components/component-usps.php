<?php $global = $args['class'];?>

<section class="global-usps <?php echo $global; ?>">
    <div class="container">
        <div class="js-global-usps">
            <?php if ( have_rows('company_usps','options') ) : ?>
                <?php while( have_rows('company_usps','options') ) : the_row(); ?>
                    <div><i class="fa-sharp fa-solid fa-circle-check text-success"></i><?php echo get_sub_field('usp'); ?></div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
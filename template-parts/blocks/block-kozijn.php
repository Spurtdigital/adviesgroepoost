<div class="block-frame position-relative">
    <div class="block-frame__media">
        <?php if(get_field( 'product_afbeelding' )):?>
            <img loading="lazy" class="img-abs-center" src="<?php echo get_field( 'product_afbeelding' )['url'];?>" alt="<?php echo get_field( 'product_afbeelding' )['alt'];?>">
        <?php endif;?>
    </div>
    <strong class="block-frame__title"><?php the_title();?></strong>
    <a href="<?php the_permalink();?>" class="stretched-link"></a>
</div>
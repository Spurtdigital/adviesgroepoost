<div class="block-acties d-md-flex align-items-stretch">
    <div class="block-acties__media">
        <img loading="lazy" src="<?php echo get_field( 'algemeen_afbeelding' )['url'];?>" alt="<?php echo get_field( 'algemeen_afbeelding' )['alt'];?>">
    </div>
    <div class="block-acties__content">
        <?php if ( get_field('label') ) : ?>
            <span class="block-acties__label"><?php echo get_field( 'label' );?></span>
        <?php endif; ?>
        <h3 class="display-3 mb-lg-2 mt-1"><?php the_title();?></h3>
        <p class="mb-0"><?php echo get_field( 'introductie_tekst' );?></p>
        <?php if ( have_rows('stappen') ) : $stepcount = 0; ?>
            <ul>
            <?php while( have_rows('stappen') ) : the_row(); $stepcount++; ?>
                <li><span><?php echo $stepcount; ?></span><?php echo get_sub_field( 'stap' );?></li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <?php if ( have_rows('links') ) : $links = 0;?>     
            <div class="btns">
                <?php while( have_rows('links') ) : the_row(); $links ++; ?>
                <?php if(count(get_field('links')) == 1){ ?>
                    <a href=" <?php echo get_sub_field('link')['url']; ?>" class="text-<?php echo $links < 2 ? 'secondary' : 'dark'; ?>"> <?php echo get_sub_field('link')['title']; ?></a>
                    <a href=" <?php the_permalink();?>" class="text-dark">Meer informatie</a>

                <?php } else { ?>
                    <a href=" <?php echo get_sub_field('link')['url']; ?>" class="text-<?php echo $links < 2 ? 'secondary' : 'dark'; ?>"> <?php echo get_sub_field('link')['title']; ?></a>
                <?php } ?>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <a href=" <?php the_permalink(); ?>" class="text-dark fw-bold">Lees meer</a>

        <?php endif;?>

    </div>
</div>
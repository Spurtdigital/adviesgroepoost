<?php $global = $args['global'];?>
<?php if ( have_rows('component_buttons', $global) ) : $btncount = 0;?>
    <div class="content-btns">
    <?php while( have_rows('component_buttons', $global) ) : the_row(); $btncount++;?>
    <?php if(get_sub_field( 'button' )) :?>
        <a class="btn btn-<?php echo get_sub_field( 'kleur' );?>" href="<?php echo get_sub_field('button')['url']; ?>" <?php if(get_sub_field( 'fancybox' )): echo'data-fancybox'; endif;?>><?php echo get_sub_field('button')['title']; ?></a>
    <?php endif; endwhile; ?>
    </div>
<?php endif; ?>
<?php $featured_img_url = get_the_post_thumbnail_url($post->ID, 'thumnail'); ?>
<div class="block-post">
    <div class="block-post__media">
        <?php if($featured_img_url):?>
            <img loading="lazy" src="<?php echo spurt_image($featured_img_url, 350, 9999);?>" alt="<?php echo the_title();?>">
        <?php endif;?>
    </div>
    <div class="block-post__content">
        <h3 class="display-6"><?php the_title();?></h3>
    </div>
    <a href="<?php the_permalink();?>" class="stretched-link"></a>
</div>
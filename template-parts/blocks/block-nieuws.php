<?php $featured_img_url = get_the_post_thumbnail_url($post->ID, 'thumnail'); ?>
<div class="block-nieuws">
    <div class="block-nieuws__media">
        <?php if($featured_img_url):?>
        <img loading="lazy" src="<?php echo spurt_image($featured_img_url, 500, 9999);?>" alt="<?php echo the_title();?>">
        <?php endif;?>
    </div>
    <div class="block-nieuws__content">
        <span class="block-nieuws__cat">
            <?php $category = get_the_category();  echo $category[0]->cat_name; ?>
        </span>
        <h3 class="display-6"><?php the_title();?></h3>
    </div>
    <a href="<?php the_permalink();?>" class="stretched-link"></a>
</div>
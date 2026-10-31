<?php
$class      = $args['class'] ?? '';
$variant_alt = in_array( $class, [ 'alt', 'block-post--alt' ], true );
$block_modifier = $variant_alt ? ' block-post--alt' : ( $class ? ' ' . esc_attr( $class ) : '' );

$post_id = get_the_ID();

if ( ! $post_id ) {
    $resolved_post = get_post();
    $post_id = $resolved_post ? (int) $resolved_post->ID : 0;
}

$featured_img_id = $post_id ? get_post_thumbnail_id( $post_id ) : 0;
$icon = get_field( 'icoon' );
$icon_url = is_array( $icon ) ? ( $icon['url'] ?? '' ) : '';
?>
<div class="block-post position-relative<?php echo $block_modifier; ?>">
    
    <div class="block-post__media mb-2 position-relative rounded-4 overflow-hidden">
        <?php if($variant_alt && $icon_url):?>
         <img class="img-abs-center--contain" loading="lazy" src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
        <?php else : ?>
        <?php if($featured_img_id):?>
        <?php
        $post_image_class = $variant_alt ? 'img-abs-center--contain' : 'img-abs-center';
        $post_image_url = wp_get_attachment_image_url( $featured_img_id, 'full' );
        ?>
        <img class="<?php echo esc_attr( $post_image_class ); ?>" src="<?php echo esc_url( creators_resized_image_url( $post_image_url, 640 ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async">
        <?php endif;?>
        <?php endif;?>
    </div>
    <div class="block-post__content">
        <!-- Current categorie -->
        <?php if ( get_the_category() ) : ?>
        <small class="d-block"><?php echo esc_html( get_the_category()[0]->name ); ?></small>
        <?php endif; ?>
        <h3 class="block-post__title fw-bold"><?php the_title();?></h3>
    </div>
    <a href="<?php the_permalink();?>" class="stretched-link"></a>
</div>
<?php
$image = get_field( 'image' );
?>

<div class="block-dienst position-relative">
    <div class="block-dienst__media position-relative">
        <?php if ( ! empty( $image['ID'] ) ) : ?>
            <?php echo wp_get_attachment_image( $image['ID'], 'large', false, [ 'class' => 'img-abs-center', 'loading' => 'lazy' ] ); ?>
        <?php endif; ?>
    </div>
    <div class="block-dienst__content">
        <a href="<?php echo get_the_permalink(); ?>" class="stretched-link d-flex justify-content-between align-items-center text-decoration-none">
            <?php echo get_the_title(); ?>
            <i class="fa-sharp fa-solid fa-arrow-right text-secondary"></i>
        </a>
    </div>
</div>
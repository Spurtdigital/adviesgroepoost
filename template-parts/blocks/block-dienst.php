<?php
$image = get_field( 'image' );
?>

<div class="block-dienst position-relative">
    <div class="block-dienst__media position-relative">
        <?php if ( ! empty( $image['ID'] ) ) : ?>
            <img class="img-abs-center" src="<?php echo esc_url( creators_resized_image_url( $image['url'] ?? '', 640 ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async">
        <?php endif; ?>
    </div>
    <div class="block-dienst__content">
        <a href="<?php echo get_the_permalink(); ?>" class="stretched-link d-flex justify-content-between align-items-center text-decoration-none">
            <?php echo get_the_title(); ?>
            <i class="fa-sharp fa-solid fa-arrow-right text-secondary"></i>
        </a>
    </div>
</div>
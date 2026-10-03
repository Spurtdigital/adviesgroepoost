<?php
if ( empty( get_field( 'home_seo_title' ) ) && empty( get_field( 'home_seo_content_left' ) ) && empty( get_field( 'home_seo_content_right' ) ) ) {
    return;
}
?>

<section class="layout-seo content content-container-sm content--nomargin <?php echo esc_attr( $args['class'] ?? '' ); ?>">
    <div class="container">
        <?php if ( get_field( 'home_seo_title' ) ) : ?>
            <h2 class="display-5 fw-bold mb-3"><?php echo creators_markdown_inline( get_field( 'home_seo_title' ) ); ?></h2>
        <?php endif; ?>
        <div class="row gy-2">
            <div class="col-lg-6">
                <?php if ( get_field( 'home_seo_content_left' ) ) : ?>
                    <?php echo wp_kses_post( get_field( 'home_seo_content_left' ) ); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <?php if ( get_field( 'home_seo_content_right' ) ) : ?>
                    <?php echo wp_kses_post( get_field( 'home_seo_content_right' ) ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
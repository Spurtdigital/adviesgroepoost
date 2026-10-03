<?php /* Template Name: Page - Ervaringen */
get_header();
?>

<?php get_template_part( 'template-parts/headers/header', 'single' ); ?>

<section class="experiences-page py-lg-10 py-3 mb-lg-5 mb-3">
    <div class="container">
        <?php if ( have_rows( 'ervaringen' ) ) : ?>
            <?php $ervaringen = []; ?>
            <?php while ( have_rows( 'ervaringen' ) ) : the_row(); ?>
                <?php
                $ervaringen[] = [
                    'afbeelding'     => get_sub_field( 'afbeelding' ),
                    'naam'           => get_sub_field( 'naam' ),
                    'plaats'         => get_sub_field( 'plaats' ),
                    'ondertitel'     => get_sub_field( 'ondertitel' ),
                    'review'         => get_sub_field( 'review' ),
                    'review_vanuit'  => get_sub_field( 'review_vanuit' ),
                    'review_cijfer'  => get_sub_field( 'review_cijfer' ),
                ];
                ?>
            <?php endwhile; ?>

            <?php shuffle( $ervaringen ); ?>

            <div class="experiences-page__masonry">
                <?php foreach ( $ervaringen as $ervaring ) : ?>
                    <article class="block-ervaring bg-light <?php echo ! empty( $ervaring['afbeelding'] ) ? ' has-media' : ''; ?>">
                        <?php if ( ! empty( $ervaring['afbeelding'] ) ) : ?>
                            <div class="block-ervaring__media">
                                <img
                                    loading="lazy"
                                    src="<?php echo esc_url( $ervaring['afbeelding']['url'] ?? '' ); ?>"
                                    alt="<?php echo esc_attr( $ervaring['afbeelding']['title'] ?? '' ); ?>"
                                >
                            </div>
                        <?php endif; ?>

                        <div class="block-ervaring__content">
                            <h3 class="display-5 mb-0">
                                <?php echo esc_html( $ervaring['naam'] ?? '' ); ?>
                                <span class="fw-normal"><?php esc_html_e( 'uit', 'creators' ); ?> <?php echo esc_html( $ervaring['plaats'] ?? '' ); ?></span>
                            </h3>

                            <?php if ( ! empty( $ervaring['ondertitel'] ) ) : ?>
                                <span class="text-success block-ervaring__subtitle"><?php echo esc_html( $ervaring['ondertitel'] ); ?></span>
                            <?php endif; ?>

                            <p class="my-2"><?php echo wp_kses_post( $ervaring['review'] ?? '' ); ?></p>
                        </div>

                        <div class="block-ervaring__footer d-flex align-items-center justify-content-between w-100">
                            <div class="block-ervaring__stars d-flex align-items-center" aria-label="5 sterren">
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <?php
                                $destination = $ervaring['review_vanuit'] ?? 'website';
                                $destination_icon = '';

                                if ( 'google' === $destination ) {
                                    $destination_icon = '<i class="fa-brands fa-google" aria-hidden="true"></i>';
                                } elseif ( 'facebook' === $destination ) {
                                    $destination_icon = '<i class="fa-brands fa-facebook-f" aria-hidden="true"></i>';
                                }
                                ?>

                                <?php echo wp_kses_post( $destination_icon ); ?>
                                <strong class="ms-1 mt-1 d-block mt-lg-0"><?php echo esc_html( $ervaring['review_cijfer'] ?? '' ); ?></strong>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

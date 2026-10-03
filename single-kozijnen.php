<?php
get_header();
?>
<div class="bg-light pt-3">
    <div class="container">
        <?php get_template_part( 'template-parts/components/component', 'breadcrumb' ); ?>
    </div>
</div>
<section class="product-hero py-lg-8 py-4">
    <div class="container">
        <div class="row align-items-center gx-xl-10 gy-2">
            <div class="col-xl-7 col-lg-6">

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="product-hero__media rounded-3 overflow-hidden position-relative">
                        <?php the_post_thumbnail( 'large', [ 'class' => 'img-abs-center' ] ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-5 col-lg-6">
                <h1 class="display-1 fw-bold mb-2"><?php the_title(); ?></h1>

                <?php if ( get_field( 'kozijn_intro_tekst' ) ) : ?>
                    <div class="content-container mb-2"><?php echo wp_kses_post( get_field( 'kozijn_intro_tekst' ) ); ?></div>
                <?php endif; ?>

                <?php $offerte_cta = get_field( 'offerte_cta_link', 'options' ); ?>
                <?php if ( ! empty( $offerte_cta['url'] ) && ! empty( $offerte_cta['title'] ) ) : ?>
                    <?php spurt_add_btns( [ [ 'link' => $offerte_cta, 'color' => 'success' ] ] ); ?>
                <?php endif; ?>

                <?php $kozijn_usps = (array) get_field( 'kozijn_usps', 'options' ); ?>
                <?php if ( ! empty( $kozijn_usps ) ) : ?>
                    <ul class="reset-list mt-lg-3 mt-2 mb-lg-4 mb-6">
                        <?php foreach ( $kozijn_usps as $kozijn_usp ) : ?>
                            <?php if ( ! empty( $kozijn_usp['text'] ) ) : ?>
                                <li><i class="fa-sharp fa-solid small fa-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $kozijn_usp['text'] ); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php
                $kozijn_advies_link   = get_field( 'kozijn_advies_cta_link', 'options' );
                $kozijn_advies_houding = get_field( 'kozijn_adviseur_houding', 'options' );
                $kozijn_adviseur       = null;

                foreach ( (array) get_field( 'medewerkers', 'options' ) as $medewerker ) {
                    if ( ! empty( $medewerker['afbeelding']['ID'] ) && ( empty( $kozijn_advies_houding ) || ( $medewerker['houding'] ?? '' ) === $kozijn_advies_houding ) ) {
                        $kozijn_adviseur = $medewerker;
                        break;
                    }
                }
                ?>
                <?php $kozijn_advies_cta_titel = get_field( 'kozijn_advies_cta_titel', 'options' ); ?>
                <?php if ( $kozijn_advies_cta_titel || ( ! empty( $kozijn_advies_link['url'] ) && ! empty( $kozijn_advies_link['title'] ) ) || $kozijn_adviseur ) : ?>
                <div class="product-hero-cta bg-light rounded-3">
                    <?php if ( $kozijn_advies_cta_titel ) : ?>
                        <div class="display-3 fw-bold"><?php echo creators_markdown_inline( $kozijn_advies_cta_titel ); ?></div>
                    <?php endif; ?>
                    <?php if ( ! empty( $kozijn_advies_link['url'] ) && ! empty( $kozijn_advies_link['title'] ) ) : ?>
                        <?php spurt_add_btns( [ [ 'link' => $kozijn_advies_link, 'color' => 'outline-dark' ] ], '', 'sm' ); ?>
                    <?php endif; ?>
                    <?php if ( $kozijn_adviseur ) : ?>
                        <?php echo wp_get_attachment_image( $kozijn_adviseur['afbeelding']['ID'], 'medium', false, [ 'class' => 'img-fluid', 'alt' => esc_attr( $kozijn_adviseur['naam'] ?? '' ) ] ); ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$kozijn_parent_id = wp_get_post_parent_id( get_the_ID() );
$kozijn_children  = [];
$kozijn_use_contentbuilder = (bool) get_field( 'kozijn_toon_contentbuilder' );

if ( ! $kozijn_parent_id ) {
    $kozijn_children = get_children(
        [
            'post_parent' => get_the_ID(),
            'post_type'   => get_post_type(),
            'post_status' => 'publish',
            'orderby'     => 'menu_order title',
            'order'       => 'ASC',
            'numberposts' => -1,
        ]
    );
}
?>

<?php if ( ! $kozijn_use_contentbuilder && ( get_field( 'kozijn_mogelijkheden_intro' ) || have_rows( 'kozijn_mogelijkheden_blokken' ) || ( ! $kozijn_parent_id && ! empty( $kozijn_children ) ) ) ) : ?>
    <section class="bg-light border-radius-top border-radius-bottom border-radius-fill--light border-radius-bg--white py-lg-8 py-4">
        <div class="container">
            <div class="col-lg-6">

                <h2 class="display-2 fw-bold mb-2"><?php echo esc_html( get_field( 'kozijn_mogelijkheden_titel' ) ?: ( get_the_title() . ' mogelijkheden' ) ); ?></h2>
                
                <?php if ( get_field( 'kozijn_mogelijkheden_intro' ) ) : ?>
                    <div class="content-container mb-3"><?php echo wp_kses_post( get_field( 'kozijn_mogelijkheden_intro' ) ); ?></div>
                    <?php endif; ?>
            </div>

            <?php if ( ! $kozijn_parent_id && ! empty( $kozijn_children ) ) : ?>
                <div class="row g-lg-3 g-2 row-cols-lg-4 row-cols-md-2 row-cols-1">
                    <?php foreach ( $kozijn_children as $post ) : setup_postdata( $post ); ?>
                        <div class="col">
                            <div class="block-kozijn bg-white rounded-3">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="block-kozijn__media position-relative">
                                        <?php the_post_thumbnail( 'medium', [ 'class' => 'img-abs-center' ] ); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="block-kozijn__content py-2 text-center position-relative">
                                    <span><?php the_title(); ?></span>
                                    <a href="<?php the_permalink(); ?>" class="stretched-link" aria-label="<?php the_title_attribute(); ?>"></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            <?php elseif ( $kozijn_parent_id && have_rows( 'kozijn_mogelijkheden_blokken' ) ) : ?>
                <div class="row g-lg-3 g-2 row-cols-lg-4 row-cols-md-2 row-cols-1">
                    <?php while ( have_rows( 'kozijn_mogelijkheden_blokken' ) ) : the_row(); ?>
                        <?php if ( get_sub_field( 'titel' ) || get_sub_field( 'afbeelding' ) ) : ?>
                            <div class="col">
                                <div class="block-kozijn bg-white rounded-3">
                                    <?php if ( get_sub_field( 'afbeelding' ) ) : ?>
                                        <div class="block-kozijn__media position-relative">
                                            <?php echo wp_get_attachment_image( get_sub_field( 'afbeelding' )['ID'], 'medium', false, [ 'class' => 'img-abs-center', 'alt' => esc_attr( get_sub_field( 'afbeelding' )['alt'] ?? get_sub_field( 'titel' ) ) ] ); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( get_sub_field( 'titel' ) ) : ?>
                                        <div class="block-kozijn__content py-2 text-center">
                                            <span><?php echo esc_html( get_sub_field( 'titel' ) ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
$kozijn_split_image = get_field( 'kozijn_split_afbeelding' );

if ( empty( $kozijn_split_image['ID'] ) ) {
	$kozijn_split_image = function_exists( 'creators_fallback_media' ) ? creators_fallback_media() : null;
}
?>

<?php if ( ! $kozijn_use_contentbuilder && ( get_field( 'kozijn_split_titel' ) || get_field( 'kozijn_split_tekst' ) || $kozijn_split_image ) ) : ?>
    <section class="content-section content-section--split my-lg-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="row gx-lg-5 gy-2 align-items-stretch">
                        <div class="col-lg-6 py-lg-5 <?php echo get_field( 'kozijn_split_afbeelding_links' ) ? 'order-2 order-lg-2' : ''; ?>">
                            <?php if ( get_field( 'kozijn_split_titel' ) ) : ?>
                                <h2 class="display-4 fw-bold mb-2 mb-lg-4"><?php echo esc_html( get_field( 'kozijn_split_titel' ) ); ?></h2>
                            <?php endif; ?>

                            <?php if ( get_field( 'kozijn_split_tekst' ) ) : ?>
                                <?php echo wp_kses_post( get_field( 'kozijn_split_tekst' ) ); ?>
                            <?php endif; ?>

                            <?php if ( get_field( 'kozijn_split_button' ) ) : ?>
                                <?php
                                spurt_add_btns(
                                    [
                                        [
                                            'link'  => get_field( 'kozijn_split_button' ),
                                            'color' => get_field( 'kozijn_split_button_kleur' ) ?: 'primary',
                                        ],
                                    ]
                                );
                                ?>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 <?php echo get_field( 'kozijn_split_afbeelding_links' ) ? 'order-1 order-lg-1' : ''; ?>">
                            <?php if ( ! empty( $kozijn_split_image ) ) : ?>
                                <div class="content-split__media position-relative rounded-3 overflow-hidden">
                                    <?php if ( ! empty( $kozijn_split_image['ID'] ) ) : ?>
                                        <?php echo wp_get_attachment_image( $kozijn_split_image['ID'], 'large', false, [ 'class' => 'img-abs-center', 'alt' => esc_attr( $kozijn_split_image['alt'] ?? get_field( 'kozijn_split_titel' ) ) ] ); ?>
                                    <?php elseif ( ! empty( $kozijn_split_image['url'] ) ) : ?>
                                        <img loading="lazy" class="img-abs-center" src="<?php echo esc_url( $kozijn_split_image['url'] ); ?>" alt="<?php echo esc_attr( $kozijn_split_image['alt'] ?? get_field( 'kozijn_split_titel' ) ); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ( $kozijn_use_contentbuilder ) : ?>
    <?php get_template_part( 'template-parts/layouts/layout', 'builder' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
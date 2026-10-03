<?php
/**
 * Header: Page Header
 * 
 * Displays breadcrumbs, title, optional alternative h1, and introduction text
 */

$page_title = $args['title'] ?? ( get_field( 'hero_titel' ) ?: get_the_title() );
$page_intro = $args['intro'] ?? get_field( 'hero_tekst' );
$buttons_array = $args['buttons'] ?? null;
$header_text_col_class = (bool) get_field( 'builder_kleiner_weergeven' ) ? 'col-xl-7 col-lg-6' : 'col-xl-10';

if ( null === $buttons_array ) {
    $buttons_array = [];
    if ( have_rows( 'hero_buttons' ) ) {
        while ( have_rows( 'hero_buttons' ) ) {
            the_row();
            $buttons_array[] = [
                'link'  => get_sub_field( 'link' ),
                'color' => get_sub_field( 'color' ),
            ];
        }
    }
}
?>

<section class="page-header page-header--alt py-lg-8 py-4 bg-light">
	<div class="container">
        <div class="row justify-content-center">
			<div class="<?php echo esc_attr( $header_text_col_class ); ?>">
                <?php get_template_part( 'template-parts/components/component', 'breadcrumb' ); ?>

                <?php if ( $page_title ) : ?>
                    <h1 class="display-1 fw-bold mb-lg-3 mb-2">
                        <?php echo creators_markdown_inline( $page_title ); ?>
                    </h1>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="row mb-lg-4 mb-3">
                <div class="col-12">
                    <div class="rounded-3 page-header__media overflow-hidden position-relative">
                        <?php the_post_thumbnail( 'full', [ 'class' => 'img-abs-center' ] ); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
			<div class="<?php echo esc_attr( $header_text_col_class ); ?>">
                <?php if ( $page_intro ) : ?>
                    <div class="page-header__intro content-container">
                        <?php echo wp_kses_post( $page_intro ); ?>
                    </div>
                <?php endif; ?>
				<?php if ( ! empty( $buttons_array ) ) { spurt_add_btns( $buttons_array ); } ?>
            </div>
        </div>
	</div>
</section>

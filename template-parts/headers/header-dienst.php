<?php
/**
 * Header: Page Header
 * 
 * Displays breadcrumbs, title, optional alternative h1, and introduction text
 */

$page_title = $args['title'] ?? ( get_field( 'hero_titel' ) ?: get_the_title() );
$page_intro = $args['intro'] ?? ( get_field( 'dienst_intro_tekst' ) ?: get_field( 'hero_tekst' ) );
$buttons_array = $args['buttons'] ?? null;

$advice_page = get_posts(
    [
        'post_type'      => 'page',
        'posts_per_page' => 1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-advies.php',
        'fields'         => 'ids',
    ]
);

$advice_page_url = ! empty( $advice_page ) ? get_permalink( (int) $advice_page[0] ) : '';

$cta_usps = get_field( 'global_cta_usps', 'options' );

if ( ! is_array( $cta_usps ) || empty( $cta_usps ) ) {
    $cta_usps = get_field( 'header_usps', 'options' );
}

$advice_person = null;
$medewerkers  = get_field( 'medewerkers', 'options' ) ?: [];

if ( is_array( $medewerkers ) ) {
    foreach ( $medewerkers as $medewerker ) {
        if ( ! empty( $medewerker['afbeelding']['ID'] ) ) {
            $advice_person = $medewerker;
            break;
        }
    }
}

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

<section class="header-dienst bg-light ">
	<div class="container-xl">
        <div class="row justify-content-center">
			<div class="col-xl-9">
                <div class="row">   
                    <div class="col-xl-6 col-lg-7">
                        <?php get_template_part( 'template-parts/components/component', 'breadcrumb' ); ?>
                        <?php if ( $page_title ) : ?>
                            <h1 class="display-1 fw-bold mb-lg-3 mb-2">
                                <?php echo creators_markdown_inline( $page_title ); ?>
                            </h1>
                        <?php endif; ?>
                        <?php if ( $page_intro ) : ?>
                                <div class="page-header__intro content-container">
                                    <?php echo wp_kses_post( $page_intro ); ?>
                                </div>
                            <?php endif; ?>

                            <?php
                            if ( ! empty( $buttons_array ) ) {
                                spurt_add_btns( $buttons_array );
                            }
                            ?>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <div class="header-dienst-cta position-relative bg-white rounded-3">
                            <div class="display-4 fw-bold"><?php
                                $header_dienst_cta_titel = get_field( 'dienst_cta_titel', 'options' ) ?: 'Plan een **gratis adviesgesprek** bij jou thuis';
                                echo creators_markdown_inline( $header_dienst_cta_titel );
                            ?></div>
                            <?php if ( is_array( $cta_usps ) && ! empty( $cta_usps ) ) : ?>
                                <ul class="reset-list my-2">
                                    <?php foreach ( array_slice( $cta_usps, 0, 2 ) as $cta_usp ) : ?>
                                        <?php if ( ! empty( $cta_usp['text'] ) ) : ?>
                                            <li><i class="text-success me-1 small fa-sharp fa-solid fa-check"></i><?php echo esc_html( $cta_usp['text'] ); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if ( is_array( $advice_person ) && ! empty( $advice_person['afbeelding']['ID'] ) ) : ?>
                                <div class="mb-2">
                                    <?php echo wp_get_attachment_image( $advice_person['afbeelding']['ID'], 'medium', false, [ 'class' => 'img-fluid', 'alt' => esc_attr( $advice_person['naam'] ?? '' ) ] ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $advice_page_url ) : ?>
                                <?php
                                get_template_part(
                                    'template-parts/components/component',
                                    'button',
                                    [
                                        'link'  => [
                                            'url'    => $advice_page_url,
                                            'title'  => get_field( 'adviesgesprek_button_titel', 'options' ) ?: __( 'Plan adviesgesprek', 'creators' ),
                                            'target' => '_self',
                                        ],
                                        'color' => 'secondary',
                                    ]
                                );
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
	</div>
</section>

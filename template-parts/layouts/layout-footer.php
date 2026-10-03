<?php
$gemeenten = get_field( 'gemeenten', 'options' );

if ( is_string( $gemeenten ) ) {
    $unserialized_gemeenten = maybe_unserialize( $gemeenten );

    if ( is_array( $unserialized_gemeenten ) ) {
        $gemeenten = $unserialized_gemeenten;
    } else {
        $decoded_gemeenten = json_decode( $gemeenten, true );
        $gemeenten         = is_array( $decoded_gemeenten ) ? $decoded_gemeenten : [];
    }
}

if ( ! is_array( $gemeenten ) ) {
    $gemeenten = [];
}

$gemeenten = array_values(
    array_filter(
        $gemeenten,
        static function ( $gemeente ) {
            return is_array( $gemeente );
        }
    )
);

if ( ! empty( $gemeenten ) ) { ?>
<section class="global-gemeenten mb-lg-2 mb-lg-5 mb-3">
    <div class="container">
        <h2 class="display-5 mb-lg-4 mb-2 fw-bold"><?php echo esc_html( get_field( 'gemeenten_title', 'options' ) ?: __( 'Wij zijn actief in onder andere de volgende gemeenten', 'creators' ) ); ?></h2>
        <div class="js-gemeenten">
            <?php
                    // Willekeurige volgorde toepassen op de gemeenten
                    shuffle( $gemeenten );

                    // Maximaal 20 items weergeven
                    $aantal_items_weergeven = min( 20, count( $gemeenten ) );

                    for ( $i = 0; $i < $aantal_items_weergeven; $i++ ) {
                        $gemeente = $gemeenten[$i];
                        if ( empty( $gemeente['logo']['url'] ) ) {
                            continue;
                        }
                ?>
                <div>
                        <div class="global-gemeenten__block">
                            <img loading="lazy" fetchpriority="low" src="<?php echo esc_url( spurt_image( $gemeente['logo']['url'], 200, 9999 ) ); ?>" alt="<?php echo esc_attr( $gemeente['logo']['alt'] ?? '' ); ?>">
                        </div>
                    </div>
                <?php
                    }
               ?>
        </div>
    </div>
</section>
<?php } ?>
<?php
$footer_top_image     = get_field( 'footer_top_image', 'options' );
$footer_top_image_url = '';
$footer_top_image_alt = '';

if ( is_array( $footer_top_image ) ) {
    $footer_top_image_url = $footer_top_image['url'] ?? '';
    $footer_top_image_alt = $footer_top_image['alt'] ?? '';
} elseif ( is_string( $footer_top_image ) ) {
    $footer_top_image_url = $footer_top_image;
}
?>
<footer class="footer">
    <div class="footer-top border-radius-bottom border-radius-bottom--center">
        <div class="container">
            <div class="row gx-0 align-items-stretch">
                <div class="col-lg-6 ">
                    <div class="footer-top__media position-relative verflow-hidden">
                        <?php if ( $footer_top_image_url ) : ?>
                            <img 
                                class="img-abs-center"
                                src="<?php echo esc_url( $footer_top_image_url ); ?>" 
                                alt="<?php echo esc_attr( $footer_top_image_alt ); ?>"
                            >
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-top__content content-container--sm bg-light py-lg-8 px-lg-8 py-4 px-3">
                        <h3 class="display-3 fw-bold mb-2 mb-1">
                            <?php echo esc_html(get_field('footer_top_title', 'options')); ?>
                        </h3>
                        <p><?php echo wp_kses_post(get_field('footer_top_content', 'options')); ?></p>
                        <?php if (get_field('footer_top_button_link', 'options')): ?>
                            <div class="mt-lg-2 mt-1">
                                <?php get_template_part('template-parts/components/component-button', null, [
                                    'link'  => get_field('footer_top_button_link', 'options'),
                                    'color' => 'secondary',
                                ]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-main bg-primary py-lg-6 py-4">
        <div class="container">
            <div class="row gx-8 gy-2">
                <div class="col-lg-3 border-end">
                    <strong class="footer-main__title d-block mb-1"><?php echo esc_html( get_field( 'footer_contact_titel', 'options' ) ?: 'Contact' ); ?></strong>
                    <ul class="reset-list footer__contact">
                        <?php if (get_field('algemeen_mailadres', 'options')): ?>
                            <li>
                                <i class="fa-solid fa-envelope me-1" aria-hidden="true"></i>
                                <a href="mailto:<?php echo esc_attr(get_field('algemeen_mailadres', 'options')); ?>"><?php echo esc_html(get_field('algemeen_mailadres', 'options')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_field('algemeen_telefoonnummer', 'options')): ?>
                            <li>
                                <i class="fa-solid fa-phone me-1" aria-hidden="true"></i>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', get_field('algemeen_telefoonnummer', 'options'))); ?>"><?php echo esc_html(get_field('algemeen_telefoonnummer', 'options')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_field('algemeen_mobielnummer', 'options')): ?>
                            <li>
                                <i class="fa-solid fa-mobile-screen-button me-1" aria-hidden="true"></i>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', get_field('algemeen_mobielnummer', 'options'))); ?>"><?php echo esc_html(get_field('algemeen_mobielnummer', 'options')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <strong class="footer-main__title d-block mt-lg-3 mb-1"><?php echo esc_html( get_field( 'footer_kantoor_titel', 'options' ) ?: 'Kantoor' ); ?></strong>
                    <ul class="reset-list footer__contact">
                        <?php if (get_field('algemeen_straatnaam', 'options') || get_field('algemeen_huisnummer', 'options') || get_field('algemeen_postcode', 'options') || get_field('algemeen_plaats', 'options')): ?>
                            <li>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode(get_field('algemeen_straatnaam', 'options') . ' ' . get_field('algemeen_huisnummer', 'options') . ' ' . get_field('algemeen_postcode', 'options') . ' ' . get_field('algemeen_plaats', 'options')); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php if (get_field('algemeen_straatnaam', 'options') || get_field('algemeen_huisnummer', 'options')): ?>
                                        <?php echo esc_html(get_field('algemeen_straatnaam', 'options')); ?>
                                        <?php echo esc_html(get_field('algemeen_huisnummer', 'options')); ?>
                                        <br>
                                    <?php endif; ?>
                                    <?php echo esc_html(get_field('algemeen_postcode', 'options')); ?>
                                    <?php echo esc_html(get_field('algemeen_plaats', 'options')); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="footer__socials mt-lg-1">
                        <?php echo spurt_social(); ?>
                    </div>
                </div>
                <div class="col-lg-9">
                    <?php
                    $registered_menus = get_registered_nav_menus();
                    $assigned_locations = get_nav_menu_locations();
                    $footer_menu_locations = [];

                    foreach (array_keys($registered_menus) as $location) {
                        if (0 === strpos($location, 'footermenu') && !empty($assigned_locations[$location])) {
                            $footer_menu_locations[] = $location;
                        }
                    }

                    $footer_menu_rows = array_chunk($footer_menu_locations, 4);
                    ?>

                    <?php foreach ($footer_menu_rows as $row_index => $menu_row) : ?>
                        <div class="row g-lg-3 g-1<?php echo 0 === $row_index ? ' border-bottom pb-lg-3 pb-0' : ' mt-lg-3 mt-0'; ?>">
                            <?php foreach ($menu_row as $menu_location) : ?>
                                <?php
                                $menu_term = wp_get_nav_menu_object($assigned_locations[$menu_location]);
                                $menu_title = $menu_term && !is_wp_error($menu_term)
                                    ? $menu_term->name
                                    : $registered_menus[$menu_location];
                                $menu_class = 'footermenu' === $menu_location ? 'columns-2 reset-list' : 'reset-list';
                                ?>
                                <div class="col-xl-3 col-md-6">
                                    <button class="footer-main__title d-block d-lg-none mb-1 footer-menu-toggle" type="button">
                                        <?php echo esc_html($menu_title); ?>
                                    </button>
                                    <strong class="footer-main__title d-none d-lg-block mb-1"><?php echo esc_html($menu_title); ?></strong>
                                    <nav class="footer-menu">
                                        <?php
                                        wp_nav_menu([
                                            'theme_location' => $menu_location,
                                            'container'      => false,
                                            'menu_class'     => $menu_class,
                                            'depth'          => 2,
                                        ]);
                                        ?>
                                    </nav>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-end bg-black py-1">
        <div class="container d-flex flex-wrap justify-content-lg-between justify-content-center align-items-center">
            <span class="text-light small d-block">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></span>
            <?php spurt_branding();?>
        </div>
    </div>
</footer>

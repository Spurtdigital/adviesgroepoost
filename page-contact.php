<?php /*Template Name: Page - Contact */ get_header();?>

<?php get_template_part( 'template-parts/headers/header','page' ); ?>

<?php
$contact_form_title    = get_field( 'contact_form_title' ) ?: 'Contactformulier';
$contact_details_title = get_field( 'contact_details_title' ) ?: 'Contactgegevens';
$contact_form_id       = get_field( 'contact_form' ) ?: 5;
?>



<section class="contact-content my-lg-10 my-3">
    <div class="container">
        <div class="row gx-xl-7 justify-content-center gx-lg-3 d-flex align-items-center">
            <div class="col-lg-5 order-2 order-lg-1">
                <div class="contact-content__form form--dark form--blue">
                    <h4 class="display-4 mb-3 text-dark fw-bold mb-lg-3 mb-2"><?php echo esc_html( $contact_form_title ); ?></h4>
                    <?php echo do_shortcode( '[contact-form-7 id="' . absint( $contact_form_id ) . '"]' ); ?>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
                <div class="contact-content__details">
                <strong class="contact-content__title"><?php echo esc_html( $contact_details_title ); ?></strong>
                <ul class="reset-list contact-content__list mt-1">
                    <li><?php echo get_field( 'algemeen_bedrijfsnaam', 'options' );?></li>
                    <li><?php echo get_field( 'algemeen_straatnaam', 'options' );?></li>
                    <li><?php echo get_field( 'algemeen_postcode', 'options' );?><?php echo get_field( 'algemeen_plaats', 'options' );?></li>
                    <?php if ( get_field('kvk_nummer', 'options') ) : ?>
                        <li><?php echo esc_html( get_field( 'contact_kvk_label', 'options' ) ?: 'KvK-nummer ' ); ?><?php echo get_field( 'kvk_nummer', 'options' );?></li>
                    <?php endif; ?>
                    <?php if ( get_field('btw_nummer', 'options') ) : ?>
                        <li><?php echo esc_html( get_field( 'contact_btw_label', 'options' ) ?: 'BTW-nummer ' ); ?><?php echo get_field( 'btw_nummer', 'options' );?></li>
                    <?php endif; ?>
                    <li class="--has-icon mt-2">
                        <a href="tel:<?php echo get_field( 'algemeen_telefoonnummer', 'options' );?>"><i class="fa-solid fa-phone"></i> <?php echo get_field( 'algemeen_telefoonnummer', 'options' );?></a>
                    </li>
                    <li class="--has-icon">
                        <a href="mailto:<?php echo get_field( 'algemeen_mailadres', 'options' );?>"><i class="fa-solid fa-envelope"></i> <?php echo get_field( 'algemeen_mailadres', 'options' );?></a>
                    </li>
                </ul>
                
                <div class="contact-content__socials social-media">
                    <?php spurt_social();?>
                </div>
                <a target="_blank" class="btn btn-success mt-2" href="<?php echo get_field('whatsapp_link','options'); ?>"><i class="fa-brands fa-whatsapp"></i><?php echo get_field('whatsapp_tekst','options'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/components/component', 'usps', array( 'class' => 'mt-4 mb-0' ) ); ?>

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>


<?php get_footer();?>
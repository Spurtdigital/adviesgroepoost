<?php /*Template Name: Page - Offertecheck */ get_header(); ?>
<style>
    .wpcf7 textarea{
        height: 150px!important;
    }
</style>
<?php get_template_part( 'template-parts/headers/header', 'single', array( 'class' => '--small')); ?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-xl-7 col-lg-6 col-lg-7">
                <div class="bg-light p-lg-3 p-2 advice-usps">
                    <?php echo get_field( 'advice_introductie' );?>
                    <?php echo do_shortcode('[contact-form-7 id="b21e386" title="Offerte vergelijker"]');?>
                    <ul class="d-flex flex-wrap gap-lg-3 gap-1 reset-list mt-2 mt-lg-1 justify-content-center">
                        <li><i class="fa-sharp fa-solid fa-circle-check text-success me-1"></i>Binnen 24 uur reactie
                        </li>
                        <li><i class="fa-sharp fa-solid fa-circle-check text-success me-1"></i>Gratis advies op afstand
                        </li>
                        <li><i class="fa-sharp fa-solid fa-circle-check text-success me-1"></i>Meer dan <stron class="value"
                                akhi="8243">0</stron> offertes vergeleken</li>
                    </ul>
                </div>
                <?php if(get_field( 'tekst_onder_het_formulier' )):?>
                <div class="mt-3 small-content">
                    <?php echo get_field( 'tekst_onder_het_formulier' );?>
                </div>
                <?php endif;?>
            </div>
            <div class="col-xxl-3 offset-xxl-1 col-xl-5 col-lg-5">
                <?php  $rows = get_field('adviseurs', 'options');  if ($rows) { shuffle($rows);  $row = $rows[0]; ?>
                <div class="advies-block">
                    <div class="author author--alt d-flex d-xl-block">
                        <div class="author__media">
                            <img loading="lazy"  src="<?php echo $row['afbeelding_met_achtergrond']['url']; ?>" alt="">
                        </div>
                        <div class="author__content">
                            <strong class="display-5">Toch liever direct contact?</strong>
                            <div class="d-flex flex-wrap gap-1">
                                <p class="fw-bold"><?php echo $row['voornaam']; ?> <?php echo $row['achternaam']; ?></p>
                                <small>Staat voor je klaar</small>
                            </div>
                            <ul class="reset-list d-flex gap-lg-3 gap-1 mt-2">
                                <li><a href="tel:<?php echo get_field('algemeen_telefoonnummer','options');?>">Bel
                                        mij</a></li>
                                <li><a href="<?php echo get_field('whatsapp_link','options'); ?>">App mij</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <ul class="company-usps reset-list mt-lg-2 mt-1">
                    <?php if ( get_field('offer_title','options') ) : ?>
                    <strong class="d-block mb-1"><?php echo get_field( 'offer_title', 'options' );?></strong>
                    <?php endif; ?>
                    <?php if ( have_rows('offer_usps','options') ) : ?>

                    <?php while( have_rows('offer_usps','options') ) : the_row(); ?>

                    <li><i class="fa-sharp fa-solid fa-circle-check text-success"></i><?php echo get_sub_field('usp'); ?>
                    </li>

                    <?php endwhile; ?>

                    <?php endif; ?>
                </ul>
                <h5 class="display-6 mt-2">In 3 simpele stappen een scan</h5>
                <ul class="company-usps reset-list mt-lg-2 mt-1">
                    <li class="--bg"><i class="fa-solid fa-file-arrow-up text-success"></i>Stap 1: Upload Je Offerte
                        Gebruik ons eenvoudige formulier om je huidige offerte te uploaden.</li>
                    <li class="--bg"><i class="fa-regular fa-receipt text-success"></i>Stap 2: Ontvang een second
                        opinion Onze experts bekijken je situatie en komen terug met een voorstel.</li>
                    <li class="--bg"><i class="fa-regular fa-piggy-bank text-success"></i>Stap 3: Bespaar slim kies voor
                        het beste aanbod en bespaar op je investering in duurzaamheid.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <h3 class="display-4 mb-2 mb-lg-3">Meer lezen over de offertecheck</h3>
        <div class="row">
            <?php
// Haal de huidige pagina op
$current_page = get_post();

// Controleer of de huidige pagina kinderen heeft
$child_pages = get_pages(array(
    'child_of' => $current_page->ID
));

// Loop door de gevonden child-pagina's en toon ze
if (!empty($child_pages)) {
    foreach ($child_pages as $child_page) { ?>
            <div class="col-lg-3">
                <?php $featured_img_url = get_the_post_thumbnail_url($child_page->ID, 'thumnail'); ?>
                <div class="block-post">
                    <div class="block-post__media">
                        <?php if($featured_img_url):?>
                        <img loading="lazy"  src="<?php echo $featured_img_url;?>" alt="<?php echo get_the_title($child_page->ID);?>">
                        <?php endif;?>
                    </div>
                    <div class="block-post__content">
                        <h3 class="display-6"><?php echo get_the_title($child_page->ID);?></h3>
                    </div>
                    <a href="<?php echo get_the_permalink($child_page->ID);?>" class="stretched-link"></a>
                </div>
            </div>
            <?php  }
} 
?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<script>
    const counters = document.querySelectorAll('.value');
    const speed = 200;

    counters.forEach(counter => {
        const animate = () => {
            const value = +counter.getAttribute('akhi');
            const data = +counter.innerText;

            const time = value / speed;
            if (data < value) {
                counter.innerText = Math.ceil(data + time);
                setTimeout(animate, 50);
            } else {
                counter.innerText = value;
            }

        }

        animate();
    });
</script>





<?php get_footer(); ?>
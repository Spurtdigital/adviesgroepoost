<?php /*Template Name: Page - Adviesgesprek */ get_header(); ?>

<?php get_template_part( 'template-parts/headers/header', 'single', array( 'class' => '--small')); ?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-xl-7 col-lg-6 col-lg-7">
                <?php echo get_field( 'advice_introductie' );?>
                <div class="bg-light p-lg-3 p-2 advice-usps">
                    <h3 class="display-5 mb-1">Gratis adviesgesprek aanvragen</h3>
                    <?php echo do_shortcode('[contact-form-7 id="7380dc2" title="Adviesgesprek op maat"]');?>
                    <ul class="d-flex flex-wrap gap-lg-3 gap-1 reset-list mt-2 mt-lg-1 justify-content-center">
                        <li><i class="fa-sharp fa-solid fa-circle-check text-success me-1"></i>Binnen 24 uur reactie</li>
                        <li><i class="fa-sharp fa-solid fa-circle-check text-success me-1"></i>Gratis advies op locatie</li>
                        <li><i class="fa-sharp fa-solid fa-circle-check text-success me-1"></i>Al <stron class="value" akhi="19720">0</stron> families gingen je voor</li>
                    </ul>
                </div>
                <?php if(get_field( 'tekst_onder_het_formulier' )):?>
                <div class="mt-3 small-content">
                    <?php echo get_field( 'tekst_onder_het_formulier' );?>
                </div>
                <?php endif;?>
                <?php if ( get_field('faq_titel') ) : ?>
                    <h3 class="display-4"><?php echo get_field('faq_titel'); ?></h3>
                <?php endif; ?>
   
                <?php if ( have_rows('faq') ) : while( have_rows('faq') ) : the_row(); ?>
                    <div class="faq-item js-faq">
                        <header class="faq-item__header js-faq-toggle">
                            <span class="faq-item__title"><?php echo get_sub_field('vraag'); ?></span>
                            <span class="faq-item__toggler"></span>
                        </header>
                        <main class="faq-item__content js-faq-content">
                            <?php echo get_sub_field('antwoord'); ?>
                        </main>
                    </div>
                <?php endwhile; ?>
                    <?php $rowCount = count( get_field('faq') ); //GET THE COUNT ?>
                    <?php $i = 1; ?>
                    <script type="application/ld+json">
                        {
                            "@context": "https://schema.org",
                            "@type": "FAQPage",

                            "mainEntity": [
                                <?php 
                                $i = 1; // Initialiseren van de teller
                                while( have_rows('faq') ) : the_row(); 
                                $sub_field_content = get_sub_field('antwoord');

                                // Verwijderen van alle a-links inclusief de tekst binnen de tags met regex
                                $clean_content = preg_replace('/<a[^>]*>.*?<\/a>/', '', $sub_field_content);

                                ?>
                                {
                                    "@type": "Question",
                                    "name": "<?php echo get_sub_field('vraag'); ?>",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "<?php echo $clean_content; ?>" 
                                    }
                                }
                                <?php if($i < $rowCount): ?>
                                    ,
                                <?php endif; ?> 
                                <?php $i++; endwhile; ?> 
                            ]
                        }
                    </script>
                <?php endif; ?>
            </div>
            <div class="col-xxl-3 offset-xxl-1 col-xl-5 col-lg-5">
                <?php $rows = get_field('adviseurs', 'options');  if ($rows) { shuffle($rows);  $row = $rows[0]; ?>
                <div class="advies-block">
                    <div class="author author--alt d-flex d-xl-block">
                        <div class="author__media">
                            <img loading="lazy" src="<?php echo $row['afbeelding_met_achtergrond']['url']; ?>" alt="">
                        </div>
                        <div class="author__content">
                            <strong class="display-5">Toch liever direct contact?</strong>
                            <div class="d-flex flex-wrap gap-1">
                                <p class="fw-bold"><?php echo $row['voornaam']; ?> <?php echo $row['achternaam']; ?></p>
                                <small>Staat voor je klaar</small>
                            </div>
                            <ul class="reset-list d-flex gap-lg-3 gap-1 mt-2">
                                <li><a href="tel:<?php echo get_field('algemeen_telefoonnummer','options');?>"><i class="fa-solid fa-phone me-1"></i>Bel mij</a></li>
                                <li><a href="<?php echo get_field('whatsapp_link','options'); ?>"><i class="fa-brands fa-whatsapp me-1"></i>App mij</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <ul class="company-usps reset-list mt-lg-2 mt-1">
                    <?php if ( have_rows('company_usps','options') ) : while( have_rows('company_usps','options') ) : the_row(); ?>
                        <li><i class="fa-sharp fa-solid fa-circle-check text-success"></i><?php echo get_sub_field('usp'); ?></li>
                    <?php endwhile;  endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
    const counters = document.querySelectorAll('.value');
    const speed = 250;

    counters.forEach( counter => {
    const animate = () => {
        const value = +counter.getAttribute('akhi');
        const data = +counter.innerText;
        
        const time = value / speed;
        if(data < value) {
            counter.innerText = Math.ceil(data + time);
            setTimeout(animate, 50);
        }else{
            counter.innerText = value;
        }
    }
    animate();
    });
</script>

<?php 
    $loop = new WP_Query(
    array(
        'post_type'      => 'dienst',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order'
    )  ); ?>

        <?php 
        $waarden = array('Kunststof Kozijnen', 'Houten Kozijnen'); // Voeg hier de handmatige diensten toe
        while ($loop->have_posts()) : $loop->the_post();
            if (get_field('in_formulier_tonen')) {
                $waarden[] = get_the_title(); // Titel toevoegen aan de waarden-array
            }
        endwhile; wp_reset_query(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var waarden = <?php echo json_encode($waarden); ?>;
    var selectBox = document.getElementById('select-boxes');

    // Maak de selectievakjes van CF7
    waarden.forEach(function (waarde) {
        var listItem = document.createElement('span');
        listItem.className = 'wpcf7-list-item';

        var label = document.createElement('label');
        listItem.appendChild(label);

        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'diensten[]';
        checkbox.value = waarde;
        label.appendChild(checkbox);

        var labelText = document.createElement('span');
        labelText.className = 'wpcf7-list-item-label';
        labelText.textContent = waarde;
        label.appendChild(labelText);

        selectBox.appendChild(listItem);
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>


<script>
function getParameterByName(name) {
    let url = new URL(window.location.href);
    return url.searchParams.get(name);
}

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        let postcode = getParameterByName('postcode');
        let huisnummer = getParameterByName('huisnummer');
        
        if (postcode) {
            document.getElementById('postcode').value = postcode;
        }
        
        if (huisnummer) {
            document.getElementById('huisnummer').value = huisnummer;
        }
        console.log(getParameterByName('postcode'));
    }, 300);
});

</script>


<?php get_template_part( 'template-parts/layouts/layout', 'reviews', array( 'class' => 'mb-lg-5 mb-3' ) ); ?>

<?php get_footer(); ?>
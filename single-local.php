<?php get_header();   $current_post_id = get_the_ID(); $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

<?php get_template_part( 'template-parts/headers/header','single' ); ?>


<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <?php echo get_field( 'introductie' );?>
                <div class="d-flex flex-wrap gap-1">
                    <a href="<?php echo get_field('global_adviesgesprek','options')['url']?>" class="btn btn-primary">Adviesgesprek aanvragen</a>
                    <a href="<?php echo get_field('whatsapp_link','options')?>" class="btn btn-secondary">Prijsindicatie aanvragen</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="bg-light pt-5">
    <div class="container">
        <div class="row gx-10">
            <div class="col-lg-4">
                <h2 class="display-2">Vraag een gratis dakcheck aan</h2>
                <p>In 2 stappen eenvoudig aangevraagd en binnen 1 dag al een passend <strong>gratis advies</strong></p>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <?php // ( 2, false, false, false, '', false );?>
                </div>
            </div>
        </div>
    </div>
</section> -->
<div class="zonnepanelen-numbers pt-5">
        <div class="container">
            <div class="row gy-2 gy-lg-3">
                <div class="col-lg-4">
                    <div class="block-number">
                        <span class="value" akhi="456"></span>
                        <small>Inwoners hebben een dakcheck gedaan</small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block-number">
                        <span class="value" akhi="<?php echo get_field( 'aantal_woningen' );?>"></span>
                        <small>Woningen in <?php echo get_field( 'name_place' );?></small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block-number">
                        <span class="value" akhi="1550"></span>
                        <small>Zonuren per jaar</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            setTimeout(animate, 15);
            }else{
            counter.innerText = value;
        }
    }
    animate();
    });
</script>

<section class="mt-3 mt-lg-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 small-content">
                <h2 class="display-3">Rendement zonnepanelen in <?php echo get_field('name_place');?></h2>
                <p>
                In <?php echo get_field('name_place');?> varieert de prijs voor zonnepanelen, wat het een uitgelezen moment maakt om hierin te investeren. De financiële opbrengsten van zonnepanelen op je dak zullen op termijn hoger uitvallen dan de rente op een spaarrekening. Deze calculatie is eenvoudig zelf te maken door verschillende offertes te vergelijken. Bovendien heeft de aanwezigheid van zonnepanelen een positieve invloed op de waarde van je woning. Een huis dat zelfvoorzienend is in energie door zonnepanelen is aantrekkelijker voor kopers, wat een extra stimulans is om te kiezen voor de installatie van zonnepanelen.
                </p>
                <h3 class="display-3">Geen directe subsidie, echter vrijstelling van BTW</h3>
                <p>
                    Door verschillende bezuinigingen is er in <?php echo get_field('name_place');?> geen sprake meer van nationale subsidies voor particulieren. De enige beschikbare vorm van financieel voordeel op dit moment is indirect, zoals de vrijstelling van BTW die eerder is beschreven.
                </p>
            </div>
        </div>
    </div>
</section>


<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<?php if( is_single( 1836 ) ) { ?>
<section class="my-3 my-lg-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 bg-light p-lg-3 p-1">
                <h3 class="display-3">Wij zijn actief in heel Nederland</h3>
                <p class="mb-0">In deze provincies zijn we allemaal actief!</p>
                    <?php $args = array(
                        'post_type' => 'local', // Aanpassen aan jouw custom post type
                        'posts_per_page' => -1,
                        'orderby' => 'rand',
                    );
                ?>
                <ul class="content-link-block">
                    <?php $loop = new WP_Query($args);  while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php if(get_field( 'is_provincie' )):?>
                            <li>
                                <a href="<?php echo get_the_permalink($provincie_id); ?>" class="stretched-link"><?php echo get_the_title($provincie_id); ?></a>
                            </li>
                        <?php endif;?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-cta">      
                    <div class="content-cta__content">
                        <h3 class="display-3 text-white">Woonachtig in <?php echo get_field('name_place')?> en geïnteresseerd in je jaarlijkse besparing door zonnepanelen?</h3>
                        <p class="my-3">Neem dan snel contact op met een van onze deskundige adviseurs, wij staan klaar om al je vragen te beantwoorden en je te voorzien van een passend deskundig gratis advies</p>
                        <a href="<?php echo get_field('global_adviesgesprek','options')['url']?>" class="btn btn-white">Adviesgesprek aanvragen</a>
                        <a href="<?php echo get_field('whatsapp_link','options')?>" class="btn btn-secondary">Prijsindicatie aanvragen</a>
                    </div>
                    <div class="content-cta__media">
                        <img loading="lazy" src="<?php echo get_field( 'fixedcta_afbeelding', 'options' )['url'];?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-3 my-lg-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 small-content">
                <h2 class="display-5">Hoeveel dakoppervlak heb ik nodig</h2>
                <p>
                    Om een zonnepaneel in <?php echo get_field( 'name_place' ); ?> te plaatsen heb je een oppervlak van circa 1,7 m2 nodig. Je kunt minder panelen plaatsen als je een klein dak hebt of te maken hebt met veel obstakels. Wil je bijv. 14 zonnepanelen plaatsen, dan heb je dus minimaal 23 m2 ruimte op je dak nodig.
                </p>
                <h2 class="display-5 mt-1">Slim investeren in zonnepanelen</h2>
                <p>
                    Het installeren van zonnepanelen in <?php echo get_field( 'name_place' ); ?> blijft een aantrekkelijke en winstgevende investering, zowel op de korte als op de lange termijn. Ondanks de geleidelijke afbouw van de salderingsregeling, die kan leiden tot een lichte daling van het financiële rendement, is de impact hiervan jaarlijks relatief beperkt. Hierdoor is het nog steeds mogelijk om de investering in een zonnepanelensysteem binnen een termijn van ongeveer zes jaar volledig terug te verdienen. Deze terugverdientijd maakt de aanschaf van zonnepanelen niet alleen economisch verantwoord, maar draagt ook bij aan een duurzamere toekomst door de productie van groene energie. Het blijft dus een slimme keuze voor huiseigenaren die hun energiekosten willen verlagen en tegelijkertijd een positieve bijdrage willen leveren aan het milieu.
                </p>
                <h2 class="display-5 mt-1">Adviesgroep Oost de partner voor zonnepanelen in <?php echo get_field( 'name_place' ); ?></h2>
                <p>Adviesgroep Oost onderscheidt zich als dé toonaangevende partner op het gebied van zonnepanelen in <?php echo get_field( 'name_place' ); ?>. Van het begin tot het eind staan wij voor je klaar: van persoonlijk advies op maat tot het zorgvuldig vergelijken van offertes, wij zorgen ervoor dat jij toegang krijgt tot het beste aanbod. Bij ons vind je alles onder één dak, zodat jij zonder zorgen en zo snel mogelijk kunt beginnen met het opwekken van je eigen zonne-energie. Schakel in met Adviesgroep Oost en geniet van de voordelen van zonne-energie met een lagere energierekening als resultaat. </p>
            </div>
        </div>
    </div>
</section>


<?php get_template_part( 'template-parts/layouts/layout', 'reviews', array( 'class' => 'mb-lg-5 mb-3' ) ); ?>

<section class="mb-5">
    <div class="container">
        <div class="row gx-lg-5">
            <div class="col-lg-6 mb-2 mb-lg-0">
                <div class="content-split__media d-none d-lg-block">
                    <img loading="lazy" src="<?php echo $featured_img_url;?>" alt="<?php the_title();?>">
                </div>
            </div>
            <div class="col-lg-6 py-1">
                <h3 class="display-4 mb-3">
                    <?php if(get_field( 'is_provincie' )):?>
                        Wij leveren zonnepanelen in heel <?php echo get_field( 'name_place' );?> 
                    <?php else: ?>
                        Adviesgroep Oost jouw partner voor zonnepanelen in <?php echo get_field( 'name_place' );?>
                    <?php endif;?>
                </h3>
                <p>
                    <?php if(get_field( 'is_provincie' )):?>
                        Ben je woonachtig in de provincie <?php echo get_field( 'name_place' );?> en op zoek naar <a href="/zonnepanelen/">zonnepanelen</a>? Wij helpen je graag met het verduurzamen van je woning of bedrijfspand. Laat je vrijblijvend adviseren over zonnepanelen in <?php echo get_field( 'name_place' );?>. Of je nu in het noorden van <?php echo get_field( 'name_place' );?> woont of in het zuiden, onze adviseurs komen graag naar je toe.
                        <a href="<?php echo get_field( 'global_adviesgesprek', 'options' )['url'];?>" class="mt-2 mb-1 btn btn-primary"><?php echo get_field( 'global_adviesgesprek', 'options' )['title'];?></a>
                        <strong class="d-block mt-1">Andere inwoners van <?php echo get_field( 'name_place' );?> bekeken ook</strong>
                    <?php else: ?>
                        Adviesgroep Oost jouw partner voor zonnepanelen in <?php echo get_field( 'name_place' );?>, wanneer je zonnepanelen wil kopen, of meer informatie wil over <a href="/zonnepanelen/">zonnepanelen</a> in <?php echo get_field('name_place');?> onze deskundige adviseurs staan voor je klaar. Vraag vrijblijvend een adviesgesprek aan of vraag direct een prijsindicatie aan via WhatsApp.
                        <a href="<?php echo get_field( 'global_adviesgesprek', 'options' )['url'];?>" class="mt-2 mb-1 btn btn-primary"><?php echo get_field( 'global_adviesgesprek', 'options' )['title'];?></a>
                        <strong class="d-block mt-1">Andere inwoners van <?php echo get_field( 'provincie' )['label'];?> bekeken ook</strong>
                    <?php endif;?>
                </p>
                <ul class="content-linklist mt-2">
                    <?php // if provincie
                        if(get_field('is_provincie')){
                            $provincie_id = get_the_ID();

                            // Argumenten voor de WP_Query
                            $args = array(
                                'post_type' => 'local', // Aanpassen aan jouw custom post type
                                'posts_per_page' => 6,
                                'post__not_in' => array($provincie_id), // Sluit de huidige post uit
                                'orderby' => 'rand',
                                'meta_query' => array(
                                    array(
                                        'key' => 'provincie', // De meta key die je wilt controleren
                                        'value' => $provincie_id, // De waarde waarmee je wilt vergelijken
                                        'compare' => '=', // Controleert op gelijkheid
                                    ),
                                ),
                            );

                            // Voer de query uit
                        } else {
                            $provincie_id = get_field( 'provincie' )['value']; 
                            $current_post_id = get_the_id();
                            $args = array(
                                'post_type' => 'local', // Aanpassen aan jouw custom post type
                                'posts_per_page' => 6,
                                'post_parent' => array($provincie_id), // Sluit de huidige post uit
                                'post__not_in' =>  array($current_post_id),
                                'orderby' => 'rand',
                                'meta_query' => array(
                                    array(
                                        'key' => 'provincie', // De meta key die je wilt controleren
                                        'value' => $provincie_id, // De waarde waarmee je wilt vergelijken
                                        'compare' => '=', // Controleert op gelijkheid
                                    ),
                                ),
                            );
                        } 

                    ?>
                    <?php $loop = new WP_Query($args);  while ($loop->have_posts()) : $loop->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                    <?php if(!get_field( 'is_provincie' )):?>
                        <li>
                            <a href="<?php echo get_the_permalink($provincie_id); ?>" class="stretched-link"><?php echo get_the_title($provincie_id); ?></a>
                        </li>
                    <?php endif;?>
                </ul>
                
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

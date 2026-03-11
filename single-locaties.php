

<?php $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );get_header(); ?>

<div class="wrapper position-relative"  data-sticky-container>

	<section class="cro-header">
		<?php if ( $featured_image ) : ?>
			<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo get_the_title(); ?>" class="img-abs-center">
		<?php endif; ?>

		<div class="container">
			<div class="col-xl-8 col-lg-7">
				<h1 class="display-3 fw-bold text-white"><?php echo get_the_title(); ?></h1>
			</div>
		</div>
	</section>

	<main class="mb-lg-10">
		<div class="container">
			<div class="page-intro">
				<div class="col-xl-8 col-lg-7 pt-lg-2 pt-1">
                <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); }?>	
				</div>
				<div class="col-xl-8 col-lg-7 pt-lg-2 pt-1 mb-lg-10 content-container">
                    <?php echo get_field('content');?>
                    <h2 class="display-3">Spouwmuurisolatie in <?php echo get_field('plaatsnaam');?></h2>
                    <p>
Ben je woningeigenaar en wil je snel en betaalbaar energie besparen? Met <strong>spouwmuurisolatie</strong> verhoog je direct het comfort in huis en verlaag je je energiekosten aanzienlijk. De isolatie wordt in de bestaande spouwmuur ingeblazen, waardoor de werkzaamheden weinig tijd kosten en nauwelijks ingrijpend zijn. Zo profiteer je direct van een warmer huis in de winter en een koeler huis in de zomer. Daarnaast kun je met spouwmuurisolatie in <?php echo get_field('plaatsnaam');?> je energielabel verbeteren en de waarde van je woning verhogen. Adviesgroep Oost begeleidt je bij elke stap: van deskundig advies tot uitvoering en subsidieaanvraag. Kies voor professionele <strong>spouwmuurisolatie in <?php echo get_field('plaatsnaam');?></strong> en begin direct met besparen.
</p>
<h3 class="display-3">Bodemisolatie</h3>
<p>
Heb je last van een koude vloer of vocht in huis in <?php echo get_field('plaatsnaam');?>? Met <strong>bodemisolatie</strong> pak je dit probleem direct bij de bron aan. Door isolatiemateriaal onder de vloer aan te brengen, blijft de kou uit de kruipruimte buiten en wordt je woning comfortabeler en gezonder. Daarnaast helpt bodemisolatie om energie te besparen en schimmelvorming te voorkomen. Bij Adviesgroep Oost regelen we het hele traject van A tot Z: van gratis advies en een duidelijke offerte tot de uitvoering en subsidieaanvraag. Kies voor <strong>bodemisolatie in <?php echo get_field('plaatsnaam');?></strong> en geniet van meer comfort én een lagere energierekening.
</p>
<h3 class="display-4">Zoldervloer isolatie <?php echo get_field('plaatsnaam');?></h3>
<p>
Heb je een onverwarmde zolder in <?php echo get_field('plaatsnaam');?>? Dan is <strong>zoldervloerisolatie</strong> een slimme oplossing om warmteverlies te beperken. Door de vloer van je zolder te isoleren, houd je de warmte in de woonruimtes beneden en bespaar je aanzienlijk op je energierekening. Bovendien is de investering relatief laag en vaak binnen enkele jaren terugverdiend. Adviesgroep Oost neemt je het hele proces uit handen: van persoonlijk advies en scherpe offerte tot de plaatsing en subsidieaanvraag. Kies voor professionele <strong>zoldervloerisolatie in <?php echo get_field('plaatsnaam');?></strong> en maak je woning energiezuiniger en comfortabeler.
</p>


                        <h2 class="display-3">Dakisolatie <?php echo get_field('plaatsnaam');?></h2>
                    <p>
                        Woon je in <?php echo get_field('plaatsnaam');?>, een stad met ruim <?php echo get_field('aantal_inwoners');?> inwoners, en wil je flink besparen op je energierekening? Met <strong>dakisolatie</strong> voorkom je warmteverlies en verhoog je direct het wooncomfort. Een goed geïsoleerd dak houdt in de winter de warmte binnen en in de zomer juist de hitte buiten. Zo verbruik je minder energie, verbeter je het energielabel van je woning en draag je bij aan een duurzamer <?php echo get_field('plaatsnaam');?>. Bovendien zijn er aantrekkelijke subsidies beschikbaar, waardoor de investering sneller is terugverdiend. Adviesgroep Oost helpt je van advies en offerte tot en met de uitvoering en subsidieaanvraag. Kies voor professionele <strong>dakisolatie in <?php echo get_field('plaatsnaam');?></strong> en profiteer van lagere energiekosten en meer comfort.
                </p>
				</div>
			</div>
		</div>
	</main>

	<?php get_template_part( 'template-parts/components/component', 'aside'); ?>

</div>

<section class="bg-light py-10 my-5">
    <div class="container">
        <div class="col-lg-12 mx-auto text-center">
            <h2 class="display-4 fw-bold mb-3">Voordelen van isolatie in <?php echo get_field('plaatsnaam');?></h2>
          <div class="row row-cols-5">
            <div>
                <div class="bg-white py-3 px-4 rounded-3 h-100">
                    <strong>Persoonlijk advies</strong>
                    <small class="d-block">Begeleiding van eerste gesprek tot oplevering.</small>
                </div>
            </div>
            <div>
                <div class="bg-white py-3 px-4 rounded-3 h-100">
                    <strong>Twentse betrouwbaarheid</strong>
                    <small class="d-block">Eerlijk, nuchter en afspraak = afspraak.</small>
                </div>
            </div>
            <div>
                <div class="bg-white py-3 px-4 rounded-3 h-100">
                    <strong>Lokale installateurs</strong>
                    <small class="d-block">Samenwerking met vakmensen uit de regio.</small>
                </div>
            </div>
            <div>
                <div class="bg-white py-3 px-4 rounded-3 h-100">
                    <strong>Scherpe deals</strong>
                    <small class="d-block">Altijd de beste prijs-kwaliteit voor jou.</small>
                </div>
            </div>
            <div>
                <div class="bg-white py-3 px-4 rounded-3 h-100">
                    <strong>Subsidiehulp</strong>
                    <small class="d-block">Ondersteuning bij aanvragen en regelingen.</small>
                </div>
            </div>
        </div>
            <a href="/vrijblijvend-adviesgesprek/" class="btn btn-primary mt-lg-3 mt-2">Gratis isolatie inspectie</a>
        </div>
    </div>
</section>


<section class="my-lg-10">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
               <h2 class="display-3">HR++ glas in <?php echo get_field('plaatsnaam');?></h2>
                <p class="mb-0">
                    Woon je in <?php echo get_field('plaatsnaam');?> en heb je nog enkel glas of standaard dubbel glas? Dan is het een slimme stap om te kiezen voor HR++ glas. Dit hoogrendementsglas bestaat uit twee glasplaten met daartussen argon gas en een speciale coating. Daardoor blijft de warmte beter binnen in de winter en houd je de hitte juist buiten in de zomer. 
                    Voor veel oudere woningen in <?php echo get_field('plaatsnaam');?> – een gemeente met ruim <?php echo get_field('aantal_inwoners');?> inwoners – is de overstap relatief eenvoudig en vaak zonder grote verbouwing mogelijk. Met HR++ glas kun je je energiekosten tot wel 20–30% verlagen. Daarnaast merk je meteen meer comfort: minder kouval, minder tocht en een stillere woning. Ook gaat je energielabel omhoog, wat je huis aantrekkelijker maakt voor de toekomst. 
                    Adviesgroep Oost is actief in <?php echo get_field('plaatsnaam');?> en helpt je van advies tot en met plaatsing. Vraag vandaag nog een gratis adviesgesprek aan en ontdek wat HR++ glas voor jouw woning kan betekenen.
                </p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="content-cta">
                    <?php 
                    if(get_sub_field( 'handmatige_vulling' )){
                        $id = get_the_ID();
                        $vullingtype = $id;
                        $fieldtype = 'get_sub_field';
                    } else {
                        $vullingtype = 'options';
                        $fieldtype = 'get_field';
                    } ?>
                    
                    <div class="content-cta__content">
                        <h3 class="display-3 text-white">Vrijblijvend advies bij je thuis in <?php echo get_field('plaatsnaam');?>?</h3>
                        <p class="my-3"><?php echo $fieldtype( 'cta_tekst', $vullingtype );?></p>
                        <?php get_template_part( 'template-parts/components/component', 'button', array( 'global' => $vullingtype ) ); ?>
                    </div>
                    <div class="content-cta__media">
                            <img loading="lazy" src="<?php echo get_field( 'fixedcta_afbeelding', 'options' )['url'];?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                            
<section class="my-lg-10">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <h2 class="display-3">Subsidie op isolatie in <?php echo get_field('plaatsnaam');?></h2>
                <p class="mb-0">
                  Wist je dat je als inwoner van <?php echo get_field('plaatsnaam');?> – een gemeente met ruim <?php echo get_field('aantal_inwoners');?> bewoners – gebruik kunt maken van de landelijke ISDE-subsidie (Investeringssubsidie Duurzame Energie en Energiebesparing)?
                    Met deze regeling krijg je een deel van de kosten voor isolatiemaatregelen terug. Zo wordt het nog aantrekkelijker om je woning energiezuiniger en comfortabeler te maken.

                    Overweeg je isolatie in <?php echo get_field('plaatsnaam');?>, zoals spouwmuur-, dak-, vloer- of bodemisolatie, of het plaatsen van HR++ glas? Dan kan de ISDE-subsidie je flink helpen besparen. Let wel op: er gelden voorwaarden, zoals minimale isolatiewaarden en de combinatie van minstens twee maatregelen.

                    Adviesgroep Oost staat in <?php echo get_field('plaatsnaam');?> voor je klaar. We regelen niet alleen de uitvoering van de isolatiewerkzaamheden, maar begeleiden je ook bij de subsidieaanvraag. Zo weet je zeker dat je niets misloopt.
                    👉 Wil je weten wat er voor jouw woning mogelijk is? Vraag vrijblijvend een gratis adviesgesprek aan en ontdek hoe jij kunt profiteren van de ISDE-subsidie.
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/layouts/layout', 'method', array( 'class' => '--dark' ) ); ?>


<section class="bg-light py-lg-10 mb-lg-10 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <h2 class="display-3 mb-lg-3 mb-2">Veelgestelde vragen over Isolatie in <?php echo get_field('plaatsnaam');?></h2>
                <div class="row gy-1">
                    <div class="col-12">
                         <div class="bg-white px-xl-2 rounded-3 faq-item js-faq">
                            <header class="faq-item__header js-faq-toggle">
                                <span class="faq-item__title">Welke isolatiemethode is het meest geschikt voor mijn type woning in  <?php echo get_field('plaatsnaam');?>?</span>
                                <span class="faq-item__toggler"></span>
                            </header>
                            <main class="faq-item__content js-faq-content">
                            Dit hangt af van het bouwjaar, type woning (bijv. tussenwoning of vrijstaand) en huidige isolatiestatus. Tijdens een gratis adviesgesprek bepalen we wat het hoogste rendement oplevert.
                            </main>
                        </div>
                    </div>
                    <div class="col-12">
                         <div class="bg-white px-xl-2 rounded-3 faq-item js-faq">
                            <header class="faq-item__header js-faq-toggle">
                                <span class="faq-item__title">Wat kost het om mijn woning te isoleren?</span>
                                <span class="faq-item__toggler"></span>
                            </header>
                            <main class="faq-item__content js-faq-content">
                                De kosten van isolatie hangen af van het type isolatie (dak, vloer, spouwmuur of glas) en de grootte van je woning. Gemiddeld liggen de kosten tussen de €2.000 en €6.000. Het goede nieuws: isolatie verdient zich vaak al binnen enkele jaren terug dankzij de lagere energierekening. Bij Adviesgroep Oost kijken we samen naar de beste oplossing voor jouw situatie en zorgen we voor een scherpe deal.
                            </main>
                        </div>
                    </div>
                    <div class="col-12">
                         <div class="bg-white px-xl-2 rounded-3 faq-item js-faq">
                            <header class="faq-item__header js-faq-toggle">
                                <span class="faq-item__title">Hoe lang is de terugverdientijd van isolatie?</span>
                                <span class="faq-item__toggler"></span>
                            </header>
                            <main class="faq-item__content js-faq-content">
                                De terugverdientijd varieert meestal tussen de 3 en 7 jaar. Dat is afhankelijk van je huidige energieverbruik, de gekozen isolatiemaatregel en eventuele subsidies. Omdat energieprijzen blijven stijgen, merk je vaak sneller voordeel dan je denkt. Wij helpen je inzicht te krijgen in de exacte besparing voor jouw woning of bedrijfspand.
                            </main>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-lg-10 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <h3 class="display-3 mb-lg-2">Wij zijn naast <?php echo get_field('plaatsnaam');?> ook actief in</h3>
            </div>
        </div>
        <div class="js-location-slider">
         <?php
            // Huidige post ID ophalen
            $current_id = get_the_ID();

            // Query instellen
            $args = array(
                'post_type'      => 'locaties',   // <-- vervang 'locaties' door je eigen CPT slug
                'posts_per_page' => 5,            // aantal posts per pagina
                'order'          => 'DESC',
                'orderby'        => 'date',
                'post__not_in'   => array($current_id) // huidige post uitsluiten
            );

            $loop = new WP_Query($args);

            if ($loop->have_posts()) :
                while ($loop->have_posts()) : $loop->the_post(); ?>
                    
                        <?php get_template_part('template-parts/blocks/block-post')?>       
                   
                <?php endwhile;  
            endif; 
            wp_reset_postdata(); ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>

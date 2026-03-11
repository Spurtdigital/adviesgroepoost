<?php 
/* Template Name: Product - Kozijn */
/* Template Post Type: kozijn */ 

get_header(); global $post; ?>

<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="offset-xl-1 col-xl-10 mb-2">
                <div class="row gx-xl-4 gy-2 justify-content-center">
                    <div class="col-lg-6">
                        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="mb-1 breadcrumbs --dark">','</div>' ); }?>
                        <div class="kozijn-hero position-relative w-100">
                            <img loading="lazy" class="img-abs-center" src="<?php echo get_field( 'product_afbeelding' )['url'];?>" alt="<?php echo get_field( 'product_afbeelding' )['alt'];?>">
                        </div>
                    </div>
                    <div class="col-lg-6 py-xl-5">
                        <h1 class="display-2 mb-2"><?php the_title();?></h1>
                        <p><?php the_field( 'introductie_tekst' );?></p>
                        <div class="d-flex flex-wrap gap-1 align-items-center">
                            <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#offerModal">Offerte aanvragen</a>
                            <a href="/vrijblijvend-advies/" class="text-decoration-none">Vrijblijvend adviesgesprek<i class="ms-1 small fa-sharp fa-solid fa-arrow-right"></i></a>
                        </div>
                        <ul class="reset-list mt-2 small">
                            <li><i class="fa-solid fa-check me-1 text-success"></i>Gratis inmeten</li>
                            <li><i class="fa-solid fa-check me-1 text-success"></i>Advies tot montage onder 1 dak</li>
                            <li><i class="fa-solid fa-check me-1 text-success"></i>Binnen 1 werkdag een offerte op maat</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mb-lg-3 mb-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <h4 class="display-5 mt-lg-3 mt-1 mb-lg-2 mb-1"><?php the_title();?> mogelijkheden</h4>
                Naast standaard <?php the_title();?> hebben we bij Adviesgroep Oost meer mogelijkheden. Hieronder vind je enkele voorbeelden van onze mogelijkheden in <?php the_title();?>. Deze maatwerk kozijnen geven slechts een indruk van de meest gekozen opties. Benieuwd naar alle mogelijkheden? Vraag er gerust naar!</span>
                <?php if ( have_rows('kozijn_mogelijkheden') ) : ?>
                    <div class="row g-lg-3 g-2 row-cols-lg-4 row-cols-2">
                    <?php while( have_rows('kozijn_mogelijkheden') ) : the_row(); ?>
                       <div class="col">
                        <div class="block-frame position-relative">
                                <div class="block-frame__media">
                                    <?php if(get_sub_field( 'afbeelding' )):?>
                                        <img loading="lazy" class="img-abs-center" src="<?php echo get_sub_field( 'afbeelding' )['url'];?>" alt="<?php echo get_sub_field( 'afbeelding' )['alt'];?>">
                                    <?php endif;?>
                                </div>
                                <strong class="block-frame__title"><?php echo get_sub_field( 'titel');?></strong>
                            </div>
                       </div>
                    <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</section>
<div class="content-row">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-cta">
                    <?php 
                        $vullingtype = 'options';
                        $fieldtype = 'get_field';
                        ?>
                    
                    <div class="content-cta__content">
                        <h3 class="display-3 text-white">Kozijnen zijn maatwerk</h3>
                        <p class="my-3">Bij Adviesgroep Oost bieden we op maat gemaakte kozijnen die perfect passen bij jouw woning. Onze experts adviseren je graag over het juiste profiel, glas en type kozijn om aan jouw wensen te voldoen.</p>
                        <?php get_template_part( 'template-parts/components/component', 'button', array( 'global' => $vullingtype ) ); ?>
                    </div>
                    <div class="content-cta__media">
                        <img loading="lazy" src="<?php echo get_field( 'fixedcta_afbeelding', 'options' )['url'];?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="offerModal" tabindex="-1" aria-labelledby="offerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header px-lg-3">
        <h5 class="modal-title" id="offerModalLabel">Vrijblijvend een offerte aanvragen voor <?php the_title();?></h5>
        <a  data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-square-minus"></i></a>
      </div>
      <div class="modal-body p-lg-3">
        <?php echo do_shortcode('[contact-form-7 id="44cd7b8" title="Kozijn offerte"]');?>
      </div>
    </div>
  </div>
</div>

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php get_footer();?>
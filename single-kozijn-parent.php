<?php 
/* Template Name: Parent - Kozijn*/
/* Template Post Type: kozijn */ 

get_header(); global $post; ?>

<?php if (!$post->post_parent) : get_template_part( 'template-parts/headers/header','single' );  ?>

<?php if(get_field( 'tekst_boven_assortiment' )):?>
<section class="my-lg-4 my-2">
    <div class="container">
        <div class="row">
            <div class="offset-lg-1 col-lg-9">
                <?php echo get_field( 'tekst_boven_assortiment' );?>
            </div>
        </div>
    </div>
</section>
<?php endif; endif;?>

<section class="mb-lg-3 mb-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <h4 class="display-5 mt-lg-3 mt-1 mb-lg-2 mb-1">Kozijn mogelijkheden</h4>
                <span class="d-block mb-lg-3 mb-2">Hieronder vind je enkele voorbeelden van onze kozijnen. Deze maatwerk kozijnen geven slechts een indruk van de meest gekozen opties. Benieuwd naar alle mogelijkheden? Vraag er gerust naar!</span>
                <?php $posts = get_field('mogelijkheden'); ?>
                <?php if ( $posts ): ?>
                    <div class="row g-lg-3 g-2 row-cols-lg-4 row-cols-2">
                        <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                        <div class="col">
                            <?php get_template_part( 'template-parts/blocks/block', 'kozijn' ); ?>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
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

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vrijblijvend een offerte aanvragen</h5>
        <a  data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-square-minus"></i></a>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode('[contact-form-7 id="44cd7b8" title="Kozijn offerte"]');?>
      </div>
    </div>
  </div>
</div>



<?php get_footer();?>
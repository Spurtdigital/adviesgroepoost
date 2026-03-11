<?php 
/* Template Name: LOCAL SEO - Kozijn*/
/* Template Post Type: kozijn */ 

get_header();
?>

<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="offset-xl-1 col-xl-9 mb-2">
                <div class="row gx-xl-4 gy-2 justify-content-center">
                    <div class="col-lg-6">
                        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs --dark">','</div>' ); }?>
                        <div class="kozijn-hero position-relative w-100">
                            <img fetchpriority="high" c class="img-abs-center" src="<?php echo get_field( 'product_afbeelding' )['url'];?>" alt="<?php echo get_field( 'product_afbeelding' )['alt'];?>">
                        </div>
                    </div>
                    <div class="col-lg-6 py-xl-5">
                        <h1 class="display-2 mb-2"><?php the_title();?></h1>
                        <p><?php the_field( 'introductie_tekst' );?></p>
                        <div class="d-flex flex-wrap gap-1 align-items-center">
                            <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Offerte aanvragen</a>
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
                <h4 class="display-5 mt-lg-3 mt-1 mb-lg-2 mb-1">Mogelijkheden kozijnen in <?php the_field( 'plaatsnaam' );?></h4>
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
                        <h3 class="display-3 text-white">Kozijn kopen in <?php the_field( 'plaatsnaam' );?></h3>
                        <p class="my-3">Bij Adviesgroep Oost bieden we op maat gemaakte kozijnen die perfect passen bij jouw woning. Onze experts adviseren je graag over het juiste profiel, glas en type kozijn om aan jouw wensen te voldoen. Van advies tot plaatsing, alles onder 1 dak.</p>
                        <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Offerte aanvragen</a>
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

<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<section class="mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                 <?php the_field( 'afsluitende_tekst' );?>
                 <a href="#" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Offerte aanvragen</a>

            </div>
        </div>
    </div>
</section>

<?php if(get_field('is_seo_pagina')):?>
<section class="mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-light p-lg-3 p-1">
                    <h4 class="display-4">We zijn ook actief in:</h4>
                    <ul class="reset-list flex-wrap d-flex gap-1">
                        <?php $loop = new WP_Query( array(
                            'post_type' => 'kozijn',
                            'posts_per_page' => -1
                            ) );  ?>
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <?php if(get_field('is_seo_pagina')):?>
                                <li><a style="white-space:nowrap"; href="<?php the_permalink();?>"><?php the_title();?></a></li>
                            <?php endif;?>
                        <?php endwhile; wp_reset_query(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php get_footer();?> 

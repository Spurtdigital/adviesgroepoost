<?php /*Template Name: Page - Ervaringen */ get_header();?>

<?php get_template_part( 'template-parts/headers/header','single' ); ?>


<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>


<section class="bg-light py-lg-10 py-3 mb-lg-5 mb-3">
    <div class="container">
    <?php 
// Stap 1: Controleren of er rijen zijn en deze in een array plaatsen
if ( have_rows('ervaringen') ) : 
    $ervaringen = [];
    while ( have_rows('ervaringen') ) : the_row();
        // Elk 'ervaring' element opslaan als een array van velden/subvelden
        $ervaringen[] = [
            'afbeelding' => get_sub_field('afbeelding'),
            'naam' => get_sub_field('naam'),
            'plaats' => get_sub_field('plaats'),
            'ondertitel' => get_sub_field('ondertitel'),
            'review' => get_sub_field('review'),
            'review_vanuit' => get_sub_field('review_vanuit'),
            'review_cijfer' => get_sub_field('review_cijfer'),
        ];
    endwhile;

    // Stap 2: De array willekeurig schudden
    shuffle($ervaringen);
    ?>

    <div class="row g-3" data-masonry='{"percentPosition": true }'>
        <?php 
        // Stap 3: Door de willekeurig gesorteerde ervaringen lopen
        foreach ($ervaringen as $ervaring) :
        ?>
            <div class="col-xxl-3 col-lg-4 col-md-6">
                <div class="block-ervaring <?php if ( $ervaring['afbeelding'] ) : echo 'has-media'; endif; ?>">
                    <?php if ( $ervaring['afbeelding'] ) : ?>
                    <div class="block-ervaring__media">
                        <img loading="lazy" src="<?php echo $ervaring['afbeelding']['url'];?>" alt="<?php echo $ervaring['afbeelding']['titel'];?>">
                    </div>
                    <?php endif; ?>
                    <div class="block-ervaring__content">
                        <h3 class="display-5 mb-0"><?php echo $ervaring['naam'];?> <span class="fw-normal">uit <?php echo $ervaring['plaats'];?></span></h3>
                        <?php if ( $ervaring['ondertitel'] ) : ?>
                            <span class="text-success block-ervaring__subtitle"><?php echo $ervaring['ondertitel'];?></span>
                        <?php endif; ?>
                        <p class="my-2"><?php echo $ervaring['review'];?></p>
                        
                    </div>
                    <div class="block-ervaring__footer d-flex align-items-center justify-content-between w-100">
                        <div class="block-ervaring__stars d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <?php 
                                $destionation = $ervaring['review_vanuit'];
                                switch ($destionation) {
                                    case "website":
                                      $destionationIcon = '';
                                      break;
                                    case "google":
                                        $destionationIcon = '<i class="fa-brands fa-google"></i>';
                                      break;
                                    case "facebook":
                                        $destionationIcon = '<i class="fa-brands fa-facebook-f"></i>';
                                      break;
                                  }
                            ?>

                            <?php echo $destionationIcon; ?>
                            <strong class="ms-1 mt-1 d-block mt-lg-0"><?php echo $ervaring['review_cijfer'];?></strong>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
      
    </div>
</section>






<?php get_footer();?>
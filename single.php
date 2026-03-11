<?php get_header();   $current_post_id = get_the_ID();?>

<?php get_template_part( 'template-parts/headers/header','single' ); ?>


<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<?php if(!get_field( 'auteur_verbergen' )):?>
<?php get_template_part( 'template-parts/components/component','author' ); ?>
<?php endif;?>

<?php if(is_singular('regio')):?>
    <?php if(get_field( 'dienst' )):?>
        <section class="mb-5">
            <div class="container">
                <div class="row gx-lg-5">
                    <div class="col-lg-6 mb-2 mb-lg-0">
                        <div class="content-split__media d-none d-lg-block">
                            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
                            <img loading="lazy" src="<?php echo $featured_img_url;?>" alt="<?php the_title();?>">
                        </div>
                    </div>
                    <div class="col-lg-6 py-1">
                        <h3 class="display-4 mb-3">Actief in heel Nederland </h3>
                    <?php
                        if (get_field('regio_tekst')) {
                            echo get_field('regio_tekst');
                        } else {
                            echo 'Adviesgroep Oost is actief in heel Nederland, ook in ' . get_the_title() . ' en de onderstaande plaatsen. Ben je opzoek naar andere diensten in een andere woonplaats?';
                        }
                    ?>
                    <strong class="mb-3 mt-lg-3 mt-2 d-block">Wij zijn actief in heel Nederland</strong>
                    <ul class="content-linklist">
                    <?php 
                        $current_post_id = get_the_ID(); // Haal de huidige post ID op

                        $loop = new WP_Query( array(
                            'post_type' => 'regio',
                            'posts_per_page' => 12,
                            'orderby' => 'rand',
                            'post__not_in' => array( $current_post_id ) // Sluit de huidige post uit
                        ) );
                        ?>

                    <?php while ( $loop->have_posts() ) : $loop->the_post();  if(get_field( 'dienst' ) == 'isolatie'):?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a>
                        </li>
                    <?php endif; endwhile; wp_reset_query(); ?>
                    </ul>
                    </div>
                </div>
            </div>
        </section>
    <?php else:?>
     <?php if(get_field('plaatsen')): ?>
        <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
        <section class="mb-5">
            <div class="container">
                <div class="row gx-lg-5">
                    <div class="col-lg-6 mb-2 mb-lg-0">
                        <div class="content-split__media d-none d-lg-block">
                            <img loading="lazy" src="<?php echo $featured_img_url;?>" alt="<?php the_title();?>">
                        </div>
                    </div>
                    <div class="col-lg-6 py-1">
                        <h3 class="display-4 mb-3"><?php echo get_field('regio_titel') ? get_field('regio_titel') : 'Plaatsen in Nederland waar wij actief zijn'; ?></h3>
                    <?php
                        if (get_field('regio_tekst')) {
                            echo get_field('regio_tekst');
                        } else {
                            echo 'Adviesgroep Oost is actief in heel Nederland, ook in ' . get_the_title() . ' en de onderstaande plaatsen. Ben je opzoek naar andere diensten in een andere woonplaats?';
                        }
                    ?>
                    <strong class="mb-3 mt-lg-3 mt-2 d-block"><?php echo get_field( 'plaatsen_titel' );?></strong>
                        <?php $posts = get_field('plaatsen'); ?>
                        <?php if ( $posts ): ?>
                            <ul class="content-linklist">
                                <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a>
                                    </li>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        <?php endif; ?>
                        <?php if(get_field( 'intro_link' )):?>
                            <a href="<?php echo get_field( 'intro_link' )['url'];?>" class="btn btn-primary mt-1"><?php echo get_field( 'intro_link' )['title'];?></a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <?php endif;?>
<?php else :?>
<?php
 if(!get_field( 'posts_verbergen' )):
if (get_field('handmatige_vulling')) {
    $posts = get_field('related_posts');
    } else {
        $loop = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post__not_in' => array($current_post_id)
        ));
    }
    ?>
    <section class="related-posts mb-lg-7">
        <div class="container">
            <h2 class="display-3 mb-lg-3 mb-1">Anderen bekeken ook</h2>
            <div class="js-related-posts slick-margin">
            <?php if (get_field('handmatige_vulling')) { ?>
                <?php foreach ($posts as $post) : setup_postdata($post); ?>
                        <?php get_template_part('template-parts/blocks/block', 'post'); ?>
                <?php endforeach;  wp_reset_postdata(); ?>
            <?php } else { ?>
                <?php while ($loop->have_posts()) :$loop->the_post();?>
                    <?php get_template_part('template-parts/blocks/block', 'post'); ?>
                <?php endwhile; wp_reset_query(); ?>
            <?php } ?>
            </div>
        </div>
    </section>
<?php endif; endif;?>


<?php if(is_singular('regio')):?>
    <section>
        <div class="layout-method --dark js-has-dark">
            <div class="container">
                <div class="row gx-xl-10 gx-lg-5 gx-3">
                    <div class="col-lg-6">
                        <h3 class="mb-lg-4">Bij Adviesgroep Oost kun je rekenen op volledig vertrouwen en totale ontzorging voor <?php the_title();?></h3>
                        <p class="mb-3">Van een vrijblijvend adviesgesprek tot de daadwerkelijke uitvoering, alles in slechts 5 eenvoudige stappen. Neem de eerste stap naar een energiezuiniger huis en plan vandaag nog jouw vrijblijvende adviesgesprek in!</p>
                        <a href="/vrijblijvend-advies/" class="btn btn-success">Adviesgesprek aanvragen</a>
                    </div>
                    <div class="col-lg-6 mt-2 mt-md-3 mt-lg-0">
                        <div class="layout-method-steps --dark">
                            <?php $stepcount = 0; if ( have_rows('stappen', 'options') ) : ?>
                                <?php while( have_rows('stappen', 'options') ) : the_row(); $stepcount ++;?>
                                <div class="layout-method-step <?php if($stepcount < 2): echo 'show'; else: echo '--dark'; endif; ?>">
                                    <span class="layout-method-step__number"><?php echo $stepcount;?></span>
                                    <div class="layout-method-step__title"><?php echo get_sub_field( 'titel' );?></div>
                                    <div class="layout-method-step__content"><?php echo get_sub_field( 'tekst' );?></div>
                                </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <?php get_template_part( 'template-parts/layouts/layout', 'reviews', array( 'class' => 'mb-lg-5 mb-3' ) ); ?>
<?php endif;?>

<?php get_footer(); ?>

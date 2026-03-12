<?php if ( have_rows( 'contentbuilder' ) ) : ?>
    <section class="content">
    <?php while ( have_rows('contentbuilder' ) ) : the_row(); ?>
        <?php if ( get_row_layout() == 'layout01' ) : // content?>
            <?php if(get_sub_field( 'vinkjes_tonen' )): $contentcheck = 'show__checks'; endif; ?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?> <?php echo $contentcheck; ?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 <?php if(get_sub_field( 'introductie_tekst' )): echo 'lead'; endif; if(get_sub_field( 'kleiner_weergeven' )): echo 'col-xl-7'; endif;?>">
                            <?php echo get_sub_field( 'tekstvlak' ); ?>
                            <?php get_template_part( 'template-parts/components/component', 'button', array( 'global' => '' ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout02' ) : // split?>
            <div class="content-row content-split <?php if(get_sub_field( 'achtergrond_kleur' )): echo'--bg'; endif;?> <?php if(get_sub_field( 'contain_afbeelding_groter_weergeven' )): echo'is--bigger'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="row gx-lg-5">
                                <div class="col-lg-6 py-1 <?php if(get_sub_field( 'afbeelding_links' )): echo'order-2 order-lg-2'; endif;?>">
                                    <h2 class="display-3 mb-2 mb-lg-4"><?php echo get_sub_field( 'titel' ); ?></h2>
                                   <?php echo get_sub_field('tekstvlak'); ?>
                                    <?php $posts = get_sub_field('links'); ?>
                                    <?php if ( $posts ): ?>
                                        <ul class="content-linklist">
                                            <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a>
                                                </li>
                                            <?php endforeach; wp_reset_postdata(); ?>
                                        </ul>
                                    <?php endif; ?>
                                    <?php get_template_part( 'template-parts/components/component', 'button', array( 'global' => '' ) ); ?>
                                </div>
                                <div class="col-lg-6 mb-2 mb-lg-0 <?php if(get_sub_field( 'afbeelding_links' )): echo'order-1 order-lg-1'; endif;?> <?php if(get_sub_field( 'verberg_mobiel' )): echo 'd-none d-lg-block'; endif;?>">
                                    <div class="content-split__media <?php if(get_sub_field( 'contain_afbeelding_groter_weergeven' )): echo'--bigger'; endif;?>">
                                         <img loading="lazy" src="<?php echo spurt_image(get_sub_field( 'afbeelding' )['url'], 720, 9999)?>" alt="<?php echo get_sub_field( 'afbeelding' )['alt']?>" <?php if(get_sub_field( 'afbeelding_contain' )): echo'style="object-fit:contain"'; endif;?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ( get_row_layout() == 'layout03' ) : // FAQ ?>
            <div class="content-row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="display-2"><?php echo get_sub_field( 'titel' );?></h2>
                            <?php echo get_sub_field( 'tekst' ); ?>
                            <?php if ( have_rows('faq') ) : ?>
                            <div class="faq-wrapper">
                                <?php while ( have_rows('faq') ) : the_row(); ?>
                                    <div class="faq-item js-faq">
                                        <header class="faq-item__header js-faq-toggle">
                                            <span class="faq-item__title"><?php echo esc_html(get_sub_field('vraag')); ?></span>
                                            <span class="faq-item__toggler"></span>
                                        </header>
                                        <main class="faq-item__content js-faq-content">
                                            <?php echo wp_kses_post(get_sub_field('antwoord')); ?>
                                        </main>
                                    </div>
                                <?php endwhile; ?>
                            </div>

                            <?php
                            $faq_items = get_sub_field('faq');
                            if (is_array($faq_items) && !empty($faq_items)) :
                                $faq_schema_entities = array();
                                foreach ($faq_items as $faq_item) {
                                    $question = isset($faq_item['vraag']) ? wp_strip_all_tags($faq_item['vraag']) : '';
                                    $answer = isset($faq_item['antwoord']) ? wp_strip_all_tags($faq_item['antwoord']) : '';

                                    if ($question === '' || $answer === '') {
                                        continue;
                                    }

                                    $faq_schema_entities[] = array(
                                        '@type' => 'Question',
                                        'name' => $question,
                                        'acceptedAnswer' => array(
                                            '@type' => 'Answer',
                                            'text' => $answer,
                                        ),
                                    );
                                }

                                if (!empty($faq_schema_entities)) :
                                    $faq_schema = array(
                                        '@context' => 'https://schema.org',
                                        '@type' => 'FAQPage',
                                        'mainEntity' => $faq_schema_entities,
                                    );
                            ?>
                            <script type="application/ld+json"><?php echo wp_json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
                            <?php
                                endif;
                            endif;
                            ?>
                        <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ( get_row_layout() == 'layout04' ) : // CTA ?>
            <div class="content-row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
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
                                    <h3 class="display-3 text-white"><?php echo $fieldtype( 'cta_titel', $vullingtype );?></h3>
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
            </div>
        <?php elseif ( get_row_layout() == 'layout05' ) : // form?>
            <div class="content-row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <?php get_template_part( 'template-parts/components/component','builder-form' ); ?>

                           <?php 
                           $form = get_sub_field('grafity_forms');
                            if($form):
                            gravity_form($form['id']);
                            endif;
                           ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif ( get_row_layout() == 'layout06' ) : // image?>
                <div class="content-row">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="content-media">
                                     <img loading="lazy" src="<?php echo get_sub_field( 'afbeelding' )['url'];?>" alt="<?php echo get_sub_field( 'afbeelding' )['alt'];?>">
                                    <?php if ( get_sub_field('video_link') ) : ?>
                                        <a href="<?php echo get_sub_field('video_link'); ?>" class="stretched-link" data-fancybox></a>
                                        <i class="fa-solid fa-play"></i>
                                    <?php endif; ?>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php elseif ( get_row_layout() == 'layout07' ) : // split?>
            <div class="content-row content-split <?php if(get_sub_field( 'achtergrond_kleur' )): echo'--bg'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="row gx-lg-5">
                                <div class="col-lg-6 py-1 <?php if(get_sub_field( 'afbeelding_links' )): echo'order-2 order-lg-2'; endif;?>">
                                    <h2 class="display-3 mb-2 mb-lg-4"><?php echo get_sub_field( 'titel' ); ?></h2>
                                   <?php echo get_sub_field('tekstvlak'); ?>
                                   <?php if ( have_rows('usps') ) : ?>
                                   <ul class="content-usps">
                                        <?php while( have_rows('usps') ) : the_row(); ?>
                                            <li><i class="fa-solid fa-check"></i><?php echo get_sub_field('usp'); ?></li>
                                        <?php endwhile; ?>
                                    </ul>
                                   <?php endif; ?>
                                   <?php if ( have_rows('buttons') ) : $btncount = 0;?>
                                        <div class="content-btns">
                                        <?php while( have_rows('buttons') ) : the_row(); $btncount++;?>
                                            <a class="btn <?php echo ($btncount > 1) ? 'btn-dark' : 'btn-primary'; ?>" href="<?php echo get_sub_field('button')['url']; ?>"><?php echo get_sub_field('button')['title']; ?></a>
                                        <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mb-2 mb-lg-0 <?php if(get_sub_field( 'afbeelding_links' )): echo'order-1 order-lg-1'; endif;?>">
                                    <div class="content-split__media">
                                         <img loading="lazy" src="<?php echo spurt_image(get_sub_field( 'afbeelding' )['url'], 720, 9999);?>" alt="<?php echo get_sub_field( 'afbeelding' )['alt']?>" <?php if(get_sub_field( 'afbeelding_contain' )): echo'style="object-fit:contain"'; endif;?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout08' ) : // Method?>
            <div class="content-row">
                <?php get_template_part( 'template-parts/layouts/layout', 'method', array( 'class' => '--dark' ) ); ?>
            </div>

        <?php elseif ( get_row_layout() == 'layout09' ) : // blokken?>
            <div class="content-row content-split <?php if(get_sub_field( 'achtergrond_kleur' )): echo'--bg'; endif;?>">
                <div class="container">
                    <div class="col-lg-8 offset-lg-2"><h4 class="display-4"><?php echo get_sub_field( 'titel' );?></h4></div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="row gy-2 gy-lg-3 row-cols-1 row-cols-md-1 row-cols-lg-3">
                                <?php if ( have_rows('blokken') ) : ?>
                                
                                    <?php while( have_rows('blokken') ) : the_row(); ?>
                                    <div class="col">
                                        <div class="content-block">

                                        <?php echo get_sub_field('icoon'); ?>
                                        <strong><?php echo get_sub_field('titel'); ?></strong>
                                        <p><?php echo get_sub_field('tekst'); ?></p>
                                        
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout10' ) : // Notication?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 bg-light p-lg-3 p-1">
                            <?php echo get_sub_field( 'notificatie' ); ?>     
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout11' ) : // Notication?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 bg-light p-lg-3 p-1">
                            <h3 class="display-3"><?php echo get_sub_field( 'titel' );?></h3>
                           <?php $posts = get_sub_field('links'); ?>
                           <?php if ( $posts ): ?>
                            <ul class="content-link-block">
                                <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                           <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
       
        <?php elseif ( get_row_layout() == 'layout12' ) : // Related?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12">
                            <h3 class="display-3"><?php echo get_sub_field( 'titel' );?></h3>
                            <?php echo get_sub_field( 'tekstvlak' );?>
                            <div class="row">
                                <?php $posts = get_sub_field('relations'); if ( $posts ):  foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <?php get_template_part( 'template-parts/blocks/block', 'post' ) ; ?>
                                </div>
                               <?php endforeach; wp_reset_postdata(); endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout13' ) : // Table?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 <?php if(get_sub_field( 'introductie_tekst' )): echo 'lead'; endif; if(get_sub_field( 'kleiner_weergeven' )): echo 'col-xl-7'; endif;?>">

                            <h3 class="display-3"><?php echo get_sub_field( 'titel' );?></h3>
                            <?php echo get_sub_field( 'tekst' );?>
                            <?php 
                            $table = get_sub_field( 'tabel' );

                            if ( ! empty ( $table ) ) {
                            
                                echo '<table border="0" class="table table-striped ">';
                            
                                    if ( ! empty( $table['caption'] ) ) {
                            
                                        echo '<caption>' . $table['caption'] . '</caption>';
                                    }
                            
                                    if ( ! empty( $table['header'] ) ) {
                            
                                        echo '<thead class="table-dark">';
                            
                                            echo '<tr>';
                            
                                                foreach ( $table['header'] as $th ) {
                            
                                                    echo '<th>';
                                                        echo $th['c'];
                                                    echo '</th>';
                                                }
                            
                                            echo '</tr>';
                            
                                        echo '</thead>';
                                    }
                            
                                    echo '<tbody>';
                            
                                        foreach ( $table['body'] as $tr ) {
                            
                                            echo '<tr>';
                            
                                                foreach ( $tr as $td ) {
                            
                                                    echo '<td>';
                                                        echo $td['c'];
                                                    echo '</td>';
                                                }
                            
                                            echo '</tr>';
                                        }
                            
                                    echo '</tbody>';
                            
                                echo '</table>';
                            }
                 
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout14' ) : // adviseurs?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10  <?php if(get_sub_field( 'introductie_tekst' )): echo 'lead'; endif; if(get_sub_field( 'kleiner_weergeven' )): echo 'col-xl-7'; endif;?>">

                            <h3 class="display-3"><?php echo get_sub_field( 'adviseurs_titel' );?></h3>
                            <?php echo get_sub_field( 'tekst' );?>
                            <div class="row g-2">
                                <?php if ( have_rows('adviseurs','options') ) : ?>
                                    <?php while( have_rows('adviseurs','options') ) : the_row(); ?>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="block-adviseur">
                                                <div class="block-adviseur__media --contain">
                                                     <img loading="lazy" src=" <?php echo get_sub_field('afbeelding')['url']; ?>" alt="">
                                                </div>
                                                <div class="block-adviseur__content">
                                                    <strong><?php echo get_sub_field( 'voornaam' );?> <?php echo get_sub_field( 'achternaam' );?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout15' ) : // authors?>
            <?php get_template_part( 'template-parts/components/component','author' ); ?>
        <?php elseif ( get_row_layout() == 'layout16' ) : // global CTA?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 <?php if(get_sub_field( 'introductie_tekst' )): echo 'lead'; endif; if(get_sub_field( 'kleiner_weergeven' )): echo 'col-xl-7'; endif;?>">
                            <div class="bg-light p-3">

                                <h3 class="display-3"><?php echo get_field( 'websitecta_titel','options' );?></h3>
                                <p><?php echo get_field( 'websitecta_tekst','options' );?></p>
                                <?php if(get_field( 'websitecta_button', 'options' )):?>
                                <a href="<?php echo get_field( 'websitecta_button','options' )['url'];?>" class="btn btn-primary"><?php echo get_field( 'websitecta_button','options' )['title'];?></a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout17' ) : // global CTA?>
            <div class="content-row <?php if(get_sub_field( 'kleiner_weergeven' )): echo 'small-content'; endif;?>">
                <div class="container">
                    <div class="scrolling">
                        <table class="price-table table table-responsive">
                            <tbody>
                                <?php if ( have_rows('header') ) : ?>
                                    <tr>
                                        <td></td>
                                        <?php while( have_rows('header') ) : the_row(); ?>
                                        <td>
                                            <?php the_sub_field('ondertitel'); ?>
                                            <br><small style="font-size: 18px; font-weight: 600;"><?php the_sub_field('titel'); ?></small>
                                        </td>
                                        <?php endwhile; ?>
                                    </tr>
                                <?php endif; ?>
                                <?php if ( have_rows('header') ) : ?>
                                    <tr class="price-table-head">
                                        <td></td>
                                        <?php while( have_rows('header') ) : the_row(); if(get_sub_field( 'prijs' )) : ?>
                                            <td class="price">
                                                €<?php the_sub_field( 'prijs' );?><small style="font-size:12px; padding-left: 4px;"><?php the_sub_field( 'prijs_voorvoegsel' );?></small>
                                                <br>
                                            </td>
                                    <?php endif; endwhile; ?>
                                    </tr>
                                <?php  endif; ?>
                                <?php 
                                    $table = get_sub_field( 'tabel' );
                                        if ( ! empty ( $table ) ) {
                                            foreach ( $table['body'] as $tr ) {
                                                echo '<tr>';
                                                    foreach ( $tr as $td ) {
                                                        echo '<td>';
                                                            echo $td['c'];
                                                        echo '</td>';
                                                    }
                                                echo '</tr>';
                                            }
                                    }  ?>                        
                                <?php if ( have_rows('header') ) : ?>
                                    <tr>
                                        <td></td>
                                        <?php while( have_rows('header') ) : the_row(); if(get_sub_field( 'prijs' )) : ?>
                                            <td class="price">
                                            
                                                <?php if(get_sub_field( 'link' )):?>
                                                <a class="btn btn-primary" href="<?php echo get_sub_field( 'link' )['url'];?>"><?php echo get_sub_field( 'link' )['title'];?></a>
                                                <?php endif;?>
                                            </td>
                                    <?php endif; endwhile; ?>
                                    </tr>
                                <?php  endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout18' ) : // Diensten blokken?>
            <div class="content-row">
                <div class="container">
                    <div class="offset-lg-1 col-lg-8">
                        <h2 class="display-3 mb-1"><?php the_sub_field( 'titel' );?></h2>
                        <div class="content-container mb-3">
                            <?php the_sub_field( 'tekstvlak' );?>
                            <?php get_template_part( 'template-parts/components/component', 'button', array( 'global' => '' ) ); ?>
                        </div>
                    </div>
                    <div class="row gy-md-3 gy-2">
                        <?php if ( have_rows('blokken') ) : while( have_rows('blokken') ) : the_row(); ?>
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="block-service">
                                    <div class="block-service__media">
                                         <img loading="lazy" src="<?php echo get_sub_field('afbeelding')['url']; ?>" alt="<?php echo get_sub_field('afbeelding')['alt']; ?>">
                                    </div>
                                    <div class="block-service__content">
                                        <?php if ( get_sub_field('titel') ) : ?>
                                            <strong><?php echo get_sub_field('titel'); ?></strong>
                                        <?php endif; ?>
                                        
                                        <?php $posts = get_sub_field('links'); ?>
                                        <?php if ( $posts ): ?>
                                            <ul class="reset-list">
                                                <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                                                    <li>
                                                        <a href="<?php the_permalink(); ?>"><i class="fa-sharp fa-light fa-angle-right me-1"></i><?php the_title(); ?></a>
                                                    </li>
                                                <?php endforeach; wp_reset_postdata(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        <?php elseif ( get_row_layout() == 'layout19' ) : // Diensten blokken?>
            <div class="content-row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h4 class="display-5 mt-lg-3 mt-1 mb-lg-2 mb-1"><?php the_sub_field( 'kozijn_titel' );?></h4>
                            <?php $posts = get_sub_field('kozijnen_mogelijkheden'); ?>
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
        <?php endif; endwhile; ?>
    </section>
<?php endif; ?>


       
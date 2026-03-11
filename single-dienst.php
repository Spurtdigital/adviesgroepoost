<?php get_header();     $current_post_id = get_the_ID(); ?>

<?php get_template_part( 'template-parts/headers/header','single' ); ?>

<?php get_template_part( 'template-parts/components/component', 'usps', array( 'class' => 'my-2' ) ); ?>


<?php get_template_part( 'template-parts/layouts/layout','builder' ); ?>

<section class="service-outro mb-3">
    <div class="container">
        <div class="row gx-0">
            <div class="col-lg-4">
                <div class="service-outro__media position-relative h-100 w-100">
                    <img fetchpriority="high" src="<?php echo esc_url(get_field('footer_top_image', 'options')['url']); ?>" class="img-abs-center" alt="<?php echo esc_attr(get_field('footer_top_image', 'options')['alt']); ?>">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="bg-light">
                    <div class="service-outro__media py-3 px-4">
                        <h3 class="display-3 mb-1">Adviesgroep Oost jouw partner in <?php the_title(); ?></h3>
                        <p class="mb-0">Wanneer je opzoek bent naar <?php the_title(); ?>, helpen wij je graag. Van advies tot uitvoer alles onder een dak. Compleet ontzorgd dus!</p>
                        <ul class="reset-list mt-lg-3 mt-md-2 mt-1">
                            <?php
                            global $post;
                            $current_post_id = get_the_ID();
                            $parent_post_id = wp_get_post_parent_id($current_post_id);

                            // Check if current post has children
                            $children = get_children(array(
                                'post_parent' => $current_post_id,
                                'post_type'   => 'dienst',
                                'numberposts' => -1,
                                'post_status' => 'publish'
                            ));

                            if (!empty($children)) {
                                // If current post has children, display them
                                foreach ($children as $child) {
                                    echo '<li><a href="' . get_permalink($child->ID) . '">' . get_the_title($child->ID) . '</a></li>';
                                }
                            } elseif ($parent_post_id) {
                                // If current post is a child, check its siblings (excluding current post)
                                $siblings = get_children(array(
                                    'post_parent' => $parent_post_id,
                                    'post_type'   => 'dienst',
                                    'numberposts' => -1,
                                    'post_status' => 'publish',
                                    'exclude'     => $current_post_id
                                ));

                                if (!empty($siblings)) {
                                    foreach ($siblings as $sibling) {
                                        echo '<li><a href="' . get_permalink($sibling->ID) . '">' . get_the_title($sibling->ID) . '</a></li>';
                                    }
                                } else {
                                    // Get parent post and display it if no siblings found
                                    $parent_post = get_post($parent_post_id);
                                    echo '<li><a href="' . get_permalink($parent_post->ID) . '">' . get_the_title($parent_post->ID) . '</a></li>';
                                }
                            } else {
                                // Get all parent posts if no children or siblings
                                $parents_query = new WP_Query(array(
                                    'post_type'      => 'dienst',
                                    'post_parent'    => 0,
                                    'posts_per_page' => -1,
                                    'post_status'    => 'publish'
                                ));

                                if ($parents_query->have_posts()) {
                                    while ($parents_query->have_posts()) {
                                        $parents_query->the_post();
                                        echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                    }
                                    wp_reset_postdata();
                                } else {
                                    echo '<li><a href="#">Geen gerelateerde posts gevonden.</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if(!get_field( 'posts_verbergen' )):?>
    <?php
    if (get_field('handmatige_vulling')) {
        $posts = get_field('related_posts');
    } else {
        $loop = new WP_Query(array(
            'post_type' => 'dienst',
            'posts_per_page' => -1,
            'post__not_in' => array($current_post_id)
        ));
    }
    ?>
    <section class="related-posts my-lg-7">
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
<?php endif;?>

<?php global $post; if ($post->post_parent == 0) { ?>
    <?php
    $loop = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category_name' => get_the_title(),
        'post__not_in' => array($current_post_id)
    ));
    ?>
    <section class="related-posts my-lg-5">
        <div class="container">
            <h2 class="display-3 mb-lg-3 mb-1">Het laatste <?php the_title();?> nieuws</h2>
            <div class="js-related-posts slick-margin">
            <?php while ($loop->have_posts()) :$loop->the_post();?>
                    <?php get_template_part('template-parts/blocks/block', 'post'); ?>
                <?php endwhile; wp_reset_query(); ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (get_field('in_formulier_tonen')) : ?>
<script>
    window.addEventListener('DOMContentLoaded', function() {
    var keyword = "advies";
    var links = document.getElementsByTagName('a');
    
    for (var i = 0; i < links.length; i++) {
        var link = links[i];
        
        if (link.innerText.toLowerCase().includes(keyword)) {
        var variabele =  "<?php echo get_the_title(); ?>"; // Hier wordt de titel van de pagina (the_title) als waarde voor de variabele gebruikt
        
        var url = link.href;
        var delimiter = url.includes("?") ? "&" : "?"; // Bepaalt of er al een querystring aanwezig is
        
        link.href = url + delimiter + "variabele=" + variabele;
        }
    }
    });
</script>
<?php endif;?>
<?php get_footer(); ?>

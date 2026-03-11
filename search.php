<?php get_header(); ?>
<section class="pt-10 pb-5 bg-light">
    <div class="container">
    <h1><?php echo sprintf(__('Zoekresultaten voor: %s', 'creators'), get_search_query()); ?></h1>
    </div>
</section>
<main>
    <div class="container my-3">
         <?php if (have_posts()) : ?>
            <?php 
            $resultaten = [];
            while (have_posts()) : the_post();
                $resultaten[$post->post_type][] = $post;
            endwhile;
            ?>

            <?php foreach ($resultaten as $post_type => $posts) : ?>
                <?php switch ($post_type) {
                    case 'post':
                        $post_type = 'post'; 
                        break;
                    case 'page':
                        $post_type = 'post';
                        break;
                    case 'dienst':
                        $post_type = 'post';
                        break;
                    case 'zonnepanelen':
                        $post_type = 'post';
                        break;
                    default:
                        $post_type = '';
                        break;
                } ?>
                <div class="row">
                    <?php foreach ($posts as $post) : setup_postdata($post); ?>
                        <div class="col-lg-4">
                            <?php get_template_part('template-parts/blocks/block', $post_type); ?>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Geen zoekresultaten gevonden.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
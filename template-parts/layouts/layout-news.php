<?php
$news_class = $args['class'] ?? '';
$news_title = $args['title'] ?? ( get_field( 'news_titel', 'options' ) ?: __( 'Het laatste nieuws', 'creators' ) );

$news_link = creators_link_field(
	$args['link'] ?? get_field( 'news_link', 'options' ),
	'',
	__( 'Bekijk alle artikelen', 'creators' )
);

if ( empty( $news_link['url'] ) ) {
	$news_url = creators_page_url_by_template( 'page-archive.php' );
	$news_link['url'] = $news_url ? $news_url : home_url( '/kennisbank/' );
}
?>
<section class="layout-nieuws <?php echo $news_class; ?>">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-lg-3 mb-2">
            <h2 class="display-4 fw-bold "><?php echo esc_html( $news_title ); ?></h2>
            <a class="link-with-icon text-decoration-none small" href="<?php echo esc_url( $news_link['url'] ); ?>"><?php echo esc_html( $news_link['title'] ); ?><i class="small ms-1 fa-regular fa-arrow-right-long"></i></a>
        </div>
        <div class="position-relative">
            <div class="js-layout-nieuws slick-margin">
                    <?php $loop = new WP_Query( array(
                    'post_type' => 'post ',
                    'posts_per_page' => 4
                )  ); ?>

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <?php get_template_part( 'template-parts/blocks/block','post' ); ?>
                <?php endwhile; wp_reset_query(); ?>
            </div>
        </div>
    </div>
</section>
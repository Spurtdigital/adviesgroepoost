<?php
/* Template Name: Archive - News */

get_header();

$archive_categories = get_terms(
	[
		'taxonomy'   => 'category',
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	]
);

$news_query = new WP_Query(
	[
		'post_type'           => 'post',
		'posts_per_page'      => -1,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	]
);
?>

<?php get_template_part( 'template-parts/headers/header', 'page' ); ?>

<section class="page-archive my-4 my-lg-5">
	<div class="container">
		<?php if ( ! empty( $archive_categories ) && ! is_wp_error( $archive_categories ) ) : ?>
			<div class="row justify-content-center mb-4 mb-lg-5">
				<div class="col-xl-10">
					<ul class="page-archive__filters reset-list">
						<li>
							<a class="page-archive__filter is-active" href="<?php echo esc_url( get_permalink() ); ?>">
								<?php esc_html_e( 'Alles', 'creators' ); ?>
							</a>
						</li>
						<?php foreach ( $archive_categories as $archive_category ) : ?>
							<li>
								<a class="page-archive__filter" href="<?php echo esc_url( get_term_link( $archive_category ) ); ?>">
									<?php echo esc_html( $archive_category->name ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $news_query->have_posts() ) : ?>
			<div class="row gy-4">
				<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
					<div class="col-md-6 col-xl-3">
						<?php get_template_part( 'template-parts/blocks/block', 'post' ); ?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="row justify-content-center">
				<div class="col-xl-8">
					<p class="mb-0"><?php esc_html_e( 'Er zijn nog geen nieuwsberichten beschikbaar.', 'creators' ); ?></p>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( get_the_content() ) : ?>
			<div class="row justify-content-center mt-4 mt-lg-5">
				<div class="col-xl-8 content-container">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_template_part( 'template-parts/layouts/layout', 'seo', [ 'class' => 'my-3 my-lg-5' ] ); ?>

<?php get_footer(); ?>
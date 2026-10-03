<?php
get_header();

$current_term = get_queried_object();
$archive_categories = get_terms(
	[
		'taxonomy'   => 'category',
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	]
);
?>

<?php
get_template_part(
	'template-parts/headers/header',
	'page',
	[
		'title'   => single_cat_title( '', false ),
		'intro'   => '',
		'buttons' => [],
	]
);
?>

<section class="page-archive my-4 my-lg-5">
	<div class="container">
		<div class="row justify-content-center mb-4 mb-lg-5">
			<div class="col-xl-8">
				<?php if ( term_description() ) : ?>
					<div class="content-container mb-3 mb-lg-4">
						<?php echo wp_kses_post( term_description() ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $archive_categories ) && ! is_wp_error( $archive_categories ) ) : ?>
					<ul class="page-archive__filters reset-list">
						<?php foreach ( $archive_categories as $archive_category ) : ?>
							<li>
								<a
									class="page-archive__filter<?php echo (int) $archive_category->term_id === (int) $current_term->term_id ? ' is-active' : ''; ?>"
									href="<?php echo esc_url( get_term_link( $archive_category ) ); ?>"
								>
									<?php echo esc_html( $archive_category->name ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="row gy-4">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="col-md-6 col-xl-3">
						<?php get_template_part( 'template-parts/blocks/block', 'post' ); ?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="row justify-content-center">
				<div class="col-xl-8">
					<p class="mb-0"><?php esc_html_e( 'Er zijn geen berichten gevonden in deze categorie.', 'creators' ); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
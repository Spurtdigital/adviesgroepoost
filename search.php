<?php get_header(); ?>

<?php get_template_part( 'template-parts/headers/header', 'page', [
	'title' => sprintf( __( 'Zoekresultaten voor: "%s"', 'creators' ), get_search_query() ),
	'intro' => have_posts() ? sprintf( __( '%d resultaten gevonden', 'creators' ), $wp_query->found_posts ) : __( 'Er zijn geen resultaten gevonden voor je zoekopdracht.', 'creators' ),
	'buttons' => [],
] ); ?>

<section class="py-lg-8 py-4">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-9">
				<?php if ( have_posts() ) : ?>
					<div class="row g-4">
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="col-lg-4">
								<?php get_template_part( 'template-parts/blocks/block', 'post' ); ?>
							</div>
						<?php endwhile; ?>
					</div>

					<nav class="mt-5">
						<?php the_posts_pagination( [
							'mid_size'  => 2,
							'prev_text' => __( '&laquo; Vorige', 'creators' ),
							'next_text' => __( 'Volgende &raquo;', 'creators' ),
						] ); ?>
					</nav>
				<?php else : ?>
					<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
						<div class="input-group">
							<input type="search" class="form-control" placeholder="<?php _e( 'Probeer een andere zoekopdracht...', 'creators' ); ?>" name="s" value="<?php echo get_search_query(); ?>">
							<button type="submit" class="btn btn-primary"><?php _e( 'Zoeken', 'creators' ); ?></button>
						</div>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

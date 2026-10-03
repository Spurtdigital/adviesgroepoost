<?php get_header(); ?>

<?php get_template_part( 'template-parts/headers/header', 'page', [
	'title' => __( 'Pagina niet gevonden', 'creators' ),
	'intro' => __( 'Sorry, we kunnen deze pagina niet meer vinden. Het lijkt erop dat deze pagina niet (meer) bestaat of misschien verhuisd is.', 'creators' ),
	'buttons' => [],
] ); ?>

<section class="py-lg-8 py-4">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-9">
				<h2 class="h4 mb-3"><?php _e( 'Wat kun je doen?', 'creators' ); ?></h2>
				<ul class="mb-4">
					<li><?php echo sprintf( __( 'Ga terug naar de <a href="%s">homepage</a>', 'creators' ), home_url() ); ?></li>
					<li><?php _e( 'Gebruik de zoekfunctie om te vinden wat je zoekt', 'creators' ); ?></li>
				</ul>
				<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
					<div class="input-group">
						<input type="search" class="form-control" placeholder="<?php _e( 'Zoeken...', 'creators' ); ?>" name="s" value="">
						<button type="submit" class="btn btn-primary"><?php _e( 'Zoeken', 'creators' ); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

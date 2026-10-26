<?php /*Template Name: Page - Oplossingen */ get_header();?>


<?php get_template_part( 'template-parts/headers/header','page' ); ?>

<section class="home-intro border-radius-top pt-5">
	<div class="container">
		<?php
		$services_archive   = get_post_type_archive_link( 'diensten' );
		$services_selection = get_field( 'oplossingen_diensten' );
		$services_args      = [
			'post_type'      => 'dienst',
			'post_status'    => 'publish',
			'post_parent'    => 0,
			'posts_per_page' => -1,
			'orderby'        => [
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			],
		];

		if ( ! empty( $services_selection ) ) {
			$services_ids = array_filter( array_map( 'absint', wp_list_pluck( $services_selection, 'ID' ) ) );

			if ( ! empty( $services_ids ) ) {
				// Handmatige selectie overschrijft de automatische query, inclusief volgorde.
				unset( $services_args['post_parent'] );
				$services_args['post__in'] = $services_ids;
				$services_args['orderby']  = 'post__in';
			}
		}

		$services_query = new WP_Query( $services_args );
		?>
		<div class="d-flex align-items-center justify-content-between mb-lg-3 mb-2">
            <h2 class="display-4 fw-bold "><?php echo esc_html( get_field( 'oplossingen_services_title' ) ?: __( 'Waar kunnen we je mee helpen?', 'creators' ) ); ?></h2>
			<?php if ( $services_archive ) : ?>
				<a href="<?php echo esc_url( $services_archive ); ?>"><?php esc_html_e( 'Bekijk alle diensten', 'creators' ); ?></a>
			<?php endif; ?>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
				<?php if ( $services_query->have_posts() ) : ?>
					<?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
						<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12 mb-4">
								<?php get_template_part( 'template-parts/blocks/block', 'dienst' ); ?>
							</div>
							<?php endwhile; ?>
						<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>


<?php get_footer();?>
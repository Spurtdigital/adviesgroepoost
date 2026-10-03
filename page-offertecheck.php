<?php /* Template Name: Page - Offertecheck */
get_header();
?>

<?php
$header_variant = is_singular( 'dienst' ) ? 'dienst' : 'dienst';
get_template_part( 'template-parts/headers/header', $header_variant );

$child_pages = get_pages(
	[
		'child_of'    => get_queried_object_id(),
		'sort_column' => 'menu_order',
		'sort_order'  => 'ASC',
	]
);
?>

<section class="advice-page advice-page--offertecheck py-5">
	<div class="container">
		<div class="row gy-4 justify-content-center">
			<div class="col-xxl-9 col-xl-7 col-lg-7">
				<?php if ( get_field( 'advice_introductie' ) ) : ?>
					<div class="advice-page__intro">
						<?php echo wp_kses_post( get_field( 'advice_introductie' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="bg-light p-lg-3 p-2 advice-page__form-block">
					<h3 class="display-5 mb-2 fw-bold "><?php echo esc_html( get_field( 'offer_form_titel' ) ?: __( 'Gratis offertecheck aanvragen', 'creators' ) ); ?></h3>
					<?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( get_field( 'advice_form_id' ) ?: 'b21e386' ) . '" title="Offerte vergelijker"]' ); ?>

					<?php
					$offer_usp_1      = get_field( 'offer_form_usp_1' ) ?: __( 'Binnen 24 uur reactie', 'creators' );
					$offer_usp_2      = get_field( 'offer_form_usp_2' ) ?: __( 'Gratis advies op afstand', 'creators' );
					$offer_usp_3_voor = get_field( 'offer_form_usp_3_voor' ) ?: 'Meer dan ';
					$offer_usp_3_na   = get_field( 'offer_form_usp_3_na' ) ?: __( ' offertes vergeleken', 'creators' );
					?>
					<ul class="d-flex flex-wrap gap-lg-3 gap-1 reset-list mt-4 mt-lg-1 justify-content-center advice-page__form-usps">
						<li><i class="fa-sharp fa-solid fa-circle-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $offer_usp_1 ); ?></li>
						<li><i class="fa-sharp fa-solid fa-circle-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $offer_usp_2 ); ?></li>
						<li><i class="fa-sharp fa-solid fa-circle-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $offer_usp_3_voor ); ?><strong class="value" data-target="8243">0</strong><?php echo esc_html( $offer_usp_3_na ); ?></li>
					</ul>
				</div>

				<?php if ( get_field( 'tekst_onder_het_formulier' ) ) : ?>
					<div class="mt-3 small-content">
						<?php echo wp_kses_post( get_field( 'tekst_onder_het_formulier' ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $child_pages ) ) : ?>
					<section class="mt-5">
						<h3 class="display-4 mb-2 mb-lg-3"><?php echo esc_html( get_field( 'offer_children_titel' ) ?: __( 'Meer lezen over de offertecheck', 'creators' ) ); ?></h3>
						<div class="row gy-3">
							<?php foreach ( $child_pages as $child_page ) : ?>
								<div class="col-lg-3 col-md-6">
									<?php $featured_image_id = get_post_thumbnail_id( $child_page->ID ); ?>
									<div class="block-post position-relative h-100">
										<div class="block-post__media">
											<?php if ( $featured_image_id ) : ?>
												<?php
												echo wp_get_attachment_image( $featured_image_id, 'medium_large', false, [
													'class'   => 'img-abs-center',
													'loading' => 'lazy',
													'alt'     => get_the_title( $child_page->ID ),
												] );
												?>
											<?php endif; ?>
										</div>
										<div class="block-post__content">
											<h3 class="display-6"><?php echo esc_html( get_the_title( $child_page->ID ) ); ?></h3>
										</div>
										<a href="<?php echo esc_url( get_the_permalink( $child_page->ID ) ); ?>" class="stretched-link"></a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/layouts/layout', 'builder' ); ?>

<?php get_footer(); ?>

<?php
/**
 * Layout: Content Builder
 * 
 * Flexible content builder with multiple layout options
 * Each section supports background color and border radius options
 */


$builder_selector = 'contentbuilder';
$builder_post_id  = get_queried_object_id();

if ( ! $builder_post_id ) {
	$builder_post_id = get_the_ID();
}

if ( ! have_rows( $builder_selector, $builder_post_id ) && have_rows( 'field_648de36a2d1a9', $builder_post_id ) ) {
	$builder_selector = 'field_648de36a2d1a9';
}

if ( ! $builder_post_id || ! have_rows( $builder_selector, $builder_post_id ) ) {
	return;
}

/**
 * Helper function to build section classes
 */
if ( ! function_exists( 'get_builder_section_classes' ) ) {
	function get_builder_section_classes() {
		$classes = [];
		
		// Background color
		if ( get_sub_field( 'achtergrond_kleur' ) ) {
			$classes[] = 'bg-light';
		}
		
		// Border radius top
		if ( get_sub_field( 'border_radius_top' ) ) {
			$classes[] = 'border-radius-top';
		}
		
		// Border radius bottom
		if ( get_sub_field( 'border_radius_bottom' ) ) {
			$classes[] = 'border-radius-bottom';
		}
		
		return implode( ' ', $classes );
	}
}

/**
	 * Helper: globale builder breedte-instelling.
	 * Kleiner aan: tekst col-xl-8, media col-xl-10.
	 * Kleiner uit: tekst col-xl-10, media col-xl-11.
 */

if ( ! function_exists( 'get_builder_is_compact' ) ) {
	function get_builder_is_compact() {
		static $is_compact = null;

		if ( null !== $is_compact ) {
			return $is_compact;
		}

		$post_id = get_queried_object_id();

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$is_compact = (bool) get_field( 'builder_kleiner_weergeven', $post_id );

		return $is_compact;
	}
}

if ( ! function_exists( 'get_builder_text_col_class' ) ) {
	function get_builder_text_col_class() {
		return get_builder_is_compact() ? 'col-xl-7' : 'col-xl-10';
	}
}

if ( ! function_exists( 'get_builder_media_col_class' ) ) {
	function get_builder_media_col_class() {
		return get_builder_is_compact() ? 'col-xl-9' : 'col-xl-11';
	}
}

/**
 * Helper: render buttons - leest component_buttons (oud veld) direct als array
 */
if ( ! function_exists( 'render_builder_buttons' ) ) {
	function render_builder_buttons() {
		$buttons = get_sub_field( 'component_buttons' );
		if ( empty( $buttons ) || ! is_array( $buttons ) ) {
			return;
		}
		echo '<div class="btns">';
		foreach ( $buttons as $btn ) {
			$link  = $btn['button'] ?? null;
			$color = $btn['kleur'] ?? 'primary';
			if ( $link ) {
				get_template_part( 'template-parts/components/component', 'button', [
					'link'  => $link,
					'color' => $color,
				] );
			}
		}
		echo '</div>';
	}
}

if ( ! function_exists( 'get_builder_first_form_id' ) ) {
	function get_builder_first_form_id( $value ) {
		if ( empty( $value ) ) {
			return 0;
		}

		if ( is_numeric( $value ) ) {
			return (int) $value;
		}

		if ( is_array( $value ) ) {
			$first_item = reset( $value );

			if ( is_numeric( $first_item ) ) {
				return (int) $first_item;
			}

			if ( is_object( $first_item ) && isset( $first_item->ID ) ) {
				return (int) $first_item->ID;
			}

			if ( is_array( $first_item ) && isset( $first_item['ID'] ) ) {
				return (int) $first_item['ID'];
			}
		}

		if ( is_object( $value ) && isset( $value->ID ) ) {
			return (int) $value->ID;
		}

		if ( is_array( $value ) && isset( $value['ID'] ) ) {
			return (int) $value['ID'];
		}

		return 0;
	}
}

if ( ! function_exists( 'get_builder_fallback_media_image' ) ) {
	function get_builder_fallback_media_image() {
		static $fallback_images = null;

		if ( null === $fallback_images ) {
			$fallback_images = [];
			$rows = get_field( 'fall_back_media', 'options' );

			if ( is_array( $rows ) ) {
				foreach ( $rows as $row ) {
					$image = $row['afbeelding'] ?? null;
					if ( is_array( $image ) && ! empty( $image['url'] ) ) {
						$fallback_images[] = $image;
					}
				}
			}
		}

		if ( empty( $fallback_images ) ) {
			return null;
		}

		return $fallback_images[ wp_rand( 0, count( $fallback_images ) - 1 ) ];
	}
}
?>

<div class="content-builder">
	<?php while ( have_rows( $builder_selector, $builder_post_id ) ) : the_row(); ?>
		<?php $layout = get_row_layout(); ?>
		<?php $section_classes = get_builder_section_classes(); ?>
		
		<?php if ( 'layout01' === $layout ) : // Content ?>
			<section class="content-section content-section--text <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_text_col_class(); ?> <?php echo get_sub_field( 'introductie_tekst' ) ? 'lead' : ''; ?>">
							<?php echo wp_kses_post( get_sub_field( 'tekstvlak' ) ); ?>
							<?php render_builder_buttons(); ?>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout02' === $layout ) : // Split with text and image ?>
			<section class="content-section content-section--split <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<?php $split_image = get_sub_field( 'afbeelding' ) ?: get_builder_fallback_media_image(); ?>
							<div class="row gx-lg-5 gy-2 align-items-stretch">
								<div class="col-lg-6 py-lg-5 <?php echo get_sub_field( 'afbeelding_links' ) ? 'order-1 order-lg-2' : ''; ?>">
									<h2 class="display-4 fw-bold mb-2 mb-lg-4"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h2>
									<?php echo wp_kses_post( get_sub_field( 'tekstvlak' ) ); ?>
									
									<?php $posts = get_sub_field( 'links' ); ?>
									<?php if ( $posts ) : ?>
										<ul class="content-linklist">
											<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
												<li>
													<a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a>
												</li>
											<?php endforeach; wp_reset_postdata(); ?>
										</ul>
									<?php endif; ?>
									
								<?php render_builder_buttons(); ?>
								</div>
								<div class="col-lg-6 <?php echo get_sub_field( 'afbeelding_links' ) ? 'order-1 order-lg-1' : ''; ?> <?php echo get_sub_field( 'verberg_mobiel' ) ? 'd-none d-lg-block' : ''; ?>">
									<div class="content-split__media position-relative rounded-3 overflow-hidden <?php echo get_sub_field( 'contain_afbeelding_groter_weergeven' ) ? '--bigger' : ''; ?>">
										<?php if ( $split_image ) : ?>
											<img class="img-abs-center" loading="lazy" src="<?php echo esc_url( spurt_image( $split_image['url'], 720, 9999 ) ); ?>" alt="<?php echo esc_attr( $split_image['alt'] ?? '' ); ?>" <?php echo get_sub_field( 'afbeelding_contain' ) ? 'style="object-fit:contain"' : ''; ?>>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout03' === $layout ) : // FAQ ?>
			<section class="content-section content-section--faq <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_text_col_class(); ?>">
							<h2 class="display-2 mb-lg-4 mb-3"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h2>
							<?php echo wp_kses_post( get_sub_field( 'tekst' ) ); ?>
							
							<?php if ( have_rows( 'faq' ) ) : ?>
								<div class="faq-wrapper mt-lg-5 mt-4">
									<?php while ( have_rows( 'faq' ) ) : the_row(); ?>
										<div class="faq-item js-faq">
											<header class="faq-item__header js-faq-toggle">
												<span class="faq-item__title"><?php echo esc_html( get_sub_field( 'vraag' ) ); ?></span>
												<span class="faq-item__toggler"></span>
											</header>
											<main class="faq-item__content js-faq-content">
												<?php echo wp_kses_post( get_sub_field( 'antwoord' ) ); ?>
											</main>
										</div>
									<?php endwhile; ?>
								</div>
								
								<?php
								$faq_items = get_sub_field( 'faq' );
								if ( is_array( $faq_items ) && ! empty( $faq_items ) ) :
									$faq_schema_entities = [];
									foreach ( $faq_items as $faq_item ) {
										$question = isset( $faq_item['vraag'] ) ? wp_strip_all_tags( $faq_item['vraag'] ) : '';
										$answer   = isset( $faq_item['antwoord'] ) ? wp_strip_all_tags( $faq_item['antwoord'] ) : '';
										
										if ( '' === $question || '' === $answer ) {
											continue;
										}
										
										$faq_schema_entities[] = [
											'@type'           => 'Question',
											'name'            => $question,
											'acceptedAnswer'  => [
												'@type' => 'Answer',
												'text'  => $answer,
											],
										];
									}
									
									if ( ! empty( $faq_schema_entities ) ) :
										$faq_schema = [
											'@context'   => 'https://schema.org',
											'@type'      => 'FAQPage',
											'mainEntity' => $faq_schema_entities,
										];
										?>
										<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
									<?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout04' === $layout ) : // CTA ?>
			<?php
			$use_manual = get_sub_field( 'handmatige_vulling' );
			$cta_title  = '';
			$cta_text   = '';
			$cta_manual_buttons = null;

			if ( $use_manual ) {
				$cta_title = (string) get_sub_field( 'cta_titel' );
				$cta_text  = (string) get_sub_field( 'cta_tekst' );
				$cta_manual_buttons = get_sub_field( 'component_buttons' );
			} else {
				// De CTA komt altijd uit de globale CTA-opties.
				$cta_title = (string) get_field( 'cta_global_titel', 'options' );
				$cta_text  = (string) get_field( 'cta_global_tekst', 'options' );
			}

			$cta_global_buttons_rows = [];

			if ( is_array( get_field( 'cta_global_buttons', 'options' ) ) ) {
				foreach ( get_field( 'cta_global_buttons', 'options' ) as $cta_global_btn ) {
					$cta_global_btn_link = $cta_global_btn['link'] ?? null;

					if ( is_array( $cta_global_btn_link ) && ! empty( $cta_global_btn_link['url'] ) && ! empty( $cta_global_btn_link['title'] ) ) {
						$cta_global_buttons_rows[] = [
							'link'  => $cta_global_btn_link,
							'color' => $cta_global_btn['color'] ?? 'primary',
						];
					}
				}
			}

			$cta_image = get_field( 'cta_global_afbeelding', 'options' );
			$cta_render = (bool) ( $cta_title || $cta_text || ! empty( $cta_manual_buttons ) || ! empty( $cta_global_buttons_rows ) );

			if ( $cta_render ) :
			?>
			<section class="content-section content-section--cta <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<div class="content-cta">
								<div class="content-cta__content position-relative z-3">
									<?php if ( $cta_title ) : ?>
										<h3 class="display-3 fw-bold text-white"><?php echo creators_markdown_inline( $cta_title ); ?></h3>
									<?php endif; ?>
									<?php if ( $cta_text ) : ?>
										<p class="my-3"><?php echo wp_kses_post( $cta_text ); ?></p>
									<?php endif; ?>
									<?php if ( ! empty( $cta_manual_buttons ) ) : ?>
										<?php render_builder_buttons(); ?>
									<?php elseif ( ! empty( $cta_global_buttons_rows ) ) : ?>
										<?php spurt_add_btns( $cta_global_buttons_rows ); ?>
									<?php endif; ?>
								</div>
								<div class="content-cta__media">
									<?php if ( is_array( $cta_image ) && ! empty( $cta_image['ID'] ) ) : ?>
										<?php echo wp_get_attachment_image( $cta_image['ID'], 'medium', false, [ 'alt' => esc_attr( $cta_image['alt'] ?? '' ) ] ); ?>
									<?php elseif ( is_string( $cta_image ) && ! empty( $cta_image ) ) : ?>
										<img loading="lazy" src="<?php echo esc_url( $cta_image ); ?>" alt="">
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>

		<?php elseif ( 'layout05' === $layout ) : // Form ?>
			<section class="content-section content-section--form <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_text_col_class(); ?>">
							<?php
							$form_title = get_sub_field( 'titel' );
							$form_text  = get_sub_field( 'tekst' );
							$form       = get_builder_first_form_id( get_sub_field( 'formulier' ) );

							if ( ! $form ) {
								$form = get_builder_first_form_id( get_sub_field( 'cf7_form' ) );
							}

							if ( $form_title ) :
								?>
								<h3 class="display-4 fw-bold mb-lg-3 mb-2"><?php echo esc_html( $form_title ); ?></h3>
							<?php endif; ?>

							<?php if ( $form_text ) : ?>
								<p class="mb-lg-4 mb-3"><?php echo esc_html( $form_text ); ?></p>
							<?php endif; ?>

							<?php
							if ( $form ) :
								echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form ) . '"]' );
							endif;
							?>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout06' === $layout ) : // Image ?>
			<section class="content-section content-section--image <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<?php $single_image = get_sub_field( 'afbeelding' ) ?: get_builder_fallback_media_image(); ?>
							<div class="content-media position-relative rounded-4 overflow-hidden">
								<?php if ( $single_image ) : ?>
									<img class="img-abs-center" loading="lazy" src="<?php echo esc_url( $single_image['url'] ); ?>" alt="<?php echo esc_attr( $single_image['alt'] ?? '' ); ?>">
								<?php endif; ?>
								
								<?php if ( get_sub_field( 'video_link' ) ) : ?>
									<a href="<?php echo esc_url( get_sub_field( 'video_link' ) ); ?>" class="stretched-link" data-fancybox></a>
									<i class="fa-solid fa-play"></i>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout07' === $layout ) : // Split with USPs ?>
			<section class="content-section content-section--split-usps <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<?php $split_usps_image = get_sub_field( 'afbeelding' ) ?: get_builder_fallback_media_image(); ?>
							<div class="row gx-lg-5 gy-2 align-items-stretch">
								<div class="col-lg-6 py-lg-4 <?php echo get_sub_field( 'afbeelding_links' ) ? 'order-2 order-lg-2' : ''; ?>">
									<h2 class="display-4 fw-bold mb-2 mb-lg-4"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h2>
									<?php echo wp_kses_post( get_sub_field( 'tekstvlak' ) ); ?>
									
									<?php if ( have_rows( 'usps' ) ) : ?>
										<ul class="content-usps list-unstyled mt-lg-3 mt-2">
											<?php while ( have_rows( 'usps' ) ) : the_row(); ?>
												<li class="mb-2"><i class="fa-solid fa-check text-primary me-2"></i><?php echo esc_html( get_sub_field( 'usp' ) ); ?></li>
											<?php endwhile; ?>
										</ul>
									<?php endif; ?>
									
							<?php render_builder_buttons(); ?>
								</div>
								<div class="col-lg-6 <?php echo get_sub_field( 'afbeelding_links' ) ? 'order-1 order-lg-1' : ''; ?>">
									<div class="content-split__media">
										<?php if ( $split_usps_image ) : ?>
											<img loading="lazy" src="<?php echo esc_url( spurt_image( $split_usps_image['url'], 720, 9999 ) ); ?>" alt="<?php echo esc_attr( $split_usps_image['alt'] ?? '' ); ?>" <?php echo get_sub_field( 'afbeelding_contain' ) ? 'style="object-fit:contain"' : ''; ?>>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout08' === $layout ) : // Method ?>
			<section class="content-section content-section--method <?php echo esc_attr( $section_classes ); ?>">
				<?php get_template_part( 'template-parts/layouts/layout', 'method' ); ?>
			</section>

		<?php elseif ( 'layout09' === $layout ) : // Blocks ?>
			<section class="content-section content-section--blocks <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<h3 class="display-4 fw-bold mb-lg-5 mb-4"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h3>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<div class="row gy-2 gy-lg-3 row-cols-1 row-cols-md-2 row-cols-lg-3">
								<?php if ( have_rows( 'blokken' ) ) : ?>
									<?php while ( have_rows( 'blokken' ) ) : the_row(); ?>
										<div class="col">
											<div class="content-block h-100 text-center">
												<?php echo wp_kses_post( get_sub_field( 'icoon' ) ); ?>
												<strong class="d-block mt-2 mb-1"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></strong>
												<p class="mb-0"><?php echo esc_html( get_sub_field( 'tekst' ) ); ?></p>
											</div>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout10' === $layout ) : // Notification ?>
			<section class="content-section content-section--notification <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_text_col_class(); ?>">
							<div class="bg-light p-lg-4 p-3">
								<?php echo wp_kses_post( get_sub_field( 'notificatie' ) ); ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout11' === $layout ) : // Notification with Title ?>
			<section class="content-section content-section--notification <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_text_col_class(); ?>">
							<div class="bg-light p-lg-4 p-3">
								<h3 class="display-4 fw-bold mb-lg-3 mb-2"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h3>
								
								<?php $posts = get_sub_field( 'links' ); ?>
								<?php if ( $posts ) : ?>
									<ul class="content-link-block list-unstyled">
										<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
											<li class="mb-2">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</li>
										<?php endforeach; wp_reset_postdata(); ?>
									</ul>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout12' === $layout ) : // Related Posts ?>
			<?php $related_block_class = get_sub_field( 'afbeelding_contain' ) ? 'alt' : ''; ?>
			<section class="content-section content-section--related <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<h3 class="display-4 fw-bold mb-lg-4 mb-3"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h3>
							<?php echo wp_kses_post( get_sub_field( 'tekstvlak' ) ); ?>
							<div class="row gy-lg-4 gy-3 mt-2">
								<?php $posts = get_sub_field( 'relations' ); ?>
								<?php if ( $posts ) : ?>
									<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
										<div class="col-lg-3 col-md-4 col-sm-6">
											<?php get_template_part( 'template-parts/blocks/block', 'post', [ 'class' => $related_block_class ] ); ?>
										</div>
									<?php endforeach; wp_reset_postdata(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout13' === $layout ) : // Table ?>
			<section class="content-section content-section--table <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<h3 class="display-4 fw-bold mb-lg-3 mb-2"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h3>
							<?php echo wp_kses_post( get_sub_field( 'tekst' ) ); ?>
							
							<?php
							$table = get_sub_field( 'tabel' );
							if ( ! empty( $table ) ) :
								?>
								<div class="table-responsive mt-lg-4 mt-3">
									<table class="table table-striped">
										<?php if ( ! empty( $table['caption'] ) ) : ?>
											<caption><?php echo esc_html( $table['caption'] ); ?></caption>
										<?php endif; ?>
										
										<?php if ( ! empty( $table['header'] ) ) : ?>
											<thead class="table-dark">
												<tr>
													<?php foreach ( $table['header'] as $th ) : ?>
														<th><?php echo wp_kses_post( $th['c'] ); ?></th>
													<?php endforeach; ?>
												</tr>
											</thead>
										<?php endif; ?>
										
										<?php if ( ! empty( $table['body'] ) ) : ?>
											<tbody>
												<?php foreach ( $table['body'] as $tr ) : ?>
													<tr>
														<?php foreach ( $tr as $td ) : ?>
															<td><?php echo wp_kses_post( $td['c'] ); ?></td>
														<?php endforeach; ?>
													</tr>
												<?php endforeach; ?>
											</tbody>
										<?php endif; ?>
									</table>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout14' === $layout ) : // Advisors ?>
			<section class="content-section content-section--advisors <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<h3 class="display-4 fw-bold mb-lg-4 mb-3"><?php echo esc_html( get_sub_field( 'adviseurs_titel' ) ); ?></h3>
							<?php echo wp_kses_post( get_sub_field( 'tekst' ) ); ?>
							
							<div class="row gy-lg-4 gy-3 mt-2">
								<?php if ( have_rows( 'adviseurs', 'options' ) ) : ?>
									<?php while ( have_rows( 'adviseurs', 'options' ) ) : the_row(); ?>
										<div class="col-lg-4 col-sm-6">
											<div class="block-adviseur">
												<div class="block-adviseur__media --contain mb-2">
													<?php if ( get_sub_field( 'afbeelding' ) ) : ?>
														<img loading="lazy" src="<?php echo esc_url( get_sub_field( 'afbeelding' )['url'] ); ?>" alt="<?php echo esc_attr( get_sub_field( 'voornaam' ) . ' ' . get_sub_field( 'achternaam' ) ); ?>">
													<?php endif; ?>
												</div>
												<div class="block-adviseur__content">
													<strong><?php echo esc_html( get_sub_field( 'voornaam' ) . ' ' . get_sub_field( 'achternaam' ) ); ?></strong>
												</div>
											</div>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout15' === $layout ) : // Authors ?>
			<section class="content-section content-section--author <?php echo esc_attr( $section_classes ); ?>">
				<?php get_template_part( 'template-parts/components/component', 'author' ); ?>
			</section>

		<?php elseif ( 'layout16' === $layout ) : // Global CTA ?>
			<?php
			$cta16_title   = get_field( 'cta_global_titel', 'options' );
			$cta16_text    = get_field( 'cta_global_tekst', 'options' );
			$cta16_buttons = [];

			if ( is_array( get_field( 'cta_global_buttons', 'options' ) ) ) {
				foreach ( get_field( 'cta_global_buttons', 'options' ) as $cta16_row ) {
					$cta16_link = $cta16_row['link'] ?? null;

					if ( is_array( $cta16_link ) && ! empty( $cta16_link['url'] ) && ! empty( $cta16_link['title'] ) ) {
						$cta16_buttons[] = [
							'link'  => $cta16_link,
							'color' => $cta16_row['color'] ?? 'primary',
						];
					}
				}
			}

			if ( $cta16_title || $cta16_text || ! empty( $cta16_buttons ) ) :
			?>
			<section class="content-section content-section--cta-global <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<div class="bg-light p-lg-4 p-3">
								<?php if ( $cta16_title ) : ?>
									<h3 class="display-4 fw-bold mb-lg-2 mb-1"><?php echo creators_markdown_inline( $cta16_title ); ?></h3>
								<?php endif; ?>
								<?php if ( $cta16_text ) : ?>
									<p><?php echo wp_kses_post( $cta16_text ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $cta16_buttons ) ) : ?>
									<?php spurt_add_btns( $cta16_buttons ); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>

		<?php elseif ( 'layout17' === $layout ) : // Price Table ?>
			<section class="content-section content-section--pricing <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<div class="table-responsive">
								<table class="price-table table">
									<tbody>
										<?php if ( have_rows( 'header' ) ) : ?>
											<tr>
												<td class="fw-bold"></td>
												<?php while ( have_rows( 'header' ) ) : the_row(); ?>
													<td>
														<small class="d-block text-muted"><?php echo esc_html( get_sub_field( 'ondertitel' ) ); ?></small>
														<strong class="display-4"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></strong>
													</td>
												<?php endwhile; ?>
											</tr>
											<tr class="price-table-head">
												<td></td>
												<?php while ( have_rows( 'header' ) ) : the_row(); ?>
													<?php if ( get_sub_field( 'prijs' ) ) : ?>
														<td class="price">
															<span class="h3 fw-bold">€<?php echo esc_html( get_sub_field( 'prijs' ) ); ?></span>
															<small class="d-block text-muted"><?php echo esc_html( get_sub_field( 'prijs_voorvoegsel' ) ); ?></small>
														</td>
													<?php endif; ?>
												<?php endwhile; ?>
											</tr>
										<?php endif; ?>
										
										<?php
										$table = get_sub_field( 'tabel' );
										if ( ! empty( $table['body'] ) ) :
											foreach ( $table['body'] as $tr ) :
												echo '<tr>';
												foreach ( $tr as $td ) :
													echo '<td>' . wp_kses_post( $td['c'] ) . '</td>';
												endforeach;
												echo '</tr>';
											endforeach;
										endif;
										?>
										
										<?php if ( have_rows( 'header' ) ) : ?>
											<tr>
												<td></td>
												<?php while ( have_rows( 'header' ) ) : the_row(); ?>
													<?php if ( get_sub_field( 'prijs' ) ) : ?>
														<td class="price">
															<?php if ( get_sub_field( 'link' ) ) : ?>
																<a class="btn btn-primary w-100" href="<?php echo esc_url( get_sub_field( 'link' )['url'] ); ?>"><?php echo esc_html( get_sub_field( 'link' )['title'] ); ?></a>
															<?php endif; ?>
														</td>
													<?php endif; ?>
												<?php endwhile; ?>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout18' === $layout ) : // Service Blocks ?>
			<section class="content-section content-section--services <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_text_col_class(); ?>">
							<h2 class="display-4 fw-bold mb-lg-3 mb-2"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h2>
							<div class="content-container mb-lg-4 mb-3">
								<?php echo wp_kses_post( get_sub_field( 'tekstvlak' ) ); ?>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<div class="row g-2 align-items-stretch">
								<?php if ( have_rows( 'blokken' ) ) : ?>
									<?php while ( have_rows( 'blokken' ) ) : the_row(); ?>
										<div class="col-lg-3 col-md-6">
											<div class="block-service h-100">
												<div class="block-service__media">
													<?php if ( get_sub_field( 'afbeelding' ) ) : ?>
														<img loading="lazy" src="<?php echo esc_url( get_sub_field( 'afbeelding' )['url'] ); ?>" alt="<?php echo esc_attr( get_sub_field( 'afbeelding' )['alt'] ); ?>">
													<?php endif; ?>
												</div>
												<div class="block-service__content h-100">
													<?php if ( get_sub_field( 'titel' ) ) : ?>
														<strong class="d-block mb-2"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></strong>
													<?php endif; ?>
													
													<?php $posts = get_sub_field( 'links' ); ?>
													<?php if ( $posts ) : ?>
														<ul class="reset-list">
															<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
																<li class="mb-1">
																	<a href="<?php the_permalink(); ?>"><i class="fa-sharp fa-light fa-angle-right me-1"></i><?php the_title(); ?></a>
																</li>
															<?php endforeach; wp_reset_postdata(); ?>
														</ul>
													<?php endif; ?>
												</div>
											</div>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php elseif ( 'layout19' === $layout ) : // Window Frames ?>
			<section class="content-section content-section--windows <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_media_col_class(); ?>">
							<h4 class="display-4 mb-lg-4 mb-3"><?php echo esc_html( get_sub_field( 'kozijn_titel' ) ); ?></h4>
							
							<?php $posts = get_sub_field( 'kozijnen_mogelijkheden' ); ?>
							<?php if ( $posts ) : ?>
								<div class="row g-lg-3 g-2 row-cols-lg-4 row-cols-md-2 row-cols-1">
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
			</section>

		<?php elseif ( 'layout20' === $layout ) : // Oplossingen / Diensten ?>
			<section class="content-section content-section--services <?php echo esc_attr( $section_classes ); ?>">
				<div class="container">
					<div class="row justify-content-center">
						<div class="<?php echo get_builder_text_col_class(); ?>">
							<?php if ( get_sub_field( 'titel' ) ) : ?>
								<h2 class="display-4 fw-bold mb-lg-3 mb-2"><?php echo esc_html( get_sub_field( 'titel' ) ); ?></h2>
							<?php endif; ?>

							<?php if ( get_sub_field( 'tekstvlak' ) ) : ?>
								<div class="content-container mb-lg-4 mb-3">
									<?php echo wp_kses_post( get_sub_field( 'tekstvlak' ) ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<div class="row">
					<div class="col-12">
							<div class="row gy-4">
								<?php
								$opl_diensten = get_sub_field( 'diensten' );
								$opl_args     = [
									'post_type'      => 'dienst',
									'posts_per_page' => -1,
									'post_status'    => 'publish',
									'orderby'        => 'menu_order date',
									'order'          => 'ASC',
									'post_parent'    => 0,
								];

								if ( ! empty( $opl_diensten ) ) {
									$opl_diensten_ids = array_filter( array_map( 'absint', wp_list_pluck( $opl_diensten, 'ID' ) ) );

									if ( ! empty( $opl_diensten_ids ) ) {
										$opl_args['post__in']    = $opl_diensten_ids;
										$opl_args['orderby']     = 'post__in';
										$opl_args['post_parent'] = null;
									}
								}

								$opl_diensten_query = new WP_Query( $opl_args );

								if ( $opl_diensten_query->have_posts() ) {
									while ( $opl_diensten_query->have_posts() ) : $opl_diensten_query->the_post();
										?>
										<div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
											<?php get_template_part( 'template-parts/blocks/block', 'dienst' ); ?>
										</div>
										<?php
									endwhile;
								}

								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
	<?php endwhile; ?>
</div>

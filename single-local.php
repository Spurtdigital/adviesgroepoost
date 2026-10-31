<?php
get_header();

$local_header_title = get_the_title();
$local_header_text  = get_field( 'local_header_tekst', 'options' ) ?: 'Onze specialist kijkt met je mee, geeft helder advies en een passend plan voor je woning.';
$local_header_cta   = get_field( 'local_header_cta_titel', 'options' ) ?: 'Toch liever direct contact?';

$local_header_link = creators_link_field(
	get_field( 'local_header_button', 'options' ),
	home_url( '/adviesgesprek/' ),
	'Adviesgesprek aanvragen'
);

$local_header_people = get_field( 'adviseurs', 'options' );

if ( ! is_array( $local_header_people ) || empty( $local_header_people ) ) {
	$local_header_people = get_field( 'medewerkers', 'options' );
}

$local_header_person = null;

if ( is_array( $local_header_people ) ) {
	foreach ( $local_header_people as $candidate ) {
		$candidate_image = $candidate['afbeelding_met_achtergrond'] ?? ( $candidate['afbeelding'] ?? null );

		if ( is_array( $candidate_image ) && ! empty( $candidate_image['url'] ) ) {
			$local_header_person = $candidate;
			break;
		}
	}
}

$local_header_person_image = null;
$local_header_person_name  = '';

if ( is_array( $local_header_person ) ) {
	$local_header_person_image = $local_header_person['afbeelding_met_achtergrond'] ?? ( $local_header_person['afbeelding'] ?? null );
	$local_header_person_name  = trim( ( $local_header_person['voornaam'] ?? '' ) . ' ' . ( $local_header_person['achternaam'] ?? '' ) );
}

$local_header_usps = get_field( 'global_cta_usps', 'options' );

if ( ! is_array( $local_header_usps ) || empty( $local_header_usps ) ) {
	$local_header_usps = get_field( 'header_usps', 'options' );
}
?>

<section class="product-hero py-lg-8 py-4 bg-light border-radius-bottom">
	<div class="container">
		<div class="row align-items-center gx-xl-10">
			<div class="col-lg-7">
				<?php get_template_part( 'template-parts/components/component', 'breadcrumb' ); ?>
				<h1 class="display-1 fw-bold mb-2"><?php echo esc_html( $local_header_title ); ?></h1>
				<div class="content-container mb-2">
					<p><?php echo esc_html( $local_header_text ); ?></p>
				</div>
			</div>

			<div class="col-lg-5">
				<div class="product-hero-cta bg-white rounded-3">
					<div class="display-4 fw-bold"><?php echo esc_html( $local_header_cta ); ?></div>
					<?php
					$local_person_prefix = get_field( 'local_header_persoon_prefix', 'options' );
					$local_person_suffix = get_field( 'local_header_persoon_suffix', 'options' );
					?>
					<?php if ( $local_header_person_name ) : ?>
						<p class="mb-2 fw-bold"><?php echo esc_html( trim( implode( ' ', array_filter( [ $local_person_prefix, $local_header_person_name, $local_person_suffix ] ) ) ) ); ?></p>
					<?php endif; ?>

					<?php if ( is_array( $local_header_usps ) && ! empty( $local_header_usps ) ) : ?>
						<ul class="reset-list mt-2 mb-2">
							<?php foreach ( array_slice( $local_header_usps, 0, 2 ) as $local_header_usp ) : ?>
								<?php if ( ! empty( $local_header_usp['text'] ) ) : ?>
									<li><i class="fa-sharp fa-solid fa-circle-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $local_header_usp['text'] ); ?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php
					spurt_add_btns(
						[
							[
								'link'  => $local_header_link,
								'color' => 'success',
							],
						]
					);
					?>

					<?php if ( is_array( $local_header_person_image ) && ! empty( $local_header_person_image['url'] ) ) : ?>
						<img class="img-fluid" src="<?php echo esc_url( creators_resized_image_url( $local_header_person_image['url'] ?? '', 400 ) ); ?>" alt="<?php echo esc_attr( $local_header_person_name ); ?>" loading="lazy" decoding="async">
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php

$global_split_images = [
	get_field( 'local_seo_afbeelding_1', 'options' ),
	get_field( 'local_seo_afbeelding_2', 'options' ),
	get_field( 'local_seo_afbeelding_3', 'options' ),
	get_field( 'local_seo_afbeelding_4', 'options' ),
	get_field( 'local_seo_afbeelding_5', 'options' ),
	get_field( 'local_seo_afbeelding_6', 'options' ),
	get_field( 'local_seo_afbeelding_7', 'options' ),
	get_field( 'local_seo_afbeelding_8', 'options' ),
];

$fallback_global_image = get_field( 'fixedcta_afbeelding', 'options' );

if ( ! $fallback_global_image ) {
	$fallback_global_image = get_field( 'footer_top_image', 'options' );
}

$render_local_cta = function() {
	$cta_title   = get_field( 'cta_global_titel', 'options' );
	$cta_text    = get_field( 'cta_global_tekst', 'options' );
	$cta_image   = get_field( 'cta_global_afbeelding', 'options' );
	$cta_buttons = [];

	if ( is_array( get_field( 'cta_global_buttons', 'options' ) ) ) {
		foreach ( get_field( 'cta_global_buttons', 'options' ) as $cta_global_item ) {
			$cta_global_item_link = $cta_global_item['link'] ?? null;

			if ( is_array( $cta_global_item_link ) && ! empty( $cta_global_item_link['url'] ) && ! empty( $cta_global_item_link['title'] ) ) {
				$cta_buttons[] = [
					'link'  => $cta_global_item_link,
					'color' => $cta_global_item['color'] ?? 'outline-light',
				];
			}
		}
	}

	$cta_image_url = '';

	if ( is_array( $cta_image ) ) {
		$cta_image_url = $cta_image['url'] ?? '';
	} elseif ( is_string( $cta_image ) ) {
		$cta_image_url = $cta_image;
	}

	if ( ! $cta_title && ! $cta_text && empty( $cta_buttons ) ) {
		return;
	}
	?>
	<section class="content-section content-section--cta my-lg-10 my-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 col-lg-10">
					<div class="content-cta">
						<div class="content-cta__content">
							<?php if ( $cta_title ) : ?>
								<h3 class="display-3 fw-bold text-white"><?php echo creators_markdown_inline( $cta_title ); ?></h3>
							<?php endif; ?>

							<?php if ( $cta_text ) : ?>
								<p class="my-3"><?php echo wp_kses_post( $cta_text ); ?></p>
							<?php endif; ?>

							<?php
							if ( ! empty( $cta_buttons ) ) {
								spurt_add_btns( $cta_buttons );
							}
							?>
						</div>

						<div class="content-cta__media">
							<?php if ( $cta_image_url ) : ?>
								<img loading="lazy" decoding="async" src="<?php echo esc_url( creators_resized_image_url( $cta_image_url, 720 ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
};

$render_local_split = function( $split_index, $split_fields ) use ( $global_split_images, $fallback_global_image, $local_header_link ) {
	$has_title = ! empty( $split_fields['title'] );
	$has_text  = ! empty( $split_fields['text'] );
	$split_number = $split_index + 1;
	$split_button_link = is_array( $split_fields['button'] ?? null ) ? $split_fields['button'] : [];
	$force_image_left = in_array( $split_number, [ 1, 3, 5, 7 ], true );
	$split_section_classes = 'content-section content-section--split';

	if ( in_array( $split_number, [ 3, 4, 5 ], true ) ) {
		$split_section_classes .= ' bg-light border-radius-fill--light border-radius-bg--white mb-0';
		if ( 3 === $split_number ) {
			$split_section_classes .= ' border-radius-top mb-0';
		}
		if ( 5 === $split_number ) {
			$split_section_classes .= ' border-radius-bottom mb-0';
		}
	} else {
		$split_section_classes .= ' py-lg-4 py-2';
	}

	if ( in_array( $split_number, [ 1, 4 ], true ) && ( empty( $split_button_link['url'] ) || empty( $split_button_link['title'] ) ) ) {
		$split_button_link = $local_header_link;
	}

	if ( ! $has_title && ! $has_text ) {
		return;
	}

	$split_image = $global_split_images[ $split_index ] ?? null;

	if ( ! $split_image ) {
		$split_image = $fallback_global_image;
	}

	$split_image_url = '';
	$split_image_alt = $has_title ? $split_fields['title'] : get_the_title();

	if ( is_array( $split_image ) ) {
		$split_image_url = $split_image['url'] ?? '';
		if ( ! empty( $split_image['alt'] ) ) {
			$split_image_alt = $split_image['alt'];
		}
	} elseif ( is_string( $split_image ) ) {
		$split_image_url = $split_image;
	}
	?>
	<section class="<?php echo esc_attr( $split_section_classes ); ?>">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 col-lg-10">
					<div class="row gx-lg-5 gy-2 align-items-stretch">
						<div class="col-lg-6 py-lg-5 <?php echo $force_image_left ? 'order-2 order-lg-2' : ''; ?>">
							<?php if ( $has_title ) : ?>
								<h2 class="display-4 fw-bold mb-2 mb-lg-4"><?php echo esc_html( $split_fields['title'] ); ?></h2>
							<?php endif; ?>

							<?php if ( $has_text ) : ?>
								<?php echo wp_kses_post( $split_fields['text'] ); ?>
							<?php endif; ?>

							<?php if ( ! empty( $split_button_link['url'] ) && ! empty( $split_button_link['title'] ) ) : ?>
								<?php
								spurt_add_btns(
									[
										[
											'link'  => $split_button_link,
											'color' => 'success',
										],
									]
								);
								?>
							<?php endif; ?>
						</div>

						<div class="col-lg-6 <?php echo $force_image_left ? 'order-1 order-lg-1' : ''; ?> <?php echo ! empty( $split_fields['hide_mobile'] ) ? 'd-none d-lg-block' : ''; ?>">
							<div class="content-split__media position-relative rounded-3 overflow-hidden <?php echo ! empty( $split_fields['bigger'] ) ? '--bigger' : ''; ?>">
								<?php if ( $split_image_url ) : ?>
									<img class="img-abs-center" loading="lazy" src="<?php echo esc_url( spurt_image( $split_image_url, 720, 9999 ) ); ?>" alt="<?php echo esc_attr( $split_image_alt ); ?>" <?php echo ! empty( $split_fields['contain'] ) ? 'style="object-fit:contain"' : ''; ?>>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
};
?>

<?php if ( get_field( 'introductie' ) ) : ?>
	<section class="content-section content-section--text pt-lg-5 pt-3">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 col-lg-10">
					<?php echo wp_kses_post( get_field( 'introductie' ) ); ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
$splits = [
	[
		'title'       => get_field( 'local_split_1_titel' ),
		'text'        => get_field( 'local_split_1_tekst' ),
		'button'      => get_field( 'local_split_1_button' ),
		'image_left'  => get_field( 'local_split_1_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_1_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_1_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_1_contain_afbeelding_groter_weergeven' ),
	],
	[
		'title'       => get_field( 'local_split_2_titel' ),
		'text'        => get_field( 'local_split_2_tekst' ),
		'button'      => get_field( 'local_split_2_button' ),
		'image_left'  => get_field( 'local_split_2_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_2_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_2_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_2_contain_afbeelding_groter_weergeven' ),
	],
	[
		'title'       => get_field( 'local_split_3_titel' ),
		'text'        => get_field( 'local_split_3_tekst' ),
		'button'      => get_field( 'local_split_3_button' ),
		'image_left'  => get_field( 'local_split_3_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_3_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_3_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_3_contain_afbeelding_groter_weergeven' ),
	],
	[
		'title'       => get_field( 'local_split_4_titel' ),
		'text'        => get_field( 'local_split_4_tekst' ),
		'button'      => get_field( 'local_split_4_button' ),
		'image_left'  => get_field( 'local_split_4_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_4_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_4_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_4_contain_afbeelding_groter_weergeven' ),
	],
	[
		'title'       => get_field( 'local_split_5_titel' ),
		'text'        => get_field( 'local_split_5_tekst' ),
		'button'      => get_field( 'local_split_5_button' ),
		'image_left'  => get_field( 'local_split_5_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_5_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_5_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_5_contain_afbeelding_groter_weergeven' ),
	],
	[
		'title'       => get_field( 'local_split_6_titel' ),
		'text'        => get_field( 'local_split_6_tekst' ),
		'button'      => get_field( 'local_split_6_button' ),
		'image_left'  => get_field( 'local_split_6_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_6_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_6_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_6_contain_afbeelding_groter_weergeven' ),
	],
	[
		'title'       => get_field( 'local_split_7_titel' ),
		'text'        => get_field( 'local_split_7_tekst' ),
		'button'      => get_field( 'local_split_7_button' ),
		'image_left'  => get_field( 'local_split_7_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_7_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_7_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_7_contain_afbeelding_groter_weergeven' ),
	],
	[
		'title'       => get_field( 'local_split_8_titel' ),
		'text'        => get_field( 'local_split_8_tekst' ),
		'button'      => get_field( 'local_split_8_button' ),
		'image_left'  => get_field( 'local_split_8_afbeelding_links' ),
		'hide_mobile' => get_field( 'local_split_8_verberg_mobiel' ),
		'contain'     => get_field( 'local_split_8_afbeelding_contain' ),
		'bigger'      => get_field( 'local_split_8_contain_afbeelding_groter_weergeven' ),
	],
];

$rendered_split_count = 0;

foreach ( $splits as $split_index => $split_fields ) {
	if ( empty( $split_fields['title'] ) && empty( $split_fields['text'] ) ) {
		continue;
	}

	$rendered_split_count++;
	$render_local_split( $split_index, $split_fields );

	if ( 2 === $rendered_split_count ) {
		$render_local_cta();
	}
}

$faq_title = get_field( 'local_faq_titel' );
$faq_text  = get_field( 'local_faq_tekst' );
$faq_items = get_field( 'local_faq_items' );

if ( $faq_title || $faq_text || ( is_array( $faq_items ) && ! empty( $faq_items ) ) ) :
	?>
	<section class="content-section content-section--faq py-lg-8 py-4">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 col-lg-10">
					<?php if ( $faq_title ) : ?>
						<h2 class="display-2 mb-lg-4 mb-3"><?php echo esc_html( $faq_title ); ?></h2>
					<?php endif; ?>

					<?php if ( $faq_text ) : ?>
						<?php echo wp_kses_post( $faq_text ); ?>
					<?php endif; ?>

					<?php if ( is_array( $faq_items ) && ! empty( $faq_items ) ) : ?>
						<?php $faq_schema_entities = []; ?>
						<div class="faq-wrapper mt-lg-5 mt-4">
							<?php foreach ( $faq_items as $faq_item ) : ?>
								<?php
								$question = $faq_item['vraag'] ?? '';
								$answer   = $faq_item['antwoord'] ?? '';

								$schema_question = wp_strip_all_tags( (string) $question );
								$schema_answer   = wp_strip_all_tags( (string) $answer );

								if ( '' !== $schema_question && '' !== $schema_answer ) {
									$faq_schema_entities[] = [
										'@type'          => 'Question',
										'name'           => $schema_question,
										'acceptedAnswer' => [
											'@type' => 'Answer',
											'text'  => $schema_answer,
										],
									];
								}
								?>
								<div class="faq-item js-faq">
									<header class="faq-item__header js-faq-toggle">
										<span class="faq-item__title"><?php echo esc_html( $question ); ?></span>
										<span class="faq-item__toggler"></span>
									</header>
									<main class="faq-item__content js-faq-content">
										<?php echo wp_kses_post( $answer ); ?>
									</main>
								</div>
							<?php endforeach; ?>
						</div>

						<?php if ( ! empty( $faq_schema_entities ) ) : ?>
							<?php
							$faq_schema = [
								'@context'   => 'https://schema.org',
								'@type'      => 'FAQPage',
								'mainEntity' => $faq_schema_entities,
							];
							?>
							<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

if ( $rendered_split_count > 0 && $rendered_split_count < 2 ) {
	$render_local_cta();
}

get_footer();
?>

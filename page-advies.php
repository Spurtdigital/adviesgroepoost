<?php /* Template Name: Page - Adviesgesprek */
get_header();
?>

<?php get_template_part( 'template-parts/headers/header', 'page' ); ?>

<?php
/**
 * Categorieën + subopties voor het adviesformulier.
 *
 * Gebaseerd op de 'dienst' CPT (in_formulier_tonen). Een dienst zonder
 * 'formulier_hoofdcategorie' is zelf een hoofdcategorie (stap 1, bijv.
 * "Isolatie"); een dienst mét die waarde wordt automatisch een suboptie
 * onder de bijbehorende hoofdcategorie (bijv. "Spouwmuurisolatie" onder
 * "Isolatie"). "Glas" en "Overig" bestaan altijd, ook zonder eigen
 * dienst-pagina, zodat er nooit een lege hoofdcategorie ontbreekt.
 */
$advice_parents  = [];
$advice_children = [];

$advice_services_query = new WP_Query(
	[
		'post_type'      => 'dienst',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	]
);

if ( $advice_services_query->have_posts() ) {
	while ( $advice_services_query->have_posts() ) {
		$advice_services_query->the_post();

		if ( ! get_field( 'in_formulier_tonen' ) ) {
			continue;
		}

		$advice_bucket_key = get_field( 'formulier_hoofdcategorie' );

		if ( $advice_bucket_key ) {
			// Deze dienst is een suboptie onder een andere hoofdcategorie.
			$advice_children[ $advice_bucket_key ][] = get_the_title();
			continue;
		}

		// Deze dienst is zelf een hoofdcategorie.
		$advice_own_variants = [];
		if ( have_rows( 'formulier_varianten' ) ) {
			while ( have_rows( 'formulier_varianten' ) ) {
				the_row();
				$advice_variant_naam = get_sub_field( 'naam' );
				if ( $advice_variant_naam ) {
					$advice_own_variants[] = $advice_variant_naam;
				}
			}
		}

		$advice_image = get_field( 'image' );
		$advice_key   = sanitize_title( get_the_title() );

		$advice_parents[ $advice_key ] = [
			'id'       => 'dienst-' . get_the_ID(),
			'label'    => get_the_title(),
			'icon_id'  => is_array( $advice_image ) ? ( $advice_image['ID'] ?? 0 ) : 0,
			'icon_url' => is_array( $advice_image ) ? ( $advice_image['sizes']['thumbnail'] ?? $advice_image['url'] ?? '' ) : '',
			'hint'     => get_field( 'formulier_hint' ),
			'featured' => (bool) get_field( 'formulier_uitgelicht' ),
			'variants' => $advice_own_variants,
		];
	}
	wp_reset_postdata();
}

// "Glas" en "Overig" bestaan altijd als vangnet, ook zonder eigen dienst-pagina.
if ( ! isset( $advice_parents['glas'] ) ) {
	$advice_parents['glas'] = [
		'id'       => 'glas',
		'label'    => 'Glas',
		'icon_id'  => 0,
		'icon_url' => '',
		'hint'     => '',
		'featured' => false,
		'variants' => [],
	];
}

if ( ! isset( $advice_parents['overig'] ) ) {
	$advice_parents['overig'] = [
		'id'       => 'overig',
		'label'    => 'Overig',
		'icon_id'  => 0,
		'icon_url' => '',
		'hint'     => '',
		'featured' => false,
		'variants' => [],
	];
}

// Subopties bij hun hoofdcategorie voegen (onbekende koppeling → Overig).
foreach ( $advice_children as $advice_bucket_key => $advice_labels ) {
	if ( ! isset( $advice_parents[ $advice_bucket_key ] ) ) {
		$advice_bucket_key = 'overig';
	}
	foreach ( $advice_labels as $advice_label ) {
		$advice_parents[ $advice_bucket_key ]['variants'][] = $advice_label;
	}
}

// "Weet ik nog niet" hoort altijd als laatste suboptie bij Overig.
$advice_parents['overig']['variants'][] = 'Weet ik nog niet';

// Totaaladvies (indien aanwezig) altijd als laatste optie.
$advice_categories = array_values( $advice_parents );
usort(
	$advice_categories,
	function ( $advice_a, $advice_b ) {
		$advice_rank = function ( $advice_cat ) {
			return 'totaaladvies' === sanitize_title( $advice_cat['label'] ) ? 1 : 0;
		};
		return $advice_rank( $advice_a ) <=> $advice_rank( $advice_b );
	}
);

// Adviseur voor de aside.
$advice_people = get_field( 'adviseurs', 'options' );
if ( ! is_array( $advice_people ) || empty( $advice_people ) ) {
	$advice_people = get_field( 'medewerkers', 'options' );
}
if ( is_array( $advice_people ) ) {
	$advice_people = array_values( array_filter( $advice_people, function ( $advice_p ) {
		return ! empty( $advice_p['afbeelding']['ID'] );
	} ) );
}
if ( is_array( $advice_people ) && ! empty( $advice_people ) ) {
	shuffle( $advice_people );
	$advice_person = $advice_people[0];
} else {
	$advice_person = null;
}

// Reviews voor de aside.
$advice_reviews = get_field( 'reviews', 'options' ) ?: [];
if ( count( $advice_reviews ) > 1 ) {
	shuffle( $advice_reviews );
}
$advice_reviews = array_slice( $advice_reviews, 0, 2 );

// Stappen voor "Hoe het gesprek verloopt" (zelfde databron als Werkwijze elders).
$advice_steps = get_field( 'stappen', 'options' ) ?: [];

$advice_whatsapp_link  = get_field( 'whatsapp_link', 'options' );
$advice_phone          = get_field( 'algemeen_telefoonnummer', 'options' );
$advice_mood_photo     = get_field( 'advies_adviseur_sfeerfoto', 'options' );
?>

<script>
	window.creatorsAdviceCategories = <?php echo wp_json_encode( $advice_categories ); ?>;
</script>

<section class="advice-page py-5">
	<div class="container">
		<div class="row gy-4">

			<div class="col-xl-8 col-lg-7">
				<?php if ( get_field( 'advice_introductie' ) ) : ?>
					<div class="advice-page__intro content-container">
						<?php echo wp_kses_post( get_field( 'advice_introductie' ) ); ?>
					</div>
				<?php endif; ?>

				<div id="form" class="advice-page__form-block bg-light rounded-3 p-lg-4 p-3">
					<div class="advice-page__step">
						<h3 class="advice-page__step-title"><?php esc_html_e( 'Waar wil je advies over?', 'creators' ); ?></h3>
						<p class="advice-page__step-hint"><?php esc_html_e( 'Kies één of meer diensten. Daarna geef je aan wat voor soort.', 'creators' ); ?></p>

						<div class="advice-page__categories js-advice-categories">
							<?php foreach ( $advice_categories as $advice_category ) : ?>
								<button type="button" class="advice-page__category<?php echo $advice_category['featured'] ? ' advice-page__category--featured' : ''; ?>" data-advice-cat="<?php echo esc_attr( $advice_category['id'] ); ?>">
									<span class="advice-page__category-row">
										<?php if ( ! empty( $advice_category['icon_id'] ) ) : ?>
											<span class="advice-page__category-icon">
												<?php echo wp_get_attachment_image( $advice_category['icon_id'], 'thumbnail', false, [ 'alt' => '' ] ); ?>
											</span>
										<?php else : ?>
											<span class="advice-page__category-icon advice-page__category-icon--fallback" aria-hidden="true">
												<i class="fa-sharp fa-solid fa-plus"></i>
											</span>
										<?php endif; ?>
										<span class="advice-page__category-label"><?php echo esc_html( $advice_category['label'] ); ?></span>
										<span class="advice-page__category-mark" aria-hidden="true">✓</span>
									</span>
									<?php if ( $advice_category['hint'] ) : ?>
										<span class="advice-page__category-hint"><?php echo esc_html( $advice_category['hint'] ); ?></span>
									<?php endif; ?>
								</button>
							<?php endforeach; ?>
						</div>

						<div class="advice-page__groups js-advice-groups"></div>

						<div class="advice-page__summary">
							<div class="advice-page__summary-label"><?php esc_html_e( 'Jouw aanvraag', 'creators' ); ?></div>
							<div class="advice-page__summary-chips js-advice-summary"></div>
						</div>
					</div>

					<div class="advice-page__step">
						<h3 class="advice-page__step-title"><?php esc_html_e( 'Je gegevens', 'creators' ); ?></h3>
						<p class="advice-page__step-hint"><?php esc_html_e( 'Postcode en huisnummer zijn genoeg — de rest vullen we aan.', 'creators' ); ?></p>

						<?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( get_field( 'advice_form_id' ) ?: '7380dc2' ) . '" title="Adviesgesprek op maat"]' ); ?>
					</div>

					<?php
					$advice_usp_1      = get_field( 'advice_form_usp_1' ) ?: __( 'Binnen 24 uur reactie', 'creators' );
					$advice_usp_2      = get_field( 'advice_form_usp_2' ) ?: __( 'Gratis advies op locatie', 'creators' );
					$advice_usp_3_voor = get_field( 'advice_form_usp_3_voor' ) ?: 'Al ';
					$advice_usp_3_na   = get_field( 'advice_form_usp_3_na' ) ?: __( ' families gingen je voor', 'creators' );
					?>
					<ul class="d-flex flex-wrap justify-content-between gap-2 reset-list mt-4 mt-lg-1 advice-page__form-usps">
						<li><i class="fa-sharp fa-solid fa-circle-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $advice_usp_1 ); ?></li>
						<li><i class="fa-sharp fa-solid fa-circle-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $advice_usp_2 ); ?></li>
						<li><i class="fa-sharp fa-solid fa-circle-check text-success me-1" aria-hidden="true"></i><?php echo esc_html( $advice_usp_3_voor ); ?><strong class="value" data-target="<?php echo esc_attr( (int) get_field( 'advice_stats_getal' ) ?: 19720 ); ?>">0</strong><?php echo esc_html( $advice_usp_3_na ); ?></li>
					</ul>
				</div>

				<?php if ( get_field( 'tekst_onder_het_formulier' ) ) : ?>
					<div class="mt-3 small-content">
						<?php echo wp_kses_post( get_field( 'tekst_onder_het_formulier' ) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-xl-4 col-lg-5">
				<div class="advice-page__aside">

					<?php if ( $advice_person ) : ?>
						<div class="advice-page__advisor bg-white rounded-3">
							<div class="advice-page__advisor-media">
								<?php if ( ! empty( $advice_mood_photo['ID'] ) ) : ?>
									<img class="img-abs-center" src="<?php echo esc_url( creators_resized_image_url( $advice_mood_photo['url'] ?? '', 480 ) ); ?>" alt="<?php echo esc_attr( $advice_mood_photo['alt'] ?? $advice_person['naam'] ?? '' ); ?>" loading="lazy" decoding="async">
								<?php else : ?>
									<img class="img-abs-center" src="<?php echo esc_url( creators_resized_image_url( $advice_person['afbeelding']['url'] ?? '', 480 ) ); ?>" alt="<?php echo esc_attr( $advice_person['naam'] ?? '' ); ?>" loading="lazy" decoding="async">
								<?php endif; ?>
							</div>
							<div class="advice-page__advisor-content">
								<?php if ( ! empty( $advice_person['naam'] ) ) : ?>
									<div class="advice-page__advisor-name"><?php echo esc_html( $advice_person['naam'] ); ?></div>
								<?php endif; ?>
								<div class="advice-page__advisor-role"><?php esc_html_e( 'Jouw adviseur', 'creators' ); ?></div>
								<p><?php esc_html_e( 'Liever eerst even bellen? Dat mag ook — dan hoef je geen formulier in te vullen.', 'creators' ); ?></p>
								<div class="d-flex flex-column gap-2">
									<?php if ( $advice_phone ) : ?>
										<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $advice_phone ) ); ?>" class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-phone me-1" aria-hidden="true"></i><?php echo esc_html( $advice_phone ); ?></a>
									<?php endif; ?>
									<?php if ( $advice_whatsapp_link ) : ?>
										<a href="<?php echo esc_url( $advice_whatsapp_link ); ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm"><i class="fa-brands fa-whatsapp me-1" aria-hidden="true"></i><?php esc_html_e( 'Stuur een WhatsApp', 'creators' ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php foreach ( $advice_reviews as $advice_review ) : ?>
						<?php get_template_part( 'template-parts/blocks/block', 'review', [ 'review' => $advice_review ] ); ?>
					<?php endforeach; ?>

					<?php if ( get_field( 'advice_stats_getal' ) || get_field( 'advice_stats_tekst' ) ) : ?>
						<div class="advice-page__stats bg-primary text-white rounded-3">
							<div class="advice-page__stats-number value" data-target="<?php echo esc_attr( (int) get_field( 'advice_stats_getal' ) ?: 19720 ); ?>">0</div>
							<div class="advice-page__stats-text"><?php echo esc_html( get_field( 'advice_stats_tekst' ) ?: __( 'huishoudens verduurzaamd sinds 2011', 'creators' ) ); ?></div>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php if ( ! empty( $advice_steps ) ) : ?>
	<section class="advice-page__how bg-light border-radius-top border-radius-bottom border-radius-fill--light border-radius-bg--white py-lg-8 py-4">
		<div class="container">
			<h2 class="display-4 fw-bold mb-3"><?php echo esc_html( get_field( 'advice_how_titel' ) ?: __( 'Hoe het gesprek verloopt', 'creators' ) ); ?></h2>
			<div class="advice-page__how-slider js-advice-how-slider slick-margin">
				<?php foreach ( $advice_steps as $advice_step_index => $advice_step ) : ?>
					<div>
						<div class="advice-page__how-card">
							<span class="advice-page__how-number"><?php echo esc_html( sprintf( __( 'STAP %d', 'creators' ), $advice_step_index + 1 ) ); ?></span>
							<h3 class="advice-page__how-title"><?php echo esc_html( $advice_step['titel'] ?? '' ); ?></h3>
							<div class="advice-page__how-text"><?php echo wp_kses_post( $advice_step['tekst'] ?? '' ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( get_field( 'faq_titel' ) || have_rows( 'faq' ) ) : ?>
	<section class="advice-page py-5">
		<div class="container">
			<section class="advice-page__faq">
				<?php if ( get_field( 'faq_titel' ) ) : ?>
					<h2 class="display-4 fw-bold mb-3"><?php echo esc_html( get_field( 'faq_titel' ) ); ?></h2>
				<?php endif; ?>

				<?php if ( have_rows( 'faq' ) ) : ?>
					<?php $faq_schema_entities = []; ?>
					<div class="faq-wrapper">
						<?php while ( have_rows( 'faq' ) ) : the_row(); ?>
							<?php $schema_question = wp_strip_all_tags( get_sub_field( 'vraag' ) ); ?>
							<?php $schema_answer = preg_replace( '/<a[^>]*>.*?<\/a>/', '', (string) get_sub_field( 'antwoord' ) ); ?>
							<?php $schema_answer = wp_strip_all_tags( $schema_answer ); ?>
							<?php
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
									<span class="faq-item__title"><?php echo esc_html( get_sub_field( 'vraag' ) ); ?></span>
									<span class="faq-item__toggler"></span>
								</header>
								<main class="faq-item__content js-faq-content">
									<?php echo wp_kses_post( get_sub_field( 'antwoord' ) ); ?>
								</main>
							</div>
						<?php endwhile; ?>
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
			</section>
		</div>
	</section>
<?php endif; ?>

<div class="advice-sticky-cta d-lg-none">
	<div class="advice-sticky-cta__text">
		<strong><?php esc_html_e( 'Gratis adviesgesprek', 'creators' ); ?></strong>
		<span><?php esc_html_e( 'Binnen 24 uur reactie · geen verplichtingen', 'creators' ); ?></span>
	</div>
	<?php if ( $advice_whatsapp_link ) : ?>
		<a href="<?php echo esc_url( $advice_whatsapp_link ); ?>" target="_blank" rel="noopener" class="btn btn-outline-dark btn-sm"><?php esc_html_e( 'WhatsApp', 'creators' ); ?></a>
	<?php endif; ?>
	<a href="#form" class="btn btn-primary btn-sm"><?php esc_html_e( 'Start aanvraag', 'creators' ); ?></a>
</div>

<?php get_template_part( 'template-parts/layouts/layout', 'builder' ); ?>

<?php get_footer(); ?>

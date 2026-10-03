<?php /* Template Name: Page - Home */
get_header();

$hero_cards    = get_field( 'hero_cards' ) ?: [];
$hero_usps     = get_field( 'hero_usps' ) ?: [];
$medewerkers   = get_field( 'medewerkers', 'options' ) ?: [];
$hero_houding    = 'staand';
$hero_adviseur   = null;
$about_houding   = 'duim_omhoog';
$about_adviseur  = null;
foreach ( $medewerkers as $medewerker ) {
	if ( ! isset( $medewerker['houding'] ) || empty( $medewerker['afbeelding'] ) ) {
		continue;
	}
	if ( null === $hero_adviseur && $medewerker['houding'] === $hero_houding ) {
		$hero_adviseur = $medewerker;
	}
	if ( null === $about_adviseur && $medewerker['houding'] === $about_houding ) {
		$about_adviseur = $medewerker;
	}
	if ( $hero_adviseur && $about_adviseur ) {
		break;
	}
}
?>
<section class="bg-light py-5">
	<div class="container">
		<div class="row gy-2 align-items-stretch">
			<div class="col-xxl-7 col-xl-8 col-lg-12">
				<div class="home-hero-block-big position-relative rounded-3 overflow-hidden h-100 bg-white">
					<?php if ( $hero_image = get_field( 'hero_image' ) ) : ?>
						<?php echo wp_get_attachment_image( $hero_image['ID'], 'large', false, [ 'class' => 'img-abs-center' ] ); ?>
					<?php endif; ?>
					<div class="home-hero-block__content text-start">
						<?php
						$hero_keywords = get_field( 'hero_keywords' ) ?: [
							[ 'keyword' => 'isolatie' ],
							[ 'keyword' => 'zonnepanelen' ],
							[ 'keyword' => 'spouwmuurisolatie' ],
							[ 'keyword' => 'airco' ],
						];
						$keywords_json = wp_json_encode( array_column( $hero_keywords, 'keyword' ) );
					?>
					<h1 class="display-1 fw-bold text-white"><?php echo esc_html( get_field( 'hero_title' ) ?: __( 'We maken je huis duurzaam met', 'creators' ) ); ?> <span class="keyword-switcher" data-keywords="<?php echo esc_attr( $keywords_json ); ?>"><strong class="keyword-switcher__word"><?php echo esc_html( $hero_keywords[0]['keyword'] ?? 'isolatie' ); ?></strong></span></h1>
						<?php spurt_add_btns( get_field( 'hero_buttons_buttons' ) ); ?>
					</div>
				</div>
			</div>
			<div class="col-xxl-5 col-xl-4 col-lg-12">
				<div class="home-hero-blocks-wrapper">
					<?php foreach ( array_slice( $hero_cards, 0, 2 ) as $index => $card ) : ?>
						<div class="home-hero-block-small <?php echo 0 === $index ? ' home-hero-block-small--alt' : ''; ?> bg-white rounded-3">
								<?php if ( ! empty( $card['title'] ) ) : ?>
									<h2 class="display-3 fw-bold"><?php echo creators_markdown_inline( $card['title'] ); ?></h2>
								<?php endif; ?>
								<?php if ( ! empty( $card['button_buttons'] ) ) : ?>
									<?php spurt_add_btns( $card['button_buttons'], '', 'sm' ); ?>
								<?php endif; ?>
								<?php if ( 0 === $index && $hero_adviseur ) : ?>
								<?php echo wp_get_attachment_image( $hero_adviseur['afbeelding']['ID'], 'large', false, [ 'alt' => esc_attr( $hero_adviseur['naam'] ?? '' ) ] ); ?>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="home-hero-usps d-flex justify-content-xl-between justify-content-center flex-wrap gap-2">
			<?php foreach ( array_slice( $hero_usps, 0, 4 ) as $usp ) : ?>
				<div class="home-hero-usps__item">
					<div class="home-hero-usps__inner">
						<i class="text-success fa-solid fa-check" aria-hidden="true"></i>
						<span class="fw-normal"><?php echo esc_html( $usp['text'] ); ?></span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="home-intro border-radius-top py-lg-10 py-4">
	<div class="container">
		<?php
		$selected_services  = get_field( 'home_services' );
		$home_services_title = get_field( 'home_services_title' ) ?: __( 'Waar kunnen we je mee helpen?', 'creators' );

		$home_services_link = creators_link_field(
			get_field( 'home_services_link' ),
			'',
			__( 'Bekijk alle diensten', 'creators' )
		);

		if ( empty( $home_services_link['url'] ) ) {
			$home_services_url = creators_page_url_by_template( 'page-oplossingen.php' );
			$home_services_link['url'] = $home_services_url ? $home_services_url : home_url( '/onze-oplossingen/' );
		}
		?>
		<div class="d-sm-flex align-items-center justify-content-between mb-lg-3 mb-2">
            <h2 class="display-4 fw-bold "><?php echo esc_html( $home_services_title ); ?></h2>
			<a href="<?php echo esc_url( $home_services_link['url'] ); ?>" class="text-decoration-none small"><?php echo esc_html( $home_services_link['title'] ); ?><i class="small ms-1 fa-regular fa-arrow-right-long"></i></a>
        </div>
		<div class="position-relative">
			<div class="js-service-slider slick-margin">
				<?php if ( $selected_services ) : ?>
					<?php foreach ( $selected_services as $post ) : setup_postdata( $post ); ?>
					<div>
						<?php get_template_part( 'template-parts/blocks/block', 'dienst' ); ?>
					</div>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="home-about">
	<div class="bg-primary border-radius-top border-radius-fill--primary border-radius-bg--white text-white py-lg-14 py-4 pb-12">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<?php if ( get_field( 'home_about_title' ) ) : ?>
						<h2 class="display-2 mb-lg-3 mb-2 fw-bold"><?php echo creators_markdown_inline( get_field( 'home_about_title' ) ); ?></h2>
					<?php endif; ?>
					<?php if ( get_field( 'home_about_content' ) ) : ?>
						<?php echo wp_kses_post( get_field( 'home_about_content' ) ); ?>
					<?php endif; ?>
					<?php spurt_add_btns( get_field( 'home_about_buttons_buttons' ) ); ?>
				</div>
				<div class="offset-lg-1 col-lg-6 home-about-steps mt-lg-0 mt-2">
					<?php $stepcount = 0; if ( have_rows( 'stappen', 'options' ) ) : ?>
						<?php while ( have_rows( 'stappen', 'options' ) ) : the_row(); $stepcount++; ?>
							<div class="home-about-step<?php echo 1 === $stepcount ? ' show is-active' : ''; ?> ms-lg-0 ms-4">
								<span class="home-about-step__number"><?php echo $stepcount; ?></span>
								<div class="home-about-step__title"><?php echo get_sub_field( 'titel' ); ?></div>
								<div class="home-about-step__content"><?php echo get_sub_field( 'tekst' ); ?></div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-light border-radius-top border-radius-fill--light border-radius-bg--primary pb-lg-8 pb-4">
		<div class="container home-about__container">
			<div class="row gy-2">
				<?php $card_count = 0; if ( have_rows( 'home_about_cards' ) ) : ?>
					<?php while ( have_rows( 'home_about_cards' ) ) : the_row(); $card_count++; ?>
						<div class="col-lg-6">
							<div class="block-home__about text-dark <?php if ( 1 === $card_count && $about_adviseur ) : echo 'block-home__about--alt'; endif; ?> bg-white rounded-3">
								<?php if ( get_sub_field( 'title' ) ) : ?>
									<h3 class="display-4 mb-lg-3 mb-2 fw-bold"><?php echo creators_markdown_inline( get_sub_field( 'title' ) ); ?></h3>
								<?php endif; ?>
								<?php if ( get_sub_field( 'content' ) ) : ?>
									<?php echo wp_kses_post( get_sub_field( 'content' ) ); ?>
								<?php endif; ?>
								<?php spurt_add_btns( get_sub_field( 'button_buttons' ), '', 'sm' ); ?>
							<?php if ( 1 === $card_count && $about_adviseur ) : ?>
								<?php echo wp_get_attachment_image( $about_adviseur['afbeelding']['ID'], 'large', false, [ 'alt' => esc_attr( $about_adviseur['naam'] ?? '' ) ] ); ?>
							<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="container">
			<div class="col-xl-3">
				<?php
				$reviews = get_field( 'reviews', 'options' ) ?: [];
				if ( count( $reviews ) > 1 ) {
					shuffle( $reviews );
				}
				$reviews = array_slice( $reviews, 0, 6 );
				?>
				<?php
				$reviews_title_prefix = get_field( 'home_reviews_titel_prefix' ) ?: __( 'Wat meer dan', 'creators' );
				$reviews_title_suffix = get_field( 'home_reviews_titel_suffix' ) ?: __( 'klanten vertellen', 'creators' );
				?>
				<h4 class="display-3 fw-bold mb-lg-3 mb-2">
					<?php echo esc_html( $reviews_title_prefix ); ?>
					<?php if ( get_field( 'header_reviews_count', 'options' ) ) : ?>
						<strong><?php echo esc_html( get_field( 'header_reviews_count', 'options' ) ); ?></strong>
					<?php endif; ?>
					<?php echo esc_html( $reviews_title_suffix ); ?>
				</h4>
			</div>
			<?php if ( ! empty( $reviews ) ) : ?>
				<div class="row position-relative">
					<div class="js-global-reviews slick-margin">
						<?php foreach ( $reviews as $review ) : ?>
							<div>
								<?php get_template_part( 'template-parts/blocks/block', 'review', [ 'review' => $review ] ); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/layouts/layout', 'news' , array( 'class' => 'my-lg-10 my-4' ) ); ?>

<?php get_template_part( 'template-parts/layouts/layout', 'seo' , array( 'class' => 'my-lg-10 my-4' ) ); ?>

<?php get_footer(); ?>

<?php
/**
 * Layout: Method / Werkwijze
 *
 * Builder variant van de homepage werkwijze-sectie.
 */

$method_title   = get_sub_field( 'titel' );
$method_text    = get_sub_field( 'tekst' );
$method_steps   = get_sub_field( 'stappen' );
$method_buttons = get_sub_field( 'component_buttons' );

if ( ! $method_title && ! $method_text && empty( $method_steps ) && empty( $method_buttons ) ) {
	return;
}
?>

<div class="bg-primary border-radius-top border-radius-fill--primary border-radius-bg--white text-white py-lg-14 py-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<?php if ( $method_title ) : ?>
					<h2 class="display-2 mb-lg-3 mb-2 fw-bold">
						<?php
						if ( function_exists( 'creators_markdown_inline' ) ) {
							echo wp_kses_post( creators_markdown_inline( $method_title ) );
						} else {
							echo esc_html( $method_title );
						}
						?>
					</h2>
				<?php endif; ?>

				<?php if ( $method_text ) : ?>
					<?php echo wp_kses_post( $method_text ); ?>
				<?php endif; ?>

				<?php render_builder_buttons(); ?>
			</div>

			<div class="offset-lg-1 col-lg-6 home-about-steps">
				<?php if ( is_array( $method_steps ) && ! empty( $method_steps ) ) : ?>
					<?php foreach ( $method_steps as $index => $step ) : ?>
						<?php
						$step_number  = $index + 1;
						$is_active    = 0 === $index;
						$step_title   = $step['titel'] ?? '';
						$step_content = $step['tekst'] ?? '';
						?>
						<div class="home-about-step<?php echo $is_active ? ' show is-active' : ''; ?>">
							<span class="home-about-step__number"><?php echo esc_html( $step_number ); ?></span>
							<div class="home-about-step__title"><?php echo esc_html( $step_title ); ?></div>
							<div class="home-about-step__content"><?php echo wp_kses_post( $step_content ); ?></div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

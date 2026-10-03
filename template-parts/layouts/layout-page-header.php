<?php
/**
 * Layout: Page Header
 * 
 * Displays breadcrumbs, title, optional alternative h1, and introduction text
 */

$page_title = get_field( 'page_title' ) ?: get_the_title();
$page_intro = get_field( 'page_intro' );
?>

<section class="page-header py-lg-8 py-4">
	<div class="container">
		<div class="col-xl-11 offset-xl-1">

			<?php
		// Yoast breadcrumbs
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<div class="page-header__breadcrumbs mb-lg-4 mb-2">', '</div>' );
			}
			?>
		
		<?php if ( $page_title ) : ?>
			<h1 class="display-1 fw-bold mb-lg-3 mb-2">
				<?php echo creators_markdown_inline( $page_title ); ?>
			</h1>
			<?php endif; ?>
			
			<?php if ( $page_intro ) : ?>
				<div class="page-header__intro lead">
					<?php echo wp_kses_post( $page_intro ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
</section>

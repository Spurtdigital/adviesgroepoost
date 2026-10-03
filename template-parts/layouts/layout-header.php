<header class="header">
	<?php
	$header_search_placeholder  = get_field( 'header_search_placeholder', 'options' ) ?: 'Waar kunnen we je mee helpen?';
	$header_reviews_tekst       = get_field( 'header_reviews_tekst', 'options' ) ?: 'reviews';
	$header_button_mobile_tekst = get_field( 'header_button_mobile_tekst', 'options' ) ?: 'Advies aanvragen';
	?>
	<div class="header-top bg-primary text-white small">
		<div class="container-xxl d-flex align-items-center justify-content-between py-1">
			<div class="header-top__reviews d-xl-flex d-none">
				<ul class="reset-list d-flex">
					<?php
					for ($i = 1; $i <= 5; $i++):
						?>
						<li><i
								class="fa-sharp fa-solid fa-star<?php echo $i > (get_field('header_reviews_rating', 'options') ?: 5) ? ' opacity-50' : ''; ?>"></i>
						</li>
					<?php endfor; ?>
				</ul>
				<span><strong><?php echo esc_html(get_field('header_reviews_count', 'options')); ?></strong> <?php echo esc_html( $header_reviews_tekst ); ?></span>
			</div>
			<div class="header-top__usps js-header-usps-slider">
				<?php
				if (get_field('header_usps', 'options')):
					foreach (get_field('header_usps', 'options') as $usp):
						?>
						<div>
							<i class="fa-sharp fa-solid fa-check"></i>
							<span><?php echo esc_html($usp['text']); ?></span>
						</div>
						<?php
					endforeach;
				endif;
				?>
			</div>
			<div class="js-header-top">
				<nav class="header-top__nav js-header-top-menu">
					<?php creators_topmenu(); ?>
				</nav>
			</div>
		</div>
	</div>
	<div class="header-main py-lg-2 py-1">
		<div class="container-xxl d-flex justify-content-between align-items-center position-relative">
			<a href="<?php echo home_url(); ?>" class="header__logo"></a>
			<div class="js-main-nav">
				<nav class="header-main__nav js-main-menu">
					<ul class="reset-list d-xl-flex gap-xl-4 gap-2">
						<?php
						if (have_rows('mega_menu_items', 'options')):
							while (have_rows('mega_menu_items', 'options')): the_row();
								$menu_columns  = get_sub_field('columns');
								$menu_image    = get_sub_field('image');
								$has_mega_menu = false;

								if (is_array($menu_columns)) {
									foreach ($menu_columns as $menu_column) {
										if (!empty($menu_column['column_title']) || !empty($menu_column['items'])) {
											$has_mega_menu = true;
											break;
										}
									}
								}

								if (!$has_mega_menu && !empty($menu_image)) {
									$has_mega_menu = true;
								}
								?>
								<li class="d-flex w-100 align-items-center<?php echo $has_mega_menu ? '' : ' mega-menu-disabled'; ?>">
									<?php
									$link = get_sub_field('link');
									$href = $link ? $link['url'] : '#';
									$target = $link && $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : '';
									?>
									<a href="<?php echo esc_url($href); ?>" <?php echo $target; ?> class="d-flex justify-content-between justify-content-xl-start align-items-center w-100">
										<?php echo esc_html(get_sub_field('title')); ?>
										<?php if ($has_mega_menu): ?>
											<i class="fa-sharp fa-solid fa-chevron-down small text-secondary"></i>
										<?php endif; ?>
									</a>
									<?php if ($has_mega_menu): ?>
										<div class="mega-menu">
											<div class="row">
												<div class="col-lg-8">
													<div class="mega-menu__content">
														<div class="row">
															<?php
															if (have_rows('columns')):
																while (have_rows('columns')): the_row();
																	?>
																	<div class="col-lg-3">
																		<?php if (get_sub_field('column_title')): ?>
																			<strong><?php echo esc_html(get_sub_field('column_title')); ?></strong>
																		<?php endif; ?>
																		<?php if (have_rows('items')): ?>
																			<nav>
																				<ul>
																					<?php
																					while (have_rows('items')): the_row();
																						$item_link = get_sub_field('link');
																						if ($item_link):
																							?>
																							<li>
																								<a href="<?php echo esc_url($item_link['url']); ?>" <?php echo $item_link['target'] ? 'target="' . esc_attr($item_link['target']) . '"' : ''; ?>>
																									<?php echo esc_html($item_link['title']); ?>
																								</a>
																							</li>
																							<?php
																						endif;
																					endwhile;
																					?>
																				</ul>
																			</nav>
																		<?php endif; ?>
																	</div>
																	<?php endwhile; ?>
															<?php endif; ?>
														</div>
													</div>
												</div>
												<?php if ($menu_image): ?>
													<div class="col-lg-4">
														<div class="mega-menu-media">
															<?php
															$img_url = is_array($menu_image) ? $menu_image['url'] : $menu_image;
															$img_alt = is_array($menu_image) ? ($menu_image['alt'] ?? '') : '';
															?>
															<img class="img-abs-center" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
															<?php if (get_sub_field('image_title')): ?>
																<span><?php echo esc_html(get_sub_field('image_title')); ?></span>
															<?php endif; ?>
														</div>
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								</li>
							<?php endwhile; ?>
						<?php endif; ?>
					</ul>
				</nav>
			</div>
			<div class="d-flex gap-1 align-items-center">
				<div class="header-search d-none d-xl-block">
					<input class="form-control rounded-pill js-search-input" type="text" placeholder="<?php echo esc_attr( $header_search_placeholder ); ?>">
				</div>
				<button class="header__search-toggle js-search-toggle d-xl-none" aria-label="Search">
					<i class="fa-sharp fa-solid fa-magnifying-glass"></i>
				</button>

				<?php $header_button_link = get_field('header_button_link', 'options'); ?>
				<?php if ($header_button_link && !empty($header_button_link['url']) && !empty($header_button_link['title'])): ?>
					<a href="<?php echo esc_url($header_button_link['url']); ?>" class="btn btn-secondary" target="<?php echo esc_attr(!empty($header_button_link['target']) ? $header_button_link['target'] : '_self'); ?>">
						<span class="d-inline d-xxl-none"><?php echo esc_html( $header_button_mobile_tekst ); ?></span>
						<span class="d-none d-xxl-inline"><?php echo esc_html($header_button_link['title']); ?></span>
					</a>
				<?php endif; ?>
                				<div class="header__toggle js-toggle-panel">
					<span></span>
				</div>
			</div>
		</div>
		<div class="header__search-wrapper js-search-wrapper d-xl-none">
			<div class="header-search">
				<input class="form-control rounded-pill js-search-input" type="text" placeholder="<?php echo esc_attr( $header_search_placeholder ); ?>">
			</div>
		</div>
	</div>
</header>

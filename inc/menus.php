<?php

function creators_nav_menu($location, $class = '', $depth = 1) {
	if ( has_nav_menu( $location ) ) {
		wp_nav_menu([
			'theme_location' => $location,
			'container'      => false,
			'menu_class'     => $class,
			'depth'          => $depth,
		]);
	}
}

function creators_topmenu() {
	creators_nav_menu('topmenu', 'd-xl-flex reset-list gap-2', 2);
}

function creators_hoofdmenu() {
	creators_nav_menu('hoofdmenu', 'js-main-menu d-xl-flex align-items-center reset-list gap-xl-3 gap-2', 2);
}

function creators_footermenu() {
	creators_nav_menu('footermenu', 'columns-2 reset-list', 2);
}

function creators_footermenu2() {
	creators_nav_menu('footermenu2', 'reset-list', 2);
}

function creators_privacymenu() {
	creators_nav_menu('privacymenu', 'd-flex reset-list gap-2', 2);
}


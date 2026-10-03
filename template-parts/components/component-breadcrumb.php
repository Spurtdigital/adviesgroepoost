<?php
/**
 * Component: Breadcrumb
 * 
 * Displays Yoast breadcrumbs if available
 */

if ( function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb( '<div class="breadcrumbs mb-lg-4 mb-2">', '</div>' );
}

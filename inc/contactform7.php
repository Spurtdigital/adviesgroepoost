<?php

function creators_cf7_add_classes( $content ) {
	$content = preg_replace(
		'/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i',
		'\2',
		$content
	);

	$content = preg_replace_callback(
		'/<(input|select|textarea)\b([^>]*?)(\s*\/?)>/i',
		function( $matches ) {
			$tag        = strtolower( $matches[1] );
			$attributes = $matches[2];
			$self_close = $matches[3];
			$type       = '';
			$classes    = [];

			if ( preg_match( '/\stype=("|\')([^"\']+)\1/i', $attributes, $type_match ) ) {
				$type = strtolower( $type_match[2] );
			}

			if ( 'input' === $tag ) {
				if ( in_array( $type, [ 'submit', 'button', 'reset' ], true ) ) {
					$classes = [ 'btn', 'btn-primary' ];
				} elseif ( in_array( $type, [ 'checkbox', 'radio' ], true ) ) {
					$classes = [ 'form-check-input' ];
				} elseif ( 'hidden' !== $type ) {
					$classes = [ 'form-control' ];
				}
			} elseif ( 'select' === $tag ) {
				$classes = [ 'form-select' ];
			} elseif ( 'textarea' === $tag ) {
				$classes = [ 'form-control' ];
			}

			if ( empty( $classes ) ) {
				return '<' . $tag . $attributes . $self_close . '>';
			}

			if ( preg_match( '/\sclass=("|\')([^"\']*)\1/i', $attributes, $class_match ) ) {
				$current_classes = preg_split( '/\s+/', trim( $class_match[2] ) );
				$merged_classes  = implode( ' ', array_unique( array_filter( array_merge( $current_classes, $classes ) ) ) );
				$attributes      = preg_replace( '/\sclass=("|\')[^"\']*\1/i', ' class="' . $merged_classes . '"', $attributes, 1 );
			} else {
				$attributes .= ' class="' . implode( ' ', $classes ) . '"';
			}

			return '<' . $tag . $attributes . $self_close . '>';
		},
		$content
	);

	return str_replace( '<br />', '', $content );
}

add_filter( 'wpcf7_form_elements', 'creators_cf7_add_classes' );

add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Het adviesformulier levert de gekozen diensten via JavaScript aan in het
 * veld #select-boxes. In de CF7-formulieren staat dit veld echter als
 * [checkbox diensten] zonder opties: dat rendert als een lege <span> zonder
 * inputs, en de server-side enum-validatie weigert elke ingevulde waarde.
 * Daarom forceren we hier een verborgen [text]-veld, zodat de JS-waarde
 * meegestuurd wordt.
 */
function creators_cf7_force_diensten_text_field( $form, $contact_form = null ) {
	return preg_replace(
		'/\[checkbox\s+diensten\b[^\]]*\]/i',
		'[text diensten id:select-boxes class:d-none]',
		$form
	);
}
add_filter( 'wpcf7_contact_form_property_form', 'creators_cf7_force_diensten_text_field', 10, 2 );

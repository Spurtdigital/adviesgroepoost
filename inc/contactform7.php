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
 * Bepaal of de huidige pagina een Contact Form 7-formulier weergeeft.
 * CF7 laadt anders op elke pagina zijn JS/CSS én reCAPTCHA; dat scheelt fors
 * door assets alleen te laden waar echt een formulier staat.
 *
 * @return bool
 */
function creators_page_has_contact_form() {
	// Templates met een vast formulier.
	if ( is_page_template( [ 'page-contact.php', 'page-advies.php', 'page-offertecheck.php' ] ) ) {
		return true;
	}

	$post_id = get_queried_object_id();

	if ( $post_id ) {
		// Builder (flexible content) kan een 'layout05'-formulier bevatten.
		foreach ( [ 'contentbuilder', 'field_648de36a2d1a9' ] as $selector ) {
			$rows = get_field( $selector, $post_id );

			if ( ! is_array( $rows ) ) {
				continue;
			}

			foreach ( $rows as $row ) {
				if ( 'layout05' === ( $row['acf_fc_layout'] ?? '' ) ) {
					if ( ! empty( $row['formulier'] ) || ! empty( $row['cf7_form'] ) ) {
						return true;
					}
				}
			}
		}
	}

	// Fallback: shortcode in de content.
	$post = get_post( $post_id );

	if ( $post && has_shortcode( $post->post_content, 'contact-form-7' ) ) {
		return true;
	}

	return false;
}

add_filter( 'wpcf7_load_js', 'creators_page_has_contact_form' );
add_filter( 'wpcf7_load_css', 'creators_page_has_contact_form' );
add_filter( 'wpcf7_load_recaptcha', 'creators_page_has_contact_form' );

/**
 * Vangnet: verwijder reCAPTCHA-scripts op pagina's zonder formulier, ook als
 * een andere plugin of CF7 ze alsnog in de wachtrij plaatst.
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( creators_page_has_contact_form() ) {
		return;
	}

	wp_dequeue_script( 'google-recaptcha' );
	wp_dequeue_script( 'wpcf7-recaptcha' );
	wp_deregister_script( 'google-recaptcha' );
	wp_deregister_script( 'wpcf7-recaptcha' );
}, 100 );

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

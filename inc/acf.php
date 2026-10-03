<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group([
		'key' => 'group_page_contact',
		'title' => 'Page Contact',
		'fields' => [
			[
				'key' => 'field_page_contact_form_title',
				'label' => 'Formulier titel',
				'name' => 'contact_form_title',
				'type' => 'text',
				'default_value' => 'Contactformulier',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_page_contact_form',
				'label' => 'Contact Form 7 formulier',
				'name' => 'contact_form',
				'type' => 'post_object',
				'post_type' => [
					'wpcf7_contact_form',
				],
				'return_format' => 'id',
				'ui' => 1,
				'allow_null' => 1,
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_page_contact_details_title',
				'label' => 'Titel contactgegevens',
				'name' => 'contact_details_title',
				'type' => 'text',
				'default_value' => 'Contactgegevens',
				'wrapper' => [
					'width' => '50',
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-contact.php',
				],
			],
		],
		'menu_order' => 1,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
		'show_in_rest' => 0,
	]);

	acf_add_local_field_group([
		'key' => 'group_local_theme_settings',
		'title' => 'Thema Settings - Lokale Paginas',
		'fields' => [
			[
				'key' => 'field_local_settings_tab',
				'label' => 'Lokale paginas',
				'name' => '',
				'type' => 'tab',
				'placement' => 'left',
				'endpoint' => 0,
			],
			[
				'key' => 'field_local_seo_afbeelding_1',
				'label' => 'SEO afbeelding 1',
				'name' => 'local_seo_afbeelding_1',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_seo_afbeelding_2',
				'label' => 'SEO afbeelding 2',
				'name' => 'local_seo_afbeelding_2',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_seo_afbeelding_3',
				'label' => 'SEO afbeelding 3',
				'name' => 'local_seo_afbeelding_3',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_seo_afbeelding_4',
				'label' => 'SEO afbeelding 4',
				'name' => 'local_seo_afbeelding_4',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_seo_afbeelding_5',
				'label' => 'SEO afbeelding 5',
				'name' => 'local_seo_afbeelding_5',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_seo_afbeelding_6',
				'label' => 'SEO afbeelding 6',
				'name' => 'local_seo_afbeelding_6',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_seo_afbeelding_7',
				'label' => 'SEO afbeelding 7',
				'name' => 'local_seo_afbeelding_7',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_seo_afbeelding_8',
				'label' => 'SEO afbeelding 8',
				'name' => 'local_seo_afbeelding_8',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_cta_titel',
				'label' => 'Lokale CTA titel',
				'name' => 'local_cta_titel',
				'type' => 'text',
				'default_value' => 'Plan een **gratis adviesgesprek** bij u thuis',
				'wrapper' => [
					'width' => '100',
				],
			],
			[
				'key' => 'field_local_cta_tekst',
				'label' => 'Lokale CTA tekst',
				'name' => 'local_cta_tekst',
				'type' => 'textarea',
				'rows' => 3,
				'wrapper' => [
					'width' => '100',
				],
			],
			[
				'key' => 'field_local_cta_button',
				'label' => 'Lokale CTA button',
				'name' => 'local_cta_button',
				'type' => 'link',
				'return_format' => 'array',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_cta_afbeelding',
				'label' => 'Lokale CTA afbeelding',
				'name' => 'local_cta_afbeelding',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_header_tekst',
				'label' => 'Header intro tekst',
				'name' => 'local_header_tekst',
				'type' => 'textarea',
				'default_value' => 'Onze specialist kijkt met je mee, geeft helder advies en een passend plan voor je woning.',
				'rows' => 3,
				'wrapper' => [
					'width' => '100',
				],
			],
			[
				'key' => 'field_local_header_button',
				'label' => 'Header button',
				'name' => 'local_header_button',
				'type' => 'link',
				'instructions' => 'Laat leeg voor automatische fallback naar de Adviesgesprek-pagina.',
				'return_format' => 'array',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_header_cta_titel',
				'label' => 'Header CTA titel',
				'name' => 'local_header_cta_titel',
				'type' => 'text',
				'default_value' => 'Toch liever direct contact?',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_header_persoon_prefix',
				'label' => 'Tekst vóór adviseurnaam',
				'name' => 'local_header_persoon_prefix',
				'type' => 'text',
				'default_value' => '',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_local_header_persoon_suffix',
				'label' => 'Tekst ná adviseurnaam',
				'name' => 'local_header_persoon_suffix',
				'type' => 'text',
				'default_value' => 'staat voor je klaar.',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'field_builder_fallback_media_tab',
				'label' => 'Builder fallback media',
				'name' => '',
				'type' => 'tab',
				'placement' => 'left',
				'endpoint' => 0,
			],
			[
				'key' => 'field_builder_fallback_media',
				'label' => 'Fall-back media',
				'name' => 'fall_back_media',
				'type' => 'repeater',
				'instructions' => 'Wordt gebruikt als willekeurige fallback wanneer een builder-afbeelding leeg is.',
				'layout' => 'block',
				'button_label' => 'Afbeelding toevoegen',
				'sub_fields' => [
					[
						'key' => 'field_builder_fallback_media_image',
						'label' => 'Afbeelding',
						'name' => 'afbeelding',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-thema-velden',
				],
			],
		],
		'menu_order' => 2,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
		'show_in_rest' => 0,
	]);
} );

add_filter( 'acf/load_field/name=builder_kleiner_weergeven', function( $field ) {
	$field['label'] = 'Kleiner weergeven';
	$field['instructions'] = 'Globale breedte voor de hele builder. Aan: tekst col-xl-8 en media col-xl-10. Uit: tekst col-xl-10 en media col-xl-11.';
	$field['default_value'] = 1;
	$field['ui'] = 1;
	$field['ui_on_text'] = 'Kleiner';
	$field['ui_off_text'] = 'Groter';

	return $field;
} );

add_filter( 'acf/prepare_field', function( $field ) {
	if ( empty( $field['name'] ) || empty( $field['parent_layout'] ) ) {
		return $field;
	}

	if ( in_array( $field['name'], [ 'groter_weergeven', 'kleiner_weergeven' ], true ) ) {
		return false;
	}

	return $field;
} );
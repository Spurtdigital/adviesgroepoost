<?php 

	
	
add_filter( 'gform_disable_css', '__return_true' );

// Gravity forms Bootstrap
add_action('wp', function () {
	add_filter('gform_field_container', 'moddit_change_gform_class_to_bootstrap', 10, 6);
	add_filter('gform_get_form_filter', 'moddit_change_ul_to_div', 10, 2);
	add_filter('gform_field_content', 'moddit_change_field_content', 10, 5);
	add_filter('gform_submit_button', 'moddit_change_submit_button', 10, 2);
});
function moddit_change_gform_class_to_bootstrap($field_container, $field, $form, $css_class, $style, $field_content)
{

	$class = 'col-lg-12 form-group';
	if ($field->type == 'date' || $field->type == 'fileupload') {
		$class = 'col-lg-6 form-group';
	} elseif ($field->type != 'checkbox' && $field->type != 'radio') {
		switch ($field->size) {
			case "small":
				$class = 'col-lg-4 form-group';
				break;
			case "medium":
				$class = 'col-lg-6 form-group';
				break;
			case "large":
				$class = 'col-lg-12 form-group';
				break;
		}
	}
	return "<div id='field_" . $field->formId . "_" . $field->id . "' class='$class $css_class'>{FIELD_CONTENT}</div>";
}
function moddit_change_ul_to_div($form_string, $form)
{
	$str = str_replace('<ul', '<div', $form_string);
	$str = str_replace('</ul', '</div', $str);
	$str = str_replace('gform_fields', 'row gx-1 gy-lg-2 gy-1 gform_fields', $str);
	$str = str_replace('gfield_label', 'gfield_label', $str);
	$str = str_replace('gfield_description validation_message', 'gfield_description validation_message text-danger font-weight-bold', $str);
	return $str;
}
function moddit_change_field_content($content, $field, $value, $lead_id, $form_id)
{
	if ($field->type == 'text' || $field->type == 'number' || $field->type == 'phone' || $field->type == 'email' || $field->type == 'date') {
		$content = str_replace('ginput_container', 'ginput_container form-floating', $content);
		$content = str_replace('<input', '<input placeholder="' . $field->label . '" class="form-control"', $content);
		if ($field->type == 'date') {
			$content = str_replace('text', 'date', $content);
		}
	}
	if ($field->type == 'textarea') {
		$content = str_replace('ginput_container', 'ginput_container form-floating', $content);
		$content = str_replace('<textarea', '<textarea placeholder="' . $field->label . '" class="form-control"', $content);
	}
	if ($field->type == 'select' || $field->type == 'multiselect') {
		$content = str_replace('ginput_container', 'ginput_container form-floating', $content);
		$content = str_replace('<select', '<select class="form-select"', $content);
	}
	if ($field->type == 'checkbox') {
		$content = str_replace('gchoice_', 'custom-control custom-checkbox gchoice_', $content);
		$content = str_replace('<input', '<input class="custom-control-input"', $content);
		$content = str_replace('<label for', '<label class="custom-control-label" for', $content);
	}
	if ($field->type == 'radio') {
		$content = str_replace('gchoice_', 'custom-control custom-radio gchoice_', $content);
		$content = str_replace('<input', '<input class="custom-control-input"', $content);
		$content = str_replace('<label for', '<label class="custom-control-label" for', $content);
	}
	$content = str_replace('gfield_required', 'gfield_required text-danger', $content);

	return $content;
}

function moddit_change_submit_button($button, $form)
{
	$text = $form['button']['text'] ?: __('Versturen', 'moonlight');
	return "<button class='gform_button btn btn-primary mt-xl-3 mt-2' id='gform_submit_button_{$form['id']}'><span class='btn__icon'><i class='fas fa-paper-plane me-1'></i></span><span class='btn__text'><span>{$text}</span></span></button>";
}

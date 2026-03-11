<?php
/***********************************
 * Contact form 7 floating forms   *
 **********************************/

 add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);
    return $content;
});

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter( 'style_loader_tag',  'preload_filter', 10, 2 );
    function preload_filter( $html, $handle ){
    if (strcmp($handle, 'creators-css') == 0) {
        $fallback = '<noscript>' . $html . '</noscript>';
        $preload = str_replace("rel='stylesheet'", "rel='preload' as='style' onload='this.rel=\"stylesheet\"'", $html);
        $html = $preload . $fallback;
    }
    return $html;
}
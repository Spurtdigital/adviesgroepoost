<?php
$link = $args['link'] ?? null;

if (!$link || empty($link['url']) || empty($link['title'])) {
    return;
}

$linkurl = $link['url'];
$text = $link['title'];
$target = !empty($link['target']) ? $link['target'] : '_self';
$type = $args['type'] ?? 'btn';
$color = $args['color'] ?? 'primary';
$size = $args['size'] ?? '';

// Bepaal variant class
if ($type === 'link') {
    $classes = 'btn btn-link';
} else {
    $classes = 'btn btn-' . esc_attr($color);
}

// Voeg size toe indien opgegeven
if ($size === 'sm') {
    $classes .= ' btn-sm';
} elseif ($size === 'lg') {
    $classes .= ' btn-lg';
}

// Check voor video link (fancybox)
$fancybox = preg_match('/youtu\.be/i', $linkurl) || preg_match('/youtube\.com\/watch/i', $linkurl) || preg_match('/vimeo\.com/i', $linkurl);
?>
<a href="<?php echo esc_url($linkurl); ?>" class="<?php echo $classes; ?>"<?php echo $fancybox ? ' data-fancybox' : ''; ?> target="<?php echo esc_attr($target); ?>">
    <?php echo esc_html($text); ?>
</a>

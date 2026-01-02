<?php 

// header.php dosyanıza bu kodu ekleyin:
echo '<!-- Checking template files: -->';
echo '<!-- header-white.php exists: ' . 
    (locate_template('template-parts/header-white.php') ? 'YES' : 'NO') . ' -->';
echo '<!-- header-default.php exists: ' . 
    (locate_template('template-parts/header-default.php') ? 'YES' : 'NO') . ' -->';

// Yolları da göster
$white_path = locate_template('template-parts/header-white.php');
$default_path = locate_template('template-parts/header-default.php');
echo '<!-- White path: ' . ($white_path ?: 'NOT FOUND') . ' -->';
echo '<!-- Default path: ' . ($default_path ?: 'NOT FOUND') . ' -->';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
// Header seçimi (tek ve doğru yer)
if (is_shop() || is_product_category() || is_product_tag() || is_product() ) {
    get_template_part('template-parts/header', 'white');
} else {
    get_template_part('template-parts/header', 'default');
}
?>
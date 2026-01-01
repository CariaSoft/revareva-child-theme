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
if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
    get_template_part('template-parts/header', 'white');
} else {
    get_template_part('template-parts/header', 'default');
}
?>
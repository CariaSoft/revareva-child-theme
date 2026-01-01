<?php
// Child theme stil ve script'lerini doğru sırayla yükle
add_action('wp_enqueue_scripts', 'revareva_child_enqueue_styles', 20);
function revareva_child_enqueue_styles() {
    // Parent theme'in style.css'sini yükle (orijinal tema zaten main.css'yi import ediyor)
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Child theme'e özel ekstra CSS eklemek istersen (opsiyonel)
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}


// WooCommerce destek bildirimi (tema WooCommerce uyumlu olsun)
add_action('after_setup_theme', 'revareva_child_woocommerce_support');
function revareva_child_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

remove_action(
    'woocommerce_before_single_product_summary',
    'woocommerce_show_product_sale_flash',
    10
);


/**
 * Header tipini koşullu olarak seç
 */
add_filter('get_header', function($name) {
    if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
        $name = 'white';
    } elseif (is_front_page()) {
        $name = 'default';
    }
    return $name;
}, 10, 1);

?>
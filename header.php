<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Duyuru Alanı -->
<div class="announcement-bar bg-dark text-white fixed-top">
    <div class="announcement-wrapper">
        <?php
        for ($i = 1; $i <= 5; $i++) {
            $text = get_theme_mod("announcement_$i");
            $link = get_theme_mod("announcement_link_$i");
            $icon = get_theme_mod("announcement_icon_$i", '🚚');

            if ($text) {
                // Sınıfı doğrudan link veya span içine veriyoruz
                $link_tag = $link ? '<a href="' . esc_url($link) . '" class="announcement-item">' : '<span class="announcement-item">';
                $link_close = $link ? '</a>' : '</span>';
                
                echo $link_tag . $icon . ' ' . esc_html($text) . $link_close;
            }
        }
        ?>
    </div>
</div>

<script>
    // İlk öğeyi aktif etme scripti (PHP döngüsünün dışında, sayfa yüklenince çalışması daha sağlıklıdır)
    document.addEventListener("DOMContentLoaded", function() {
        const firstItem = document.querySelector(".announcement-item");
        if (firstItem) firstItem.classList.add("active");
    });
</script>


<?php
// Header seçimi - Koşullu
if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
    get_template_part('header', 'white'); // Mağaza/kategori/ürün için beyaz header
} else {
    get_template_part('header', 'default'); // Ana sayfa için transparan header
}
?>



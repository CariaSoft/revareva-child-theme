<?php
/**
 * Announcement Bar
 * Görünüm ve davranış korunmuştur
 */
?>

<!-- Duyuru Alanı -->
<div class="announcement-bar bg-dark text-white fixed-top">
    <div class="announcement-wrapper">
        <?php
        for ($i = 1; $i <= 5; $i++) {
            $text = get_theme_mod("announcement_$i");
            $link = get_theme_mod("announcement_link_$i");
            $icon = get_theme_mod("announcement_icon_$i", '🚚');

            if ($text) {
                $link_tag   = $link
                    ? '<a href="' . esc_url($link) . '" class="announcement-item">'
                    : '<span class="announcement-item">';
                $link_close = $link ? '</a>' : '</span>';

                echo $link_tag . $icon . ' ' . esc_html($text) . $link_close;
            }
        }
        ?>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const firstItem = document.querySelector(".announcement-item");
    if (firstItem) firstItem.classList.add("active");
});
</script>

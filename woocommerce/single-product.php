<?php
/**
 * Revareva Child - Ürün Detay Sayfası (single-product.php)
 * product.html'e birebir yakın dinamik görünüm
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); // header-white gelir
?>

<div class="container mt-5 pt-5">
    <div class="row">
        <!-- Ürün Foto + Varyasyon -->
        <div class="col-lg-6">
            <?php woocommerce_show_product_images(); ?>
        </div>

        <!-- Ürün Bilgi -->
        <div class="col-lg-6">
            <?php woocommerce_template_single_title(); ?>
            <?php woocommerce_template_single_price(); ?>
            <?php woocommerce_template_single_excerpt(); ?>

            <!-- Varyasyonlar (Renk, Beden) -->
            <?php woocommerce_template_single_add_to_cart(); ?>

<!-- Ürün Ek Bilgileri (ACF) -->
<div class="product-meta mt-4">
    <?php if ( get_field('icerik') ) : ?>
        <h5>İçerik</h5>
        <?php the_field('icerik'); ?>
    <?php endif; ?>

    <?php if ( get_field('bakim_onerisi') ) : ?>
        <h5>Bakım Önerisi</h5>
        <?php the_field('bakim_onerisi'); ?>
    <?php endif; ?>

    <?php if ( get_field('teslimat') ) : ?>
        <h5>Teslimat</h5>
        <?php the_field('teslimat'); ?>
    <?php endif; ?>

    <?php if ( get_field('iade') ) : ?>
        <h5>İade</h5>
        <?php the_field('iade'); ?>
    <?php endif; ?>
</div>

            <!-- Favoriler (YITH Wishlist) -->
            <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
        </div>
    </div>

    <!-- Prestij Blok -->
    <?php get_template_part( 'footer-prestige' ); ?>
</div>

<?php get_footer(); ?>
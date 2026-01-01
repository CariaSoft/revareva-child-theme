<?php
/**
 * Revareva Child - Ürün Kategori Arşivi (taxonomy-product_cat.php)
 *
 * Kategori sayfalarına özel görünüm (kategori.html benzeri yapı)
 *
 * @package Revareva Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Güvenlik
}

get_header(); // Standart header çağrısı (functions.php'deki filtre ile white header seçilir)
?>

<div class="container mt-4 mb-5">

    <!-- Breadcrumb -->
    <?php woocommerce_breadcrumb(); ?>

    <div class="row">

        <!-- Sol Sidebar: Kategoriler + Filtreler -->
        <div class="col-lg-3 col-md-4 sidebar-categories">

            <h3 class="mb-4 fw-bold">Kategoriler</h3>

            <?php
            // Mevcut kategorinin alt kategorilerini listele
            $current_cat = get_queried_object();
            $child_args = array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
                'parent'     => $current_cat->term_id,
            );
            $child_cats = get_terms( $child_args );

            if ( ! empty( $child_cats ) && ! is_wp_error( $child_cats ) ) :
                ?>
                <ul class="list-unstyled category-list">
                    <?php foreach ( $child_cats as $child ) : ?>
                        <li class="mb-2">
                            <a href="<?php echo esc_url( get_term_link( $child ) ); ?>" class="text-decoration-none text-dark">
                                <?php echo esc_html( $child->name ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php
            endif;

            // Shop sidebar widget'ları (fiyat aralığı, renk, beden vs.)
            if ( is_active_sidebar( 'shop-sidebar' ) ) {
                dynamic_sidebar( 'shop-sidebar' );
            }
            ?>
        </div>

        <!-- Sağ İçerik: Ürünler + Offcanvas Filtre/Sıralama -->
        <div class="col-lg-9 col-md-8">

            <!-- Offcanvas Tetikleyici -->
            <div class="d-flex justify-content-end mb-4">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasShopFilters" aria-controls="offcanvasShopFilters">
                    Filtrele & Sırala
                </button>
            </div>

            <!-- Offcanvas İçeriği -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasShopFilters" aria-labelledby="offcanvasShopFiltersLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasShopFiltersLabel">Filtre ve Sıralama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Sıralama dropdown -->
                    <?php woocommerce_catalog_ordering(); ?>

                    <!-- Filtre widget'ları (layered nav) -->
                    <?php if ( is_active_sidebar( 'shop-filters' ) ) : ?>
                        <?php dynamic_sidebar( 'shop-filters' ); ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Başlık ve Ürünler -->
            <?php if ( woocommerce_product_loop() ) : ?>

                <header class="woocommerce-products-header mb-4">
                    <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                </header>

                <?php woocommerce_product_loop_start(); ?>

                <?php while ( have_posts() ) : ?>
                    <?php the_post(); ?>
                    <?php wc_get_template_part( 'content', 'product' ); ?>
                <?php endwhile; ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action( 'woocommerce_after_shop_loop' ); // Sayfalama vb. ?>

            <?php else : ?>
                <?php do_action( 'woocommerce_no_products_found' ); ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
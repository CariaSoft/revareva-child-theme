<?php
// taxonomy-product_cat.php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Güvenlik
}

get_header( 'white' ); // header-white.php'yi çağır (temanda varsa, yoksa get_header(); kullan)
?>

<main id="main" class="site-main">

    <div class="container"> <!-- veya senin container class'ın -->

        <!-- Breadcrumb -->
        <?php woocommerce_breadcrumb(); ?>

        <div class="row">

            <!-- Sol Sidebar: Kategoriler + Filtreler (kategori.html'deki gibi) -->
            <div class="col-lg-3 col-md-4 sidebar">
                <h3>Kategoriler</h3>
                <?php 
                // Alt kategorileri listele (hierarchical)
                $current_cat = get_queried_object();
                $child_args = array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => false,
                    'parent'     => $current_cat->term_id,
                );
                $child_cats = get_terms( $child_args );

                if ( ! empty( $child_cats ) && ! is_wp_error( $child_cats ) ) {
                    echo '<ul class="category-list">';
                    foreach ( $child_cats as $child ) {
                        echo '<li><a href="' . esc_url( get_term_link( $child ) ) . '">' . esc_html( $child->name ) . '</a></li>';
                    }
                    echo '</ul>';
                }

                // Filtre widget'ları (offcanvas dışında kalıcı sidebar istiyorsan)
                if ( is_active_sidebar( 'shop-sidebar' ) ) {
                    dynamic_sidebar( 'shop-sidebar' );
                }
                ?>
            </div>

            <!-- Sağ İçerik: Ürünler + Offcanvas Filtre/Sıralama -->
            <div class="col-lg-9 col-md-8">

                <!-- Offcanvas Tetikleyici Buton -->
                <div class="filters-bar mb-4">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasShopFilters" aria-controls="offcanvasShopFilters">
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
                        <?php woocommerce_catalog_ordering(); // Sıralama dropdown ?>

                        <!-- Layered nav filtreleri (fiyat, renk, beden vs.) -->
                        <?php
                        if ( is_active_sidebar( 'shop-filters' ) ) {
                            dynamic_sidebar( 'shop-filters' );
                        }
                        ?>
                    </div>
                </div>

                <!-- Ürün Loop -->
                <?php if ( woocommerce_product_loop() ) : ?>

                    <header class="woocommerce-products-header">
                        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                    </header>

                    <?php woocommerce_product_loop_start(); ?>

                    <?php while ( have_posts() ) : ?>
                        <?php the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; ?>

                    <?php woocommerce_product_loop_end(); ?>

                    <?php do_action( 'woocommerce_after_shop_loop' ); // Pagination vs. ?>

                <?php else : ?>
                    <?php do_action( 'woocommerce_no_products_found' ); ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
<?php
/**
 * Revareva Child - Ürün Kategori Arşivi (taxonomy-product_cat.php)
 * kategori.html'e birebir yakın dinamik görünüm
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Mevcut kategoriyi al
$current_cat = get_queried_object();

?>

<!-- ===== EKMEK KIRINTISI VE KATEGORİ NAVİGASYONU ===== -->
<div class="container-fluid px-1 px-sm-2 px-md-3 px-lg-4 px-xl-4 pt-3 pb-3">
    <?php woocommerce_breadcrumb(); ?>

    <div class="category-section d-flex align-items-center text-uppercase pt-4">
        <div class="active-subcategory flex-shrink-0 pe-4">
            <a href="<?php echo esc_url( get_term_link( $current_cat ) ); ?>" class="subcategory-link active fw-bold fs-5">
                <?php echo esc_html( $current_cat->name ); ?> (<?php echo $current_cat->count; ?>)
            </a>
        </div>

        <div class="subcategory-scroll flex-grow-1 overflow-x-auto pe-4">
            <div class="d-flex gap-3">
                <a href="<?php echo esc_url( get_term_link( $current_cat ) ); ?>" class="subcategory-link flex-shrink-0">Tüm <?php echo esc_html( $current_cat->name ); ?></a>

                <?php
                $child_args = array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                    'parent'     => $current_cat->term_id,
                );
                $child_cats = get_terms( $child_args );

                if ( ! empty( $child_cats ) && ! is_wp_error( $child_cats ) ) {
                    foreach ( $child_cats as $child ) {
                        echo '<a href="' . esc_url( get_term_link( $child ) ) . '" class="subcategory-link flex-shrink-0">' . esc_html( $child->name ) . '</a>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="sort-filter d-flex gap-4 flex-shrink-0">
            <a href="#" class="text-uppercase fw-bold" data-bs-toggle="offcanvas" data-bs-target="#sortOffcanvas">
                Sıralama
            </a>
            <a href="#" class="text-uppercase fw-bold" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
                Filtre
            </a>
        </div>
    </div>
</div>

<!-- SIRALAMA OFFCANVAS -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="sortOffcanvas" aria-labelledby="sortOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="sortOffcanvasLabel">SIRALAMA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="get" class="woocommerce-ordering" id="sortForm">
            <div class="sort-options-wrapper">
                <div class="sort-option">
                    <input type="radio" id="sort-yeniye-gore" name="orderby" value="menu_order" class="sort-radio" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'menu_order') ? 'checked' : ''; ?>>
                    <label for="sort-yeniye-gore" class="sort-label">YENİYE GÖRE</label>
                </div>
                <div class="sort-option">
                    <input type="radio" id="sort-fiyata-artan" name="orderby" value="price" class="sort-radio" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'price') ? 'checked' : ''; ?>>
                    <label for="sort-fiyata-artan" class="sort-label">FİYATA GÖRE ARTAN</label>
                </div>
                <div class="sort-option">
                    <input type="radio" id="sort-fiyata-azalan" name="orderby" value="price-desc" class="sort-radio" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'price-desc') ? 'checked' : ''; ?>>
                    <label for="sort-fiyata-azalan" class="sort-label">FİYATA GÖRE AZALAN</label>
                </div>
            </div>
            <input type="hidden" name="paged" value="1">
            <?php 
            // Diğer GET parametrelerini sakla
            foreach ($_GET as $key => $value) {
                if ($key !== 'orderby' && $key !== 'paged') {
                    if (is_array($value)) {
                        foreach ($value as $val) {
                            echo '<input type="hidden" name="' . esc_attr($key) . '[]" value="' . esc_attr($val) . '">';
                        }
                    } else {
                        echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                    }
                }
            }
            ?>
            <button type="submit" class="btn btn-dark w-100 mt-auto sort-apply-btn">GÖRÜNTÜLE</button>
        </form>
    </div>
</div>

<!-- FİLTRE OFFCANVAS -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="filterOffcanvasLabel">FİLTRE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <form id="filterForm" method="get">
            <div class="accordion" id="filterAccordion">
                <?php
                // Dinamik olarak nitelikleri al
                $attribute_taxonomies = wc_get_attribute_taxonomies();
                $current_filters = array(
                    'renk' => isset($_GET['filter_renk']) ? (array)$_GET['filter_renk'] : array(),
                    'beden' => isset($_GET['filter_beden']) ? (array)$_GET['filter_beden'] : array(),
                    'ozellik' => isset($_GET['filter_ozellik']) ? (array)$_GET['filter_ozellik'] : array(),
                    'stil' => isset($_GET['filter_stil']) ? (array)$_GET['filter_stil'] : array(),
                );
                
                foreach ($attribute_taxonomies as $attribute) {
                    $taxonomy_name = 'pa_' . $attribute->attribute_name;
                    
                    // Sadece istediğimiz nitelikleri göster
                    if (!in_array($attribute->attribute_name, array('renk', 'beden', 'ozellik', 'stil'))) {
                        continue;
                    }
                    
                    $terms = get_terms(array(
                        'taxonomy' => $taxonomy_name,
                        'hide_empty' => true,
                        'orderby' => $attribute->attribute_orderby,
                    ));
                    
                    if (empty($terms) || is_wp_error($terms)) {
                        continue;
                    }
                    
                    $attribute_label = $attribute->attribute_label ?: ucfirst($attribute->attribute_name);
                    $filter_key = 'filter_' . $attribute->attribute_name;
                    ?>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($attribute->attribute_name); ?>">
                                <?php echo esc_html($attribute_label); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo esc_attr($attribute->attribute_name); ?>" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                            <div class="accordion-body">
                                <?php foreach ($terms as $term): 
                                    $is_checked = in_array($term->slug, $current_filters[$attribute->attribute_name]);
                                ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" 
                                           id="<?php echo esc_attr($attribute->attribute_name . '_' . $term->slug); ?>" 
                                           name="<?php echo esc_attr($filter_key); ?>[]" 
                                           value="<?php echo esc_attr($term->slug); ?>"
                                           <?php echo $is_checked ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="<?php echo esc_attr($attribute->attribute_name . '_' . $term->slug); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            
            <?php 
            // Diğer GET parametrelerini sakla
            foreach ($_GET as $key => $value) {
                if ($key !== 'filter_renk' && $key !== 'filter_beden' && $key !== 'filter_ozellik' && $key !== 'filter_stil' && $key !== 'paged') {
                    if (is_array($value)) {
                        foreach ($value as $val) {
                            echo '<input type="hidden" name="' . esc_attr($key) . '[]" value="' . esc_attr($val) . '">';
                        }
                    } else {
                        echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                    }
                }
            }
            ?>
        </form>
    </div>

    <div class="offcanvas-footer px-3 pb-3 pt-2 border-top filter-footer">
        <button type="button" class="btn btn-clear" onclick="clearAllFilters()">Tüm Filtreleri Temizle</button>
        <button type="button" class="btn btn-apply" onclick="document.getElementById('filterForm').submit()" data-bs-dismiss="offcanvas">Ürünleri Göster</button>
    </div>
</div>

<!-- ===== ÜRÜNLER GRID ===== -->
<div class="container-fluid px-0">
    <div class="row g-0 mx-0">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php 
                global $product;
                if ( ! $product ) {
                    continue;
                }
                ?>
                
                <div class="col-6 col-md-4 col-lg-3 px-1 px-sm-2 px-md-3">
                    <div class="product-card h-100 position-relative border-0">
                        <div class="product-image position-relative overflow-hidden bg-light">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="d-block">
                                <?php echo $product->get_image('woocommerce_thumbnail', array('class' => 'img-fluid')); ?>
                            </a>
                        </div>
                        
                        <div class="product-info p-3 pt-2">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="text-decoration-none text-dark">
                                <h3 class="product-title fs-6 fw-normal mb-1 lh-sm">
                                    <?php echo get_the_title(); ?>
                                </h3>
                            </a>
                            
                            <div class="product-price mt-2">
                                <span class="price fw-bold">
                                    <?php echo $product->get_price_html(); ?>
                                </span>
                            </div>
                        </div>
                        
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="stretched-link"></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12">
                <?php wc_no_products_found(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Sayfalama -->
<div class="container mt-5">
    <?php do_action( 'woocommerce_after_shop_loop' ); ?>
</div>

<!-- Footer -->
<?php get_template_part( 'footer-prestige' ); ?>

<!-- JavaScript Fonksiyonları -->
<script type="text/javascript">
    function clearAllFilters() {
        // Tüm checkbox'ları kaldır
        var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        
        // URL'den filtre parametrelerini kaldır
        var newUrl = window.location.pathname;
        var urlParams = new URLSearchParams(window.location.search);
        
        var preservedParams = {};
        
        for (const [key, value] of urlParams) {
            if (key !== 'filter_renk' && key !== 'filter_beden' && key !== 'filter_ozellik' && key !== 'filter_stil') {
                preservedParams[key] = value;
            }
        }
        
        var params = new URLSearchParams();
        
        for (const [key, value] of Object.entries(preservedParams)) {
            params.append(key, value);
        }
        
        if (params.toString()) {
            newUrl += '?' + params.toString();
        }
        
        window.location.href = newUrl;
    }
</script>

<?php get_footer(); ?>

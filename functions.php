<?php
/**
 * Revareva Child Theme functions and definitions
 */

// Child theme için gerekli fonksiyonlar buraya eklenecek

// WooCommerce eylemlerini özelleştirme
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Remove default gallery actions to prevent conflicts
remove_action( 'woocommerce_before_single_product_summary', 'custom_product_images', 20 );

// Yeni eylemleri ekleme
// Not: custom_product_images fonksiyonu artık content-single-product.php dosyasında özel olarak ele alınıyor

// WooCommerce ilgili ürünler bölümünü özelleştir
function custom_related_products_section() {
    global $product;
    
    // Ürün sayfasında değilse çık
    if ( ! is_product() || ! is_object( $product ) ) {
        return;
    }
    
    // İlgili ürünleri cache'le - performans için
    $cache_key = 'related_products_' . $product->get_id();
    $related_products = wp_cache_get( $cache_key, 'related_products' );
    
    if ( false === $related_products ) {
        $related_products = wc_get_related_products( $product->get_id(), 8 );
        wp_cache_set( $cache_key, $related_products, 'related_products', 1 * HOUR_IN_SECONDS );
    }
    
    if ( $related_products ) {
        $carousel_items = array_chunk( $related_products, 4 );
        ?>
        <section class="related-products py-5 mt-5">
            <div class="container-fluid py-1">
                <h2 class="text-uppercase fw-medium mb-5 fs-5">Sevebileceğiniz Ürünler</h2>

                <div id="relatedCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
                    <div class="carousel-inner">
                        <?php
                        $active_class = 'active';
                        foreach ( $carousel_items as $index => $product_ids ) {
                            ?>
                            <div class="carousel-item <?php echo $active_class; ?>">
                                <div class="row g-0">
                                    <?php
                                    foreach ( $product_ids as $product_id ) {
                                        $related_product = wc_get_product( $product_id );
                                        if ( $related_product && $related_product->is_visible() ) {
                                            ?>
                                            <div class="col-6 col-lg-3 mb-4">
                                                <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="text-decoration-none text-dark">
                                                    <div class="ratio ratio-1x1">
                                                        <?php echo wp_kses_post( $related_product->get_image( 'woocommerce_thumbnail' ) ); ?>
                                                    </div>

                                                    <div class="pt-3">
                                                        <h6 class="product-name text-uppercase mb-1">
                                                            <?php echo esc_html( $related_product->get_name() ); ?>
                                                        </h6>

                                                        <div class="product-price text-start">
                                                            <?php
                                                            $price_html = $related_product->get_price_html();
                                                            echo wp_kses_post( $price_html );
                                                            ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            $active_class = '';
                        }
                        ?>
                    </div>

                    <!-- Carousel Okları -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#relatedCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Önceki</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#relatedCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sonraki</span>
                    </button>
                </div>
            </div>
        </section>
        <?php
    }
}

// WooCommerce ilgili ürünler bölümünü özelleştir
add_action( 'woocommerce_after_single_product_summary', 'custom_related_products_section', 15 );

// Offcanvas açıklamalarını ekleyen fonksiyon
function add_product_offcanvas_elements() {
    if ( is_product() ) {
        global $post;
        if ( ! $post ) {
            return;
        }
        
        $content = get_post_meta( $post->ID, '_content_info', true );
        $care = get_post_meta( $post->ID, '_care_info', true );
        $shipping = get_post_meta( $post->ID, '_shipping_info', true );
        $returns = get_post_meta( $post->ID, '_returns_info', true );
        
        $content = !empty($content) ? esc_html($content) : 'Ürün içeriği bilgisi bulunmamaktadır.';
        $care = !empty($care) ? esc_html($care) : 'Ürün bakım önerisi bulunmamaktadır.';
        $shipping = !empty($shipping) ? esc_html($shipping) : 'Teslimat bilgisi bulunmamaktadır.';
        $returns = !empty($returns) ? esc_html($returns) : 'İade bilgisi bulunmamaktadır.';
        
        $product_content = get_the_content(null, false, $post);
        
        echo '<!-- Offcanvas açıklamaları -->
        <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="urunAciklamasiOffcanvas" aria-labelledby="urunAciklamasiLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="urunAciklamasiLabel">ÜRÜN AÇIKLAMASI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">' . wp_kses_post($product_content) . '</div>
        </div>

        <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="icerikOffcanvas" aria-labelledby="icerikLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="icerikLabel">İÇERİK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">' . $content . '</div>
        </div>

        <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="bakimOnerisiOffcanvas" aria-labelledby="bakimOnerisiLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="bakimOnerisiLabel">BAKIM ÖNERİSİ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">' . $care . '</div>
        </div>

        <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="teslimatOffcanvas" aria-labelledby="teslimatLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="teslimatLabel">TESLİMAT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">' . $shipping . '</div>
        </div>

        <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="iadeOffcanvas" aria-labelledby="iadeLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="iadeLabel">İADE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">' . $returns . '</div>
        </div>';
    }
}

// Offcanvas açıklamalarını ekle
add_action( 'wp_footer', 'add_product_offcanvas_elements' );

// Gerekli JavaScript kodlarını ekleyen fonksiyon
function add_product_page_scripts() {
    if ( is_product() ) {
        wp_add_inline_script( 'bootstrap-js', '
            document.addEventListener("DOMContentLoaded", () => {
                const thumbnails = document.querySelectorAll(".thumbnail");
                const images = document.querySelectorAll(".gallery-image");

                if (thumbnails.length === 0 || images.length === 0) return;

                // Thumbnail tıklama → ilgili görsele geç
                thumbnails.forEach((thumb) => {
                    thumb.addEventListener("click", () => {
                        const index = parseInt(thumb.dataset.index);

                        // Aktif sınıfı güncelle
                        thumbnails.forEach((t) => t.classList.remove("active"));
                        thumb.classList.add("active");

                        // Görselleri güncelle
                        images.forEach((img) => img.classList.remove("active"));
                        images[index].classList.add("active");
                    });
                });

                // Sayfa açılışında ilk thumbnail ve ilk görsel aktif
                if (thumbnails.length > 0) {
                    thumbnails[0].classList.add("active");
                }
                if (images.length > 0) {
                    images[0].classList.add("active");
                }
            });
        ');
    }
}

// JavaScript kodlarını ekle
add_action( 'wp_footer', 'add_product_page_scripts' );

// Gerekli CSS stillerini ekleyen fonksiyon
function add_product_page_styles() {
    if ( is_product() ) {
        wp_add_inline_style( 'bootstrap-css', '
            .product-main {
                padding-top: 50px;
            }
            
            .product-main .row {
                display: flex;
                align-items: stretch;
                width: 100%;
            }
            
            .product-gallery-container {
                display: flex;
                align-items: stretch;
                min-height: 500px;
            }
            
            .product-gallery {
                height: 100%;
                min-height: 500px;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                flex: 1;
            }
            
            .gallery-images-container {
                flex: 1;
                position: relative;
                min-height: 400px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .gallery-image {
                width: 100%;
                height: 100%;
                object-fit: contain;
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            
            .gallery-image.active {
                opacity: 1;
                z-index: 1;
            }
            
            .thumbnails-container {
                position: relative;
                padding: 10px 0;
                max-height: 150px;
                overflow-y: auto;
            }
            
            .thumbnails {
                display: flex;
                flex-direction: row;
                gap: 10px;
                padding: 5px;
            }
            
            .thumbnail {
                width: 60px;
                height: 60px;
                object-fit: cover;
                cursor: pointer;
                border: 2px solid transparent;
                transition: border-color 0.3s ease;
            }
            
            .thumbnail.active {
                border-color: #000;
            }
            
            .product-details {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }
            
            /* Küçük ekranlarda da eşitleme */
            @media (max-width: 768px) {
                .product-main .row {
                    flex-direction: column;
                }
                
                .product-gallery-container {
                    min-height: 400px;
                }
                
                .product-gallery {
                    min-height: 400px;
                }
                
                .gallery-image {
                    min-height: 400px;
                }
            }
            
            .thumbnail {
                width: 60px;
                height: 60px;
                object-fit: cover;
                cursor: pointer;
                border: 2px solid transparent;
            }
            
            .thumbnail.active {
                border-color: #000;
            }
            
            .product-details {
                background-color: #fff;
                padding: 2rem !important;
            }
            
            .related-products .carousel-item {
                display: flex;
            }
            
            .related-products .carousel-item .row {
                width: 100%;
            }
        ');
    }
}

// CSS stillerini ekle
add_action( 'wp_enqueue_scripts', 'add_product_page_styles' );

// Bootstrap ve Font Awesome kütüphanelerini yükle
function load_bootstrap_fa() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    
    // Child theme CSS
    wp_enqueue_style('child-custom-css', get_stylesheet_directory_uri() . '/assets/css/child-custom.css', array('bootstrap-css'), '1.0.0');
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);
}
add_action('wp_enqueue_scripts', 'load_bootstrap_fa');

// Child theme özel JavaScript dosyasını yükle
function enqueue_child_custom_scripts() {
    wp_enqueue_script(
        'child-custom-js',
        get_stylesheet_directory_uri() . '/assets/js/child-custom.js',
        array('jquery'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_child_custom_scripts');

// WooCommerce ürün galerisini özelleştir
function custom_product_images() {
    global $product;
    ?>
    <div class="product-gallery">
        <div class="gallery-images-container">
            <?php
            $attachment_ids = $product->get_gallery_image_ids();
            $featured_image_id = get_post_thumbnail_id( $product->get_id() );
            
            // Ana görsel
            if ( $featured_image_id ) {
                $image_src = wp_get_attachment_image_src( $featured_image_id, 'large' );
                if ( $image_src ) {
                    ?>
                    <img src="<?php echo esc_url( $image_src[0] ); ?>" class="gallery-image active" data-index="0" alt="Ana Görsel" />
                    <?php
                }
            }
            
            // Galeri görselleri
            $index = 1;
            foreach ( $attachment_ids as $attachment_id ) {
                $image_src = wp_get_attachment_image_src( $attachment_id, 'large' );
                if ( $image_src ) {
                    ?>
                    <img src="<?php echo esc_url( $image_src[0] ); ?>" class="gallery-image" data-index="<?php echo $index; ?>" alt="Galeri Görsel <?php echo $index; ?>" />
                    <?php
                    $index++;
                }
            }
            ?>
        </div>
        
        <!-- Thumbnail'lar -->
        <div class="thumbnails-container">
            <div class="thumbnails d-flex flex-column gap-3">
                <?php
                $thumb_index = 0;
                if ( $featured_image_id ) {
                    $thumb_src = wp_get_attachment_image_src( $featured_image_id, 'thumbnail' );
                    if ( $thumb_src ) {
                        ?>
                        <img src="<?php echo esc_url( $thumb_src[0] ); ?>" class="thumbnail active" data-index="0" alt="Thumb <?php echo $thumb_index; ?>" />
                        <?php
                    }
                }
                
                foreach ( $attachment_ids as $attachment_id ) {
                    $thumb_src = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
                    if ( $thumb_src ) {
                        $thumb_index++;
                        ?>
                        <img src="<?php echo esc_url( $thumb_src[0] ); ?>" class="thumbnail" data-index="<?php echo $thumb_index; ?>" alt="Thumb <?php echo $thumb_index; ?>" />
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

// WooCommerce ürün bilgilerini özelleştir
function custom_product_summary() {
    global $product;
    ?>
    <div class="d-flex justify-content-between align-items-start mb-4">
        <h1 class="fs-4 text-uppercase fw-bold mb-0">
            <?php echo esc_html( get_the_title() ); ?>
        </h1>

        <!-- Kalp ikonuna tıklandığında favorilere ekle / favoriler sayfasına git -->
        <a href="favorites.html" class="text-dark" title="Favorilere Ekle">
            <i class="fa-regular fa-heart fs-4 hover-text-danger"></i>
        </a>
    </div>

    <div class="mb-5">
        <span class="fs-3 fw-bold">
            <?php echo wp_kses_post( $product->get_price_html() ); ?>
        </span>
        <?php
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();
        if ( $regular_price && $sale_price && $regular_price > $sale_price ) {
            $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
            ?>
            <span class="fs-5 text-muted text-decoration-line-through ms-3"><?php echo wc_price( $regular_price ); ?></span>
            <span class="fs-5 text-danger ms-3">-<?php echo $discount; ?>%</span>
            <?php
        }
        ?>
    </div>

    <?php
    // Renk seçimi
    $renk_attribute = 'pa_renk'; // WooCommerce renk özelliği
    if ( taxonomy_exists( $renk_attribute ) ) {
        $terms = get_the_terms( get_the_ID(), $renk_attribute );
        if ( $terms && ! is_wp_error( $terms ) ) {
            ?>
            <div class="mb-4">
                <h3 class="text-uppercase mb-3">Renk</h3>
                <div class="d-flex gap-3">
                    <?php
                    foreach ( $terms as $term ) {
                        // Renk kodunu term meta'dan al
                        $color_value = get_term_meta( $term->term_id, 'product_attribute_color', true );
                        if ( ! $color_value ) {
                            $color_value = '#cccccc'; // Varsayılan renk
                        }
                        ?>
                        <div class="border rounded" style="width: 40px; height: 40px; background-color: <?php echo esc_attr( $color_value ); ?>; cursor: pointer;"
                            data-term-id="<?php echo esc_attr( $term->term_id ); ?>"
                            data-term-name="<?php echo esc_attr( $term->name ); ?>"
                            title="<?php echo esc_attr( $term->name ); ?>">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <?php
    // Beden seçimi
    $beden_attribute = 'pa_beden'; // WooCommerce beden özelliği
    if ( taxonomy_exists( $beden_attribute ) ) {
        $terms = get_the_terms( get_the_ID(), $beden_attribute );
        if ( $terms && ! is_wp_error( $terms ) ) {
            ?>
            <div class="mb-5">
                <h3 class="text-uppercase mb-3">Beden</h3>
                <select class="form-select w-50" name="pa_beden">
                    <option value="">Beden Seçiniz</option>
                    <?php
                    foreach ( $terms as $term ) {
                        ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <?php
        }
    }
    ?>

    <?php
    // WooCommerce sepete ekle formu
    woocommerce_template_single_add_to_cart();
    ?>

    <div class="border-top pt-4">
        <a href="#" class="d-block py-3 text-uppercase text-decoration-none" data-bs-toggle="offcanvas"
            data-bs-target="#urunAciklamasiOffcanvas">Ürün Açıklaması</a>
        <a href="#" class="d-block py-3 text-uppercase text-decoration-none" data-bs-toggle="offcanvas"
            data-bs-target="#icerikOffcanvas">İçerik</a>
        <a href="#" class="d-block py-3 text-uppercase text-decoration-none" data-bs-toggle="offcanvas"
            data-bs-target="#bakimOnerisiOffcanvas">Bakım Önerisi</a>
        <a href="#" class="d-block py-3 text-uppercase text-decoration-none" data-bs-toggle="offcanvas"
            data-bs-target="#teslimatOffcanvas">Teslimat</a>
        <a href="#" class="d-block py-3 text-uppercase text-decoration-none" data-bs-toggle="offcanvas"
            data-bs-target="#iadeOffcanvas">İade</a>
    </div>
    <?php
}
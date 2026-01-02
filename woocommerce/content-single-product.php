<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="product-main pt-5">
    <div class="row g-0">
        <!-- Sol: Fotoğraf Gallery -->
        <div class="col-md-6 position-relative">
            <div class="product-gallery">
                <?php
                global $product;
                $attachment_ids = $product->get_gallery_image_ids();
                $image_id = $product->get_image_id();
                
                // Ana görseli göster
                $image_url = wp_get_attachment_image_src($image_id, 'large');
                if ($image_url) {
                    echo '<img src="' . esc_url($image_url[0]) . '" class="w-100 main-product-image" style="object-fit: contain; max-height: 100%;" alt="Product Image" data-index="main"/>';
                } else {
                    echo '<img src="' . wc_placeholder_img_src('large') . '" class="w-100 main-product-image" style="object-fit: contain; max-height: 100%;" alt="Product Image" data-index="main"/>';
                }
                
                // Galeri görsellerini ekle (gizli olarak)
                if ($attachment_ids && count($attachment_ids) > 0) {
                    foreach ($attachment_ids as $attachment_id) {
                        $gallery_image_url = wp_get_attachment_image_src($attachment_id, 'large');
                        if ($gallery_image_url) {
                            echo '<img src="' . esc_url($gallery_image_url[0]) . '" class="gallery-image-hidden" style="display: none;" alt="Gallery Image" data-index="' . $attachment_id . '"/>';
                        }
                    }
                }
                ?>
            </div>

            <!-- Thumbnail'lar -->
            <div class="thumbnails position-absolute bottom-0 start-0 p-4 d-flex flex-column gap-3 z-3">
                <?php
                global $product;
                $attachment_ids = $product->get_gallery_image_ids();
                $image_id = $product->get_image_id();
                
                // Ana görseli önce ekleyelim
                $image_url = wp_get_attachment_image_src($image_id, 'woocommerce_thumbnail');
                if ($image_url) {
                    echo '<img src="' . esc_url($image_url[0]) . '" class="thumbnail active" data-index="main" alt="Thumb" onclick="changeMainImage(this)" style="cursor: pointer; width: 80px; height: 80px; object-fit: cover;"/>';
                }
                
                if ($attachment_ids && count($attachment_ids) > 0) {
                    foreach ($attachment_ids as $attachment_id) {
                        $thumbnail_url = wp_get_attachment_image_src($attachment_id, 'woocommerce_thumbnail');
                        if ($thumbnail_url) {
                            echo '<img src="' . esc_url($thumbnail_url[0]) . '" class="thumbnail" data-index="' . $attachment_id . '" alt="Thumb" onclick="changeMainImage(this)" style="cursor: pointer; width: 80px; height: 80px; object-fit: cover;"/>';
                        }
                    }
                }
                ?>
            </div>
        </div>

        <!-- Sağ: Ürün Detayları -->
        <div class="col-md-6 bg-white p-5 product-details">
            <?php
            global $product;
            
            // Ürün Adı
            echo '<div class="d-flex justify-content-between align-items-start mb-4">';
            echo '<h1 class="fs-4 text-uppercase fw-bold mb-0">' . esc_html(get_the_title()) . '</h1>';
            
            // Favori Ikonu
            echo '<a href="#" class="text-dark" title="Favorilere Ekle">';
            echo '<i class="fa-regular fa-heart fs-4 hover-text-danger"></i>';
            echo '</a>';
            echo '</div>';
            
            // Fiyat Bilgileri
            echo '<div class="mb-5">';
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();
            
            if ($sale_price && $sale_price !== $regular_price) {
                $discount_percent = round(((float)$regular_price - (float)$sale_price) / (float)$regular_price * 100);
                echo '<span class="fs-3 fw-bold">' . wc_price($sale_price) . '</span>';
                echo '<span class="fs-5 text-muted text-decoration-line-through ms-3">' . wc_price($regular_price) . '</span>';
                echo '<span class="fs-5 text-danger ms-3">-' . $discount_percent . '%</span>';
            } else {
                echo '<span class="fs-3 fw-bold">' . wc_price($regular_price ? $regular_price : $sale_price) . '</span>';
            }
            echo '</div>';
            
            // Renk Seçimi
            echo '<div class="mb-4">';
            echo '<h3 class="text-uppercase mb-3">Renk</h3>';
            echo '<div class="d-flex gap-3">';
            echo '<div class="border rounded" style="width: 40px; height: 40px; background-color: navy; cursor: pointer;"></div>';
            echo '</div>';
            echo '</div>';
            
            // Beden Seçimi
            echo '<div class="mb-5">';
            echo '<h3 class="text-uppercase mb-3">Beden</h3>';
            
            if ($product->is_type('variable')) {
                echo '<select class="form-select w-50" name="product-variation">';
                $available_variations = $product->get_available_variations();
                foreach ($available_variations as $variation) {
                    $variation_id = $variation['variation_id'];
                    $variation_data = wc_get_product($variation_id);
                    $attributes = $variation_data->get_attributes();
                    foreach ($attributes as $attr => $value) {
                        if (strpos($attr, 'pa_beden') !== false || strpos($attr, 'size') !== false) {
                            echo '<option value="' . esc_attr($value) . '">' . esc_html($value) . '</option>';
                        }
                    }
                }
                echo '</select>';
            } else {
                echo '<select class="form-select w-50">';
                echo '<option>XS</option>';
                echo '<option>S</option>';
                echo '<option>M</option>';
                echo '<option>L</option>';
                echo '<option>XL</option>';
                echo '</select>';
            }
            
            echo '</div>';
            
            // Sepete Ekle Butonu
            echo '<button class="btn btn-dark w-50 py-3 mb-5 text-uppercase fw-medium">Sepete Ekle</button>';
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
        </div>
    </div>
</div>

<?php
// WooCommerce ürün açıklamaları ve diğer sekmeler
do_action( 'woocommerce_after_single_product_summary' );
?>
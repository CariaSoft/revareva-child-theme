<?php get_header(); // Tek çağrı – header.php içindeki koşul karar verir ?>

<main class="main-content pt-5">
    <div class="container-fluid">

        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav py-4 border-bottom bg-light">
            <div class="container">
                <?php woocommerce_breadcrumb(array(
                    'delimiter' => ' / ',
                    'wrap_before' => '<ol class="breadcrumb mb-0">',
                    'wrap_after' => '</ol>',
                    'before' => '<li class="breadcrumb-item">',
                    'after' => '</li>',
                    'home' => 'Anasayfa'
                )); ?>
            </div>
        </nav>

        <!-- Kategori Başlık ve Açıklama -->
        <div class="category-header py-5 text-center bg-light">
            <div class="container">
                <h1 class="display-5 fw-bold mb-3"><?php woocommerce_page_title(); ?></h1>
                <?php if (term_description()) : ?>
                    <div class="lead text-muted max-w-800 mx-auto">
                        <?php echo term_description(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Ürünler Grid -->
        <div class="container py-5">
            <?php if (woocommerce_product_loop()) : ?>
                <div class="row g-4">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php endwhile; ?>
                </div>

                <!-- Sayfalama -->
                <div class="pagination-wrapper py-5 text-center">
                    <?php woocommerce_pagination(); ?>
                </div>
            <?php else : ?>
                <p class="text-center py-5">Bu kategoride ürün bulunmamaktadır.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_template_part('footer-prestige'); ?>

<?php get_footer(); ?>
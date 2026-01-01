<?php
/**
 * Header - White (Shop / Category / Product)
 */
?>

<?php get_template_part('template-parts/announcement-bar'); ?>

<header id="mainHeader" class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
    <div class="container-fluid px-1 px-sm-2 px-md-3 px-lg-4 px-xl-4 mt-2">

        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo home_url(); ?>">
            <?php
            $dark_logo_id = get_theme_mod('dark_logo') ?: get_theme_mod('custom_logo');
            $dark_url = $dark_logo_id
                ? wp_get_attachment_image_src($dark_logo_id, 'full')[0]
                : get_template_directory_uri() . '/assets/img/caria-logo-siyah.png';
            ?>
            <img src="<?php echo esc_url($dark_url); ?>" alt="<?php bloginfo('name'); ?> Logo" height="40">
        </a>

        <!-- Menü -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'navbar-nav ms-auto me-2 me-lg-3 gap-3 gap-lg-4 text-uppercase fw-medium',
                'fallback_cb'    => '__return_false',
                'depth'          => 2,
                'walker'         => new bootstrap_5_wp_nav_menu_walker(),
            ]);
            ?>
        </div>

        <!-- Sağ ikonlar -->
        <div class="d-flex align-items-center gap-2 gap-sm-3 header-icons ms-auto">
            <a href="#" class="text-dark" data-bs-toggle="offcanvas" data-bs-target="#searchOffcanvas">
                <i class="fas fa-search fs-5"></i>
            </a>
            <a href="#" class="text-dark" data-bs-toggle="offcanvas" data-bs-target="#accountOffcanvas">
                <i class="fa-regular fa-user fs-5"></i>
            </a>
            <a href="#" class="text-dark" data-bs-toggle="offcanvas" data-bs-target="#favoritesOffcanvas">
                <i class="fa-regular fa-heart fs-5"></i>
            </a>
            <a href="#" class="text-dark position-relative" data-bs-toggle="offcanvas" data-bs-target="#accountOffcanvas" data-bs-tab="cart">
                <i class="fa-solid fa-bag-shopping fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger small">
                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
            </a>

            <button class="navbar-toggler border-0 d-lg-none" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

    </div>
</header>

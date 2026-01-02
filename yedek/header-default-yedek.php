<?php
/**
 * Header - Default (Ana Sayfa / Diğer)
 */
?>

<?php get_template_part('template-parts/announcement-bar'); ?>

<!-- Default Header – Transparan arka plan, beyaz logo/icon/link'ler -->
<header id="mainHeader" class="navbar navbar-expand-lg fixed-top navbar-dark bg-transparent">
    <div class="container-fluid px-1 px-sm-2 px-md-3 px-lg-4 px-xl-5 mt-2">
        <!-- Logo (beyaz versiyon, height=40) -->
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php
            $light_logo_id = get_theme_mod( 'light_logo' ); // Açık Arka Plan Logosu (Beyaz)
            $light_url = $light_logo_id ? wp_get_attachment_image_url( $light_logo_id, 'full' ) : get_stylesheet_directory_uri() . '/assets/img/caria-logo.png';
            $dark_logo_id = get_theme_mod( 'dark_logo' ); // Yedek siyah logo
            $dark_url = $dark_logo_id ? wp_get_attachment_image_url( $dark_logo_id, 'full' ) : get_stylesheet_directory_uri() . '/assets/img/caria-logo-siyah.png';
            ?>
            <img src="<?php echo esc_url( $light_url ); ?>" alt="<?php bloginfo( 'name' ); ?> Logo" class="logo-white" height="40" />
            <img src="<?php echo esc_url( $dark_url ); ?>" alt="<?php bloginfo( 'name' ); ?> Logo" class="logo-dark d-none" height="40" />
        </a>

        <!-- Menü (beyaz linkler) -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'navbar-nav ms-auto me-2 me-lg-3 gap-3 gap-lg-4 text-uppercase fw-medium',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new Bootstrap_5_Wp_Nav_Menu_Walker()
            ) );
            ?>
        </div>

        <!-- Sağ İkonlar (beyaz iconlar) -->
        <div class="d-flex align-items-center gap-2 gap-sm-3 header-icons ms-auto">
            <a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#searchOffcanvas">
                <i class="fas fa-search fs-5"></i>
            </a>
            <a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#accountOffcanvas">
                <i class="fa-regular fa-user fs-5"></i>
            </a>
            <a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#favoritesOffcanvas">
                <i class="fa-regular fa-heart fs-5"></i>
            </a>
            <a href="#" class="text-white position-relative" data-bs-toggle="offcanvas" data-bs-target="#accountOffcanvas" data-bs-tab="cart">
                <i class="fa-solid fa-bag-shopping fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger small">
                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
            </a>
            <button class="navbar-toggler border-0 d-lg-none text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
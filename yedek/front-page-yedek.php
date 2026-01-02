<?php get_header(); ?>

<!-- Slider -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
  <div class="carousel-indicators">
    <?php for ($i = 1; $i <= 5; $i++) {
        if (get_theme_mod("slider_image_$i")) {
            echo '<button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="' . ($i-1) . '" ' . ($i==1 ? 'class="active"' : '') . '></button>';
        }
    } ?>
  </div>

  <div class="carousel-inner">
    <?php 
    $active = true;
    for ($i = 1; $i <= 5; $i++) {
        $image_id = get_theme_mod("slider_image_$i");
        if ($image_id) {
            $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
            $title = strtoupper(get_theme_mod("slider_title_$i"));
            $button_text = strtoupper(get_theme_mod("slider_button_text_$i", 'KEŞFET'));
            $link = get_theme_mod("slider_link_$i");
            ?>
            <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                <img src="<?php echo esc_url($image_url); ?>" class="d-block w-100" alt="<?php echo esc_attr($title); ?>" />
                <div class="carousel-caption d-none d-md-block">
                    <?php if ($title) echo '<h5 class=" fw-bold">' . esc_html($title) . '</h5>'; ?>
                    <?php if ($link) echo '<a href="' . esc_url($link) . '" class="btn btn-slider btn-lg text-uppercase fw-semibold">' . esc_html($button_text) . '</a>'; ?>
                </div>
            </div>
            <?php $active = false;
        }
    } ?>
  </div>

  <!-- Kontroller -->
  <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden"><?php _e('Önceki', 'revareva'); ?></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden"><?php _e('Sonraki', 'revareva'); ?></span>
  </button>
</div>

<!-- Dörtlü Blok -->
<section class="dortlu-blok">
  <div class="container-fluid p-0">
    <div class="row g-1">
      <?php for ($i = 1; $i <= 4; $i++) {
          $image_id = get_theme_mod("quad_image_$i");
          $title = strtoupper(get_theme_mod("quad_title_$i"));
          $link = get_theme_mod("quad_link_$i");

          if ($image_id) {
              $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
              ?>
              <div class="col-12 col-sm-6 col-lg-3">
                  <div class="product-block-item position-relative overflow-hidden">
                      <?php if ($link) echo '<a href="' . esc_url($link) . '">'; ?>
                          <img src="<?php echo esc_url($image_url); ?>" class="w-100 h-100 object-fit-cover" alt="<?php echo esc_attr($title); ?>" />
                      <?php if ($link) echo '</a>'; ?>
                      <div class="product-block-overlay">
                          <?php if ($link) echo '<a href="' . esc_url($link) . '" class="product-block-link">'; ?>
                              <?php echo esc_html($title); ?>
                          <?php if ($link) echo '</a>'; ?>
                      </div>
                  </div>
              </div>
              <?php
          }
      } ?>
    </div>
  </div>
</section>

<!-- İkili Blok -->
<section class="ikili-blok">
  <div class="container-fluid p-0">
    <div class="row g-0">
      <?php for ($i = 1; $i <= 2; $i++) {
          $image_id = get_theme_mod("duo_image_$i");
          $category_title = strtoupper(get_theme_mod("duo_category_title_$i", 'AKSESUAR'));
          $button_text = strtoupper(get_theme_mod("duo_button_text_$i", ($i == 1 ? 'KADIN' : 'ERKEK')));
          $link = get_theme_mod("duo_link_$i");

          if ($image_id) {
              $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
              ?>
              <div class="col-12 col-md-6">
                  <div class="product-block-item position-relative overflow-hidden">
                      <?php if ($link) echo '<a href="' . esc_url($link) . '">'; ?>
                          <img src="<?php echo esc_url($image_url); ?>" class="w-100 h-100 object-fit-cover img-responsive-square" alt="<?php echo esc_attr($category_title); ?>" />
                      <?php if ($link) echo '</a>'; ?>
                      <div class="product-block-overlay">
                          <h5 class="text-white mb-3 fw-bold"><?php echo esc_html($category_title); ?></h5>
                          <?php if ($link) echo '<a href="' . esc_url($link) . '" class="product-block-link">'; ?>
                              <?php echo esc_html($button_text); ?>
                          <?php if ($link) echo '</a>'; ?>
                      </div>
                  </div>
              </div>
              <?php
          }
      } ?>
    </div>
  </div>
</section>

<!-- Prestij Blok -->
<?php get_template_part('footer-prestige'); ?>
<!-- Footer -->
<?php get_footer(); ?>
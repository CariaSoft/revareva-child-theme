     <!-- =========================
     OFFCANVAS MOBİL
     ========================= -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMobileMenu">
      <div class="offcanvas-header border-bottom">
        <a href="<?php echo home_url(); ?>" class="navbar-brand mb-0 mobile-menu-logo">
          <?php 
          $mobile_logo_id = 110; // ← Medya Kütüphanesi'ndeki caria-logo-siyah.png ID'si
          echo wp_get_attachment_image($mobile_logo_id, 'full', false, array('height' => '32', 'alt' => 'Caria Fashion Logo'));
          ?>
        </a>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="<?php _e('Kapat', 'revareva'); ?>"
        ></button>
      </div>
      <div class="offcanvas-body p-0">
        <div class="mobile-menu-wrapper">
          <!-- Seviye 1: Ana Menü -->
          <div class="mobile-menu-panel active" data-menu="root">
            <ul class="mobile-menu-list">
              <li class="mobile-menu-item">
                <button class="mobile-menu-link" type="button" data-menu-target="kadin">
                  <span><?php _e('KADIN', 'revareva'); ?></span>
                  <i class="fas fa-chevron-right mobile-menu-arrow"></i>
                </button>
              </li>
              <li class="mobile-menu-item">
                <button class="mobile-menu-link" type="button" data-menu-target="erkek">
                  <span><?php _e('ERKEK', 'revareva'); ?></span>
                  <i class="fas fa-chevron-right mobile-menu-arrow"></i>
                </button>
              </li>
              <li class="mobile-menu-item">
                <button class="mobile-menu-link" type="button" data-menu-target="cocuk">
                  <span><?php _e('ÇOCUK', 'revareva'); ?></span>
                  <i class="fas fa-chevron-right mobile-menu-arrow"></i>
                </button>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('KOZMETİK', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('MARKALAR', 'revareva'); ?></a>
              </li>
            </ul>

            <ul class="mobile-menu-list mobile-menu-list-secondary">
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('MAĞAZALARIMIZ', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('SIKCA SORULAN SORULAR', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('BİZE ULAŞIN', 'revareva'); ?></a>
              </li>
            </ul>
          </div>

          <!-- Seviye 2: KADIN -->
          <div class="mobile-menu-panel" data-menu="kadin">
            <div class="mobile-menu-top border-bottom">
              <button class="mobile-menu-back" type="button" data-menu-back="root">
                <i class="fas fa-chevron-left"></i>
                <span><?php _e('KADIN', 'revareva'); ?></span>
              </button>
            </div>
            <ul class="mobile-menu-list">
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('YENİ GELENLER', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('GİYİM', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('AYAKKABI', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('ÇANTA', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('AKSESUAR', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple text-danger"><?php _e('İNDİRİM', 'revareva'); ?></a>
              </li>
            </ul>
          </div>

          <!-- Seviye 2: ERKEK -->
          <div class="mobile-menu-panel" data-menu="erkek">
            <div class="mobile-menu-top border-bottom">
              <button class="mobile-menu-back" type="button" data-menu-back="root">
                <i class="fas fa-chevron-left"></i>
                <span><?php _e('ERKEK', 'revareva'); ?></span>
              </button>
            </div>
            <ul class="mobile-menu-list">
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('YENİ GELENLER', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('GİYİM', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('AYAKKABI', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('AKSESUAR', 'revareva'); ?></a>
              </li>
            </ul>
          </div>

          <!-- Seviye 2: ÇOCUK -->
          <div class="mobile-menu-panel" data-menu="cocuk">
            <div class="mobile-menu-top border-bottom">
              <button class="mobile-menu-back" type="button" data-menu-back="root">
                <i class="fas fa-chevron-left"></i>
                <span><?php _e('ÇOCUK', 'revareva'); ?></span>
              </button>
            </div>
            <ul class="mobile-menu-list">
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('KIZ ÇOCUK', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('ERKEK ÇOCUK', 'revareva'); ?></a>
              </li>
              <li class="mobile-menu-item">
                <a href="#" class="mobile-menu-link-simple"><?php _e('BEBEK', 'revareva'); ?></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
     <!-- =========================
     OFFCANVAS 3: FAVORİLER
     ========================= -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="favoritesOffcanvas" aria-labelledby="favoritesOffcanvasLabel">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="favoritesOffcanvasLabel"><?php _e('FAVORİLERİM', 'revareva'); ?></h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <!-- Boş Favori Mesajı -->
        <div class="text-center py-5" id="emptyFavorites">
          <i class="far fa-heart display-1 text-muted mb-3"></i>
          <h5 class="mb-3"><?php _e('FAVORİLERİNİZDE ÜRÜN BULUNMAMAKTADIR', 'revareva'); ?></h5>
          <p class="text-muted"><?php _e('Beğendiğiniz ürünleri favorilere ekleyebilirsiniz.', 'revareva'); ?></p>
        </div>
      </div>
    </div>

    <!-- =========================
     OFFCANVAS 1: HESAP & SEPET
     ========================= -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="accountOffcanvas" aria-labelledby="accountOffcanvasLabel" >
      <div class="offcanvas-header border-bottom">
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body p-0">
        <!-- Sekmeler -->
        <ul class="nav nav-pills nav-fill border-bottom" id="accountTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active rounded-0 text-dark fw-semibold py-3"
              id="account-tab"
              data-bs-toggle="tab"
              data-bs-target="#account-pane"
              type="button"
              role="tab"
            >
              <i class="far fa-circle me-2" style="font-size: 0.6rem"></i>
              <?php _e('HESAP', 'revareva'); ?>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link rounded-0 text-dark fw-semibold py-3"
              id="cart-tab"
              data-bs-toggle="tab"
              data-bs-target="#cart-pane"
              type="button"
              role="tab"
            >
              <i class="far fa-circle me-2" style="font-size: 0.6rem"></i> <?php _e('SEPET', 'revareva'); ?>
            </button>
          </li>
        </ul>

        <!-- Sekme İçerikleri -->
        <div class="tab-content" id="accountTabsContent">
          <!-- HESAP Sekmesi -->
          <div
            class="tab-pane fade show active"
            id="account-pane"
            role="tabpanel"
            aria-labelledby="account-tab"
          >
            <div class="p-4">
              <!-- Giriş Yap / Üye Ol Butonları -->
              <div class="d-flex gap-2 mb-4">
                <button class="btn btn-dark flex-fill fw-semibold" id="loginBtn"><?php _e('Giriş Yap', 'revareva'); ?></button>
                <button class="btn btn-outline-dark flex-fill fw-semibold" id="registerBtn">
                  <?php _e('Üye ol', 'revareva'); ?>
                </button>
              </div>

              <!-- Login Formu -->
              <div id="loginForm">
                <p class="mb-3"><?php _e('E-postanız ile giriş yapın', 'revareva'); ?></p>

                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="<?php _e('E-Posta', 'revareva'); ?>" />
                </div>

                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Şifre" />
                </div>

                <a href="#" class="d-block mb-4 text-dark text-decoration-underline"
                  ><?php _e('Sifremi Unuttum', 'revareva'); ?></a
                >

                <button class="btn btn-dark w-100 py-3 fw-semibold"><?php _e('GİRİŞ YAP', 'revareva'); ?></button>
              </div>

              <!-- Register Formu (Başlangıçta gizli) -->
              <div id="registerForm" style="display: none">
                <p class="mb-3"><?php _e('Yeni hesap oluştur', 'revareva'); ?></p>

                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="<?php _e('Ad Soyad', 'revareva'); ?>" />
                </div>

                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="<?php _e('E-Posta', 'revareva'); ?>" />
                </div>

                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="<?php _e('Şifre', 'revareva'); ?>" />
                </div>

                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="<?php _e('Şifre Tekrar', 'revareva'); ?>" />
                </div>

                <button class="btn btn-dark w-100 py-3 fw-semibold"><?php _e('ÜYE OL', 'revareva'); ?></button>
              </div>
            </div>
          </div>

          <!-- SEPET Sekmesi -->
          <div class="tab-pane fade" id="cart-pane" role="tabpanel" aria-labelledby="cart-tab">
            <div class="p-4">
              <!-- Boş Sepet Mesajı -->
              <div class="text-center py-5" id="emptyCart">
                <i class="fas fa-bag-shopping display-1 text-muted mb-3"></i>
                <h5 class="mb-3"><?php _e('SEPETİNİZDE ÜRÜN BULUNMAMAKTADIR', 'revareva'); ?></h5>
                <p class="text-muted"><?php _e('Alışverişe başlamak için ürünleri kesfedebilirsiniz.', 'revareva'); ?></p>
              </div>

              <!-- Sepet Ürünleri (Orneğin dolu sepet) -->
              <div id="cartItems" style="display: none">
                <!-- Örnek Ürün -->
                <div class="cart-item border-bottom pb-3 mb-3">
                  <div class="row align-items-center">
                    <div class="col-4">
                      <?php 
                      $cart_product_image_id = 116; // ← Örnek ürün fotoğrafı ID
                      echo wp_get_attachment_image($cart_product_image_id, 'woocommerce_thumbnail', false, array('class' => 'img-fluid', 'alt' => 'Ürün'));
                      ?>
                    </div>
                    <div class="col-8">
                      <h6 class="mb-1"><?php _e('Ürün Adı', 'revareva'); ?></h6>
                      <p class="mb-1 small text-muted"><?php _e('Beden: M | Renk: Siyah', 'revareva'); ?></p>
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">₺ 1.250,00</span>
                        <div class="btn-group btn-group-sm">
                          <button class="btn btn-outline-secondary">-</button>
                          <button class="btn btn-outline-secondary disabled">1</button>
                          <button class="btn btn-outline-secondary">+</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Toplam -->
                <div class="border-top pt-3 mt-4">
                  <div class="d-flex justify-content-between mb-2">
                    <span><?php _e('Ara Toplam:', 'revareva'); ?></span>
                    <span class="fw-bold">₺ 1.250,00</span>
                  </div>
                  <button class="btn btn-dark w-100 py-3 fw-semibold mt-3"><?php _e('SEPETE GİT', 'revareva'); ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- =========================
     OFFCANVAS 2: ARAMA
     ========================= -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="searchOffcanvas" aria-labelledby="searchOffcanvasLabel">
      <div class="offcanvas-header border-bottom">
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <!-- Arama Input -->
        <div class="mb-4">
          <div class="input-group input-group-lg">
            <span class="input-group-text bg-white border-0">
              <i class="fas fa-search"></i>
            </span>
            <input
              type="text"
              class="form-control border-0 border-bottom shadow-none"
              placeholder="<?php _e('ÜRÜN ARAYINIZ...', 'revareva'); ?>"
              id="searchInput"
              autofocus
            />
          </div>
        </div>

        <!-- Popüler Aramalar -->
        <div class="mb-4">
          <h6 class="fw-bold mb-3"><?php _e('POPÜLER ARAMALAR', 'revareva'); ?></h6>
          <div class="d-flex flex-wrap gap-2">
            <a href="#" class="badge bg-light text-dark text-decoration-none py-2 px-3"
              ><?php _e('DIŞ GİYİM', 'revareva'); ?></a
            >
            <a href="#" class="badge bg-light text-dark text-decoration-none py-2 px-3"><?php _e('ELBİSE', 'revareva'); ?></a>
            <a href="#" class="badge bg-light text-dark text-decoration-none py-2 px-3"><?php _e('CEKET', 'revareva'); ?></a>
            <a href="#" class="badge bg-light text-dark text-decoration-none py-2 px-3"><?php _e('PANTOLON', 'revareva'); ?></a>
          </div>
        </div>

        <!-- Arama Sonuçları -->
        <div id="searchResults">
          <h6 class="fw-bold mb-3"><?php _e('ÜRÜNLER', 'revareva'); ?></h6>

          <!-- Örnek Sonuç -->
          <div class="search-result-item border-bottom pb-3 mb-3">
            <div class="row">
              <div class="col-3">
                <?php 
                $search_product_image_id_1 = 117; // ← Örnek ürün fotoğrafı ID
                echo wp_get_attachment_image($search_product_image_id_1, 'woocommerce_thumbnail', false, array('class' => 'img-fluid', 'alt' => 'Ürün'));
                ?>
              </div>
              <div class="col-9">
                <h6 class="mb-1"><?php _e('İçi Kürklü Denim Ceket', 'revareva'); ?></h6>
                <p class="mb-1">
                  <span class="text-decoration-line-through text-muted">₺ 23.650,00</span>
                  <span class="fw-bold ms-2">₺ 16.555,00</span>
                </p>
              </div>
            </div>
          </div>

          <div class="search-result-item border-bottom pb-3 mb-3">
            <div class="row">
              <div class="col-3">
                <?php 
                $search_product_image_id_2 = 118; // ← Örnek ürün fotoğrafı ID
                echo wp_get_attachment_image($search_product_image_id_2, 'woocommerce_thumbnail', false, array('class' => 'img-fluid', 'alt' => 'Ürün'));
                ?>
              </div>
              <div class="col-9">
                <h6 class="mb-1"><?php _e('İnci Biyeli Payet Geçişli Siyah Yelek', 'revareva'); ?></h6>
                <p class="mb-1">
                  <span class="text-decoration-line-through text-muted">₺ 14.580,00</span>
                  <span class="fw-bold ms-2">₺ 10.206,00</span>
                </p>
              </div>
            </div>
          </div>

          <div class="search-result-item border-bottom pb-3 mb-3">
            <div class="row">
              <div class="col-3">
                <?php 
                $search_product_image_id_3 = 119; // ← Örnek ürün fotoğrafı ID
                echo wp_get_attachment_image($search_product_image_id_3, 'woocommerce_thumbnail', false, array('class' => 'img-fluid', 'alt' => 'Ürün'));
                ?>
              </div>
              <div class="col-9">
                <h6 class="mb-1"><?php _e('Ekru Kol Detaylı Lacivert Triko Elbise', 'revareva'); ?></h6>
                <p class="mb-1">
                  <span class="text-decoration-line-through text-muted">₺ 19.115,00</span>
                  <span class="fw-bold ms-2">₺ 13.380,50</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer">
      <div class="footer-main py-5">
        <div class="container-fluid">
          <!-- İlk Satır: Yardım, Kadın, Erkek, Sosyal Medya -->
          <div class="row">
            <!-- YARDIM -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
              <h6 class="footer-heading fw-bold mb-3"><?php _e('YARDIM', 'revareva'); ?></h6>
              <ul class="list-unstyled footer-links">
                <li><a href="#"><?php _e('SIK SORULAN SORULAR', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('BİZİMLE İLETİŞİME GEÇİN', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('BEDEN TABLOSU', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('TESLİMAT VE İADE', 'revareva'); ?></a></li>
              </ul>
            </div>

            <!-- KADIN KOLEKSİYONU -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
              <h6 class="footer-heading fw-bold mb-3"><?php _e('KADIN KOLEKSİYONU', 'revareva'); ?></h6>
              <ul class="list-unstyled footer-links">
                <li><a href="#"><?php _e('KADIN ELBİSE', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('BLUZ & GÖMLEK', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('KADIN ŞORT & ETEK', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('KADIN AYAKKABI', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('KADIN ÇANTA', 'revareva'); ?></a></li>
              </ul>
            </div>

            <!-- ERKEK KOLEKSİYONU -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
              <h6 class="footer-heading fw-bold mb-3"><?php _e('ERKEK KOLEKSİYONU', 'revareva'); ?></h6>
              <ul class="list-unstyled footer-links">
                <li><a href="#"><?php _e('ERKEK GÖMLEK', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('ŞORT & PANTOLON', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('AYAKKABI', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('ERKEK ÇANTA', 'revareva'); ?></a></li>
              </ul>
            </div>

            <!-- SOSYAL MEDYA -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
              <h6 class="footer-heading fw-bold mb-3"><?php _e('SOSYAL MEDYA', 'revareva'); ?></h6>
              <ul class="list-unstyled footer-links">
                <li><a href="#"><?php _e('FACEBOOK', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('INSTAGRAM', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('TİKTOK', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('PİNTEREST', 'revareva'); ?></a></li>
                <li><a href="#"><?php _e('SHOPIFY', 'revareva'); ?></a></li>
              </ul>
            </div>
          </div>

          <!-- İkinci Satır: ETBİS ve E-Bülten -->
          <div class="row">
            <!-- ETBIS -->
            <div class="col-12 col-sm-6 col-md-6 mb-4 mb-md-0">
              <div class="text-start text-md-start mt-4">
                <?php
                $etbis_logo_id = get_theme_mod('etbis_logo');

                if ($etbis_logo_id) {
                    echo wp_get_attachment_image($etbis_logo_id, 'full', false, array(
                        'style' => 'width:120px; height:120px;',
                        'alt'   => 'ETBİS\'e kayıtlıdır'
                    ));
                } else {
                    // Fallback: Tema klasöründen eski logo
                    echo '<img src="' . get_template_directory_uri() . '/assets/img/etbis.png" alt="ETBİS\'e kayıtlıdır" style="width:120px; height:120px;">';
                }
                ?>
              </div>
            </div>

            <!-- E-BÜLTEN -->
            <div class="col-12 col-sm-6 col-md-6">
              <h6 class="footer-heading fw-bold mb-3"><?php _e('E-BÜLTEN', 'revareva'); ?></h6>
              <div class="d-flex mb-3">
                <input type="email" class="form-control" placeholder="<?php _e('E-Posta*', 'revareva'); ?>" />
                <button class="btn btn-dark ms-2"><?php _e('KAYIT OL', 'revareva'); ?></button>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="kvkkCheck" />
                <label class="form-check-label small" for="kvkkCheck">
                  <a href="#" class="text-decoration-underline"
                    ><?php _e('Kişisel Verilerin Korunması Politikasına', 'revareva'); ?></a
                  >
                  <?php _e('istinaden, Aydınlatma Metni kapsamında kimlik ve iletişim verilerimin Revareva tarafından tarafıma iletilecek ürün ve hizmetlerin pazarlanması gereçektirilerek sunulan ürün ve hizmetlerin bağlı, kullanım alışkanlıklarım ve ihtiyaçlarıma göre özelleştirilmesi için ticari elektronik ileti gönderilmesi amacıyla işlenmesini ve bununla sınırlı olmak hizmet alanlarına üçüncü taraflara paylaşılmasını onaylarım.', 'revareva'); ?>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Alt Footer -->
      <div class="footer-bottom py-4 border-top bg-light">
        <div class="container-fluid">
          <div class="row align-items-center">
            <!-- Dil Seçici -->
            <div class="col-12 col-lg-3 mb-3 mb-lg-0 text-center text-lg-start">
              <select class="form-select form-select-sm d-inline-block" style="max-width: 150px;">
                <option selected>TR</option>
                <option value="en">EN</option>
              </select>
            </div>

            <!-- Orta Kısım -->
            <div class="col-12 col-lg-6 text-center mb-3 mb-lg-0">
              <!-- Logo -->
              <?php
              $footer_logo_id = get_theme_mod('dark_logo') ? get_theme_mod('dark_logo') : get_theme_mod('custom_logo');
              if ($footer_logo_id) {
                  echo wp_get_attachment_image($footer_logo_id, 'full', false, array(
                      'height' => '60',
                      'class'  => 'mb-3',
                      'alt'    => 'Caria Fashion Logo'
                  ));
              } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/img/caria-logo-siyah.png" alt="Caria Fashion Logo" height="60" class="mb-3">';
              }
              ?>

              <!-- Ödeme İkonları - Orijinale %100 sadık: çok yakın, tek satır -->
              <div class="payment-icons mb-3">
                <?php
                $payment_icons = array(101,104,102,103); // mastercard, visa, maestro, troy ID'leri
                foreach ($payment_icons as $index => $icon_id) {
                    if ($icon_id) {
                        $margin = ($index < count($payment_icons) - 1) ? 'me-1' : ''; // sadece son ikon hariç 4px boşluk
                        echo wp_get_attachment_image($icon_id, 'full', false, array(
                            'height' => '28',
                            'class'  => 'img-fluid ' . $margin,
                            'alt'    => 'Ödeme Yöntemi'
                        ));
                    }
                }
                ?>
              </div>

              <!-- Copyright -->
              <p class="small mb-0 text-muted">
                Copyright © <?php echo date('Y'); ?> Caria Fashion. Tüm hakları saklıdır.
              </p>
            </div>

            <!-- Sağ Boş Alan -->
            <div class="col-12 col-lg-3"></div>
          </div>
        </div>
      </div>

    </footer>

    <?php wp_footer(); ?>
</body>
</html>
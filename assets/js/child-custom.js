/**
 * Kategori sayfasında scroll efekti kaldırma
 * Header her zaman beyaz, menüler her zaman koyu siyah, logo boşluğu yok
 */
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('#mainHeader');
    if (header && header.classList.contains('bg-white')) {
        // Parent JS'den gelen scroll efektini devre dışı bırak
        header.style.transition = 'none !important';
        header.classList.remove('bg-transparent', 'navbar-light'); // Transparan varsa kaldır
        header.classList.add('bg-white', 'navbar-dark'); // Sabit beyaz ve koyu mod

        // Menü linklerini zorla koyu siyah yap (soluk beyaz efekti kaldır)
        const navLinks = header.querySelectorAll('.navbar-nav .nav-link');
        navLinks.forEach(link => {
            link.style.color = '#000 !important';
            link.style.opacity = '1 !important';
            link.style.transition = 'none !important';
        });

        // Iconları koyu siyah yap
        const icons = header.querySelectorAll('.header-icons a');
        icons.forEach(icon => {
            icon.style.color = '#000 !important';
            icon.style.opacity = '1 !important';
        });

        // Logo boşluğunu önle (eğer varsa)
        const logo = header.querySelector('.navbar-brand img');
        if (logo) {
            logo.style.opacity = '1 !important';
            logo.style.visibility = 'visible !important';
        }
    }
});

// Sayfa scroll olduğunda bile hiçbir şey değişmesin
window.addEventListener('scroll', function() {
    // Boş bırak – hiçbir değişiklik yapma
}, { passive: true });
/**
 * Ana sayfa header scroll efekti
 * Header aşağı kaydırınca beyaz arka plan, siyah içerik olacak
 */
document.addEventListener('DOMContentLoaded', function() {
    // Default header için scroll efekti (ana sayfa ve diğer sayfalar)
    if (!document.body.classList.contains('page-category') && !document.body.classList.contains('page-product') && !document.body.classList.contains('single-product')) {
        let scrolled = false;
        const header = document.querySelector('#mainHeader');
        if (header) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    if (!scrolled) {
                        header.classList.add('scrolled');
                        scrolled = true;
                    }
                } else {
                    if (scrolled) {
                        header.classList.remove('scrolled');
                        scrolled = false;
                    }
                }
            }, { passive: true });
        }
    } else if (document.body.classList.contains('page-category')) {
        // Kategori sayfası: Efekt tamamen kaldır
        const header = document.querySelector('#mainHeaderWhite');
        if (header) {
            header.style.transition = 'none';
            header.classList.remove('bg-transparent');
            header.classList.add('bg-white');
        }
    }
});

// Sıralama fonksiyonu
function applySorting() {
    const selectedRadio = document.querySelector('input[name="orderby"]:checked');
    if (selectedRadio) {
        const orderby = selectedRadio.value;
        let order = 'asc';
        
        if (orderby === 'price-desc') {
            order = 'desc';
        }
        
        document.getElementById('orderValue').value = order;
        document.getElementById('sortForm').submit();
    }
}

// Filtreleme fonksiyonu
function applyFilters() {
    // URL'yi oluştur
    let url = new URL(window.location.href);
    
    // Seçili renk filtrelerini ekle
    const colorCheckboxes = document.querySelectorAll('input[name="filter_renk[]"]:checked');
    if (colorCheckboxes.length > 0) {
        const colorValues = Array.from(colorCheckboxes).map(cb => cb.value).join(',');
        url.searchParams.set('pa_renk', colorValues);
    } else {
        url.searchParams.delete('pa_renk');
    }
    
    // Seçili beden filtrelerini ekle
    const sizeCheckboxes = document.querySelectorAll('input[name="filter_beden[]"]:checked');
    if (sizeCheckboxes.length > 0) {
        const sizeValues = Array.from(sizeCheckboxes).map(cb => cb.value).join(',');
        url.searchParams.set('pa_beden', sizeValues);
    } else {
        url.searchParams.delete('pa_beden');
    }
    
    // Seçili özellik filtrelerini ekle
    const featureCheckboxes = document.querySelectorAll('input[name="filter_ozellik[]"]:checked');
    if (featureCheckboxes.length > 0) {
        const featureValues = Array.from(featureCheckboxes).map(cb => cb.value).join(',');
        url.searchParams.set('pa_ozellik', featureValues);
    } else {
        url.searchParams.delete('pa_ozellik');
    }
    
    // Seçili stil filtrelerini ekle
    const styleCheckboxes = document.querySelectorAll('input[name="filter_stil[]"]:checked');
    if (styleCheckboxes.length > 0) {
        const styleValues = Array.from(styleCheckboxes).map(cb => cb.value).join(',');
        url.searchParams.set('pa_stil', styleValues);
    } else {
        url.searchParams.delete('pa_stil');
    }
    
    // Sıralama parametrelerini ekle
    const orderbyRadio = document.querySelector('input[name="orderby"]:checked');
    if (orderbyRadio) {
        url.searchParams.set('orderby', orderbyRadio.value);
        const orderValue = document.getElementById('orderValue').value;
        url.searchParams.set('order', orderValue);
    }
    
    // Sayfayı yönlendir
    window.location.href = url.toString();
}

// Tüm filtreleri temizleme fonksiyonu
function clearAllFilters() {
    // Tüm checkbox'ları temizle
    const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
    allCheckboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
}

// Sayfa yüklendiğinde seçili sıralamayı belirle
window.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    const orderby = urlParams.get('orderby');
    const order = urlParams.get('order');
    
    let targetValue = orderby;
    if (orderby === 'price' && order === 'desc') {
        targetValue = 'price-desc';
    }
    
    const selectedRadio = document.querySelector(`input[name="orderby"][value="${targetValue}"]`);
    if (selectedRadio) {
        selectedRadio.checked = true;
    }
    
    // Order değerini de ayarla
    document.getElementById('orderValue').value = order || 'asc';
});

// Product Gallery Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Product gallery functionality
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    if (thumbnails.length === 0) return;
    
    // Add click event to each thumbnail
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumbnail
            this.classList.add('active');
            
            // Get the data-index from the clicked thumbnail
            const dataIndex = this.getAttribute('data-index');
            
            // Find the main product image container
            const gallery = document.querySelector('.product-gallery');
            if (!gallery) return;
            
            // Find the corresponding main image based on data-index
            let mainImage;
            if (dataIndex === 'main') {
                mainImage = gallery.querySelector('img[data-index="main"]');
            } else {
                mainImage = gallery.querySelector('img[data-index="' + dataIndex + '"]');
                if (!mainImage) {
                    // If direct match not found, get the image with the same index
                    mainImage = gallery.querySelector('.gallery-image-hidden[data-index="' + dataIndex + '"]');
                }
            }
            
            if (mainImage) {
                // Get the main product image element
                const mainProductImage = gallery.querySelector('.main-product-image');
                if (mainProductImage) {
                    // Update the src of the main product image
                    mainProductImage.src = mainImage.src;
                }
            }
        });
    });
});

// Alternative function for inline onclick
function changeMainImage(thumb) {
    // Remove active class from all thumbnails
    const allThumbs = document.querySelectorAll('.thumbnail');
    allThumbs.forEach(t => t.classList.remove('active'));
    
    // Add active class to clicked thumbnail
    thumb.classList.add('active');
    
    // Get the data-index from the clicked thumbnail
    const dataIndex = thumb.getAttribute('data-index');
    
    // Find the main product gallery container
    const gallery = document.querySelector('.product-gallery');
    if (!gallery) return;
    
    // Find the corresponding main image based on data-index
    let mainImage;
    if (dataIndex === 'main') {
        mainImage = gallery.querySelector('img[data-index="main"]');
    } else {
        mainImage = gallery.querySelector('img[data-index="' + dataIndex + '"]');
        if (!mainImage) {
            // If direct match not found, get the image with the same index
            mainImage = gallery.querySelector('.gallery-image-hidden[data-index="' + dataIndex + '"]');
        }
    }
    
    if (mainImage) {
        // Get the main product image element
        const mainProductImage = gallery.querySelector('.main-product-image');
        if (mainProductImage) {
            // Update the src of the main product image
            mainProductImage.src = mainImage.src;
        }
    }
}
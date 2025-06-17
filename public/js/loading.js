// Global loading overlay functions
const LoadingOverlay = {
    // Menampilkan loading overlay
    show: function(text = 'Memuat...') {
        const loadingOverlay = document.getElementById('loading-overlay');
        const loadingText = document.querySelector('.loading-text');
        
        if (loadingOverlay && loadingText) {
            loadingText.textContent = text;
            loadingOverlay.style.display = 'flex';
            loadingOverlay.classList.remove('hidden');
        }
    },
    
    // Menyembunyikan loading overlay
    hide: function() {
        const loadingOverlay = document.getElementById('loading-overlay');
        
        if (loadingOverlay) {
            loadingOverlay.classList.add('hidden');
            
            // Menghapus overlay setelah animasi selesai
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
            }, 500);
        }
    },
    
    // Inisialisasi untuk page load
    init: function() {
        const loadingOverlay = document.getElementById('loading-overlay');
        
        if (!loadingOverlay) return;
        
        // Sembunyikan saat DOM selesai dimuat
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(this.hide.bind(this), 500);
        } else {
            window.addEventListener('load', () => {
                setTimeout(this.hide.bind(this), 500);
            });
        }
        
        // Fallback: sembunyikan setelah 5 detik
        setTimeout(this.hide.bind(this), 5000);
    }
};

// Inisialisasi loading overlay
LoadingOverlay.init();

// AJAX global setup
if (typeof $ !== 'undefined') {
    // Menampilkan loading saat AJAX dimulai
    $(document).ajaxStart(function() {
        LoadingOverlay.show('Memproses permintaan...');
    });
    
    // Menyembunyikan loading saat AJAX selesai
    $(document).ajaxStop(function() {
        LoadingOverlay.hide();
    });
    
    // Menyembunyikan loading jika terjadi error
    $(document).ajaxError(function() {
        LoadingOverlay.hide();
    });
}

// Export untuk penggunaan global
window.LoadingOverlay = LoadingOverlay;

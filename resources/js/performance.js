const setLazyAttributes = () => {
    const images = document.querySelectorAll('img');
    images.forEach((img) => {
        if (!img.hasAttribute('loading')) {
            img.loading = 'lazy';
        }
        if (!img.hasAttribute('decoding')) {
            img.decoding = 'async';
        }
    });
};

const enhanceLazyLoading = () => {
    if (!('IntersectionObserver' in window)) {
        setLazyAttributes();
        return;
    }

    const io = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        },
        {
            rootMargin: '200px 0px',
            threshold: 0.1,
        },
    );

    document.querySelectorAll('img[data-src]').forEach((img) => io.observe(img));
    setLazyAttributes();
};

const registerServiceWorker = () => {
    if (!('serviceWorker' in navigator)) {
        return;
    }

    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register('/service-worker.js')
            .catch((error) => console.error('Service worker registration failed:', error));
    });
};

window.addEventListener('DOMContentLoaded', enhanceLazyLoading);
registerServiceWorker();

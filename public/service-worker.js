const CACHE_VERSION = 'al-anwar-static-v1';
const RUNTIME_CACHE = 'al-anwar-runtime';

self.addEventListener('install', (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_VERSION).then((cache) =>
            cache.addAll([
                '/',
                '/favicon.png',
            ]),
        ),
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(
                keys
                    .filter((key) => ![CACHE_VERSION, RUNTIME_CACHE].includes(key))
                    .map((key) => caches.delete(key)),
            ),
        ),
    );
    self.clients.claim();
});

const shouldCache = (request) => {
    if (request.method !== 'GET') {
        return false;
    }

    if (request.destination === 'image') {
        return true;
    }

    return /\.(?:js|css|woff2?|ttf|eot)$/.test(new URL(request.url).pathname);
};

self.addEventListener('fetch', (event) => {
    const { request } = event;

    if (!shouldCache(request)) {
        return;
    }

    event.respondWith(
        caches.match(request).then((cachedResponse) => {
            if (cachedResponse) {
                event.waitUntil(
                    fetch(request)
                        .then((response) => {
                            if (response && response.status === 200) {
                                return caches.open(RUNTIME_CACHE).then((cache) => cache.put(request, response.clone()));
                            }
                        })
                        .catch(() => cachedResponse),
                );

                return cachedResponse;
            }

            return fetch(request)
                .then((response) => {
                    if (response && response.status === 200) {
                        const cacheTarget = request.destination === 'image' ? CACHE_VERSION : RUNTIME_CACHE;
                        const cacheCopy = response.clone();
                        caches.open(cacheTarget).then((cache) => cache.put(request, cacheCopy));
                    }

                    return response;
                })
                .catch(() => cachedResponse);
        }),
    );
});

const STATIC_CACHE = "assets-v1";
const API_CACHE = "api-list-v1";

// Cache-first untuk file hasil build (/assets/...)
self.addEventListener("fetch", (event) => {
    const url = new URL(event.request.url);

    // Cache aset hasil build
    if (url.pathname.startsWith("/assets/")) {
        event.respondWith(
            (async () => {
                const cache = await caches.open(STATIC_CACHE);
                const cached = await cache.match(event.request);
                if (cached) return cached;
                const resp = await fetch(event.request);
                cache.put(event.request, resp.clone());
                return resp;
            })()
        );
        return;
    }

    // SWR untuk endpoint daftar/publik
    if (/^\/api\/(list|search|public)/i.test(url.pathname)) {
        event.respondWith(
            (async () => {
                const cache = await caches.open(API_CACHE);
                const cached = await cache.match(event.request);
                const network = fetch(event.request)
                    .then((r) => {
                        cache.put(event.request, r.clone());
                        return r;
                    })
                    .catch(() => cached);
                return cached || network;
            })()
        );
    }
});

var staticCacheName = "pwa-v" + new Date().getTime();
var url = '/projects/zstarter/public_html/';
var filesToCache = [
    url+'offline',
    url+'frontend/assets/css/bootstrap.css',
   url+'frontend/assets/libs/tiny-slider/tiny-slider.css',
   url+'frontend/assets/css/bootstrap.min.css',
   url+'frontend/assets/css/icons.min.css',
   url+'frontend/assets/libs/@iconscout/unicons/css/line.css',
   url+'frontend/assets/css/style.min.css',
    url+'frontend/assets/css/ct-ultimate-gdpr.min.css',
    url+'images/icons/icon-72x72.png',
    url+'images/icons/icon-96x96.png',
    url+'images/icons/icon-128x128.png',
    url+'images/icons/icon-144x144.png',
    url+'images/icons/icon-152x152.png',
    url+'images/icons/icon-192x192.png',
    url+'images/icons/icon-384x384.png',
    url+'images/icons/icon-512x512.png',
    url+'images/icons/splash-640x1136.png',
    url+'images/icons/splash-750x1334.png',
    url+'images/icons/splash-828x1792.png',
    url+'images/icons/splash-1125x2436.png',
    url+'images/icons/splash-1242x2208.png',
    url+'images/icons/splash-1242x2688.png',
    url+'images/icons/splash-1536x2048.png',
    url+'images/icons/splash-1668x2224.png',
    url+'images/icons/splash-1668x2388.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
/* PWA service worker. Never cache authenticated or API responses. */
const CACHE_NAME = 'sport-academy-static-v1';
const STATIC_ASSETS = [
  '/offline.html',
  '/images/pwa-icon.svg',
  '/manifest.webmanifest'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => cache.addAll(STATIC_ASSETS))
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => Promise.all(
      keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
    )).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  const request = event.request;
  const url = new URL(request.url);

  if (request.method !== 'GET' || url.origin !== self.location.origin) return;

  // Keep authenticated pages, forms, and application data network-only.
  if (request.mode === 'navigate' || url.pathname.startsWith('/api/')) {
    if (request.mode === 'navigate') {
      event.respondWith(fetch(request).catch(async () => {
        const cached = await caches.match('/offline.html');
        return cached || new Response('You are offline. Reconnect and try again.', {
          status: 503,
          headers: { 'Content-Type': 'text/plain; charset=utf-8' }
        });
      }));
    }
    return;
  }

  // Cache only known static PWA assets; do not cache arbitrary private content.
  if (STATIC_ASSETS.includes(url.pathname)) {
    event.respondWith(caches.match(request).then((cached) => cached || fetch(request)));
  }
});

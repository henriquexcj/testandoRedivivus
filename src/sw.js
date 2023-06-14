self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open('redi-vivus-cache').then(function(cache) {
      return cache.addAll([
        '/',
        'index.html',
        'assets/css/main.css',
        'assets/js/main.js',
        // Adicione aqui todos os recursos do seu site que devem ser armazenados em cache
      ]);
    })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request);
    })
  );
});

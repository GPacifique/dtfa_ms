(() => {
  'use strict';

  let installPrompt = null;

  const isStandalone = () =>
    window.matchMedia('(display-mode: standalone)').matches ||
    window.navigator.standalone === true;

  function createInstallButton() {
    if (document.getElementById('pwa-install-button') || isStandalone()) return;

    const button = document.createElement('button');
    button.id = 'pwa-install-button';
    button.type = 'button';
    button.innerHTML = '<span aria-hidden="true">⬇</span> Install app';
    button.setAttribute('aria-label', 'Install Sport Academy app');
    Object.assign(button.style, {
      position: 'fixed', left: '18px', bottom: '20px', zIndex: '9998',
      display: 'inline-flex', alignItems: 'center', gap: '9px',
      padding: '12px 16px', border: '0', borderRadius: '999px',
      background: '#1d4ed8', color: '#fff', font: '600 14px system-ui, sans-serif',
      boxShadow: '0 8px 24px rgba(15,23,42,.22)', cursor: 'pointer'
    });

    button.addEventListener('click', async () => {
      if (installPrompt) {
        installPrompt.prompt();
        await installPrompt.userChoice;
        installPrompt = null;
        button.remove();
        return;
      }

      const isIOS = /iphone|ipad|ipod/i.test(navigator.userAgent);
      const message = isIOS
        ? 'To install: tap Share in Safari, then choose “Add to Home Screen”.'
        : 'If your browser supports installation, use its Install app option in the address bar or browser menu. On Android, open the browser menu and choose “Install app” or “Add to Home screen”.';
      window.alert(message);
    });

    document.body.appendChild(button);
  }

  window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    installPrompt = event;
    createInstallButton();
  });

  window.addEventListener('appinstalled', () => {
    installPrompt = null;
    document.getElementById('pwa-install-button')?.remove();
  });

  window.addEventListener('DOMContentLoaded', () => {
    if ('serviceWorker' in navigator && /^https?:$/.test(window.location.protocol)) {
      navigator.serviceWorker.register('/sw.js').catch((error) => {
        console.warn('PWA service worker registration failed:', error);
      });
    }

    // Show an install/help control in all layouts, even before the browser
    // emits beforeinstallprompt (for example, on iOS Safari).
    createInstallButton();
  });
})();

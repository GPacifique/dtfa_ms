<script>
// Global inline scripts
(function(){
  // Theme toggle: toggles a data-theme attribute and persists to localStorage
  window.toggleTheme = function(){
    try {
      const current = localStorage.getItem('theme') || 'light';
      // cycle: light -> dark -> light
      const next = current === 'dark' ? 'light' : 'dark';
      localStorage.setItem('theme', next);
      applyTheme(next);
    } catch(e) {}
  };

  function applyTheme(mode){
    const root = document.documentElement;
    // keep a data-theme attribute for any non-Tailwind usage, and
    // also add/remove the `.dark` class so Tailwind (class mode) works.
    if (mode === 'dark') {
      root.setAttribute('data-theme','dark');
      root.classList.add('dark');
    } else if (mode === 'light') {
      root.setAttribute('data-theme','light');
      root.classList.remove('dark');
    } else {
      root.removeAttribute('data-theme');
      root.classList.remove('dark');
    }
  }

  // init theme: prefer saved value, otherwise start LIGHT (ignore system prefs)
  try { applyTheme(localStorage.getItem('theme') || 'light'); } catch(e) {}

  // Auto-hide flash messages if any
  document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('[data-flash]')?.forEach(function(el){
      setTimeout(function(){ el.classList.add('hidden'); }, 4000);
    });
  });

  // Mobile menu helper if element exists
  window.toggleMobileMenu = function(){
    const el = document.getElementById('mobileMenu');
    if (el) el.classList.toggle('hidden');
  };

  document.addEventListener('DOMContentLoaded', function(){
    // wire theme toggle buttons
    document.querySelectorAll('[data-theme-toggle]').forEach(function(btn){
      btn.addEventListener('click', function(e){ e.preventDefault(); window.toggleTheme(); });
    });
  });
})();
</script>

<script>
// Global inline scripts
(function(){
  // Theme toggle: toggles a data-theme attribute and persists to localStorage
  window.toggleTheme = function(){
    try {
      const root = document.documentElement;
      const current = localStorage.getItem('theme') || 'system';
      // cycle: system -> dark -> light -> system
      let next = 'dark';
      if (current === 'dark') next = 'light';
      if (current === 'light') next = 'system';
      localStorage.setItem('theme', next);
      applyTheme(next);
    } catch(e) {}
  };
  function applyTheme(mode){
    const root = document.documentElement;
    root.removeAttribute('data-theme');
    if (mode === 'dark') root.setAttribute('data-theme','dark');
    if (mode === 'light') root.setAttribute('data-theme','light');
  }
  // init theme
  try { applyTheme(localStorage.getItem('theme') || 'system'); } catch(e) {}

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

  // Fallback sidebar toggles (works when Alpine is not responsive / during dev build issues)
  function applySidebarState(open){
    const sidebar = document.getElementById('app-sidebar');
    const main = document.getElementById('main-content');
    if (!sidebar || !main) return;

    if (open) {
      sidebar.classList.remove('w-20'); sidebar.classList.add('w-64');
      main.classList.remove('lg:ml-20'); main.classList.add('lg:ml-64');
      document.documentElement.classList.remove('overflow-hidden');
      localStorage.setItem('sidebar-collapsed','false');
    } else {
      sidebar.classList.remove('w-64'); sidebar.classList.add('w-20');
      main.classList.remove('lg:ml-64'); main.classList.add('lg:ml-20');
      document.documentElement.classList.remove('overflow-hidden');
      localStorage.setItem('sidebar-collapsed','true');
    }
  }

  function toggleSidebar(e){
    const sidebar = document.getElementById('app-sidebar');
    if (!sidebar) return;
    const isOpen = sidebar.classList.contains('w-64');
    applySidebarState(!isOpen);
  }

  function toggleSidebarMobile(e){
    const sidebar = document.getElementById('app-sidebar');
    if (!sidebar) return;
    sidebar.classList.toggle('translate-x-0');
    sidebar.classList.toggle('-translate-x-full');
    const nowOpen = sidebar.classList.contains('translate-x-0');
    if (nowOpen) document.documentElement.classList.add('overflow-hidden'); else document.documentElement.classList.remove('overflow-hidden');
    localStorage.setItem('sidebar-mobile-open', nowOpen ? 'true' : 'false');
    // set aria-hidden on main
    document.querySelectorAll('main, [role="main"]').forEach(function(el){
      if (nowOpen) el.setAttribute('aria-hidden','true'); else el.removeAttribute('aria-hidden');
    });
  }

  document.addEventListener('DOMContentLoaded', function(){
    // wire fallback toggles
    document.querySelectorAll('[data-toggle-sidebar]').forEach(function(btn){ btn.addEventListener('click', toggleSidebar); });
    document.querySelectorAll('[data-toggle-sidebar-mobile]').forEach(function(btn){ btn.addEventListener('click', toggleSidebarMobile); });

    // ensure initial classes match stored state
    try {
      const collapsed = localStorage.getItem('sidebar-collapsed');
      if (collapsed === 'true') applySidebarState(false); else applySidebarState(true);
      const mobileOpen = localStorage.getItem('sidebar-mobile-open') === 'true';
      if (mobileOpen) {
        const sidebar = document.getElementById('app-sidebar');
        if (sidebar) { sidebar.classList.remove('-translate-x-full'); sidebar.classList.add('translate-x-0'); document.documentElement.classList.add('overflow-hidden'); }
      }
    } catch(e) {}
  });
})();
</script>

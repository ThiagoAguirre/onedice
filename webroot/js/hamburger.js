// Inicializa ícones e menu quando o DOM estiver pronto.
document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide && typeof lucide.createIcons === 'function') {
    try {
      lucide.createIcons();
    } catch (err) {
      // Falha silenciosa na inicialização dos ícones
      console.warn('lucide.createIcons() falhou:', err);
    }
  }

  // Menu Logic
  const menuBtn = document.getElementById('menuBtn');
  const closeMenuBtn = document.getElementById('closeMenuBtn');
  const menuOverlay = document.getElementById('menuOverlay');
  const menuDrawer = document.getElementById('menuDrawer');

  function openMenu() {
    if (!menuOverlay || !menuDrawer) return;
    menuOverlay.classList.remove('opacity-0', 'pointer-events-none');
    menuDrawer.classList.remove('translate-x-full');
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  }

  function closeMenu() {
    if (!menuOverlay || !menuDrawer) return;
    menuOverlay.classList.add('opacity-0', 'pointer-events-none');
    menuDrawer.classList.add('translate-x-full');
    document.body.style.overflow = ''; // Restore scrolling
  }

  if (menuBtn) menuBtn.addEventListener('click', openMenu);
  if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
  if (menuOverlay) menuOverlay.addEventListener('click', closeMenu);

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });
});

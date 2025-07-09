/**
 * Header functionality - Mobile menu, search toggle, sticky header
 * 
 * @package Pen-pol
 */

(function() {
  // DOM Elements
  const header = document.getElementById('masthead');
  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const mobileNavigation = document.getElementById('mobile-navigation');
  const searchToggle = document.querySelector('.search-toggle');
  const searchForm = document.getElementById('search-form');
  
  // Inicjalizacja po załadowaniu dokumentu
  document.addEventListener('DOMContentLoaded', function() {
    initStickyHeader();
    initMobileMenu();
    initSearchToggle();
  });

  // =========================================================
  // Funkcja inicjalizująca sticky header
  // =========================================================
  function initStickyHeader() {
    if (!header) return;
    
    const heroHeight = 50; // Wysokość, po której przewinięciu header staje się sticky

    function makeHeaderSticky() {
      if (window.pageYOffset > heroHeight) {
        if (!header.classList.contains('is-sticky')) {
          requestAnimationFrame(() => {
            header.classList.add('is-sticky');
          });
        }
      } else {
        if (header.classList.contains('is-sticky')) {
          requestAnimationFrame(() => {
            header.classList.remove('is-sticky');
          });
        }
      }
    }

    // Inicjalne sprawdzenie przy ładowaniu
    makeHeaderSticky();

    // Sprawdzanie przy przewijaniu (z throttlingiem dla wydajności)
    let ticking = false;
    window.addEventListener('scroll', function() {
      if (!ticking) {
        window.requestAnimationFrame(function() {
          makeHeaderSticky();
          ticking = false;
        });
        ticking = true;
      }
    });

    // Sprawdzanie przy zmianie rozmiaru okna
    window.addEventListener('resize', makeHeaderSticky);
  }

  // =========================================================
  // Funkcja inicjalizująca menu mobilne
  // =========================================================
  function initMobileMenu() {
    if (!mobileMenuToggle || !mobileNavigation) return;
    
    mobileMenuToggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      const expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);
      
      if (!expanded) {
        mobileNavigation.classList.add('is-active');
        mobileNavigation.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden'; // Blokada scrollowania
      } else {
        mobileNavigation.classList.remove('is-active');
        mobileNavigation.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = ''; // Przywrócenie scrollowania
      }
    });

    // Zamykanie menu mobilnego przy zmianie szerokości ekranu
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 1024 && mobileNavigation.classList.contains('is-active')) {
        mobileNavigation.classList.remove('is-active');
        mobileNavigation.setAttribute('aria-hidden', 'true');
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  }

  // =========================================================
  // Funkcja inicjalizująca wyszukiwarkę
  // =========================================================
  function initSearchToggle() {
    if (!searchToggle || !searchForm) return;
    
    searchToggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      const expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);
      
      if (!expanded) {
        searchForm.hidden = false;
        // Fokusowanie na polu wyszukiwania
        const searchInput = searchForm.querySelector('input[type="search"]');
        if (searchInput) {
          setTimeout(() => searchInput.focus(), 100);
        }
      } else {
        searchForm.hidden = true;
      }
    });
    
    // Zamykanie wyszukiwarki przy kliknięciu poza nią
    document.addEventListener('click', function(e) {
      if (!searchForm.hidden && 
          !searchForm.contains(e.target) && 
          !searchToggle.contains(e.target)) {
        searchForm.hidden = true;
        searchToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }
})();
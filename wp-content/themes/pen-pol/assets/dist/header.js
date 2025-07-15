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
    initMobileSubmenu();
  });

  // =========================================================
  // Funkcja inicjalizująca sticky header
  // =========================================================
  function initStickyHeader() {
    if (!header) return;
    
    // Funkcja do ustawiania sticky headera
    function setHeaderSticky() {
      const scrollY = window.scrollY || window.pageYOffset;
      
      if (scrollY > 100) { // Gdy przescrollujemy więcej niż 100px
        header.classList.add('is-sticky');
      } else {
        header.classList.remove('is-sticky');
      }
    }
    
    // Wywołaj przy załadowaniu
    setHeaderSticky();
    
    // Nasłuchuj na scroll
    window.addEventListener('scroll', setHeaderSticky);
    
    // Sprawdzanie przy zmianie rozmiaru okna
    window.addEventListener('resize', function() {
      // Jeśli mamy otwarty mobilny dropdown przy zmianie na desktop, zamknij go
      if (window.innerWidth >= 1024 && document.body.classList.contains('menu-open')) {
        closeMobileMenu();
      }
      
      // Wywołaj również sprawdzenie sticky
      setHeaderSticky();
    });
  }

  // =========================================================
  // Funkcja inicjalizująca menu mobilne
  // =========================================================
  function initMobileMenu() {
    if (!mobileMenuToggle || !mobileNavigation) return;
    
    // Funkcja zamykania menu mobilnego
    function closeMobileMenu() {
      mobileMenuToggle.setAttribute('aria-expanded', 'false');
      
      // Dodajemy klasę dla animacji zamykania
      mobileNavigation.classList.add('is-closing');
      
      // Opóźnienie przed całkowitym ukryciem menu - dla płynniejszej animacji
      setTimeout(() => {
        mobileNavigation.classList.remove('is-active');
        mobileNavigation.classList.remove('is-closing');
        mobileNavigation.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('menu-open');
      }, 300); // Czas dopasowany do czasu animacji
      
      // Resetowanie stanu submenu
      const activeSubmenu = mobileNavigation.querySelectorAll('.menu-item-has-children.active, .sub-menu.active');
      activeSubmenu.forEach(item => {
        item.classList.remove('active');
      });
      
      const expandedItems = mobileNavigation.querySelectorAll('[aria-expanded="true"]');
      expandedItems.forEach(item => {
        if (item !== mobileMenuToggle) {
          item.setAttribute('aria-expanded', 'false');
        }
      });
    }
    
    // Dodanie funkcji do window, aby była dostępna globalnie
    window.closeMobileMenu = closeMobileMenu;
    
    mobileMenuToggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      const expanded = this.getAttribute('aria-expanded') === 'true';
      
      if (!expanded) {
        // Otwieranie menu
        this.setAttribute('aria-expanded', 'true');
        mobileNavigation.classList.add('is-active');
        mobileNavigation.setAttribute('aria-hidden', 'false');
        document.body.classList.add('menu-open');
      } else {
        // Zamykanie menu
        closeMobileMenu();
      }
    });
    
    // Dodaj obsługę przycisku X w menu
    const closeButton = document.querySelector('.mobile-menu-close');
    if (closeButton) {
      closeButton.addEventListener('click', function(e) {
        e.preventDefault();
        closeMobileMenu();
      });
    }
    
    // Zamykanie menu mobilnego przy zmianie szerokości ekranu
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 1024 && mobileNavigation.classList.contains('is-active')) {
        closeMobileMenu();
      }
    });
    
    // Zamykanie menu mobilnego przy kliknięciu poza nim
    document.addEventListener('click', function(e) {
      if (mobileNavigation.classList.contains('is-active') &&
          !mobileNavigation.contains(e.target) &&
          !mobileMenuToggle.contains(e.target)) {
        closeMobileMenu();
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
  
  // =========================================================
  // Funkcja inicjalizująca submenu w menu mobilnym
  // =========================================================
  function initMobileSubmenu() {
    if (!mobileNavigation) return;
    
    // Pobierz wszystkie elementy menu z submenu
    const menuItemsWithChildren = mobileNavigation.querySelectorAll('.mobile-menu-wrapper .menu-item-has-children');
    
    menuItemsWithChildren.forEach(function(item) {
      // Dodaj atrybut aria-expanded do każdego linku w menu z submenu
      const itemLink = item.querySelector('a');
      const subMenu = item.querySelector('.sub-menu');
      
      if (itemLink && subMenu) {
        // Przypisz ID do submenu dla dostępności
        const submenuId = 'submenu-' + (Math.random().toString(36).substr(2, 9));
        subMenu.id = submenuId;
        
        // Przypisz atrybuty ARIA dla dostępności
        itemLink.setAttribute('aria-expanded', 'false');
        itemLink.setAttribute('aria-controls', submenuId);
        
        // Obsługa kliknięcia na link z submenu
        itemLink.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          // Przełącz klasę active dla elementu menu i submenu
          const isExpanded = item.classList.contains('active');
          
          // Zamknij wszystkie inne submenu
          menuItemsWithChildren.forEach(function(otherItem) {
            if (otherItem !== item && otherItem.classList.contains('active')) {
              otherItem.classList.remove('active');
              otherItem.querySelector('a').setAttribute('aria-expanded', 'false');
              const otherSubMenu = otherItem.querySelector('.sub-menu');
              if (otherSubMenu) {
                otherSubMenu.classList.remove('active');
              }
            }
          });
          
          // Przełącz bieżące submenu
          item.classList.toggle('active');
          subMenu.classList.toggle('active');
          itemLink.setAttribute('aria-expanded', !isExpanded);
        });
      }
    });
  }

})();
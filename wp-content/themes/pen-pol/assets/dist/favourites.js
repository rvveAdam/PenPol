/**
 * Pen-pol - Funkcjonalność ulubionych produktów
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

(function($) {
  "use strict";

  // Funkcja do pobierania ulubionych z cookies
  function getFavorites() {
    try {
      const favorites = getCookie("wc_favorites");
      if (favorites) {
        const parsed = JSON.parse(decodeURIComponent(favorites));
        return Array.isArray(parsed) ? parsed.map((id) => parseInt(id)) : [];
      }
    } catch (e) {
      console.error("Błąd parsowania cookies ulubionych:", e);
    }
    return [];
  }

  // Funkcja do zapisywania ulubionych w cookies
  function saveFavorites(favorites) {
    try {
      const validFavorites = favorites
        .filter((id) => id && !isNaN(id))
        .map((id) => parseInt(id));
      const cookieValue = JSON.stringify(validFavorites);
      setCookie("wc_favorites", cookieValue, 30);
    } catch (e) {
      console.error("Błąd zapisywania cookies:", e);
    }
  }

  // Funkcja do ustawiania cookie
  function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie =
      name +
      "=" +
      value +
      ";expires=" +
      expires.toUTCString() +
      ";path=/;SameSite=Lax";
  }

  // Funkcja do pobierania cookie
  function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) {
        return c.substring(nameEQ.length, c.length);
      }
    }
    return null;
  }

  // Funkcja do aktualizacji ikony ulubionego
  function updateFavoriteIcon(productId, isFavorite) {
    
    const productCards = document.querySelectorAll(".product-card");
    
    productCards.forEach((card) => {
      const cardProductId = getProductIdFromCard(card);
      
      if (cardProductId == productId) {
        const favIcon = card.querySelector(".fav-icon a img");
        
        if (favIcon) {
          // Pełna ścieżka do obrazka
          const currentSrc = favIcon.src;
          const imgPath = currentSrc.substring(0, currentSrc.lastIndexOf('/') + 1);
          
          if (isFavorite) {
            favIcon.src = imgPath + 'heart.svg';
            favIcon.alt = 'Usuń z ulubionych';
          } else {
            favIcon.src = imgPath + 'fav.svg';
            favIcon.alt = 'Dodaj do ulubionych';
          }
        }
      }
    });
  }

  // Funkcja do pobierania ID produktu z karty
  function getProductIdFromCard(card) {
    
    // Sprawdź przycisk "Dodaj do koszyka"
    const cartButton = card.querySelector('.product-card__cart-button');
    if (cartButton) {
      const productId = cartButton.getAttribute('data-product_id');
      if (productId) {
        return parseInt(productId);
      }
    }

    // Sprawdź linki w karcie
    const productLinks = card.querySelectorAll('a[href*="/product/"]');
    if (productLinks.length > 0) {
      
      for (let link of productLinks) {
        const productId = link.getAttribute('data-product_id') || link.getAttribute('data-product-id');
        if (productId) {
          return parseInt(productId);
        }
      }
    }

    // Ostatnia opcja - sprawdź wszystkie elementy z data-product-id
    const elementsWithProductId = card.querySelectorAll('[data-product_id], [data-product-id]');
    if (elementsWithProductId.length > 0) {
      
      for (let element of elementsWithProductId) {
        const productId = element.getAttribute('data-product_id') || element.getAttribute('data-product-id');
        if (productId) {
          return parseInt(productId);
        }
      }
    }
    
    return null;
  }

  // Funkcja do przełączania ulubionego
  function toggleFavorite(productId) {
    productId = parseInt(productId);
    
    if (!productId || isNaN(productId)) {
      console.error('Nieprawidłowe ID produktu');
      return;
    }

    let favorites = getFavorites();
    
    const index = favorites.indexOf(productId);

    if (index > -1) {
      favorites.splice(index, 1);
      updateFavoriteIcon(productId, false);
    } else {
      favorites.push(productId);
      updateFavoriteIcon(productId, true);
    }

    saveFavorites(favorites);
    updateFavoritesCount();
  }

  // Funkcja do aktualizacji licznika ulubionych
  function updateFavoritesCount() {
    const favorites = getFavorites();
    const count = favorites.length;
    
    const counters = document.querySelectorAll(
      ".favorites__count-number, .favorites-count, .wishlist-count"
    );

    counters.forEach((counter) => {
      counter.textContent = count;
      counter.style.display = count > 0 ? "inline-flex" : "none";
    });
    
    // Aktualizacja tekstów dla polskiej gramatyki
    const countTextElements = document.querySelectorAll(
      ".favorites__count-text, .favorites-count-text"
    );
    countTextElements.forEach((element) => {
      if (count === 1) {
        element.textContent = "produkt";
      } else if (count > 1 && count < 5) {
        element.textContent = "produkty";
      } else {
        element.textContent = "produktów";
      }
    });
  }

  // Inicjalizacja - ustaw ikony na podstawie zapisanych ulubionych
  function initializeFavorites() {
    const favorites = getFavorites();
    
    // Dodaj atrybut data-product-id do kart produktów, jeśli go nie mają
    $('.product-card').each(function() {
      const card = $(this);
      if (!card.attr('data-product-id')) {
        const cartButton = card.find('.product-card__cart-button');
        if (cartButton.length) {
          const productId = cartButton.attr('data-product_id');
          if (productId) {
            card.attr('data-product-id', productId);
          }
        }
      }
    });
    
    const productCards = document.querySelectorAll(".product-card");

    productCards.forEach((card) => {
      const productId = getProductIdFromCard(card);
      
      if (productId && favorites.includes(productId)) {
        updateFavoriteIcon(productId, true);
      }
    });

    updateFavoritesCount();
  }

  // Event listener dla przycisków ulubionych
  function setupEventListeners() {
    
    // Upewniamy się, że dokument jest gotowy
    $(document).ready(function() {
      
      // Sprawdzamy czy mamy ikony ulubionych
      const favIcons = $('.fav-icon');
      
      // Używamy delegacji zdarzeń na dokumencie
      $(document).on('click', '.fav-icon a', function(e) {
        console.log('Kliknięto ikonę ulubionych');
        e.preventDefault();
        e.stopPropagation();
        
        const productCard = $(this).closest('.product-card');
        
        if (productCard.length) {
          // Pobierz ID produktu z karty
          const productId = getProductIdFromCard(productCard[0]);
          
          if (productId) {
            // Sprawdź czy jesteśmy na stronie ulubionych
            const isOnFavoritesPage = $('.favorites').length > 0 || window.location.pathname.includes('/ulubione/');
            
            if (isOnFavoritesPage) {
              let favorites = getFavorites();
              const index = favorites.indexOf(productId);

              if (index > -1) {
                favorites.splice(index, 1);
                saveFavorites(favorites);
                updateFavoritesCount();
                
                // Dodaj klasę animacji przed przeładowaniem
                productCard.addClass('favorites__product--removing');
                setTimeout(() => {
                  location.reload();
                }, 300);
              }
            } else {
              toggleFavorite(productId);
            }
          } else {
            console.error('Nie znaleziono ID produktu');
          }
        } else {
          console.error('Nie znaleziono karty produktu');
        }
      });
    });
  }

  // Funkcja do usuwania wszystkich ulubionych
  function clearAllFavorites() {
    if (confirm('Czy na pewno chcesz usunąć wszystkie ulubione produkty?')) {
      saveFavorites([]);
      updateFavoritesCount();
      location.reload();
    }
  }

  // Inicjalizacja
  $(function() {
    setupEventListeners();
    setTimeout(initializeFavorites, 100);

    // Eksportuj funkcje dla globalnego użycia
    window.getFavorites = getFavorites;
    window.toggleFavorite = toggleFavorite;
    window.updateFavoritesCount = updateFavoritesCount;
    window.clearAllFavorites = clearAllFavorites;
  });
})(jQuery);
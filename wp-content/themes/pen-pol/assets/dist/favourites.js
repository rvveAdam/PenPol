(function () {
  "use strict";

  // Poczekaj na pełne załadowanie strony
  function waitForReady(callback) {
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", callback);
    } else {
      callback();
    }
  }

  // Funkcja do pobierania ulubionych z cookies
  function getFavorites() {
    try {
      const favorites = getCookie("wc_favorites");
      if (favorites) {
        const parsed = JSON.parse(decodeURIComponent(favorites));
        return Array.isArray(parsed) ? parsed.map((id) => parseInt(id)) : [];
      }
    } catch (e) {
      console.log("Błąd parsowania cookies ulubionych:", e);
    }
    return [];
  }

  // Funkcja do zapisywania ulubionych w cookies
  function saveFavorites(favorites) {
    try {
      const validFavorites = favorites
        .filter((id) => id && !isNaN(id))
        .map((id) => parseInt(id));
      const cookieValue = encodeURIComponent(JSON.stringify(validFavorites));
      setCookie("wc_favorites", cookieValue, 30);
    } catch (e) {
      console.log("Błąd zapisywania cookies:", e);
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
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // Funkcja sprawdzająca czy element jest głównym produktem
  function isMainProduct(card) {
    // Sprawdź czy element jest w głównej sekcji produktu
    return (
      card.closest(".single-product-hero-section") ||
      card.closest(".product-summary") ||
      card.closest(".woocommerce-product-details") ||
      card.classList.contains("single-product-hero-section") ||
      card.classList.contains("product-summary") ||
      // Sprawdź czy element nie jest w karuzeli/sliderze
      (!card.closest(".carousel") &&
        !card.closest(".slider") &&
        !card.closest(".swiper") &&
        !card.closest(".related") &&
        !card.closest(".upsells") &&
        !card.closest(".cross-sells") &&
        !card.closest('[class*="carousel"]') &&
        !card.closest('[class*="slider"]') &&
        !card.closest('[class*="related"]') &&
        card.querySelector(".fav-ivon-single")) // Ma ikonę single
    );
  }

  // Funkcja do aktualizacji ikony ulubionego
  function updateFavoriteIcon(productId, isFavorite) {
    const productCards = document.querySelectorAll(".product-card");
    productCards.forEach((card) => {
      const cardProductId = getProductIdFromCard(card);
      if (cardProductId == productId) {
        const favIcon = card.querySelector(".fav-ivon img");
        if (favIcon) {
          const currentSrc = favIcon.src;
          if (isFavorite) {
            if (currentSrc.includes("fav.svg")) {
              favIcon.src = currentSrc.replace("fav.svg", "fav-filled.svg");
            }
            favIcon.alt = "Usuń z ulubionych";
          } else {
            if (currentSrc.includes("fav-filled.svg")) {
              favIcon.src = currentSrc.replace("fav-filled.svg", "fav.svg");
            }
            favIcon.alt = "Dodaj do ulubionych";
          }
        }
      }
    });

    // Obsługa ikony na stronie pojedynczego produktu - tylko głównego produktu
    if (document.body.classList.contains("single-product")) {
      const singleProductIcon = document.querySelector(".fav-ivon-single img");
      if (singleProductIcon) {
        // Sprawdź czy to ikona głównego produktu
        const mainProductId = getMainProductId();
        if (mainProductId == productId) {
          const currentSrc = singleProductIcon.src;
          if (isFavorite) {
            if (currentSrc.includes("fav.svg")) {
              singleProductIcon.src = currentSrc.replace(
                "fav.svg",
                "fav-filled.svg"
              );
            }
            singleProductIcon.alt = "Usuń z ulubionych";
          } else {
            if (currentSrc.includes("fav-filled.svg")) {
              singleProductIcon.src = currentSrc.replace(
                "fav-filled.svg",
                "fav.svg"
              );
            }
            singleProductIcon.alt = "Dodaj do ulubionych";
          }
        }
      }
    }
  }

  // Funkcja do pobierania ID głównego produktu na stronie single-product
  function getMainProductId() {
    // Spróbuj znaleźć ID z formularza dodawania do koszyka
    const addToCartForm = document.querySelector(
      "form.cart, .variations_form, form.variations_form"
    );
    if (addToCartForm) {
      const productId =
        addToCartForm.getAttribute("data-product_id") ||
        addToCartForm.querySelector('input[name="add-to-cart"]')?.value ||
        addToCartForm.querySelector('input[name="product_id"]')?.value;
      if (productId) {
        return parseInt(productId);
      }
    }

    // Sprawdź ID z URL
    const postId = document
      .querySelector('article[id*="post-"]')
      ?.id?.match(/post-(\d+)/)?.[1];
    if (postId) {
      return parseInt(postId);
    }

    // Sprawdź czy jest gdzieś data-product-id na głównej sekcji
    const mainSection = document.querySelector(
      ".single-product-hero-section, .product-summary"
    );
    if (mainSection) {
      const productIdElement = mainSection.querySelector(
        "[data-product-id], [data-product_id]"
      );
      if (productIdElement) {
        const productId =
          productIdElement.getAttribute("data-product-id") ||
          productIdElement.getAttribute("data-product_id");
        if (productId) {
          return parseInt(productId);
        }
      }
    }

    // Sprawdź przycisk add-to-cart w głównej sekcji
    const addToCartBtn = document.querySelector(
      ".single_add_to_cart_button, .ajax_add_to_cart"
    );
    if (addToCartBtn) {
      const productId =
        addToCartBtn.getAttribute("data-product_id") ||
        addToCartBtn.getAttribute("data-product-id");
      if (productId) {
        return parseInt(productId);
      }
    }

    return null;
  }

  // Funkcja do przełączania ulubionego (dla innych stron niż ulubione)
  function toggleFavorite(productId) {
    productId = parseInt(productId);
    if (!productId || isNaN(productId)) {
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
      ".favorites-count, .wishlist-count"
    );

    counters.forEach((counter) => {
      counter.textContent = count;
      counter.style.display = count > 0 ? "inline-flex" : "none";
    });
  }

  // POPRAWIONA funkcja do pobierania ID produktu z karty
  function getProductIdFromCard(card) {
    // Na stronie pojedynczego produktu
    if (
      document.body.classList.contains("single-product") ||
      window.location.pathname.includes("/product/")
    ) {
      // PIERWSZA ZASADA: Sprawdź czy to główny produkt czy produkt z karuzeli
      if (isMainProduct(card)) {
        // To jest główny produkt - użyj globalnego wyszukiwania
        return getMainProductId();
      } else {
        // To jest produkt z karuzeli - sprawdź jego lokalny ID
        // NAJPIERW sprawdź lokalne atrybuty karty
        let productId =
          card.getAttribute("data-product-id") ||
          card.getAttribute("data-product_id");
        if (productId) {
          return parseInt(productId);
        }

        // Sprawdź linki w karcie
        const productLink = card.querySelector(
          '.product-link, a[href*="/product/"]'
        );
        if (productLink) {
          productId =
            productLink.getAttribute("data-product-id") ||
            productLink.getAttribute("data-product_id");
          if (productId) {
            return parseInt(productId);
          }

          // Sprawdź URL linka
          const href = productLink.getAttribute("href");
          if (href && href.includes("/product/")) {
            const urlParams = new URLSearchParams(href.split("?")[1] || "");
            const urlProductId =
              urlParams.get("product_id") || urlParams.get("add-to-cart");
            if (urlProductId && !isNaN(urlProductId)) {
              return parseInt(urlProductId);
            }
          }
        }

        // Sprawdź elementy z ID w karcie
        const elementsWithProductId = card.querySelectorAll(
          "[data-product_id], [data-product-id]"
        );
        if (elementsWithProductId.length > 0) {
          for (let element of elementsWithProductId) {
            productId =
              element.getAttribute("data-product_id") ||
              element.getAttribute("data-product-id");
            if (productId) {
              return parseInt(productId);
            }
          }
        }

        // Sprawdź formularze w karcie
        const forms = card.querySelectorAll("form");
        for (let form of forms) {
          const hiddenProductId = form.querySelector(
            'input[name="product_id"], input[name="add-to-cart"]'
          );
          if (hiddenProductId && hiddenProductId.value) {
            return parseInt(hiddenProductId.value);
          }

          productId =
            form.getAttribute("data-product_id") ||
            form.getAttribute("data-product-id");
          if (productId) {
            return parseInt(productId);
          }
        }

        return null;
      }
    }

    // Dla pozostałych stron - oryginalna logika
    let productId = card.getAttribute("data-product-id");
    if (productId) {
      return parseInt(productId);
    }

    const productLink = card.querySelector(
      '.product-link, a[href*="/product/"]'
    );
    if (productLink) {
      productId = productLink.getAttribute("data-product-id");
      if (productId) {
        return parseInt(productId);
      }
    }

    const elementsWithProductId = card.querySelectorAll(
      "[data-product_id], [data-product-id]"
    );
    if (elementsWithProductId.length > 0) {
      for (let element of elementsWithProductId) {
        productId =
          element.getAttribute("data-product_id") ||
          element.getAttribute("data-product-id");
        if (productId) {
          return parseInt(productId);
        }
      }
    }

    const allLinks = card.querySelectorAll("a");
    for (let link of allLinks) {
      productId =
        link.getAttribute("data-product-id") ||
        link.getAttribute("data-product_id");
      if (productId) {
        return parseInt(productId);
      }

      const href = link.getAttribute("href");
      if (href && href.includes("/product/")) {
        const urlParams = new URLSearchParams(href.split("?")[1] || "");
        const urlProductId =
          urlParams.get("product_id") || urlParams.get("add-to-cart");
        if (urlProductId && !isNaN(urlProductId)) {
          return parseInt(urlProductId);
        }
      }
    }

    const forms = card.querySelectorAll("form");
    for (let form of forms) {
      const hiddenProductId = form.querySelector(
        'input[name="product_id"], input[name="add-to-cart"]'
      );
      if (hiddenProductId && hiddenProductId.value) {
        return parseInt(hiddenProductId.value);
      }

      productId =
        form.getAttribute("data-product_id") ||
        form.getAttribute("data-product-id");
      if (productId) {
        return parseInt(productId);
      }
    }

    const productElements = card.querySelectorAll(
      '.product, [class*="product"], [id*="product"]'
    );
    for (let element of productElements) {
      productId =
        element.getAttribute("data-product-id") ||
        element.getAttribute("data-product_id") ||
        element.getAttribute("data-id");
      if (productId && !isNaN(productId)) {
        return parseInt(productId);
      }
    }

    const dataElements = card.querySelectorAll(
      "[data-product-id], [data-product_id], [data-id]"
    );
    for (let element of dataElements) {
      productId =
        element.getAttribute("data-product-id") ||
        element.getAttribute("data-product_id") ||
        element.getAttribute("data-id");
      if (productId && !isNaN(productId)) {
        return parseInt(productId);
      }
    }

    return null;
  }

  // Inicjalizacja - ustaw ikony na podstawie zapisanych ulubionych
  function initializeFavorites() {
    const favorites = getFavorites();
    const productCards = document.querySelectorAll(
      '.product-card, .product, [class*="product-"]'
    );

    productCards.forEach((card) => {
      const productId = getProductIdFromCard(card);
      if (productId && favorites.includes(productId)) {
        updateFavoriteIcon(productId, true);
      }
    });

    // Obsługa ikony na stronie pojedynczego produktu - tylko główny produkt
    if (document.body.classList.contains("single-product")) {
      const mainProductId = getMainProductId();
      if (mainProductId && favorites.includes(mainProductId)) {
        updateFavoriteIcon(mainProductId, true);
      }
    }

    updateFavoritesCount();
  }

  // POPRAWIONY Event listener z obsługą strony ulubionych
  function setupEventListeners() {
    document.addEventListener("click", function (e) {
      // ROZSZERZONY: Sprawdź czy kliknięto w przycisk koszyka lub nawigacyjny
      const isNavigationLink = e.target.closest(
        ".button, .main-button, .no-favorites a, .cart-button, .ajax_add_to_cart, .single_add_to_cart_button, .custom-plus-btn, .custom-minus-btn, .plus-btn, .minus-btn, .quantity-buttons, .cart-actions button, .woocommerce-variation-add-to-cart button"
      );

      // WAŻNE: Jeśli to przycisk koszyka/quantity - nie przechwytuj
      if (isNavigationLink) {
        return;
      }

      // Sprawdź czy jesteśmy na stronie ulubionych
      const isOnFavoritesPage =
        document.querySelector(".favorites-page") ||
        window.location.pathname.includes("/ulubione/") ||
        document.querySelector(".favorite-product") ||
        document.body.classList.contains("page-template-favorites") ||
        document.title.toLowerCase().includes("ulubione");

      // POPRAWIONY: Bardziej precyzyjny selektor dla ikon ulubionych
      const favIcon = e.target.closest(
        ".fav-ivon a, .fav-ivon-single a, .fav-icon a, .favorite-btn"
      );

      if (favIcon) {
        // DODATKOWE SPRAWDZENIE: Czy rzeczywiście klikamy w ikonę serca
        const hasHeartIcon =
          favIcon.querySelector(
            'img[src*="fav"], img[alt*="fav"], img[alt*="ulub"], img[alt*="Add to favorites"]'
          ) ||
          e.target.src?.includes("fav") ||
          e.target.alt?.includes("fav") ||
          e.target.alt?.includes("Add to favorites") ||
          e.target.alt?.includes("ulub");

        // TYLKO jeśli to rzeczywiście ikona serca
        if (hasHeartIcon) {
          e.preventDefault();
          e.stopPropagation();

          console.log("Favorites icon clicked"); // Debug

          const productCard = favIcon.closest(
            '.product-card, .product, [class*="product-"], .favorite-product, .single-product-hero-section, li, div'
          );

          if (productCard) {
            const productId = getProductIdFromCard(productCard);

            if (productId) {
              console.log("Product ID found:", productId); // Debug

              if (isOnFavoritesPage) {
                // Na stronie ulubionych - usuń z cookies i przeładuj stronę
                let favorites = getFavorites();
                const index = favorites.indexOf(productId);

                if (index > -1) {
                  favorites.splice(index, 1);
                  saveFavorites(favorites);
                  updateFavoritesCount();
                  setTimeout(() => {
                    location.reload();
                  }, 100);
                }
              } else {
                // Na innych stronach użyj normalnego toggleFavorite
                toggleFavorite(productId);
              }
            } else {
              console.log("Product ID not found"); // Debug
            }
          } else {
            console.log("Product card not found"); // Debug
          }
        } else {
          console.log("Not a heart icon click"); // Debug
        }
      }
    });

    // Dodatkowy listener dla dynamicznie ładowanych produktów
    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.type === "childList" && mutation.addedNodes.length > 0) {
          const newProducts = Array.from(mutation.addedNodes).filter(
            (node) =>
              node.nodeType === 1 &&
              (node.classList.contains("product-card") ||
                node.classList.contains("product") ||
                (node.querySelector &&
                  node.querySelector(".product-card, .product")))
          );

          if (newProducts.length > 0) {
            setTimeout(initializeFavorites, 100);
          }
        }
      });
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  }

  // Funkcja do usuwania produktu z ulubionych (dla strony ulubionych)
  function removeFavorite(productId) {
    productId = parseInt(productId);
    let favorites = getFavorites();
    const index = favorites.indexOf(productId);

    if (index > -1) {
      favorites.splice(index, 1);
      saveFavorites(favorites);

      const productElement = document.querySelector(
        `.favorite-product[data-product-id="${productId}"]`
      );
      if (productElement) {
        productElement.style.transition =
          "opacity 0.3s ease, transform 0.3s ease";
        productElement.style.opacity = "0";
        productElement.style.transform = "scale(0.9)";

        setTimeout(() => {
          productElement.remove();

          const remainingProducts =
            document.querySelectorAll(".favorite-product");
          if (remainingProducts.length === 0) {
            location.reload();
          }
        }, 300);
      }

      updateFavoritesCount();
    }
  }

  // Funkcja do czyszczenia wszystkich ulubionych
  function clearAllFavorites() {
    saveFavorites([]);
    updateFavoritesCount();
    location.reload();
  }

  // Inicjalizacja po załadowaniu strony
  waitForReady(function () {
    console.log("Favorites script initialized"); // Debug
    setupEventListeners();
    setTimeout(initializeFavorites, 100);

    // Eksportuj funkcje dla globalnego użycia
    window.getFavorites = getFavorites;
    window.toggleFavorite = toggleFavorite;
    window.updateFavoritesCount = updateFavoritesCount;
    window.removeFavorite = removeFavorite;
    window.clearAllFavorites = clearAllFavorites;
    window.getProductIdFromCard = getProductIdFromCard;
  });
})();
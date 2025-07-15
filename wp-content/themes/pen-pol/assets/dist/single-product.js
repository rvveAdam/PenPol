/**
 * Single Product JavaScript
 * Obsługuje funkcjonalność strony pojedynczego produktu
 */
jQuery(document).ready(function($) {
  
  // Inicjalizacja galerii produktowej, jeśli istnieje
  if ($(".product-gallery-main").length && $(".product-gallery-thumbs").length) {
    // Inicjalizacja Swiper dla miniatur produktu
    var productThumbs = new Swiper(".product-gallery-thumbs .swiper-container", {
      spaceBetween: 10,
      slidesPerView: "auto",
      freeMode: true,
      watchSlidesProgress: true,
      direction: "vertical", // Pionowy kierunek dla miniaturek
      navigation: {
        nextEl: ".product-gallery-thumbs .swiper-button-next",
        prevEl: ".product-gallery-thumbs .swiper-button-prev",
      },
      breakpoints: {
        // when window width is <= 768px
        320: {
          direction: "horizontal", // Poziomy kierunek na mobile
          slidesPerView: 3,
          spaceBetween: 5,
          navigation: false, // Wyłącz nawigację na mobile
        },
        768: {
          direction: "vertical", // Pionowy kierunek na desktop
          slidesPerView: 5, // Maksymalnie 5 miniaturek widoczne
          spaceBetween: 10,
          navigation: {
            nextEl: ".product-gallery-thumbs .swiper-button-next",
            prevEl: ".product-gallery-thumbs .swiper-button-prev",
          },
        },
      },
    });

    // Inicjalizacja Swiper dla głównych zdjęć produktu
    var productMain = new Swiper(".product-gallery-main .swiper-container", {
      spaceBetween: 10,
      navigation: {
        nextEl: ".product-gallery-main-next",
        prevEl: ".product-gallery-main-prev",
      },
      pagination: {
        el: ".product-gallery-main-pagination",
        clickable: true,
      },
      thumbs: {
        swiper: productThumbs,
      },
    });
  }

  // Obsługa zakładek produktu
  $('.product-tab-button').on('click', function(e) {
    e.preventDefault();
    
    const tabId = $(this).data('tab');
    
    // Aktualizacja URL z parametrem tab (opcjonalne, dla zachowania przy odświeżeniu strony)
    if (history.pushState) {
      const newUrl = updateUrlParameter(window.location.href, 'tab', tabId);
      window.history.pushState({ path: newUrl }, '', newUrl);
    }
    
    // Usunięcie klasy active ze wszystkich zakładek i zawartości
    $('.product-tab-button').removeClass('active');
    $('.product-tab-content').removeClass('active');
    
    // Dodanie klasy active do bieżącej zakładki i zawartości
    $(this).addClass('active');
    $('#tab-' + tabId).addClass('active');
  });

  // Funkcja do aktualizacji parametrów URL
  function updateUrlParameter(url, key, value) {
    const re = new RegExp('([?&])' + key + '=.*?(&|$)', 'i');
    const separator = url.indexOf('?') !== -1 ? '&' : '?';
    
    if (url.match(re)) {
      return url.replace(re, '$1' + key + '=' + value + '$2');
    } else {
      return url + separator + key + '=' + value;
    }
  }

  // Obsługa nawigacji z URL przy ładowaniu strony
  function initTabFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');
    
    if (tabParam && document.getElementById('tab-' + tabParam)) {
      $('.product-tab-button[data-tab="' + tabParam + '"]').trigger('click');
    } else {
      // Domyślnie aktywuj pierwszą zakładkę, jeśli nie ma parametru w URL
      $('.product-tab-button:first').trigger('click');
    }
  }

  // Inicjalizacja zakładek
  initTabFromUrl();

  // Obsługa selektora wariantów (dropdown)
  $('.variant-selector__header').on('click', function() {
    const dropdown = $(this).siblings('.variant-selector__dropdown');
    const icon = $(this).find('.variant-selector__header-icon');
    
    dropdown.toggleClass('open');
    icon.toggleClass('open');
  });

  // Zamykanie dropdownu po kliknięciu poza nim
  $(document).on('click', function(e) {
    if (!$(e.target).closest('.variant-selector').length) {
      $('.variant-selector__dropdown').removeClass('open');
      $('.variant-selector__header-icon').removeClass('open');
    }
  });

  // Przekierowanie po wyborze wariantu
  $('.variant-selector__dropdown-item').on('click', function() {
    const productId = $(this).data('product-id');
    const input = $(this).find('input[type="radio"]');
    
    // Zaznacz radio
    input.prop('checked', true);
    
    // Przekieruj na stronę wybranego produktu
    window.location.href = '?p=' + productId;
  });

  // AJAX dodawanie do koszyka
  $('.ajax_add_to_cart').on('click', function(e) {
    e.preventDefault();
    
    const $thisButton = $(this);
    const productId = $thisButton.data('product_id');
    const quantity = $('.quantity .qty').val() || 1;
    
    // Dodanie klasy ładowania
    $thisButton.addClass('loading');
    $thisButton.find('.spinner').show();
    $thisButton.find('.button-text').hide();
    
    $.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: 'woocommerce_ajax_add_to_cart',
        product_id: productId,
        quantity: quantity
      },
      success: function(response) {
        if (response.error & response.product_url) {
          window.location = response.product_url;
          return;
        }
        
        // Odświeżenie fragmentów WooCommerce (koszyk, itp.)
        if (response.fragments) {
          $.each(response.fragments, function(key, value) {
            $(key).replaceWith(value);
          });
        }
        
        // Wyświetlenie powiadomienia o dodaniu do koszyka
        if ($('.woocommerce-message').length === 0) {
          $('main.site-main').prepend('<div class="woocommerce-message">' + wc_add_to_cart_params.i18n_added_to_cart + '</div>');
        }
        
        // Usunięcie klasy ładowania
        $thisButton.removeClass('loading');
        $thisButton.find('.spinner').hide();
        $thisButton.find('.button-text').show();
        
        // Opcjonalnie: przewiń do powiadomienia
        $('html, body').animate({
          scrollTop: $('.woocommerce-message').offset().top - 100
        }, 500);
      },
      error: function() {
        // Wyświetlenie komunikatu o błędzie
        if ($('.woocommerce-error').length === 0) {
          $('main.site-main').prepend('<div class="woocommerce-error">' + wc_add_to_cart_params.i18n_ajax_error + '</div>');
        }
        
        // Usunięcie klasy ładowania
        $thisButton.removeClass('loading');
        $thisButton.find('.spinner').hide();
        $thisButton.find('.button-text').show();
      }
    });
  });
  
  // Obsługa gwiazdek w recenzjach
  $('.stars a').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const $stars = $this.parent().find('a');
    const $rating = $this.closest('.comment-form-rating').find('#rating');
    
    $rating.val($this.text().charAt(0));
    $stars.removeClass('active');
    $this.addClass('active');
    $stars.each(function(index) {
      if (index <= $stars.index($this)) {
        $(this).addClass('active');
      }
    });
    
    return false;
  });
});

(function($) {
  // Funkcja inicjalizująca przyciski ilości
  function initQuantityButtons() {
    // Znajdujemy wszystkie pola ilości na stronie
    $('.quantity').each(function() {
      // Sprawdzamy, czy przyciski już istnieją
      if ($(this).find('.qty-button').length === 0) {
        // Dodajemy przyciski plus i minus
        $(this).prepend('<button type="button" class="qty-button qty-button--minus" aria-label="Zmniejsz ilość">−</button>');
        $(this).append('<button type="button" class="qty-button qty-button--plus" aria-label="Zwiększ ilość">+</button>');
        
        // Obsługa kliknięcia przycisku minus
        $(this).on('click', '.qty-button--minus', function(e) {
          e.preventDefault();
          var input = $(this).siblings('input.qty');
          var val = parseInt(input.val());
          var min = parseInt(input.attr('min'));
          
          if (val > (min ? min : 1)) {
            input.val(val - 1).trigger('change');
          }
        });
        
        // Obsługa kliknięcia przycisku plus
        $(this).on('click', '.qty-button--plus', function(e) {
          e.preventDefault();
          var input = $(this).siblings('input.qty');
          var val = parseInt(input.val());
          var max = parseInt(input.attr('max'));
          
          if (!max || val < max) {
            input.val(val + 1).trigger('change');
          }
        });
      }
    });
  }
  
  // Inicjalizacja po załadowaniu strony
  $(document).ready(function() {
    initQuantityButtons();
    
    // Obsługa dynamicznie dodawanych elementów (np. po AJAX)
    $(document.body).on('updated_cart_totals wc_fragments_refreshed', function() {
      initQuantityButtons();
    });
  });
})(jQuery);
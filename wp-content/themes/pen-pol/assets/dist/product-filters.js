/**
 * Product Filters Functionality - FacetWP Integration
 * 
 * Handles desktop and mobile filter interactions, hiding empty filters,
 * and managing filter state
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

(function($) {
  'use strict';
  
  // Stan aplikacji
  const state = {
    activeFilter: null,
    modalOpen: false,
    filters: {},
    emptyFilters: []
  };
  
  // Inicjalizacja
  function init() {
    // Inicjalizacja tylko jeśli istnieją filtry na stronie
    if ($('.shop-archive__filter-item').length === 0) return;
    
    setupEventListeners();
    updateFilterCounts();
    handleEmptyFilters();
    
    // Obsługa zdarzeń FacetWP
    $(document).on('facetwp-loaded', handleFacetWPLoaded);
    $(document).on('facetwp-refresh', handleFacetWPRefresh);
  }
  
  // Ustawienie nasłuchiwania zdarzeń
  function setupEventListeners() {
    // Kliknięcie przycisku filtra (desktop)
    $(document).on('click', '.shop-archive__filter-toggle', toggleFilter);
    
    // Kliknięcie poza filtrem (desktop)
    $(document).on('click', function(e) {
      if (!$(e.target).closest('.shop-archive__filter-item').length && 
          !$(e.target).closest('.shop-archive__mobile-modal').length) {
        closeAllFilters();
      }
    });
    
    // Kliknięcie w opcję filtra nie powinno zamykać panelu
    $(document).on('click', '.shop-archive__filter-content', function(e) {
      e.stopPropagation();
    });
    
    // Otwarcie modalu mobilnego
    $('#mobile-filter-open').on('click', openMobileModal);
    
    // Zamknięcie modalu mobilnego
    $('#mobile-filter-close, #mobile-filter-close-overlay').on('click', closeMobileModal);
    
    // Zastosowanie filtrów w modalu
    $('#mobile-filter-apply').on('click', closeMobileModal);
    
    // Reset filtrów w modalu
    $('#mobile-filter-reset').on('click', function() {
      if (typeof FWP !== 'undefined') {
        FWP.reset();
      }
    });
    
    // Escape key dla zamknięcia modalu
    $(document).on('keydown', function(e) {
      if (e.keyCode === 27 && state.modalOpen) {
        closeMobileModal();
      }
    });
  }
  
  // Przełączanie filtra (desktop)
  function toggleFilter(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const $filterItem = $(this).closest('.shop-archive__filter-item');
    const filterName = $filterItem.data('filter');
    
    // Jeśli kliknięto aktywny filtr, zamknij go
    if ($filterItem.hasClass('active')) {
      $filterItem.removeClass('active');
      state.activeFilter = null;
    } else {
      // Zamknij inne filtry
      $('.shop-archive__filter-item').removeClass('active');
      
      // Aktywuj ten filtr
      $filterItem.addClass('active');
      state.activeFilter = filterName;
    }
  }
  
  // Zamknięcie wszystkich filtrów (desktop)
  function closeAllFilters() {
    $('.shop-archive__filter-item').removeClass('active');
    state.activeFilter = null;
  }
  
  // Otwarcie modalu mobilnego
  function openMobileModal() {
    const $modal = $('#mobile-filters-modal');
    
    // Pokaż tylko filtry które nie są puste
    $('.shop-archive__mobile-filter').each(function() {
      const filterName = $(this).data('filter');
      const isEmpty = state.emptyFilters.includes(filterName);
      
      if (isEmpty) {
        $(this).hide();
      } else {
        $(this).show();
      }
    });
    
    // Aktywuj modal
    $modal.addClass('active');
    $('body').css('overflow', 'hidden'); // Prevent background scrolling
    
    state.modalOpen = true;
  }
  
  // Zamknięcie modalu mobilnego
  function closeMobileModal() {
    const $modal = $('#mobile-filters-modal');
    
    // Zamknij modal
    $modal.removeClass('active');
    $('body').css('overflow', ''); // Restore scrolling
    
    state.modalOpen = false;
  }
  
  // Obsługa zdarzenia przed odświeżeniem FacetWP
  function handleFacetWPRefresh() {
    // Nie rób nic specjalnego podczas refresh
  }
  
  // Obsługa zdarzenia po załadowaniu FacetWP
  function handleFacetWPLoaded() {
    // Małe opóźnienie żeby FacetWP się w pełni załadował
    setTimeout(function() {
      updateFilterCounts();
      handleEmptyFilters();
      
      // Jeśli był aktywny filtr, ponownie go otwórz (o ile jest nadal widoczny)
      if (state.activeFilter) {
        const $activeItem = $(`.shop-archive__filter-item[data-filter="${state.activeFilter}"]`);
        if ($activeItem.is(':visible')) {
          $activeItem.addClass('active');
        } else {
          // Jeśli aktywny filtr zniknął, wyczyść stan
          state.activeFilter = null;
        }
      }
      
      // Jeśli modal jest otwarty, zaktualizuj widoczność filtrów
      if (state.modalOpen) {
        $('.shop-archive__mobile-filter').each(function() {
          const filterName = $(this).data('filter');
          const isEmpty = state.emptyFilters.includes(filterName);
          
          if (isEmpty) {
            $(this).hide();
          } else {
            $(this).show();
          }
        });
      }
    }, 50);
  }
  
  // Obsługa pustych filtrów - ukrywanie/pokazywanie
  function handleEmptyFilters() {
    if (typeof FWP === 'undefined' || typeof FWP.settings === 'undefined' || 
        typeof FWP.settings.num_choices === 'undefined') {
      return;
    }
    
    // Wyczyść tablicę pustych filtrów
    state.emptyFilters = [];
    
    // Sprawdź wszystkie facety
    for (const facetName in FWP.settings.num_choices) {
      if (facetName === 'reset') continue;
      
      const choices = FWP.settings.num_choices[facetName];
      const isEmpty = choices === 0;
      const $desktopFilterItem = $(`.shop-archive__filter-item[data-filter="${facetName}"]`);
      const $mobileFilterItem = $(`.shop-archive__mobile-filter[data-filter="${facetName}"]`);
      
      if (isEmpty) {
        // Jeśli facet jest pusty, ukryj go w obu miejscach
        $desktopFilterItem.hide();
        $mobileFilterItem.hide();
        state.emptyFilters.push(facetName);
      } else {
        // Jeśli facet ma opcje, pokaż go w obu miejscach
        $desktopFilterItem.show();
        // Mobile filter pokazujemy tylko jeśli modal jest otwarty
        if (state.modalOpen) {
          $mobileFilterItem.show();
        }
      }
    }
    
    // Sprawdź dodatkowe opcje - obsługa różnych typów facetów
    $('.shop-archive__filter-item').each(function() {
      const $item = $(this);
      const facetName = $item.data('filter');
      
      // Jeśli filtr nie jest już oznaczony jako pusty
      if (!state.emptyFilters.includes(facetName)) {
        // Sprawdź, czy zawiera jakiekolwiek opcje lub inne elementy interaktywne
        const $facet = $item.find('.facetwp-facet');
        const hasOptions = checkFacetHasOptions($facet);
        
        if (!hasOptions) {
          const $mobileFilterItem = $(`.shop-archive__mobile-filter[data-filter="${facetName}"]`);
          $item.hide();
          $mobileFilterItem.hide();
          state.emptyFilters.push(facetName);
        }
      }
    });
  }
  
  // Sprawdź czy facet ma dostępne opcje
  function checkFacetHasOptions($facet) {
    return $facet.find('.facetwp-checkbox').length > 0 || 
           $facet.find('.facetwp-radio').length > 0 || 
           $facet.find('.facetwp-link').length > 0 ||
           $facet.find('select option').length > 1 || // Uwzględnij dropdown
           $facet.find('input[type="text"]').length > 0 || // Uwzględnij pola tekstowe
           $facet.find('input[type="search"]').length > 0;
  }
  
  // Aktualizacja liczników filtrów
  function updateFilterCounts() {
    if (typeof FWP === 'undefined') return;
    
    let totalActiveFilters = 0;
    
    // Przejdź przez wszystkie facety
    for (const facetName in FWP.facets) {
      if (facetName === 'reset') continue;
      
      const facetData = FWP.facets[facetName];
      let count = 0;
      
      // Różne typy facetów
      if (Array.isArray(facetData)) {
        count = facetData.length;
      } else if (typeof facetData === 'object' && facetData !== null) {
        if (facetData.min !== undefined && facetData.max !== undefined) {
          if (facetData.min !== '' || facetData.max !== '') {
            count = 1;
          }
        }
      } else if (facetData !== '' && facetData !== null && facetData !== undefined) {
        count = 1;
      }
      
      // Zapisz liczbę w stanie
      state.filters[facetName] = count;
      
      // Aktualizuj licznik na przycisku desktop
      const $filterItem = $(`.shop-archive__filter-item[data-filter="${facetName}"]`);
      const $counter = $filterItem.find('.shop-archive__filter-count');
      
      if (count > 0) {
        $counter.text(count);
      } else {
        $counter.empty();
      }
      
      // Zwiększ licznik całkowity
      totalActiveFilters += count;
    }
    
    // Aktualizuj licznik na przycisku mobilnym
    const $mobileCounter = $('.shop-archive__mobile-count');
    if (totalActiveFilters > 0) {
      $mobileCounter.text(totalActiveFilters);
    } else {
      $mobileCounter.empty();
    }
  }
  
  // Debug funkcja
  function debugFilters() {
    console.log('=== DEBUG FILTERS ===');
    console.log('FWP dostępne:', typeof FWP !== 'undefined');
    console.log('Stan filtrów:', state.filters);
    console.log('Puste filtry:', state.emptyFilters);
    console.log('Modal otwarty:', state.modalOpen);
    
    if (typeof FWP !== 'undefined') {
      console.log('FWP.facets:', FWP.facets);
      console.log('FWP.settings.num_choices:', FWP.settings.num_choices);
    }
    
    $('.shop-archive__filter-item').each(function() {
      const filterName = $(this).data('filter');
      console.log(`Desktop filter ${filterName}:`, {
        visible: $(this).is(':visible'),
        hasContent: checkFacetHasOptions($(this).find('.facetwp-facet'))
      });
    });
    
    $('.shop-archive__mobile-filter').each(function() {
      const filterName = $(this).data('filter');
      console.log(`Mobile filter ${filterName}:`, {
        visible: $(this).is(':visible'),
        hasContent: checkFacetHasOptions($(this).find('.facetwp-facet'))
      });
    });
  }
  
  // Dodaj debug do window dla testów w konsoli
  window.debugFilters = debugFilters;
  
  // Nasłuchuj na załadowanie dokumentu
  $(document).ready(init);
  
})(jQuery);